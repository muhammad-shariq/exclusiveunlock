<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends FSD_Controller 
{
	var $before_filter = array('name' => 'supplier_authorization', 'except' => array());
	
	public function index()
	{
		$this->load->model('supplier_model');
		$data['template'] = "supplier/dashboard";
		$data['networks'] = $this->supplier_model->get_supplier_methods('');
		$this->load->view('supplier/master_template',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/admin/welcome.php */