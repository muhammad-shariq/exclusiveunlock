<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . 'third_party/DhruFusion.php';

class Apimanager extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('apimanager_model');
		$this->load->model('method_model');
		$this->load->model('network_model');
        $this->load->model('fileservices_model');
	}
	
	public function index()
	{
		$data['template'] = "admin/apimanager/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->apimanager_model->get_datatable($this->access);
	}

	public function add()
	{
		$data['template'] = "admin/apimanager/add";
		$data['library'] = $this->apimanager_model->get_api();
		$this->load->view('admin/master_template',$data);
	}
	
	public function edit($id)
	{		
		$data['data'] = $this->apimanager_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/apimanager/edit";
		$data['library'] = $this->apimanager_model->get_api();
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		$result = $this->method_model->count_where(array('ApiID' => $id));
		if($result > 0)
		{
			$this->session->set_flashdata('warning', $result . ' method(s) are associated with this API.');
			redirect("admin/apimanager/");			
		}
        
		$result = $this->fileservices_model->count_where(array('ApiID' => $id));
		if($result > 0)
		{
			$this->session->set_flashdata('warning', $result . ' File service(s) are associated with this API.');
			redirect("admin/apimanager/");			
		}        
		$this->apimanager_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/apimanager/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');			
		
		$this->form_validation->set_rules('Title' , 'Title' ,'required|max_length[255]');		
		$this->form_validation->set_rules('Host' , 'Host' ,'required|max_length[255]');
		$this->form_validation->set_rules('Username' , 'Username' ,'required|max_length[255]');
		$this->form_validation->set_rules('ApiKey' , 'ApiKey' ,'required|max_length[255]');
		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL,TRUE);
			$data['Status'] = isset($data['Status'])?"Enabled":"Disabled";             			 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			
			$this->apimanager_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/apimanager/");
		}
	}		

	public function update()
	{
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];
		$this->load->library('form_validation');		
				
		$this->form_validation->set_rules('Title' , 'Title' ,'required|max_length[255]');		
		$this->form_validation->set_rules('Host' , 'Host' ,'required|max_length[255]');
		$this->form_validation->set_rules('Username' , 'Username' ,'required|max_length[255]');
		$this->form_validation->set_rules('ApiKey' , 'ApiKey' ,'required|max_length[255]');	

		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
            $data['Status'] = isset($data['Status'])?"Enabled":"Disabled"; 
						
			$this->apimanager_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/apimanager/");
		}
	}
	
	public function service_list($id)
	{		
		## List All API services ##
		$api_account = $this->apimanager_model->get_where(array('ID'=> $id));
		if(isset($api_account[0]) && count($api_account[0])>0)
		{
			switch ($api_account[0]['ApiType']) 
			{
				case 'Imei':
					switch (intval($api_account[0]['LibraryID'])) 
					{
						case LIBRARY_DHURU_CLIENT: // Dhuru Fusion Client
							$api = new DhruFusion($api_account[0]['Host'], $api_account[0]['Username'], $api_account[0]['ApiKey']);
							$api->debug = FALSE; // Debug on
							$request = $api->action('imeiservicelist');
							if(isset($request['SUCCESS'][0]['LIST']) && count($request['SUCCESS'][0]['LIST']) >0 )
							{
								$data['networks'] = $this->network_model->get_all();
								$data['service_list'] = $request['SUCCESS'][0]['LIST'];
								$data['template'] = "admin/apimanager/imei_service_list";
							}
							elseif (isset($request['ERROR'][0]['MESSAGE'])) 
							{
								$this->session->set_flashdata('error', $request['ERROR'][0]['MESSAGE']);
								redirect('admin/apimanager');	
							}	
							else
							{
								$this->session->set_flashdata('error', 'Services list not available at this time');
								redirect('admin/apimanager');								
							}													
						break;
					}
				break;
				case 'File':				 
					switch (intval($api_account[0]['LibraryID'])) 
					{
						case LIBRARY_DHURU_CLIENT: // Dhuru Fusion Client
							$api = new DhruFusion($api_account[0]['Host'], $api_account[0]['Username'], $api_account[0]['ApiKey']);
							$api->debug = FALSE; // Debug on
							$request = $api->action('fileservicelist');
							//echo '<pre>'; print_r($request); exit;
							if(isset($request['SUCCESS'][0]['LIST']) && count($request['SUCCESS'][0]['LIST']) >0 )
							{
								$data['service_list'] = $request['SUCCESS'][0]['LIST'];
								$data['template'] = "admin/apimanager/file_service_list";
							}
							elseif (isset($request['ERROR'][0]['MESSAGE'])) 
							{
								$this->session->set_flashdata('error', $request['ERROR'][0]['MESSAGE']);
								redirect('admin/apimanager');	
							}
							else
							{
								$this->session->set_flashdata('error', 'Services list not available at this time');
								redirect('admin/apimanager');								
							}						
						break;
					}				
				break;
			}			
			$this->load->view('admin/master_template', $data);
		}
		else
		{
			$this->session->set_flashdata('error', 'Invalid record.');
			redirect('admin/apimanager');
		}		
	}
    
    public function add_imei_service_list($id)
	{
		## Insert Selected services ##
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$post = $this->input->post(NULL, TRUE);	
			if(isset($post['chk']) && count($post['chk'])>0)
			{
				$data = array();
				foreach ($post['chk'] as $service_id) 
				{
					$tool_id = $service_id;
					$data[$service_id]['NetworkID'] = $post['NetworkID'][$service_id];
					$data[$service_id]['ApiID'] = $id;
					$data[$service_id]['ToolID'] = $tool_id;
					$data[$service_id]['Title'] = $post['ServiceName'][$service_id];
					$data[$service_id]['DeliveryTime'] = $post['Time'][$service_id];
					$data[$service_id]['Price'] = $post['Price'][$service_id];					
										
					$data[$service_id]['Network'] = $post['Network'][$service_id] == "None" ? '0':'1';
					$data[$service_id]['Mobile'] = $post['Mobile'][$service_id] == "None" ? '0':'1';
					$data[$service_id]['Provider'] = $post['Provider'][$service_id] == "None" ? '0':'1';
					$data[$service_id]['PIN'] = $post['PIN'][$service_id] == "None" ? '0':'1';
					$data[$service_id]['KBH'] = $post['KBH'][$service_id] == "None" ? '0':'1';
					$data[$service_id]['MEP'] = $post['MEP'][$service_id] == "None" ? '0':'1';
					$data[$service_id]['PRD'] = $post['PRD'][$service_id] == "None" ? '0':'1';
					$data[$service_id]['Type'] = $post['Type'][$service_id] == "None" ? '0':'1';
					$data[$service_id]['Locks'] = !isset($post['Locks'][$service_id]) || $post['Locks'][$service_id] == "None" ? '0':'1';
					$data[$service_id]['Reference'] = $post['Reference'][$service_id] == "None" ? '0':'1';
					
					$data[$service_id]['Status'] = 'Enabled';
					$data[$service_id]['CreatedDateTime'] = date("y-m-d H:i:s");
					$data[$service_id]['UpdatedDateTime'] = date("y-m-d H:i:s");									
					
				}
				$this->method_model->insert_batch($data);
				$this->session->set_flashdata('success', 'Selected services has been added successfully.');
				redirect(site_url('admin/apimanager/'));				
			}
		}
        $this->session->set_flashdata('error', 'No service selected.');
        redirect('admin/apimanager');        
    } 
    
    public function add_file_service_list($id)
	{
		## Insert Selected services ##
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$post = $this->input->post(NULL, TRUE);	
			if(isset($post['chk']) && count($post['chk'])>0)
			{
				$data = array();
				foreach ($post['chk'] as $service_id) 
				{
					$tool_id = $service_id;
					$data[$service_id]['ApiID'] = $id;
					$data[$service_id]['ToolID'] = $tool_id;
					$data[$service_id]['Title'] = $post['ServiceName'][$service_id];
					$data[$service_id]['DeliveryTime'] = $post['Time'][$service_id];
					$data[$service_id]['Price'] = $post['Price'][$service_id];
					$data[$service_id]['AllowExtension'] = $post['AllowExtension'][$service_id];
					
					$data[$service_id]['Status'] = 'Enabled';
					$data[$service_id]['CreatedDateTime'] = date("y-m-d H:i:s");
					$data[$service_id]['UpdatedDateTime'] = date("y-m-d H:i:s");
				}
				$this->fileservices_model->insert_batch($data);
				$this->session->set_flashdata('success', 'Selected services has been added successfully.');
				redirect(site_url('admin/apimanager/'));				
			}	
		}
        $this->session->set_flashdata('error', 'No service selected.');
        redirect('admin/apimanager');        
    }          	
}

/* End of file apimanager.php */
/* Location: ./application/controllers/admin/apimanager.php */