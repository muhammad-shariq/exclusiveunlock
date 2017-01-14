<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuration extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('configuration_model');		
	}
	
	public function index()
	{
		$data['data'] = $this->configuration_model->get_all();
		$data['template'] = "admin/configuration";
		$this->load->view('admin/master_template',$data);
	}
	
	public function update()
	{
		$this->load->library('form_validation');
		$this->load->library('image_lib');
				
		$this->form_validation->set_rules('ApplicationName' , 'Application Name' ,'required');
		$this->form_validation->set_rules('ApplicationURL' , 'Application URL' ,'required');
		$this->form_validation->set_rules('AnalyticsCode' , 'Analytics Code' ,'');
		$this->form_validation->set_rules('FaceBook' , 'Facebook' ,'');
		$this->form_validation->set_rules('Twitter' , 'Twitter' ,'');
		$this->form_validation->set_rules('LinkedIn' , 'Linked In' ,'');
		$this->form_validation->set_rules('GooglePlus' , 'Google Plus' ,'');
		$this->form_validation->set_rules('Skype' , 'Skype' ,'');
		$this->form_validation->set_rules('CallUs' , 'Call Us' ,'');
		$this->form_validation->set_rules('CurrencyCode' , 'Currency Code' ,'');																										

		if($this->form_validation->run() === FALSE)
		{
			$this->index();
		}
		else
		{
			$data = $this->input->post(NULL,TRUE);		
			$data['Status'] = isset($data['Status'])?"Online":"Offline";				
			$this->configuration_model->update($data);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/configuration/");
		}
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/admin/welcome.php */