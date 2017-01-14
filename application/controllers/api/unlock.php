<?php

class unlock extends FSD_Controller{
	
	const API_URL = 'http://unlocknetwork.co.uk/api/';
	private $api_key;
	private $debug;
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->library("clientapi/UnlocknetworkAPI");	
		$this->api_key = "5ed543c4-5c3b-11e4-a378-64815a41364d";
		$this->debug = FALSE;	
	}
	
	public function available_credit()
	{
		$obj = new UnlocknetworkAPI();
		$data = $obj->available_credit();
		echo ($data);
		
	}
	
	public function imei_service_list()
	{
		$obj = new UnlocknetworkAPI();
		$data = $obj->imei_service_list();
		$dataArray = json_decode($data, true);
		echo "<pre>";
		print_r($dataArray);
		die();
	}
	
	public function set_all_networks()
	{
		$this->load->model('network_model');
		
		$networks = array();
		$obj = new UnlocknetworkAPI();
		
		$data = $obj->imei_service_list();
		$dataArray = json_decode($data, true);
		
		if(count($dataArray) > 0 )
		{
			foreach ($dataArray as $key => $val)
			{
				$networks[$key]['api_network_id'] = $val['network_id'];
				$networks[$key]['Title'] = $val['network'];
			}
			
			$this->network_model->insert_batch($networks);
		}
		
		echo "Networks added successfully";		
	}
	
	private function place_imei_order($param)
	{
		return $this->exe_curl('placeimeiorder', $param);
	}
	
	public function crone_place_imei_order()
	{
		$this->load->model('imeiorder_model');
		$order_list = $this->imeiorder_model->bulk(array('gsm_imei_orders.Status' => 'Pending' , 'RefrenceID' => NULL ));
		
		foreach ($order_list as $val)
		{

			$params = array();
			$params['network_id'] = $val['ToolID'];
			$params['imei'] = $val['IMEI'];
			$params['email'] = $val['Email'];
			
			if($val['Model'] != "")
			{
				$params['model'] = $val['Model'];
			}
			
			if($val['ProviderID'] != "" )
			{
				$params['ProviderID'] = $val['ProviderID'];
			}
			
			if($val['PRD'] != "" )
			{
				$params['prd_number'] = $val['PRD'];
			}
			
			if($val['KBH'] != "" )
			{
				$params['kbh_number'] = $val['KBH'];
			}
			
			if($val['SerialNumber'] != 0 )
			{
				$params['serial_number'] = $val['SerialNumber'];
			}
			
			/*$params = array(
'network_id' => 145,
'phone_id' => 20,
'model' => 'Test',
'imei' => $params['imei'],
//'provider_id' => 1,
//'prd_number' => 'jasja',
//'kbh_number' => 'asas',
//'serial_number' => 'serial_number',
'email' => $params['email'],
//'model_id' => 656565
);*/
			$api_order = $this->place_imei_order($params);
			
			$dataArray = json_decode($api_order, true);
						
			if(isset($dataArray['order_id']))
			{
				$data['RefrenceID'] = $dataArray['order_id'];
				$this->imeiorder_model->update($data,$val['ID']);
			}
			
			
		}
		
		echo("Function Successfully runs");	
		
	}
	
	public function crone_imei_order_details()
	{
		$this->load->model('imeiorder_model');
		$order_list = $this->imeiorder_model->bulk(array('gsm_imei_orders.Status' => 'Pending' , 'RefrenceID !=' => 'NULL' ));
		
		//send link
		$mail_From = "info@ibussolutions.com";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= $mail_From . "\r\n";
		
		foreach ($order_list as $val)
		{
			$dataArray = $this->imei_order_details($val['RefrenceID']);
			$api_order = json_decode($dataArray, true);
			
			$message = "Your IMEI ORDER ID \"{$val['ID']}\" \n";
			$message .= "and IMEI is \"{$val['IMEI']}\". \n";
						
				switch ($api_order['status'])
				{
					###success or pending
					case 0: 
						if($api_order['code'] != "" )
						{
							$data['Status'] = "Issued";
							$data['Code'] = $api_order['code'];
							
							$message .= "Your order status is completed successfully.Your Code is \"{$data['Code']}\"  ";
						}
						else 
						{
							$data['Status'] = "Pending";
							$data['Code'] = "";
							
							$message .= "Your order status is in Pending. ";
						}
					break;
					
					####cancel;
					case 2: 
						$data['Status'] = "Cancel";
						$data['Code'] = "";
						
						$message .= "Your order status is Cancel.Reason is \"{$api_order['cancel_reason']}\" . ";
					break;
										
				}
				
				$this->imeiorder_model->update($data,$val['ID']);
				
				//mail
				mail($val['Email'], "Imei Order Status", $message,$headers);
			
		}
		
			
	}
	
	public function imei_order_details($order_id)
	{
		return $this->exe_curl('getimeiorder/'.$order_id);
	}
	
	private function exe_curl($action, $data = NULL)
	{
		$curl = curl_init(self::API_URL.$action);
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);                          
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);                           
		curl_setopt($curl, CURLOPT_USERAGENT, $this->api_key);
		curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-Type: application/json"));
		if($data !== NULL)
		{
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		}
		if($this->debug === TRUE)
		{
			curl_setopt($curl, CURLOPT_VERBOSE, 1);
			curl_setopt($curl, CURLOPT_HEADER, 1);	
		}
		$response = curl_exec($curl);                                          
		return $response;
	}
	
	
}