<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class checkout extends FSD_Controller 
{
	var $before_filter = array('name' => 'member_authorization', 'except' => array());
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('merchant');
		$this->merchant->load('paypal_express');
		$this->load->model('payment_model');
	}
	
	public function index()
	{
		$this->form_validation->set_rules('Credit', 'Credit', 'required|');
		 if ($this->form_validation->run() == FALSE)
	      {
	      	$this->session->set_flashdata("fail","Invalid Credit");
	        redirect('member/checkout');
	      }
	      else
	      {
	      		### Get Paypal settings
	      		$paypal_settings = $this->payment_model->get_where(array('ID'=>1));
	      		
	      		### Initilize settings	      		
		      	$settings = array(
				    'username' => $paypal_settings[0]['UserName'],
				    'password' => $paypal_settings[0]['Password'],
				    'signature' => $paypal_settings[0]['Signature'],
				    'test_mode' => true
					);
				$this->merchant->initialize($settings);
				
				### Set amount on the basis of percent
				$amount = $this->input->post('Credit');
				if($paypal_settings > 0)
				{
					$percent = ( ( $amount * $paypal_settings[0]['percent'] ) / 100 );
					$amount += $percent;
				}
				$this->session->set_userdata('addcredit',$amount);
				
				### set paramerters for paypals
				$params = array(
		    	'amount' => $amount,
		    	'currency' => $paypal_settings[0]['Currency'],
		    	'return_url' => 'http://demo.unlocknetwork.co.uk/index.php/member/checkout/complete',
		    	'cancel_url' => 'http://demo.unlocknetwork.co.uk/index.php/member/checkout/cancel');		
				$response = $this->merchant->purchase($params);		
		  }
		
		
	}
	
	function cancel()
	{
		$this->session->set_userdata('addcredit',"");
		redirect('member/dashboard');
	}
	
	function complete()
	{
		$this->load->library('merchant');
		$this->merchant->load('paypal_express');
		### Get Paypal settings
	    $paypal_settings = $this->payment_model->get_where(array('ID'=>1));

	    ### Initilize settings	      		
		$settings = array(
				    'username' => $paypal_settings[0]['UserName'],
				    'password' => $paypal_settings[0]['Password'],
				    'signature' => $paypal_settings[0]['Signature'],
				    'test_mode' => true
					);
		$this->merchant->initialize($settings);
		
		$params = array(
		    	'amount' => $this->session->userdata('addcredit'),
		    	'currency' => $paypal_settings[0]['Currency'],
		    	'return_url' => 'http://demo.unlocknetwork.co.uk/index.php/member/checkout/complete',
		    	'cancel_url' => 'http://demo.unlocknetwork.co.uk/index.php/member/checkout/cancel');
		
		$this->merchant->initialize($settings);
		
		$response = $this->merchant->purchase_return($params);
		
		if ($response->status() == Merchant_response::COMPLETE)
		{
		    if ($response->success())
			{
				$this->load->model('credit_model');
				$credit_data = array(
				'MemberID' => $this->session->userdata('MemberID'),
				'TransactionCode' => 'PCK',
				'TransactionID' => $_GET['PayerID'],
				'Description' => "Add Credit from Paypal",
				'Amount' => $this->session->userdata('addcredit'),
				'CreatedDateTime' => date("Y-m-d H:i:s")
				);
				$this->credit_model->insert($credit_data);
				
				$this->session->set_flashdata("success","Your credit added successfully");
				redirect('member/dashboard/addfund');
			}
			else {
				$this->session->set_flashdata("fail","Invalid Credit");
				redirect('member/dashboard/addfund');
			}
		}
		else {
			$this->session->set_flashdata("fail","Invalid Credit");
			redirect('member/dashboard/addfund');
		}
	}
}