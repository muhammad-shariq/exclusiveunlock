<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filemanager extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	
	public function index()
	{
		$data['template'] = "admin/filemanager/list";
		$this->load->view('admin/master_template',$data);
	}
	
	public function elfinder_init()
	{
	  $this->load->helper('path');
	  $opts = array(
	    // 'debug' => true, 
	    'roots' => array(
	      array(
	        'driver' => 'LocalFileSystem', 
	        'path'   => set_realpath('uploads'), 
	        'URL'    => base_url('uploads'),
	        'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
	        // more elFinder options here
	      )       
	    )
	  );
	  $this->load->library('elfinder_lib', $opts);
	}
	
    public function plupload()
    {
    	$this->load->library('plupload');    	
        echo $this->plupload->process_upload($_REQUEST,$_FILES);
    }
	
	public function browse()
	{
		$data['template'] = "admin/filemanager/browse";
		$this->load->view('admin/master_template',$data);
	}		
}

/* End of file filemanager.php */
/* Location: ./application/controllers/admin/filemanager.php */