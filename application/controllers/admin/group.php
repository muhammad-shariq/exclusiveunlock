<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('group_model');
		$this->load->model('member_model');		
	}
	
	public function index()
	{
		$data['template'] = "admin/group/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->group_model->get_datatable($this->access);
	}

	public function add()
	{
		$data['template'] = "admin/group/add";
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{		
		$data['data'] = $this->group_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/group/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		if($id == 1)
		{
			$this->session->set_flashdata('warning', 'Default group can not be delete.');
			redirect("admin/group/");
		}
		
		$c = $this->member_model->count_where(array('MemberGroupID' => $id));
		if($c > 0)
		{
			$this->session->set_flashdata('warning', 'This group can not be delete, It has '.$c.' members.');
			redirect("admin/group/");
		}		
		$this->group_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/group/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');				
		
		$this->form_validation->set_rules('Title' , 'Title' ,'required');
		$this->form_validation->set_rules('Discount' , 'Discount' ,'required|numeric');	

		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL, TRUE);	
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			$groupid = $this->group_model->insert($data); //insert group and return id
			
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/group/");
		}
	}		

	public function update()
	{
		$this->load->library('form_validation');
		$data = $this->input->post(NULL, TRUE);
		$id = $data['ID'];		
				
		$this->form_validation->set_rules('Title' , 'Title' ,'required');
		$this->form_validation->set_rules('Discount' , 'Discount' ,'required|numeric');		
		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);					
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$this->group_model->update($data, $id);
			
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/group/");
		}
	}
}

/* End of file group.php */
/* Location: ./application/controllers/admin/group.php */