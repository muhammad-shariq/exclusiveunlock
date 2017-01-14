<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fileservices extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fileservices_model');
		$this->load->model('apimanager_model');
		$this->load->model('fileorder_model');
		
	}
	
	public function index()
	{
		$data['template'] = "admin/fileservices/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->fileservices_model->get_datatable($this->access);
	}

	public function add()
	{
		$api_list = array('' => '');
		foreach ($this->apimanager_model->get_all() as $value) 
		{
			$api_list[$value['ID']] = $value['Title'];
		}
		$data['api_list'] = $api_list;		
		$data['template'] = "admin/fileservices/add";
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
		$data['data'] = $this->fileservices_model->get_where(array('ID'=> $id));			
		$data['template'] = "admin/fileservices/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		$result = $this->fileorder_model->count_where(array('FileServiceID' => $id));
		if($result > 0)
		{
			$this->session->set_flashdata('warning', $result . ' order(s) are associated with this service.');
			redirect("admin/fileservices/");			
		}
		$this->fileservices_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/fileservices/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');				
		
		$this->form_validation->set_rules('ApiID' , 'Api ID' ,'integer');
        $this->form_validation->set_rules('Title' , 'Title' ,'required|max_length[255]');
		$this->form_validation->set_rules('ToolID' , 'Tool ID' ,'numeric');
        $this->form_validation->set_rules('Price' , 'Price' ,'required|numeric');
        $this->form_validation->set_rules('DeliveryTime' , 'Delivery Time' ,'required|max_length[255]');
        $this->form_validation->set_rules('Description' , 'Description' ,'max_length[512]');
        $this->form_validation->set_rules('AllowExtension' , 'Allow Extension' ,'max_length[225]');
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
			
			$fileid = $this->fileservices_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/fileservices/");
		}
	}		

	public function update()
	{
		$this->load->library('form_validation');
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];		
				
		$this->form_validation->set_rules('ApiID' , 'Api ID' ,'integer');
        $this->form_validation->set_rules('Title' , 'Title' ,'required|max_length[255]');
		$this->form_validation->set_rules('ToolID' , 'Tool ID' ,'numeric');
        $this->form_validation->set_rules('Price' , 'Price' ,'required|numeric');
        $this->form_validation->set_rules('DeliveryTime' , 'Delivery Time' ,'required|max_length[255]');
        $this->form_validation->set_rules('Description' , 'Description' ,'max_length[512]');
        $this->form_validation->set_rules('AllowExtension' , 'Allow Extension' ,'max_length[225]');			
		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);
            $data['Status'] = isset($data['Status'])?"Enabled":"Disabled"; 					
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");						
			$this->fileservices_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/fileservices/");
		}
	}
	
	
}

/* End of file fileservices.php */
/* Location: ./application/controllers/admin/fileservices.php */