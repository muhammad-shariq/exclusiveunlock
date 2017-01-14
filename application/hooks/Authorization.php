<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authorization Class
 *
 * This class enables you to authorization for multi-user role system.
 *
 * @package     CodeIgniter
 * @subpackage  Hooks
 * @category    Hooks
 * @author      Muhammad Shariq
 * @version     1.0
 */
class Authorization
{
	var $CI;
	var $router;

	public function __construct()
	{
		$this->CI =& get_instance();
        $this->router =& load_class('Router');
	}

	public function validate()
	{
        $called_function = $this->router->fetch_method();
		$called_controller = $this->router->fetch_class();
		$called_directory = strtolower($this->router->fetch_directory());
		if($called_directory == 'admin/' || $called_directory == 'admin')
		{						
			$this->CI->load->model('employee_model');
			$res = $this->CI->employee_model->get_roles(array('Slug' => $called_controller, 'EmployeeID' => $this->CI->session->userdata('employee_id')));
			if(count($res) > 0)
			{
				$this->CI->access = array(
					'view' => $res[0]['View'], 
					'add' => $res[0]['Add'], 
					'edit' => $res[0]['Edit'], 
					'delete' => $res[0]['Delete']
				);
				
				switch ( strtolower($called_function)) 
				{
					case 'listener':
					case 'index':
						if($res[0]['View'] != 'Y' )
							die('Access not allowed to perform this operation.');
						else 
							$this->CI->access['view'] = 'Y';
						break;
					case 'insert':
					case 'add':
						if($res[0]['Add'] != 'Y' )
							die('Access not allowed to perform this operation.');
						else 
							$this->CI->access['add'] = 'Y';
						break;
					case 'edit':
					case 'update':
						if($res[0]['Edit'] != 'Y' )
							die('Access not allowed to perform this operation.');
						else 
							$this->CI->access['edit'] = 'Y';
						break;
					case 'delete':
						if($res[0]['Delete'] != 'Y' )
							die('Access not allowed to perform this operation.');
						else 
							$this->CI->access['delete'] = 'Y';
						break;
				}	
			}			
		}
	}
	
}