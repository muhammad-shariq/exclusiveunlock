<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class servicemodel extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('servicemodel_model');
		
		$this->load->model('brand_model');		
	}
	
	public function index()
	{
		$data['template'] = "admin/servicemodel/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->servicemodel_model->get_datatable($this->access);
	}

	public function add()
	{
		$data['template'] = "admin/servicemodel/add";
		$data['brand'] = $this->brand_model->get_all();
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{		
		$data['data'] = $this->servicemodel_model->get_where(array('ModelID'=> $id));
		$data['brand'] = $this->brand_model->get_all();
		$data['template'] = "admin/servicemodel/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		$this->servicemodel_model->delete($id);
		$this->session->set_flashdata('success', 'Record delete successfully.');
		redirect("admin/servicemodel/");
	}
	
	
	public function insert()
	{
		$this->load->library('form_validation');			
		
		$this->form_validation->set_rules('Title' , 'Title' ,'required');		
		$this->form_validation->set_rules('ApiModelID' , 'ApiModelID' ,'required');
		$this->form_validation->set_rules('BrandID' , 'BrandID' ,'required');
		
		if($this->form_validation->run() === FALSE)
		{
			$this->add();
		}
		else
		{
			$data = $this->input->post(NULL,TRUE);			 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$data['CreatedDateTime'] = date("Y-m-d H:i:s");
			
			$this->servicemodel_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/servicemodel/");
		}
	}		

	public function update()
	{
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ModelID'];
		$this->load->library('form_validation');		
				
		$this->form_validation->set_rules('Title' , 'Title' ,'required');		
		$this->form_validation->set_rules('ApiModelID' , 'ApiModelID' ,'required');
		$this->form_validation->set_rules('BrandID' , 'BrandID' ,'required');		

		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
						
			$this->servicemodel_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/servicemodel/");
		}
	}
	
	public function save_roles()
	{
		$data = $this->input->post(Null,TRUE);
		if( array_key_exists("arr",$data) && count($data['arr']) > 0)
		{
			foreach ($data['arr'] as $key => $value) {
				$update = array();
				if(!array_key_exists($key,$data['arr']))
				{
					$update['Add'] = "N";
					$update['Edit'] = "N";
					$update['View'] = "N";
					$update['Delete'] = "N";
				}
				if(array_key_exists('Add', $data['arr'][$key]))
				{
					$update['Add'] = $value['Add'];
				}else
					{$update['Add'] = "N";  }
				if(array_key_exists('Edit', $data['arr'][$key]))
				{
					$update['Edit'] = $value['Edit'];
				}else
					{ $update['Edit'] = "N";  }
				if(array_key_exists('View', $data['arr'][$key]))
				{
					$update['View'] = $value['View'];
				}else
					{ $update['View'] = "N";  }
				if(array_key_exists('Delete', $data['arr'][$key]))
				{
					$update['Delete'] = $value['Delete'];
				}else
					{ $update['Delete'] = "N";  }
				
				$update['ID'] = $key;
				
				$this->servicemodel_model->update_roles($update,$key);								
			}
			$this->session->set_flashdata('success', 'Roles updated successfully.');
			redirect("admin/servicemodel/");
		}else
			{
				$update = array(
				'Add' => "N",
				'Edit' => "N",
				'View' => "N",
				'Delete' => "N"
				);
				$this->servicemodel_model->disabled_roles($update,$data['servicemodelID']);
				$this->session->set_flashdata('success', 'Roles updated successfully.');
				redirect("admin/servicemodel/");
			}		
	}
	
}

/* End of file servicemodel.php */
/* Location: ./application/controllers/admin/servicemodel.php */