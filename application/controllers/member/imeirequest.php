<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class imeirequest extends FSD_Controller 
{
	var $before_filter = array('name' => 'member_authorization', 'except' => array());
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('method_model');
		$this->load->model('brand_model');
		$this->load->model('provider_model');
		$this->load->model('menu_model');
		$this->load->model('network_model');
		$this->load->model('imeiorder_model');
		$this->load->model('credit_model');
		$this->load->model("servicemodel_model");		
		$this->load->model("mep_model");
	}
	
	########### IMEI Order Request Form display #######################################
	
	public function index()
	{
		$data = array();
		$data['menu_header'] = $this->menu_model->get_tree((array('MenuID'=>1, 'ParentID'=>null,'Status'=>'Enabled')),1);
		$data['Title'] = "Imei Request";
		$data['imeimethods'] = $this->method_model->method_with_networks();
		$data['template'] = "member/imei/request";
		$id = $this->session->userdata('MemberID');
		$data['credit'] = $this->credit_model->get_credit($id);
		if($data['credit'][0]['credit'] == ""  )
		{
			$data['credit'][0]['credit'] = 0;
		}
		$this->load->view('mastertemplate',$data);
	}
	
	######################## Verify Imei Request FOrm display #########################
	
	public function verify()
	{
		$data = array();
		$data['menu_header'] = $this->menu_model->get_tree((array('MenuID'=>1, 'ParentID'=>null,'Status'=>'Enabled')),1);
		$data['Title'] = "Verify Imei Request";
		$data['imeimethods'] = $this->method_model->get_where(array('Status'=> 'Enabled'));
		$data['template'] = "member/imei/verifyrequest";
		$id = $this->session->userdata('MemberID');
		$data['credit'] = $this->credit_model->get_credit($id);
		if($data['credit'][0]['credit'] == ""  )
		{
			$data['credit'][0]['credit'] = 0;
		}
		$this->load->view('mastertemplate',$data);
	}
	
	######################## Insert Verify Imei Request  #########################
	
	public function verifyinsert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('orderid' , 'order id' ,'required');
		$this->form_validation->set_rules('code' , 'code' ,'required');
		$this->form_validation->set_rules('imei' , 'imei' ,'required');
		if($this->form_validation->run() === FALSE)	
		{
			$this->session->set_flashdata("fail","Please Fill All required Fields");
			$this->index();	
		}
		else 
		{
			$data = $this->input->post(NULL,TRUE);
			
			$order_data = $this->imeiorder_model->get_order_details(array('gsm_imei_orders.ID' => $data['orderid'], 'gsm_imei_orders.IMEI' => $data['imei'], 'gsm_imei_orders.Code' => $data['code'] ));
			
			if(!empty($order_data))
			{
				if($order_data[0]['verify'] == 0 )
				{
					$update['verify'] = 1;
					$update['Status'] = 'Verified';
					$update['UpdatedDateTime'] = date("Y-m-d H:i:s");
					
					$this->imeiorder_model->update($update,$data['orderid']);
					
					$this->session->set_flashdata("success","Your request submitted");
					redirect(site_url('member/imeirequest/verify'));
				}
				else 
				{
					$this->session->set_flashdata("fail","You already have verify request before");
					redirect(site_url('member/imeirequest/verify'));
				}
			}
			else 
			{
				$this->session->set_flashdata("fail","Your Record Not Found.");
				redirect(site_url('member/imeirequest/verify'));
			}
			
		}
	}
		
	################# Ajax form request fields shown according to database criteria ####
	
	public function formfields()
	{
		if($this->input->is_ajax_request() === TRUE && $this->input->post('MethodID') !== FALSE)
		{
			$member_id = $this->session->userdata('MemberID');
			$id = $this->input->post('MethodID');	
			
			$method = $this->method_model->get_where(array('ID' => $id));			
			$pricing = $this->method_model->get_user_price($member_id, $id);
			
			$data['price'] = floatval($pricing[0]['Price']);
			$data['delivery_time'] = $method[0]['DeliveryTime'];
			$data['description'] = $method[0]['Description'];
			
			## DropDowns ##
			$data['providers'] = $method[0]['Network'] == 1? $this->provider_model->get_where(array('MethodID' => $id)):NULL;
			$data['models'] = $method[0]['Mobile'] == 1? $this->servicemodel_model->get_where(array('MethodID' => $id)):NULL;
			$data['meps'] = $method[0]['MEP'] == 1? $this->mep_model->get_where(array('MethodID' => $id)):NULL;
			## Text Boxes ##
			$data['pin'] = $method[0]['PIN'] == 1? TRUE:FALSE;
			$data['kbh'] = $method[0]['KBH'] == 1? TRUE:FALSE;
			$data['prd'] = $method[0]['PRD'] == 1? TRUE:FALSE;
			$data['type'] = $method[0]['Type'] == 1? TRUE:FALSE;
			$data['locks'] = $method[0]['Locks'] == 1? TRUE:FALSE;
			$data['serial_number'] = $method[0]['SerialNumber'] == 1? TRUE:FALSE;
			$data['reference'] = $method[0]['Reference'] == 1? TRUE:FALSE;			
			
			//var_dump($data); exit;
			$this->load->view("member/imei/loadrequiredfield", $data);
		}
	}
	
	###### Place IMER Request Order and deduct charges ################################
	
	public function insert()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('MethodID' , 'Method' ,'required');
		$this->form_validation->set_rules('IMEI' , 'IMEI' ,'trim|required|callback_imei_check');
		$this->form_validation->set_rules('Email' , 'Email' ,'valid_email');
		if($this->form_validation->run() === FALSE)	
		{
			$this->index();	
		}
		else 
		{
			$data = $this->input->post(NULL, TRUE);
			$method_id = $data['MethodID'];
			$member_id = $this->session->userdata('MemberID');
			$credit = $this->credit_model->get_credit($member_id);
			$pricing = $this->method_model->get_user_price($member_id, $method_id);
			$price = $pricing[0]['Price'];
			
			#### Get IMEI CODES,Count Requests For Orders check Credit
			$imei_data = explode(PHP_EOL, $data['IMEI']);			
			$total_price = count($imei_data) * $price;

			if($total_price > $credit[0]['credit'] )
			{
				$this->session->set_flashdata('fail', " You have not enough credit for the request.");
				redirect("member/imeirequest/");
			}
			
			#### Place Order			
			foreach($imei_data as $key => $val)
			{
				$insert = array();
				$insert['MethodID'] = $method_id;
				$insert['IMEI'] = $val;
				$insert['Email'] = $data['Email'];

				$insert['MemberID'] = $member_id;
				$insert['Maker'] = array_key_exists("Maker", $data)? $data['Maker']: NULL;
				$insert['Model'] = array_key_exists("Model", $data)? $data['Model']: NULL;				
				## API Fields ##
				//$insert['NetworkID'] = array_key_exists("Network", $data)? $data['Network']:NULL;
				$insert['SerialNumber'] = array_key_exists("SerialNumber", $data)? $data['SerialNumber']: NULL;
				$insert['ModelID'] = array_key_exists("ModelID", $data)? $data['ModelID']: NULL;				
				$insert['ProviderID'] = array_key_exists("ProviderID", $data)? $data['ProviderID']: NULL;
				$insert['MEPID'] = array_key_exists("MEPID", $data)? $data['MEPID']: NULL;
				$insert['PIN'] = array_key_exists("PIN", $data)? $data['PIN']: NULL;
				$insert['KBH'] = array_key_exists("KBH", $data)? $data['KBH']: NULL;
				$insert['PRD'] = array_key_exists("PRD", $data)? $data['PRD']: NULL;
				$insert['Type'] = array_key_exists("Type", $data)? $data['Type']: NULL;
				$insert['Locks'] = array_key_exists("Locks", $data)? $data['Locks']: NULL;
				$insert['Reference'] = array_key_exists("Reference", $data)? $data['Reference']: NULL;
				
				$insert['Note'] = $data['Note'];
				$insert['Status'] = 'Pending';
				$insert['UpdatedDateTime'] = date("Y-m-d H:i:s");				
				$insert['CreatedDateTime'] = date("Y-m-d H:i:s");		
				
				$insert_id = $this->imeiorder_model->insert($insert);
				
				#####Deduct Credits from available credits
				$credit_data = array(
					'MemberID' => $member_id,
					'TransactionCode' => IMEI_CODE_REQUEST,
					'TransactionID' => $insert_id,
					'Description' => "IMEI Code request against imei:".$val,
					'Amount' => -1 * abs($price),
					'CreatedDateTime' => date("Y-m-d H:i:s")
				);
				$this->credit_model->insert($credit_data);
			}						
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("member/imeirequest/");
		}
	}
	
	public function history()
	{
		$data = array();
		//$data['menu_header'] = $this->menu_model->get_tree((array('MenuID'=>1, 'ParentID'=>null,'Status'=>'Enabled')),1);
		$id = $this->session->userdata('MemberID');
		$data['Title'] = "IMEI Service History";
		$data['template'] = "member/imei/history";
		$data['credit'] = $this->credit_model->get_credit($id);
		if($data['credit'][0]['credit'] == ""  )
		{
			$data['credit'][0]['credit'] = 0;
		}
		$this->load->view('mastertemplate',$data);
	}
	
	public function listener($status)
	{
		$id = $this->session->userdata('MemberID');
		echo $this->imeiorder_model->get_imei_data_select($id, $status);
	}
	
	/* IMEI Validation */
	public function imei_check($str)
	{
		$imeis = explode(PHP_EOL, $str);		
		$imeis = array_unique($imeis);
		
		foreach($imeis as $imei)
		{	
			if( is_numeric($imei) && TRUE !== $this->is_imei($imei) ) 
			{
				$this->form_validation->set_message('imei_check', 'One or more IMEI(s) are invalid.');
				return FALSE;
			}			
		}
		return TRUE;		
	}
	
	private function is_imei($imei)
	{
		// Should be 15 digits
		if(strlen($imei) != 15 || !ctype_digit($imei))
			return false;
		// Get digits
		$digits = str_split($imei);
		// Remove last digit, and store it
		$imei_last = array_pop($digits);
		// Create log
		$log = array();
		// Loop through digits
		foreach($digits as $key => $n)
		{
			// If key is odd, then count is even
			if($key & 1)
			{
				// Get double digits
				$double = str_split($n * 2);
				// Sum double digits
				$n = array_sum($double);
			}
			// Append log
			$log[] = $n;
		}
		// Sum log & multiply by 9
		$sum = array_sum($log) * 9;
		// Compare the last digit with $imei_last
		return substr($sum, -1) == $imei_last;
	}
}