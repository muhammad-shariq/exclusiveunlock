<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mep_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_mep";
	}
		
	public function get_where($params) 
	{
        $query = $this->db->get_where($this->tbl_name, $params);
        return $query->result_array();
    }  
}   