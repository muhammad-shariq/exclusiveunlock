<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Session extends CI_Controller
{
	public function session()
	{
		parent::__construct();
		$this->load->model('supplier_model');
	}

	public function index()
	{
		if( $this->session->userdata('is_supplier_logged_in') === FALSE)
			$this->load->view("supplier/login");
		else
			redirect('supplier');
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email|min_length[4]');
		$this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[4]|max_length[32]');

		if ($this->form_validation->run() !== FALSE)
		{
			$result = $this->supplier_model->get_where(
						array(
							'Email' => $this->input->post('Email'),
							'Password' => md5($this->input->post('Password')),
							'Status' => 'Enabled'
						)
					);
			
			if (count($result)>0)
			{
				$data = array(
					'supplier_id' => $result[0]["ID"],
					'full_name' => $result[0]["FirstName"]." ".$result[0]["LastName"],
                    'email' => $result[0]["Email"],
                    'is_supplier_logged_in' => TRUE
				);
				$this->session->set_userdata($data);
				
				if($this->input->post('return_url')!="")
					redirect($this->input->post('return_url'));
				else
					redirect("supplier");
			}
			else
			{
				$this->session->set_flashdata("notification", "Invalid Email or Password");
				redirect("supplier");
			}
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
			$data = $this->employee_model->get_where(array('Email'=> $email, 'Status' => 'Enabled'));			
			if(count($data)>0)
			{	 
				 $token = array(
				 'TokenUsed' => 0,
				 'Token' => $data[0]['ID']."-".rand(12345,54321)
				 );
				$this->employee_model->update($token,$data[0]['ID']);
				$this->session->set_flashdata("notification", "Your password link has been sent in your account");
				redirect('admin/session/login');
			}
			$this->session->set_flashdata("notification", "Your account not found.");			
			redirect('admin/session/login');
		}
		else
		{
			$this->session->set_flashdata("notification", "Invalid Email.");
			$this->login();
		}
	}

	function generate_password($token)
	{
		if(empty($token))
		{
			$this->session->set_flashdata("notification", "Invalid Token number.");
			$this->login();
		}
		else {
			$data = $this->employee_model->get_where(array('Token' => $token, 'Status' => 'Enabled' ));
			if(count($data) > 0)
			{
				$length = 8;
				$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
				
				//sends Email here
				//data u
				$userdata = array(
					'TokenUsed' => 1,
					'Token' => '',
					'Password' => md5($password)
				);
				$update = $this->employee_model->update($userdata,$data[0]['ID']);
				$this->session->set_flashdata("notification", "Password changed.");
				$this->login();
			}
			else 
			{
				$this->session->set_flashdata("notification", "Invalid Token number.");
				$this->login();
			}			
		}		
	}


	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}