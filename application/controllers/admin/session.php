<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Session extends CI_Controller
{
	public function session()
	{
		parent::__construct();
		$this->load->model('employee_model');
		$this->load->model('autoresponder_model');
	}

	public function index()
	{
		if( $this->session->userdata('is_admin_logged_in') === FALSE)
			$this->load->view("admin/login");
		else
			redirect('admin');
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email|min_length[4]');
		$this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[4]|max_length[32]');

		if ($this->form_validation->run() !== FALSE)
		{
			$result = $this->employee_model->get_where(
						array(
							'Email' => $this->input->post('Email'),
							'Password' => md5($this->input->post('Password')),
							'Status' => 'Enabled'
						)
					);
			
			if (count($result)>0)
			{
				$data = array(
					'employee_id' => $result[0]["ID"],
					'full_name' => $result[0]["FirstName"]." ".$result[0]["LastName"],
                    'email' => $result[0]["Email"],
                    'is_admin_logged_in' => TRUE
				);
				$this->session->set_userdata($data);
				
				if($this->input->post('return_url')!="")
					redirect($this->input->post('return_url'));
				else
					redirect("admin");
			}
			$this->session->set_flashdata("error", "Invalid Email or Password");
			redirect("admin/session");
		}
		$this->index();
	}

	public function forgot_password()
	{
		$this->load->library('form_validation');	
		$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email|min_length[4]');
		if($this->form_validation->run() !== FALSE)
		{
			$email = $this->input->post('Email',TRUE);
			$employee = $this->employee_model->get_where(array('Email'=> $email, 'Status' => 'Enabled'));			
			if(count($employee)>0)
			{
				$token = $employee[0]['ID']."-".rand(12345,54321); 
				$this->employee_model->update(array('Token' => $token), $employee[0]['ID']);
				
				## Get Issue Email Template ##
				$data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 4)); // Forgot Password Token Email					
				## Send Email with Template ## 		
				if(isset($data) && count($data)>0)
				{
					$from_name = $data[0]['FromName'];
					$from_email = $data[0]['FromEmail'];
					$to_email = $data[0]['ToEmail'];
					$subject = $data[0]['Subject'];
					$message = html_entity_decode($data[0]['Message']);
					
					//Information
					$post['TOKEN_URL'] = site_url('admin/session/set_password/'.$token);
					$post['FirstName'] = $employee[0]['FirstName'];
					$post['LastName'] = $employee[0]['LastName'];
					$post['Email'] = $employee[0]['Email'];
			
					$this->fsd->email_template($post, $from_email, $from_name, $to_email, $subject, $message );
					$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
					
					$this->session->set_flashdata("success","An email has been sent to your account.");
					redirect('admin/session/login');						
				}					
			}			
		}
		$this->session->set_flashdata("error", "Invalid email address.");
		redirect('admin/session/');
	}

	public function set_password($token)
	{
		if(empty($token))
			redirect('admin/session/');
		$data = $this->employee_model->get_where(array('Token'=> $token, 'Status' => 'Enabled'));
		if(count($data) > 0)
		{
			$length = 8;
			$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
			## Get Issue Email Template ##
			$template = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 5)); // Forgot Password Token Email					
			## Send Email with Template ## 		
			if(isset($template) && count($template)>0)
			{
				$from_name = $template[0]['FromName'];
				$from_email = $template[0]['FromEmail'];
				$to_email = $template[0]['ToEmail'];
				$subject = $template[0]['Subject'];
				$message = html_entity_decode($template[0]['Message']);
				
				//Information
				$post['Password'] = $password;
				$post['FirstName'] = $data[0]['FirstName'];
				$post['LastName'] = $data[0]['LastName'];
				$post['Email'] = $data[0]['Email'];
		
				$this->fsd->email_template($post, $from_email, $from_name, $to_email, $subject, $message );
				$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
				
				$userdata = array('Token' => NULL, 'Password' => md5($password) );
				$update = $this->employee_model->update($userdata, $data[0]['ID']);
				$this->session->set_flashdata("success", "Your new password has been sent to your email account.");
				redirect('admin/session/');						
			}				 				
		}
		$this->session->set_flashdata("error","Invalid token URL.");
		redirect('admin/session/');
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}