<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('supplier_model');
		$this->load->model('method_model');	
	}
	
	public function index()
	{
		$data['template'] = "admin/supplier/list";
		
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->supplier_model->get_datatable($this->access);
	}

	public function add()
	{		
		$data['template'] = "admin/supplier/add";
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{		
		$data['data'] = $this->supplier_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/supplier/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		$this->supplier_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/supplier/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');		
		
		$this->form_validation->set_rules('FirstName' , 'FirstName' ,'required');		
		$this->form_validation->set_rules('LastName' , 'LastName' ,'required');
		$this->form_validation->set_rules('Email' , 'Email' ,'required|email|is_unique[gsm_suppliers.Email]');
		
		$this->form_validation->set_rules('Password' , 'Password' ,'required|min_length[6]');		
		$this->form_validation->set_rules('Mobile' , 'Mobile' ,'');
		
		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL,TRUE);		
			$data['Password'] = md5($data['Password']);	 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			
			$supplierid = $this->supplier_model->insert($data);
			$methods = $this->method_model->get_all();
			$methods_data = array();
			foreach($methods as $key => $val)
			{
				$methods_data[$key]['SupplierID'] = $supplierid;
				$methods_data[$key]['MethodID'] = $val['ID'];
				$methods_data[$key]['Price'] = $val['Price'];
				$methods_data[$key]['Status'] = "Disabled"; 
			}
			$this->method_model->insert_batch_suppliermethods($methods_data);				
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/supplier/");
		}
	}		

	public function update()
	{
		$this->load->library('form_validation');	
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];
							
		$this->form_validation->set_rules('FirstName' , 'FirstName' ,'required');		
		$this->form_validation->set_rules('LastName' , 'LastName' ,'required');
		$this->form_validation->set_rules('Email' , 'Email' ,'required|email');
		$this->form_validation->set_rules('Password' , 'Password' ,'required|min_length[6]');
		$this->form_validation->set_rules('Mobile' , 'Mobile' ,'');
		
		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);					
			 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['Password'] = md5($data['Password']);			
			$this->supplier_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/supplier/");
		}
	}
	
	public function suppliermethod()
	{
		$data = $this->input->post(NULL,TRUE);
		$count = count($data['Price']);
		$insert = array();
		if($count > 0)
		{
			
			for($a=0; $a<$count; $a++)
			{
				$insert[$a]['SupplierID'] = $data['ID'];
				$insert[$a]['MethodID'] = $data['MethodID'][$a];
				$insert[$a]['Price'] = $data['Price'][$a];
				$insert[$a]['Status'] = $data['Status'][$a];
			}
			
			$this->supplier_model->del_supplier_method($data['ID']);
			$this->method_model->insert_batch_suppliermethods($insert);
			$this->session->set_flashdata('success', 'Supplier Record updated successfully.');
			redirect("admin/supplier/");
		}
		$this->session->set_flashdata('success', 'Invalid Argument.');
		redirect("admin/supplier/");
	}
	
	public function editsupplier($id)
	{
		$data['methods'] = $this->supplier_model->get_all_method_supplier($id);
		$data['template'] = "admin/supplier/editsupplier";
		$data['id'] = $id;
		$this->load->view('admin/master_template',$data);		
	}
}

/* End of file supplier.php */
/* Location: ./application/controllers/admin/supplier.php */