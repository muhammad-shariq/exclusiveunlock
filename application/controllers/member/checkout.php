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
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->form_validation->set_rules('Credit', 'Credit', 'required|numeric|greater_than_equal_to[5]');
			if($this->form_validation->run() === FALSE)
			{
				$this->session->set_flashdata("fail", validation_errors());
				redirect('member/dashboard/addfund');
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
					'test_mode' => TEST_MODE
					);
				$this->merchant->initialize($settings);
				
				### Set amount on the basis of percent
				$amount = $this->input->post('Credit');
				$this->session->set_userdata('addcredit', $amount);
				if($paypal_settings > 0)
				{
					$percent = ( ( $amount * $paypal_settings[0]['percent'] ) / 100 );
					$amount += $percent;
					$amount += 0.35; // PayPal extra fee
				}
				$this->session->set_userdata('addamount', $amount);
				
				### set paramerters for paypals
				$params = array(
					'amount' => $amount,
					'name' => 'Store Credits',
					'description' => 'Add Store Credits '. $this->input->post('Credit'),
					'currency' => $paypal_settings[0]['Currency'],
					'return_url' => site_url('member/checkout/complete'),
					'cancel_url' => site_url('member/checkout/cancel')
				);		
				$response = $this->merchant->purchase($params);		
			}
		}
		else
		{
			redirect('member/dashboard/addfund');
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
			'test_mode' => TEST_MODE
		);
		$this->merchant->initialize($settings);
		
		$params = array(
			'amount' => $this->session->userdata('addamount'),
			'name' => 'Store Credits',
			'description' => 'Add Store Credits '. $this->session->userdata('addcredit'),
			'currency' => $paypal_settings[0]['Currency'],
			'return_url' => site_url('member/checkout/complete'),
			'cancel_url' => site_url('member/checkout/cancel')
		);
		
		$this->merchant->initialize($settings);
		
		$response = $this->merchant->purchase_return($params);
		
		if ($response->status() == Merchant_response::COMPLETE)
		{
		    if ($response->success())
			{
				$this->load->model('credit_model');
				$credit_data = array(
				'MemberID' => $this->session->userdata('MemberID'),
				'TransactionCode' => PAYPAL_PAYMENT_RECEIVED,
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