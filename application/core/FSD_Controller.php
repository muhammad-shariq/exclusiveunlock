<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FSD_Controller extends CI_Controller
{		
	 public function __construct()
	 {
	 	parent::__construct();
		$this->load->model('employee_model');
	 }
	 
	 public function authorization() 
	 {	 	
	 	if( $this->session->userdata('is_admin_logged_in') === FALSE)
	   	{
	 		redirect('admin/session/?return_url='.str_replace($this->config->item('url_suffix'), "", current_url()));	
	   	}
	 }	 

	
	 public function get_configuration() 
	 {
	 	
	 	$this->load->model('configuration_model');
	 	$config = $this->configuration_model->get_all();
		$this->ApplicationName = $config[0]['ApplicationName'];
		$this->Twitter = $config[0]['Twitter'];
	 	$this->FaceBook = $config[0]['FaceBook'];	 	
	 	$this->GooglePlus = $config[0]['GooglePlus'];
	 	$this->LinkedIn = $config[0]['LinkedIn'];
		$this->Email = $config[0]['Email'];
	 	$this->CallUs = $config[0]['CallUs'];
		$this->Skype = $config[0]['Skype'];
	 	$this->AnalyticsCode = $config[0]['AnalyticsCode'];
		$this->CurrencyCode = $config[0]['CurrencyCode'];
		$this->SiteStatus = $config[0]['Status'];
	 	if($this->SiteStatus=="Offline")
	 		die("Site Under Maintainance");
	 }
	
	 public function member_authorization() 
	 {  
	 	if( $this->session->userdata('is_member_logged_in') === FALSE)
	   	{	   		
	 		redirect('login.html?return_url='.str_replace($this->config->item('url_suffix'), "", current_url()));	
	   	}
	   	else 
	   	{
	   		$this->get_configuration();
	   	}
	 }
	 
	 public function supplier_authorization() 
	 {  
	 	if( $this->session->userdata('is_supplier_logged_in') === FALSE)
	   	{	   		
	 		redirect('supplier/session/?return_url='.str_replace($this->config->item('url_suffix'), "", current_url()));	
	   	}
	 }
	 
	 public function member_login()
	 {
	 	if( $this->session->userdata('is_member_logged_in') != FALSE)	 	
		{
			redirect('member/dashboard');
		}
	 }	 
}