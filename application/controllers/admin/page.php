<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	var $editor = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');		
		$this->load->helper('ckeditor');
		
		//Ckeditor's configuration
		$this->editor =  array(
		
			//ID of the textarea that will be replaced
			'id' 	=> 	'Content',
			'path'	=>	$this->config->item('ckeditor_path'),
		
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"100%",	//Setting a custom width
				'height' 	=> 	'400px',	//Setting a custom height
				'htmlEncodeOutput' => 'true',
				'stylesheetParser_skipSelectors' => '/(^body\.|^caption\.|\.high|^\.)/i',
				'bodyClass ' => '',
				'contentsCss' => base_url("css/styles.css"),				
				'filebrowserBrowseUrl' => site_url('admin/filemanager/browse').'?mode=file'
					
			)
		);
	}
	
	public function index()
	{
		$data['template'] = "admin/page/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function listener()
	{
		echo $this->page_model->get_datatable($this->access);
	}

	public function add()
	{
		//Ckeditor's configuration
		$data['ckeditor'] = $this->editor;
		$data['template'] = "admin/page/add";
		$this->load->view('admin/master_template',$data);
	}

	public function edit($id)
	{
		$data['ckeditor'] = $this->editor;
		$data['data'] = $this->page_model->get_where(array('ID'=> $id));
		$data['template'] = "admin/page/edit";
		$this->load->view('admin/master_template',$data);
	}
		
	public function delete($id)
	{
		$result = $this->page_model->get_where(array('ID'=> $id));		

		if($this->page_model->delete($id) > 0)
		{
			$this->session->set_flashdata('success', 'Record delete successfully.');
		}
		else 
		{
			$this->session->set_flashdata('warning', 'This page can not be delete.');
		}
						
		//Delete Orignal File
		if(file_exists($this->config->item('upload_page_dir').$result[0]['BannerFile']))
			unlink($this->config->item('upload_page_dir').$result[0]['BannerFile']);
		//Delete Thumb File		
		if(file_exists($this->config->item('upload_page_thumb_dir').$result[0]['BannerFile']))
			unlink($this->config->item('upload_page_thumb_dir').$result[0]['BannerFile']);		
		

		
		redirect("admin/page/");
	}
	
	public function insert()
	{
		$this->load->library('form_validation');
		$this->load->library('image_lib');		
		
		$this->form_validation->set_rules('PageName' , 'Page Name' ,'required|min_length[3]|is_unique[cms_pages.PageName]');
		$this->form_validation->set_rules('HeadTitle' , 'HeadTitle' ,'required|min_length[3]');
		$this->form_validation->set_rules('Title' , 'Title' ,'required|min_length[3]');
		$this->form_validation->set_rules('Content' , 'Content' ,'');
		$this->form_validation->set_rules('MetaKeyword' , 'Meta Keyword' ,'');
		$this->form_validation->set_rules('MetaDescription' , 'Meta Description' ,'');		

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
			
			//Upload Banner
			$config['upload_path'] = $this->config->item('upload_page_dir');
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= $this->config->item('upload_size_max');
			$this->load->library('upload', $config);			

			if ( $this->upload->do_upload('BannerFile'))
			{	
				$img_data =  $this->upload->data();
			    //your desired config for the resize() function
			    $config = array(
				    'source_image'      => $img_data['full_path'], //path to the uploaded image
				    'new_image'         => $this->config->item('upload_page_thumb_dir'), //path to
				    'maintain_ratio'    => true,
				    'width'             => 128,
				    'height'            => 128
			    );
			    
			    //you have to call the initialize() function each time you call the resize()
			    //otherwise it will not work and only generate one thumbnail
			    $this->image_lib->initialize($config);
			    $this->image_lib->resize();
			    
			    $data['BannerFile'] = $img_data['file_name']; 
			}			
			
			$id = $this->page_model->insert($data);
			$this->session->set_flashdata('success', 'Record added successfully.');
			redirect("admin/page/edit/".$id);
		}
	}		

	public function update()
	{
		$this->load->library('form_validation');
		$this->load->library('image_lib');
		$data = $this->input->post(NULL,TRUE);
		$id = $data['ID'];
		if( $data['PageNameOld'] !== $data['PageName'])
		{
			$this->form_validation->set_rules('PageName' , 'Page Name' ,'required|min_length[3]|is_unique[cms_pages.PageName]');	
		}
									
		$this->form_validation->set_rules('HeadTitle' , 'HeadTitle' ,'required|min_length[3]');
		$this->form_validation->set_rules('Title' , 'Title' ,'required|min_length[3]');
		$this->form_validation->set_rules('Content' , 'Content' ,'');
		$this->form_validation->set_rules('MetaKeyword' , 'Meta Keyword' ,'');
		$this->form_validation->set_rules('MetaDescription' , 'Meta Description' ,'');		

		if($this->form_validation->run() === FALSE)
		{
			$this->edit($id);
		}
		else
		{
			unset($data['ID']);
			unset($data['PageNameOld']);
			$data['Status'] = isset($data['Status'])?"Enabled":"Disabled"; 
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			
			if(isset($data['Delete']))
			{
				//Delete Orignal File
				if(file_exists($this->config->item('upload_page_dir').$data['Delete']))
					unlink($this->config->item('upload_page_dir').$data['Delete']);
				//Delete Thumb File		
				if(file_exists($this->config->item('upload_page_thumb_dir').$data['Delete']))
					unlink($this->config->item('upload_page_thumb_dir').$data['Delete']);
															
				$data['BannerFile'] = "";
				unset($data['Delete']); 
			}
			
			//Upload Banner
			$config['upload_path'] = $this->config->item('upload_page_dir');
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= $this->config->item('upload_size_max');
			$this->load->library('upload', $config);			

			if ( $this->upload->do_upload('BannerFile'))
			{	
				$img_data =  $this->upload->data();
			    //your desired config for the resize() function
			    $config = array(
				    'source_image'      => $img_data['full_path'], //path to the uploaded image
				    'new_image'         => $this->config->item('upload_page_thumb_dir'), //path to
				    'maintain_ratio'    => true,
				    'width'             => 128,
				    'height'            => 128
			    );
			    
			    //you have to call the initialize() function each time you call the resize()
			    //otherwise it will not work and only generate one thumbnail
			    $this->image_lib->initialize($config);
			    $this->image_lib->resize();
			    
			    $data['BannerFile'] = $img_data['file_name']; 
			}			
						
			$this->page_model->update($data, $id);
			$this->session->set_flashdata('success', 'Record updated successfully.');
			redirect("admin/page/edit/".$id);
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */