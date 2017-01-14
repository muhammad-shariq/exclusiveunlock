<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class provider_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_provider";
		$this->tbl_apis = "gsm_apis";
	}
	
	public function get_where($params) 
	{
        $query = $this->db->get_where($this->tbl_name, $params);
        return $query->result_array();
    }    
	
    public function get_all() 
    {                
        $query = $this->db->get($this->tbl_name);
        return $query->result_array();
    }
    
    public function count_all() 
    {
        $query = $this->db->count_all($this->tbl_name);
        return $query;
    }

    public function insert($data) 
    {
        $this->db->insert($this->tbl_name, $data);
        $id = $this->db->insert_id();
        return intval($id);
    }
	
	public function insert_batch($data)
	{
		$this->db->insert_batch($this->tbl_name, $data);
	}

    public function update($data, $id)
    {   
        $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }
    
    public function delete_by_method_id($id)
    {
        $this->db->delete($this->tbl_name, array('MethodID' => $id));                
    }    
	
    public function delete($id)
    {
        $this->db->delete($this->tbl_name, array('ID' => $id));                
    }
}