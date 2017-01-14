<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends FSD_Controller 
{
	var $before_filter = array('name' => 'authorization', 'except' => array());
	var $access = array('view' => '', 'add' => '', 'edit' => '', 'delete' => '');
	
	public function index()
	{
		$data['template'] = "admin/dashboard";
		$this->load->view('admin/master_template',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/admin/welcome.php */