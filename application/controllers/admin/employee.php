<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('employee_model');
	}
	
	public function index()
	{
		$data['template'] = "admin/employee/list";
		
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->employee_model->get_datatable($this->access);
	}

	public function add()
	{
		$data['template'] = "admin/employee/add";
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{		
		$data['data'] = $this->employee_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/employee/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		if($id == 1)
		{
			$this->session->set_flashdata('info', 'This account can not be delete.');
			redirect("admin/employee/");			
		}
		$this->employee_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/employee/");
	}

	public function roles($id)
	{
		$data['data'] = $this->employee_model->get_roles(array('hr_modules_access.EmployeeID' => $id ));
		$data['template'] = "admin/employee/roles";
		$this->load->view('admin/master_template',$data);
	}
	
	public function insert()
	{
		$this->load->library('form_validation');			
		
		$this->form_validation->set_rules('FirstName' , 'FirstName' ,'required');		
		$this->form_validation->set_rules('LastName' , 'LastName' ,'required');
		$this->form_validation->set_rules('Email' , 'Email' ,'required|valid_email|is_unique[hr_employees.Email]');
		$this->form_validation->set_rules('Password' , 'Password' ,'required|min_length[6]');
		## set custom validation error messages ##
		$this->form_validation->set_message('is_unique', "This email is already registered with us.");		

		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL, TRUE);
			$data['Password'] = md5($data['Password']);			 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			
			$this->employee_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/employee/");
		}
	}		

	public function update()
	{
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];
		$this->load->library('form_validation');		
				
		$this->form_validation->set_rules('FirstName' , 'FirstName' ,'required');		
		$this->form_validation->set_rules('LastName' , 'LastName' ,'required');
		$this->form_validation->set_rules('Password' , 'Password' ,'min_length[6]');		

		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);
			if(isset($data['Email']))
				unset($data['Email']);			
			if(empty($data['Password']))
				unset($data['Password']);
			else
				$data['Password'] = md5($data['Password']);
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
						
			$this->employee_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/employee/");
		}
	}
	
	public function save_roles()
	{
		$data = $this->input->post(Null, TRUE);
		if( array_key_exists("arr", $data) && count($data['arr']) > 0)
		{
			foreach ($data['arr'] as $key => $value) 
			{
				$update = array();
				if(!array_key_exists($key, $data['arr']))
				{
					$update['Add'] = "N";
					$update['Edit'] = "N";
					$update['View'] = "N";
					$update['Delete'] = "N";
				}
				if(array_key_exists('Add', $data['arr'][$key]))
				{
					$update['Add'] = $value['Add'];
				}else
					{$update['Add'] = "N";  }
				if(array_key_exists('Edit', $data['arr'][$key]))
				{
					$update['Edit'] = $value['Edit'];
				}else
					{ $update['Edit'] = "N";  }
				if(array_key_exists('View', $data['arr'][$key]))
				{
					$update['View'] = $value['View'];
				}else
					{ $update['View'] = "N";  }
				if(array_key_exists('Delete', $data['arr'][$key]))
				{
					$update['Delete'] = $value['Delete'];
				}else
					{ $update['Delete'] = "N";  }
				
				$update['ID'] = $key;
				
				$this->employee_model->update_roles($update, $key);								
			}
			$this->session->set_flashdata('success', 'Roles updated successfully.');
			redirect("admin/employee/");
		}
		$update = array('Add' => "N", 'Edit' => "N", 'View' => "N", 'Delete' => "N");
		$this->employee_model->disabled_roles($update,$data['EmployeeID']);
		$this->session->set_flashdata('success', 'Roles updated successfully.');
		redirect("admin/employee/");				
	}
    
	public function profile()
	{
        $id = $this->session->userdata('employee_id');
        if($this->input->server('REQUEST_METHOD') === 'POST')
        {            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('FirstName' , 'First Name' ,'required|min_length[3]|max_length[255]');		
            $this->form_validation->set_rules('LastName' , 'Last Name' ,'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('Password' , 'Current Password' ,'min_length[6]|max_length[255]|callback_password_check');
            $this->form_validation->set_rules('NewPassword' , 'New Password' ,'min_length[6]|max_length[255]');
            $this->form_validation->set_rules('ConfirmPassword' , 'Confirm Password' ,'min_length[6]|max_length[255]|matches[NewPassword]');		

            if($this->form_validation->run() !== FALSE)
            {
                $data = $this->input->post(NULL, TRUE);
                $data['Password'] = md5($data['NewPassword']);
                $data['UpdatedDateTime'] = date("Y-m-d H:i:s");
                
                unset($data['NewPassword']);
                unset($data['ConfirmPassword']);
                $this->employee_model->update($data, $id);
                $this->session->set_flashdata('success', 'Profile has been updated successfully.');
                redirect("admin/employee/profile");
            }            
        }
		$data['data'] = $this->employee_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/employee/profile";
		$this->load->view('admin/master_template', $data);		
	}
    
	public function password_check($str)
	{
        $result = $this->employee_model->get_where(
                    array(
                        'ID' => $this->session->userdata('employee_id'),
                        'Password' => md5($str),
                        'Status' => 'Enabled'
                    )
                );        
        if (count($result)>0)	
		{
			return TRUE;
		}
        $this->form_validation->set_message('password_check', 'The %s did not match with current %s.');
        return FALSE;        
	}        	
}

/* End of file employee.php */
/* Location: ./application/controllers/admin/employee.php */