<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Method extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('method_model');
		$this->load->model('provider_model');
		$this->load->model('brand_model');
		$this->load->model('apimanager_model');
		$this->load->model('network_model');
		$this->load->model('imeiorder_model');
	}
	
	public function index()
	{
		$data['template'] = "admin/method/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->method_model->get_datatable($this->access);
	}

	public function add()
	{
		$api_list = array('0'=>'');
		foreach ($this->apimanager_model->get_all() as $value) 
		{
			$api_list[$value['ID']] = $value['Title'];
		}
		$data['api_list'] = $api_list;		
		
		$data['network'] = $this->network_model->get_all();
		$data['template'] = "admin/method/add";
		
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{
		$api_list = array('0'=>'');
		foreach ($this->apimanager_model->get_all() as $value) 
		{
			$api_list[$value['ID']] = $value['Title'];
		}
		$data['api_list'] = $api_list;
		$data['network'] = $this->network_model->get_all();
		$data['data'] = $this->method_model->get_where(array('ID'=> $id));			
		$data['template'] = "admin/method/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		$result = $this->imeiorder_model->count_where(array('MethodID' => $id));
		if($result > 0)
		{
			$this->session->set_flashdata('warning', $result . ' order(s) are associated with this method.');
			redirect("admin/method/");			
		}
		$this->method_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/method/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');				
		
		$this->form_validation->set_rules('Title' , 'Title' ,'required');			

		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL,TRUE);	
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			$data['Status'] = "Enabled";
			
			#### Insert data IMEI Method 
			$methodid = $this->method_model->insert($data);
						
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/method/");
		}
	}		

	public function update()
	{
		$this->load->library('form_validation');
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];		
				
		$this->form_validation->set_rules('Title' , 'Title' ,'required');		
		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);					
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
						
			$this->method_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/method/");
		}
	}
	
	public function sync($id)
	{
		include APPPATH . 'third_party/DhruFusion.php';
		## List All API services ##
		$api_account = $this->method_model->get_api_credentials($id);
		$api = new DhruFusion($api_account[0]['Host'], $api_account[0]['Username'], $api_account[0]['ApiKey']);
		$api->debug = FALSE; // Debug on
		
		## Update Provider List against Method ##
		if($api_account[0]['Provider'] == 1)
		{
			$para = array();
			$providers = array();
			$para['ID'] = $api_account[0]['ToolID']; // got from 'imeiservicelist' [SERVICEID]
			$request = $api->action('providerlist', $para);	
			//echo '<pre>'; print_r($request); exit;
			if(isset($request['SUCCESS']))
			{
				## Delete All Provider against this method ##
				$this->provider_model->delete_by_method_id($id);
				foreach($request['SUCCESS'][0]['LIST'] as $v)
				{
					if(isset($v['PROVIDERS']))
					{						
						foreach($v['PROVIDERS'] as $k => $value)
						{
							$providers[$k]['CountryNetworkID'] = $v['ID'];
							$providers[$k]['MethodID'] = $id;
							$providers[$k]['ApiProviderID'] = $value['ID'];
							$providers[$k]['Title'] = $value['NAME'];
							$providers[$k]['Status'] = 'Enabled';
						}
					}
				}
				$this->provider_model->insert_batch($providers);
			}				
		}
		
		## Update Mobile List against Method ##
		if($api_account[0]['Mobile'] == 1)
		{
			$para = array();
			$models = array();
			$para['ID'] = $api_account[0]['ToolID']; // got from 'imeiservicelist' [SERVICEID]
			$request = $api->action('modellist', $para);	
			//echo '<pre>'; print_r($request); exit;
			if(isset($request['SUCCESS']))
			{
				## Delete all Brands against this method ##
				$this->brand_model->delete_by_method_id($id);				
				foreach($request['SUCCESS'][0]['LIST'] as $v)
				{
					$brand = array();
					$brand['ApiBrandID'] = $v['ID'];
					$brand['MethodID'] = $id;
					$brand['Title'] = $v['NAME'];
					$brand['CreatedDateTime'] = date("Y-m-d H:i:s");
					$brand['UpdatedDateTime'] = date("Y-m-d H:i:s");
					$brand['Status'] = 'Enabled';
					$brand_id = $this->brand_model->insert($brand);
					
					if(isset($v['MODELS']))
					{						
						foreach($v['MODELS'] as $k => $value)
						{
							$models[$k]['BrandID'] = $brand_id;
							$models[$k]['MethodID'] = $id;
							$models[$k]['ApiModelID'] = $value['ID'];
							$models[$k]['Title'] = $value['NAME'];
							$models[$k]['CreatedDateTime'] = date("Y-m-d H:i:s");
							$models[$k]['UpdatedDateTime'] = date("Y-m-d H:i:s");
							$models[$k]['Status'] = 'Enabled';
						}
					}
				}
				$this->brand_model->insert_batch_models($models);
			}				
		}		
		$this->session->set_flashdata('success', 'Sync updated successfully.');
		redirect("admin/method/");
	}	
}

/* End of file method.php */
/* Location: ./application/controllers/admin/method.php */