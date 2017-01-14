<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autoresponder extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('autoresponder_model');
		$this->load->helper('ckeditor');
		
		//Ckeditor's configuration
		$this->editor =  array(
		
			//ID of the textarea that will be replaced
			'id' 	=> 	'Message',
			'path'	=>	$this->config->item('ckeditor_path'),
		
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'400px',	//Setting a custom height
				'htmlEncodeOutput' => 'true',
				'stylesheetParser_skipSelectors' => '/(^body\.|^caption\.|\.high|^\.)/i;',
				//'contentsCss' => base_url("css/styles.css"),				
				'filebrowserBrowseUrl' => site_url('admin/filemanager/browse').'?mode=file'
					
			)
		);				
	}
	
	public function index()
	{
		$data['template'] = "admin/autoresponder/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->autoresponder_model->get_datatable($this->access);
	}

	public function add()
	{
		//Ckeditor's configuration
		$data['ckeditor'] = $this->editor;
		$data['template'] = "admin/autoresponder/add";
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{
		//Ckeditor's configuration
		$data['ckeditor'] = $this->editor;
		$data['data'] = $this->autoresponder_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/autoresponder/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{	
		$this->autoresponder_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/autoresponder/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');
		$this->load->library('image_lib');		
		
		$this->form_validation->set_rules('Title' , 'Title' ,'required|min_length[3]');
		$this->form_validation->set_rules('FromEmail' , 'From Email' ,'required|min_length[3]');
		$this->form_validation->set_rules('ToEmail' , 'To Email' ,'required|min_length[3]');
		$this->form_validation->set_rules('Message' , 'Message' ,'required|min_length[3]');				

		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL, TRUE);
			$data['Status'] = isset($data['Status'])?"Enabled":"Disabled"; 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");			
			$this->autoresponder_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/autoresponder/");
		}
	}		

	public function update()
	{
		$this->load->library('form_validation');
		$this->load->library('image_lib');
				
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];
							
		$this->form_validation->set_rules('Title' , 'Title' ,'required|min_length[3]');
		$this->form_validation->set_rules('FromEmail' , 'From Email' ,'required|min_length[3]');
		$this->form_validation->set_rules('ToEmail' , 'To Email' ,'required|min_length[3]');
		$this->form_validation->set_rules('Message' , 'Message' ,'required|min_length[3]');
		if($this->form_validation->run() === FALSE)
		{ 
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);						
			$data['Status'] = isset($data['Status'])?"Enabled":"Disabled"; 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$this->autoresponder_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/autoresponder/");
		}
	}
}

/* End of file autoresponder.php */
/* Location: ./application/controllers/admin/autoresponder.php */