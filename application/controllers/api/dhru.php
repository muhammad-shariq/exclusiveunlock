<?php

class dhru extends FSD_Controller{

	public function  __construct()
	{
		parent::__construct();
		$this->load->model("apimanager_model");		
		$this->load->library("clientapi/DhruFusion");
	}
	
	##### Set Dhru Fusion Set Credential #############3
	
	public function get_dhru_api()
	{
		$apidata = $this->apimanager_model->get_where(array('ID' => 1));				
		define("REQUESTFORMAT", "JSON"); // we recommend json format (More information http://php.net/manual/en/book.json.php)
		define('DHRUFUSION_URL', $apidata[0]['Host']);
		define("USERNAME", $apidata[0]['Username']);
		define("API_ACCESS_KEY", $apidata[0]['ApiKey']);
		define("API_ID",$apidata[0]['ID']);
	}
	
	public function get_api_account_info()
	{
		
		$this->get_dhru_api();
		
		$api = new DhruFusion();
		
		// Debug on
		$api->debug = false;
		
		$request = $api->action('accountinfo');
		echo '<pre>';
		print_r($request);
		echo '</pre>';		
	}
	
	####### Get IMEI Dhru Fusion Method Services ##################
	
	public function get_api_imei_service_list()
	{
		$this->load->model('method_model');
		
		$this->get_dhru_api();
		$api = new DhruFusion();
		$data = array();
		// Debug on
		$api->debug = false;
		
		$request = $api->action('imeiservicelist');
		$a = 0;
		foreach ($request['SUCCESS'][0]['LIST'] as $key => $val )
		{
			foreach ($val['SERVICES'] as $childkey => $childval)
			{
				$data[$a]['NetworkID'] = 0;
				$data[$a]['ApiID'] = API_ID;
				$data[$a]['ToolID'] = $childval['SERVICEID'];
				$data[$a]['Title'] = $childval['SERVICENAME'];
				$data[$a]['DeliveryTime'] = $childval['TIME'];
				$data[$a]['Description'] = $childval['INFO'];
				$data[$a]['Price'] = $childval['CREDIT'];
				$data[$a]['Network'] = $childval['Requires.Network'] == 'None'?0:1;
				$data[$a]['Mobile'] = $childval['Requires.Mobile'] == 'None'?0:1;
				$data[$a]['Provider'] = $childval['Requires.Provider'] == 'None'?0:1;
				$data[$a]['PIN'] = $childval['Requires.PIN'] == 'None'?0:1;
				$data[$a]['KBH'] = $childval['Requires.KBH'] == 'None'?0:1;
				$data[$a]['MEP'] = $childval['Requires.MEP'] == 'None'?0:1;
				$data[$a]['PRD'] = $childval['Requires.PRD'] == 'None'?0:1;
				$data[$a]['Type'] = $childval['Requires.Type'] == 'None'?0:1;
				$data[$a]['Locks'] = $childval['Requires.Locks'] == 'None'?0:1;
				$data[$a]['Reference'] = $childval['Requires.Reference'] == 'None'?0:1;
				$data[$a]['CreatedDateTime'] = date("Y-m-d H:i:s");
				$data[$a]['UpdatedDateTime'] = date("Y-m-d H:i:s");
				$data[$a]['Status'] = "Enabled";
				$a++;
			}
		}
		
		$this->method_model->insert_batch($data);
		echo "Function successfully runs";
		echo "<pre>";
		//print_r($data);
		echo "</pre>";
	}
	
	###### Get Dhru Mep List #################33
	
	public function get_mep_list()
	{
		$this->load->model('brand_model');
		$this->get_dhru_api();
		$api = new DhruFusion();
		
		// Debug on
		$api->debug = false;
		
		$request = $api->action('meplist');
		$insert = array();
		foreach($request['SUCCESS'][0]['LIST'] as $key => $val )
		{
			$insert[$key]['Title'] = $val['NAME'];
			$insert[$key]['ApiMepID'] = $val['ID'];
			$insert[$key]['Status'] = 'Enabled';
		}
		
		$this->brand_model->truncate_mep();		
		$this->brand_model->insert_batch_mep($insert);
		echo "function runs successfully";
		echo '<pre>';
		//print_r($insert);
		print_r($request);
		echo '</pre>';				
	}
	
	public function get_api_model_list($toolserviceid = 5720) //Service ID from imei service list
	{
		$this->load->model('brand_model');
		$this->get_dhru_api();
		
		$api = new DhruFusion();
		
		// Debug on
		$api->debug = false;
		$para['ID'] = "$toolserviceid"; // got from 'imeiservicelist' [SERVICEID]
		$request = $api->action('modellist', $para);
		foreach($request['SUCCESS'][0]['LIST'] as $key => $val )
		{
			//$brand = $this->brand_model->get_where(array('ToolID'=> $toolserviceid));
			//if(! count($brand) > 0)
			{
				$insertBrand = array(
				'ApiBrandID' => $val['ID'],
				'ToolID' => $toolserviceid,
				'Title' => $val['NAME'],
				'UpdatedDateTime' => date("Y-m-d H:i:s"),
				'CreatedDateTime' => date("Y-m-d H:i:s"),
				'Status' => 'Enabled'
				);				
				
				$brandid = $this->brand_model->insert($insertBrand);				
				$createddate = date("Y-m-d H:i:s");
				$insert_model = array();
				foreach($val['MODELS'] as $key2 => $value )
				{
					$insert_model[$key2]['BrandID'] = $brandid;
					$insert_model[$key2]['ApiModelID'] = $value['ID'];
					$insert_model[$key2]['ToolID'] = $toolserviceid;
					$insert_model[$key2]['Title'] = $value['NAME'];
					$insert_model[$key2]['CreatedDateTime'] = $createddate;
					$insert_model[$key2]['UpdatedDateTime'] = $createddate; 
					$insert_model[$key2]['Status'] = 'Enabled';
				}				
				//$this->brand_model->insert_batch_model($insert_model);
			}			
		}
		
		echo "function run successfully";
		echo '<pre>';
		print_r($insert_model);
		print_r($request);
		echo '</pre>';				
	}
	
	public function get_api_provider_list($toolserviceid = 41) //Service ID from imei service list
	{
		$this->load->model('brand_model');
		$this->get_dhru_api();
		$api = new DhruFusion();
		
		// Debug on
		$api->debug = false;
		$para['ID'] = "$toolserviceid"; // got from 'imeiservicelist' [SERVICEID]
		$request = $api->action('providerlist', $para);
		$providerData = $this->brand_model->get_provider(array('ToolID' => $toolserviceid ));
		if(! count($providerData) > 0)
		{
			foreach($request['SUCCESS'][0]['LIST'] as $key => $val )
			{
				$insert = array();
				foreach($val['PROVIDERS'] as $key2 => $value )
				{
					$insert[$key2]['ToolID'] = $toolserviceid;
					$insert[$key2]['ApiProviderID'] = $value['ID'];
					$insert[$key2]['Title'] = $value['NAME'];
					$insert[$key2]['CountryNetworkID'] = $val['ID'];
					$insert[$key2]['Status'] = 'Enabled';
				}
				//$this->brand_model->insert_batch_provider($insert);
			}
		}
		echo "function runs successfully";		
		echo '<pre>';
		print_r($insert);
		echo '</pre>';				
	}
	
	############# place FIle order Request ##########################
	
	public function api_place_file_order($tool_id = 31,$file_name = "ORDERID31TEST.txt",$note = "")
	{
		$this->get_dhru_api();
		$api = new DhruFusion();
		
		$api->debug = false;

		$para['ID'] = $tool_id;
		$para['FILENAME'] = $file_name;
		$para['FILEDATA'] = base64_encode($note);
		$request = $api->action('placefileorder',$para);
		
		return $request;
		echo '<PRE>';
		print_r($request);
		echo '</PRE>';
	}
	
	public function crone_api_place_file_order()
	{
		$this->load->model("fileservices_model");
		$filer_orders = $this->fileservices_model->get_where_fileservices_orders(array('Status' => 'Pending'));
				
		foreach ($filer_orders as $val)
		{
			$api_order = $this->api_place_file_order($val['ToolID'],$val['IMEI'],$val['Note']);
			if(isset($api_order['ERROR']))
			{
				
			}
			elseif(isset($api_order['SUCCESS']))
			{
				$data['RefrenceID'] = $api_order['SUCCESS'][0]['REFERENCEID'];
				$this->fileservices_model->update($data,$val['ID']);
			}
			
		}
		
		echo("Function Successfully runs");	
	}
	
	public function crone_get_file_order_details()
	{
		$this->load->model("fileservices_model");
		$filer_orders = $this->fileservices_model->get_where(array('Status' => 'Pending' , 'RefrenceID !=' => 'NULL'));
		
		foreach ($order_list as $val)
		{
			$api_order = $this->get_file_order_details($val['RefrenceID']);
			
			if(isset($api_order['SUCCESS']))
			{
				switch ($api_order['SUCCESS'][0]['STATUS'])
				{
					###success
					case 4: 
						$data['Status'] = "Issued";
						$data['Code'] = $api_order['SUCCESS'][0]['CODE'];
					break;
					
					#####rejected
					case 3: 
						$data['Status'] = "Canceled";
					break;
					
					####Pending
					case 2:
						$data['Status'] = "Pending";
					break;	

					#### In Process
					case 1:
						$data['Status'] = "Pending";
					break;			
				}
				
				$this->imeiorder_model->update($data,$val['ID']);
			}
		}
		
	}
	
	public function get_file_order_details($refernce_id)
	{
		$this->get_dhru_api();
		
		$api = new DhruFusion();
		
		// Debug on
		$api->debug = false;
		
		$para['ID'] = $refernce_id;
		$request = $api->action('getfileorder',$para);
		
		return $request;
		echo '<PRE>';
		print_r($request);
		echo '</PRE>';
	}
	
	######### Crone of IMEI PLACE ORDER REQUEST ##################### 
	
	public function place_crone_order_request()
	{
		$this->load->model('imeiorder_model');
		$order_list = $this->imeiorder_model->bulk(array('gsm_imei_orders.Status' => 'Pending' , 'RefrenceID' => NULL,'gsm_imei_orders.ApiID !=' => 0,'gsm_imei_orders.ApiNetworkID' => 0 ));
		
		foreach ($order_list as $val)
		{
			$api_order = $this->api_place_api_order($val['ToolID'],$val['IMEI']);
			if(isset($api_order['ERROR']))
			{
				
			}
			elseif(isset($api_order['SUCCESS']))
			{
				$data['RefrenceID'] = $api_order['SUCCESS'][0]['REFERENCEID'];
				$this->imeiorder_model->update($data,$val['ID']);
			}
			echo "<pre>";
			print_r($api_order);
			echo "</pre>";			
		}
		
		echo("Function Successfully runs");		
	}
	
	############### Crone of get details imei orders ##############
	
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
			$api_order = $this->get_imei_order_details($val['RefrenceID']);

			$message = "Your IMEI ORDER ID \"{$val['ID']}\" \n";
			$message .= "and IMEI is \"{$val['IMEI']}\". \n";
						
			if(isset($api_order['SUCCESS']))
			{
				switch ($api_order['SUCCESS'][0]['STATUS'])
				{
					###success
					case 4: 
						$data['Status'] = "Issued";
						$data['Code'] = $api_order['SUCCESS'][0]['CODE'];
						
						$message .= "Your order status is completed successfully.Your Code is \"{$data['Code']}\"  ";
					break;
					
					#####rejected
					case 3: 
						$data['Status'] = "Canceled";
						
						$message .= " Your Order status is Canceled";
					break;
					
					####Pending
					case 2:
						$data['Status'] = "Pending";
						
						$message .= " Your Order status is still in process";
					break;	

					#### In Process
					case 1:
						$data['Status'] = "Pending";
						
						$message .= " Your Order status is still in process";
					break;			
				}
				
				$this->imeiorder_model->update($data,$val['ID']);
				
				//mail
				mail($val['Email'], "Imei Order Status", $message,$headers);
			}
		}
		
		echo "<pre>";
		print_r($order_list);
		echo "</pre>";
		
	}
	
	############### Get Place Order IMEI details ###################
	
	public function get_imei_order_details($refrence_id = 2237225)
	{
		$this->get_dhru_api();
		$api = new DhruFusion();

		// Debug on
		$api->debug = false;
		
		
		$para['ID'] = $refrence_id; // got REFERENCEID from placeimeiorder
		$request = $api->action('getimeiorder', $para);
		
		return $request;
		echo "<pre>";
		print_r($request);
		echo "</pre>";
	}
	
	public function api_place_api_order($service_id = 2471,$imei = "111111111511116")
	{
		$this->get_dhru_api();
		$api = new DhruFusion();

		// Debug on
		$api->debug = false;
				
		$para['IMEI'] = $imei;
		$para['ID'] = $service_id; // got from 'imeiservicelist' [SERVICEID]
		// PARAMETRES IS REQUIRED
		// $para['MODELID'] = "";
		// $para['PROVIDERID'] = "";
		// $para['MEP'] = "";
		// $para['PIN'] = "";
		// $para['KBH'] = "";
		// $para['PRD'] = "";
		// $para['TYPE'] = "";
		// $para['REFERENCE'] = "";
		// $para['LOCKS'] = "";
				
		$request = $api->action('placeimeiorder', $para);		
		
		//echo '<PRE>';
		//print_r($request);
		//echo '</PRE>';
		return $request;
	}	
}
