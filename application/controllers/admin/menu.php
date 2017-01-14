<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('menu_model');		
	}
	
	public function index()
	{
		$data['template'] = "admin/menu/list";
		$data['sorted_list']= $this->menu_model->get_menu_tree();
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->menu_model->get_datatable($this->access);
	}
	public function update_order()
	{
		$data=$this->input->post(NULL,TRUE);
		$this->menu_model->UpdateMenuOrder($data);
		$this->session->set_flashdata('message', 'Order updated successfully.');
		redirect('admin/menu/');
	}

	public function add()
	{
		$data['parent_list'] = $this->menu_model->get_all(); // Parent Menu List
		$data['menu_list'] = $this->menu_model->get_all_menus(); // Menu Positions list
		$data['template'] = "admin/menu/add";
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{
		$data['parent_list'] = $this->menu_model->get_all(); // Parent Menu List
		$data['menu_list'] = $this->menu_model->get_all_menus(); // Menu Positions list		
		$data['data'] = $this->menu_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/menu/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		$this->menu_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/menu/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');				
		
		$this->form_validation->set_rules('MenuID' , 'Menu Position' ,'required');		
		$this->form_validation->set_rules('Title' , 'Title' ,'required');
		$this->form_validation->set_rules('Url' , 'Url' ,'');		

		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL,TRUE);
			$data['Status'] = isset($data['Status'])?"Enabled":"Disabled"; 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			
			$this->menu_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/menu/");
		}
	}		

	public function update()
	{
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];		
		$this->load->library('form_validation');		
				
		$this->form_validation->set_rules('HeadTitle' , 'HeadTitle' ,'');
		$this->form_validation->set_rules('Title' , 'Title' ,'');
		$this->form_validation->set_rules('Content' , 'Content' ,'');
		$this->form_validation->set_rules('MetaKeyword' , 'Meta Keyword' ,'');
		$this->form_validation->set_rules('MetaDescription' , 'Meta Description' ,'');		

		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);						
			$data['Status'] = isset($data['Status'])?"Enabled":"Disabled"; 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
						
			$this->menu_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/menu/");
		}
	}
}

/* End of file menu.php */
/* Location: ./application/controllers/admin/menu.php */