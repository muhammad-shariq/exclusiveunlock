<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include APPPATH . 'third_party/DhruFusion.php';

/**
 * Cron Class
 *
 * Request orders to API server and Get status or requested orders
 */

class Cron extends CI_Controller 
{
	/**
	 * Constructor
	 *
	 * Simply load all required models and libraries
	 *
	 * @access	public
	 */    
	public function __construct()
	{
		parent::__construct();
        ## If request if not from cron or cli then show 404 error ##
        /*if($this->input->is_cli_request() === FALSE)
        {
            show_404();
            exit;
        }*/
                
		$this->load->model("method_model");
		$this->load->model("apimanager_model");
		$this->load->model("autoresponder_model");
		$this->load->model("credit_model");
		$this->load->model("imeiorder_model");
        $this->load->model("fileorder_model");
	}
    
	/**
	 * Request imei order to API Server
	 *
	 * get imei orders statuses from API server with reference ID
	 *
	 * @param	void
	 * @return	void
	 * @author	Muhammad Shariq
	 */		
	public function send_imei_orders()
	{
		$result = $this->method_model->send_pending_imei_orders();
		foreach ($result as $order) 
		{
			switch ($order['LibraryID']) 
			{
				case LIBRARY_DHURU_CLIENT: // Dhuru Fusion Client
					$api = new DhruFusion($order['Host'], $order['Username'], $order['ApiKey']);
					$api->debug = FALSE; // Debug on
					$para['IMEI'] = $order['IMEI'];
					$para['ID'] = $order['ToolID']; // got from 'imeiservicelist' [SERVICEID]
					// PARAMETRES IS require_once
					$para['MODELID'] = $order['ModelID'];
					$para['PROVIDERID'] = $order['ProviderID'];
					$para['MEP'] = $order['MEPID'];
					$para['PIN'] = $order['PIN'];
					$para['KBH'] = $order['KBH'];
					$para['PRD'] = $order['PRD'];
					//$para['SECRO'] = $order['ModelID'];
					$para['TYPE'] = $order['Type'];
					$para['REFERENCE'] = $order['Reference'];
					$para['LOCKS'] = $order['Locks'];
		
					$request = $api->action('placeimeiorder', $para);
					if (isset($request['SUCCESS']) && count($request['SUCCESS'])>0 )
					{
						$data['ReferenceID'] = $request['SUCCESS'][0]['REFERENCEID']; // get ID from Server
						$data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
						$this->imeiorder_model->update($data, $order['ID']);						
					}					
					break;
			}
			sleep(1);
		}
	}
    
	/**
	 * Receive IMEI Order From API Server
	 *
	 * get imei orders statuses from API server with reference ID
	 *
	 * @param	void
	 * @return	void
	 * @author	Muhammad Shariq
	 */	
	public function receive_imei_orders()
	{
		$result = $this->method_model->get_pending_imei_orders();
		foreach ($result as $imei_orders) 
		{
			$id = $imei_orders['ID'];
			$member_id = $imei_orders['MemberID'];
			$data = array();	
			switch ($imei_orders['LibraryID']) 
			{
				case LIBRARY_DHURU_CLIENT: //Dhuru Fusion Client
					$api = new DhruFusion($imei_orders['Host'], $imei_orders['Username'], $imei_orders['ApiKey']);
					$api->debug = FALSE; // Debug on
					$para['ID'] = $imei_orders['ReferenceID']; // got REFERENCEID from placeimeiorder
					$request = $api->action('getimeiorder', $para);
					//echo '<pre>'; var_dump($request); die('</pre>');
					if(isset($request['SUCCESS']) && count($request['SUCCESS'])>0)
					{
						switch(intval($request['SUCCESS'][0]['STATUS']))
						{
							case 0: // Pendding					
							case 1: //In Process				
							case 2:
								break;
							case 3: // Rejected
								$data['Code'] = $request['SUCCESS'][0]['CODE'];
								$data['Comments'] = $request['SUCCESS'][0]['CODE'];
								$data['Status'] = 'Canceled';
								$data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
								$this->imeiorder_model->update($data, $id);
								
								## Amount Refund ##
								$this->credit_model->refund($id, IMEI_CODE_REQUEST, $member_id);
								## Get Canceled Email Template ##
								$data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 2)); // IMEI Code Canceled 
								break;
							case 4:	//success
								$data['Code'] = $request['SUCCESS'][0]['CODE'];
								$data['Status'] = 'Issued';
								$data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
								$this->imeiorder_model->update($data, $id);
								## Get Issue Email Template ##
								$data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 3)); // IMEI Code Issued 
								break;
						}				
					}
				break;
			}
			## Send Email with Template ## 		
			if(isset($data) && count($data)>0)
			{
				$from_name = $data[0]['FromName'];
				$from_email = $data[0]['FromEmail'];
				$to_email = $data[0]['ToEmail'];
				$subject = $data[0]['Subject'];
				$message = html_entity_decode($data[0]['Message']);
				
				//Information
				$post['Code'] = $request['SUCCESS'][0]['CODE'];
				$post['IMEI'] = $imei_orders['IMEI'];
				$post['FirstName'] = $imei_orders['FirstName'];
				$post['LastName'] = $imei_orders['LastName'];
				$post['Email'] = $imei_orders['Email'];
	
				$this->fsd->email_template($post, $from_email, $from_name, $to_email, $subject, $message );
				$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
			}
			sleep(1);								
		}
	} 
    
	/**
	 * Request File order to API Server
	 *
	 * get file orders statuses from API server with reference ID
	 *
	 * @param	void
	 * @return	void
	 * @author	Muhammad Shariq
	 */		
	public function send_file_orders()
	{
		$result = $this->fileorder_model->get_all_pending_orders();
		foreach ($result as $order) 
		{
			switch ($order['LibraryID']) 
			{
				case LIBRARY_DHURU_CLIENT: // Dhuru Fusion Client
					$api = new DhruFusion($order['Host'], $order['Username'], $order['ApiKey']);
					$api->debug = FALSE; // Debug on
                    
                    $para['ID'] = $order['ToolID']; // got from 'imeiservicelist' [SERVICEID]
                    $para['FILENAME'] = $order['FileName'];
                    $para['FILEDATA'] = base64_encode($this->config->item('upload_fileservice_dir').$order['FileName']);
                    $request = $api->action('placefileorder', $para);
					if (isset($request['SUCCESS']) && count($request['SUCCESS'])>0 )
					{
						$data['ReferenceID'] = $request['SUCCESS'][0]['REFERENCEID']; // get ID from Server
						$data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
						$this->fileorder_model->update($data, $order['ID']);						
					}					
					break;
			}
			sleep(1);
		}
	}
    
	/**
	 * Receive File Order From API Server
	 *
	 * get file orders statuses from API server with reference ID
	 *
	 * @param	void
	 * @return	void
	 * @author	Muhammad Shariq
	 */	
	public function receive_file_orders()
	{
		$result = $this->fileorder_model->get_requested_pending_orders();
		foreach ($result as $imei_orders) 
		{
			$id = $imei_orders['ID'];
			$member_id = $imei_orders['MemberID'];
			$data = array();	
			switch ($imei_orders['LibraryID']) 
			{
				case LIBRARY_DHURU_CLIENT: //Dhuru Fusion Client
					$api = new DhruFusion($imei_orders['Host'], $imei_orders['Username'], $imei_orders['ApiKey']);
					$api->debug = FALSE; // Debug on
					$para['ID'] = $imei_orders['ReferenceID']; // got REFERENCEID from placeimeiorder
					$request = $api->action('getfileorder', $para);
					//echo '<pre>'; var_dump($request); die('</pre>');
					if(isset($request['SUCCESS']) && count($request['SUCCESS'])>0)
					{
						switch(intval($request['SUCCESS'][0]['STATUS']))
						{
							case 0: // Pendding					
							case 1: //In Process				
							case 2:
								break;
							case 3: // Rejected
								$data['Code'] = $request['SUCCESS'][0]['CODE'];
								$data['Comments'] = $request['SUCCESS'][0]['CODE'];
								$data['Status'] = 'Canceled';
								$data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
								$this->fileorder_model->update($data, $id);
								
								## Amount Refund ##
								$this->credit_model->refund($id, BROUTFORCE_CODE_REQUEST, $member_id);
								## Get Canceled Email Template ##
								$data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 6)); // IMEI Code Canceled 
								break;
							case 4:	//success
								$data['Code'] = $request['SUCCESS'][0]['CODE'];
								$data['Status'] = 'Issued';
								$data['UpdatedDateTime'] = date("Y-m-d H:i:s");									
								$this->fileorder_model->update($data, $id);
								## Get Issue Email Template ##
								$data = $this->autoresponder_model->get_where(array('Status' => 'Enabled', 'ID' => 7)); // IMEI Code Issued 
								break;
						}				
					}
				break;
			}
			## Send Email with Template ## 		
			if(isset($data) && count($data)>0)
			{
				$from_name = $data[0]['FromName'];
				$from_email = $data[0]['FromEmail'];
				$to_email = $data[0]['ToEmail'];
				$subject = $data[0]['Subject'];
				$message = html_entity_decode($data[0]['Message']);
				
				//Information
				$post['Code'] = $request['SUCCESS'][0]['CODE'];
				$post['IMEI'] = $imei_orders['IMEI'];
				$post['FirstName'] = $imei_orders['FirstName'];
				$post['LastName'] = $imei_orders['LastName'];
				$post['Email'] = $imei_orders['Email'];
	
				$this->fsd->email_template($post, $from_email, $from_name, $to_email, $subject, $message );
				$this->fsd->sent_email($from_email, $from_name,$to_email, $subject, $message );
			}
			sleep(1);								
		}
	}

	/**
	 * Disabled network sync
	 *
	 * Receive imei network From API Server and compare with local networks
	 *
	 * @param	void
	 * @return	void
	 * @author	Muhammad Shariq
	 */	
	public function syc_imei_methods()
	{
		$apis = $this->apimanager_model->get_where(array('ApiType' => 'Imei'));
		foreach ($apis as $api) 
		{
			$id = $api['ID'];
			switch ($api['LibraryID']) 
			{
				case LIBRARY_DHURU_CLIENT:
					$active_netowrks = array();
					$api = new DhruFusion($api['Host'], $api['Username'], $api['ApiKey']);
					$api->debug = FALSE; // Debug on
					$request = $api->action('imeiservicelist');
					if(isset($request['SUCCESS'][0]['LIST']) && count($request['SUCCESS'][0]['LIST']) >0 )
					{
						foreach ($request['SUCCESS'][0]['LIST'] as $services) 
						{
							if(isset($services['SERVICEID']))
								$active_netowrks[] = $services['SERVICEID'];
							else
							{
								foreach ($services['SERVICES'] as $service)
								{
									if(isset($service['SERVICEID']))
										$active_netowrks[] = $service['SERVICEID'];
								}
							}
						}
						//echo '<pre>'; print_r($active_netowrks); echo '</pre>'; exit;
						## get networks form database ##
						$methods = $this->method_model->get_where(array('Status' => 'Enabled', 'ApiID' => $id));
						foreach ($methods as $method) 
						{
							## Search in active networks ##
							if(!in_array($method['ToolID'], $active_netowrks))
							{
								$this->method_model->update(array('Status' => 'Disabled'), $method['ID']);
							}
						}						
					}
					break;
			}
		}
	}	       	
}

/* End of file cron.php */
/* Location: ./application/controllers/cron.php */