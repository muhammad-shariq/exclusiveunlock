<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class network_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_networks";
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
	
	private function get_methods($id = 0)
	{
		$this->db->from("gsm_methods");
		if($id > 0)
		{
			$this->db->where("NetworkID",$id);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_tree()
	{
		$network = $this->get_all();
		$data = array();
		foreach($network as $key => $val)
		{
			$data[$key]['Title'] = $val['Title'];
			$data[$key]['Method'] = $this->get_methods($val['ID']); 			  
		}
		return $data;
	}
	
	private function get_edit_methods($methodid = 0 , $id =0)
	{
		$this->db->select("gsm_member_group_methods.*,gsm_methods.Title As MethodTitle");
		$this->db->from("gsm_member_group_methods");
		$this->db->join("gsm_methods","gsm_methods.ID = gsm_member_group_methods.MethodID","inner");
		if($id > 0 )
		{
			$this->db->where("MemberGroupID",$id);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_edit_tree($id)
	{
		$network = $this->get_all();
		$data = array();
		foreach($network as $key => $val)
		{
			$data[$key]['Title'] = $val['Title'];
			$data[$key]['Method'] = $this->get_edit_methods($val['ID'],$id); 			  
		}
		return $data;
	}
	
	public function delete_methods($groupid = 0)
	{
		if($groupid > 0)
			$this->db->delete("gsm_member_group_methods", array('MemberGroupID' => $groupid));
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

    public function delete($id)
    {
        $this->db->delete($this->tbl_name, array('ID' => $id));                
    }
	
	function get_datatable($access)
	{
		$this->load->library('datatables');
		$oprations = '';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/network/edit/$1").'" title="Edit this record" class="tip"><span class="isb-edit"></span></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/network/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><span class="isb-delete"></span></a>';
		
		$this->datatables
				->select("ID, Title, UpdatedDateTime, CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->add_column('delete', $oprations, 'ID');		
		return $this->datatables->generate();
	}	
}