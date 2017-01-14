<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('payment_model');
	}
	
	public function index()
	{
		$data['template'] = "admin/payment/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->payment_model->get_datatable($this->access);
	}

	public function add()
	{
		
		$data['template'] = "admin/payment/add";
		
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{
		$data['data'] = $this->payment_model->get_where(array('ID'=> $id));			
		$data['template'] = "admin/payment/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		//$id = $this->input->get('id',TRUE);
		$this->payment_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/payment/");
	}

	public function delete_selected()
	{
		$id = $this->input->get('id',TRUE);
		$this->payment_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/payment/");
	}
		
	public function insert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('UserName' , 'UserName' ,'required');
		$this->form_validation->set_rules('percent' , 'percent' ,'');
		$this->form_validation->set_rules('Signature' , 'Signature' ,'');
		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL,TRUE);	
			
			$this->payment_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/payment/");
		}
	}		

	public function update()
	{
		$this->load->library('form_validation');
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];		
				
		$this->form_validation->set_rules('Type' , 'Type' ,'required');
		$this->form_validation->set_rules('UserName' , 'UserName' ,'');
		$this->form_validation->set_rules('Password' , 'Password' ,'');
		$this->form_validation->set_rules('Signature' , 'Signature' ,'');
		$this->form_validation->set_rules('percent' , 'percent' ,'');
		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);					
						
			$this->payment_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/payment/");
		}
	}
			
}

/* End of file payment.php */
/* Location: ./application/controllers/admin/payment.php */