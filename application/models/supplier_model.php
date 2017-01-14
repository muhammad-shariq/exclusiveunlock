<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class supplier_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name="gsm_suppliers";
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

    public function update($data, $id)
    {   
        $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }

    public function delete($id)
    {
        $this->db->delete($this->tbl_name, array('ID' => $id));                
    }
	
	public function del_supplier_method($id)
    {
        $this->db->delete("gsm_supplier_methods", array('SupplierID' => $id));                
    }
	
	public function get_all_method_supplier($id)
	{
		$this->db->select('gsm_supplier_methods.*,gsm_methods.Title');
		$this->db->from('gsm_supplier_methods');
		$this->db->join('gsm_methods','gsm_methods.ID = gsm_supplier_methods.MethodID','inner');
		$this->db->where('gsm_supplier_methods.SupplierID',$id);
		$query = $this->db->get();
		return $query->result_array();		
	}
	
	public function get_supplier_methods($params = false)
	{
		$this->db->select('gsm_supplier_methods.*,gsm_methods.Title');
		$this->db->from('gsm_supplier_methods');
		$this->db->join('gsm_methods','gsm_methods.ID = gsm_supplier_methods.MethodID','inner');
		if($params)
		{
			$this->db->where($params);	
		}		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_datatable($access)
	{
		$this->load->library('datatables');
		$oprations = '';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/supplier/edit/$1").'" title="Edit this record" class="tip"><span class="isb-edit"></span></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/supplier/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><span class="isb-delete"></span></a>';
		
		$this->datatables
				->select("ID, FirstName, LastName, Mobile, Email, Status, UpdatedDateTime, CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->add_column('delete', $oprations, 'ID');		
		return $this->datatables->generate();
	}	
}