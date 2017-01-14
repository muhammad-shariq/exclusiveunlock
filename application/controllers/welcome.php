<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends FSD_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		redirect('login');
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */