<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('method_model');
		$this->load->model('group_model');		
	}
	
	public function index()
	{
		$data['template'] = "admin/member/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->member_model->get_datatable($this->access);
	}

	public function add()
	{
		$group_list= array('' => '');
		foreach ($this->group_model->get_all() as $key => $value) 
		{
			$group_list[$value['ID']] = $value['Title'];
		}
		$data['group_list'] = $group_list;
		$data['template'] = "admin/member/add";
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{
		$group_list= array('' => '');
		foreach ($this->group_model->get_all() as $key => $value) 
		{
			$group_list[$value['ID']] = $value['Title'];
		}
		$data['group_list'] = $group_list;		
		$data['data'] = $this->member_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/member/edit";
		
		$this->load->view('admin/master_template',$data);
	}
	
	
	public function editprice($id)
	{
		$data['methods'] = $this->method_model->get_all_user_price($id);
		$data['MemberID'] = $id;
		$data['template'] = "admin/member/editprice";
		//echo '<pre>';
		//print_r($data);
		//die();
		$this->load->view('admin/master_template',$data);				
	}
		
	public function delete($id)
	{
		$this->member_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/member/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');		
		
		$this->form_validation->set_rules('FirstName' , 'FirstName' ,'required');		
		$this->form_validation->set_rules('LastName' , 'LastName' ,'required');
		$this->form_validation->set_rules('Email' , 'Email' ,'required|email|is_unique[gsm_members.Email]');
		$this->form_validation->set_rules('Password' , 'Password' ,'required|min_length[6]');		
		$this->form_validation->set_rules('Mobile' , 'Mobile' ,'');
		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL,TRUE);			 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			
			$this->member_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/member/");
		}
	}		

	################# Edit Imei Method Price Individually ############
	
	public function editmethodprice($id = 0)
	{
		$data['methods'] = $this->member_model->get_all_method_member($id);
		$data['MemberID'] = $id;
		$data['template'] = "admin/member/editmethodprice";
		$this->load->view('admin/master_template',$data);						
	}
	
	############## Edit File Method Price Individually ############
	public function editfilemethodprice($id = 0)
	{
		$data['file_methods'] = $this->member_model->get_all_file_member_price($id);
		$data['MemberID'] = $id;
		$data['template'] = "admin/member/editfilemethodprice";
		$this->load->view('admin/master_template',$data);
	}
	
	###### Save changes Individually IMEI Method Prices #############
	
	function membermethod()
	{
		$data = $this->input->post(NULL,TRUE);
		$this->member_model->delete_method($data['ID']);
		for($a=0; $a<count($data['Title']); $a++)
		{
			$insert = array(
			'MemberID' => $data['ID'],
			'MethodID' => $data['MethodID'][$a],
			'Price' => $data['Title'][$a]
			);
			$this->member_model->insert_method($insert);
		}
		$this->session->set_flashdata('success', 'Method Price edit successfully.');
	    redirect("admin/member/");
		
	}
	
	###### Save changes Individually File Method Prices #############
	
	public function filemembermethod()
	{
		$data = $this->input->post(NULL,TRUE);
		$this->member_model->delete_filemethod($data['ID']);
		for($a=0; $a<count($data['Title']); $a++)
		{
			$insert = array(
			'MemberID' => $data['ID'],
			'FileServiceID' => $data['FileServiceID'][$a],
			'Price' => $data['Title'][$a]
			);
			$this->member_model->insert_filemethod($insert);
		}
		$this->session->set_flashdata('success', 'File Method Price edit successfully.');
	    redirect("admin/member/");
	}

	public function update()
	{
		$this->load->library('form_validation');	
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];
							
		$this->form_validation->set_rules('FirstName' , 'FirstName' ,'required');		
		$this->form_validation->set_rules('LastName' , 'LastName' ,'required');
		$this->form_validation->set_rules('Email' , 'Email' ,'required|email');
		$this->form_validation->set_rules('Password' , 'Password' ,'min_length[6]');
		$this->form_validation->set_rules('Mobile' , 'Mobile' ,'');
		
		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);					
			 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
						
			$this->member_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/member/");
		}
	}
}

/* End of file member.php */
/* Location: ./application/controllers/admin/member.php */