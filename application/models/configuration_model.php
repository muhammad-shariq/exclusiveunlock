<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class configuration_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name="app_configurations";
	}

    function get_all() 
    {                
        $query = $this->db->get($this->tbl_name);
        return $query->result_array();
    }

    function update($data)
    {   
        $this->db->update($this->tbl_name, $data, array());
    }
}