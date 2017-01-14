<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class employee_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "hr_employees";
		$this->tbl_access = "hr_modules_access";
		$this->tbl_modules = "hr_modules";
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
	
	public function update_roles($data, $id)
	{
		$this->db->update( "hr_modules_access", $data, array('ID' => $id));
	}
	
	public function disabled_roles($data, $Employeeid)
	{		
		$this->db->update( "hr_modules_access", $data, array('EmployeeID' => $Employeeid));
	}

    public function delete($id)
    {
        $this->db->delete($this->tbl_name, array('ID' => $id,'IsAdmin'=>'No'));
    }
	
	public function get_roles($params = false)
	{
		$this->db->select("hr_modules_access.*,hr_modules.Title,hr_modules.Slug");
		$this->db->from("hr_modules_access");
		$this->db->join("hr_modules","hr_modules.ID = hr_modules_access.ModuleID", "inner");
		if($params)
		{
			$this->db->where($params);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function validate_authorization($employee_id, $module_slug)
	{
		$this->db->select("Delete, View, Edit, Add");
		$this->db->from("hr_modules_access");
		$this->db->join("hr_modules","hr_modules.ID = hr_modules_access.ModuleID", "inner");
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
			$oprations .= '<a href="'.site_url("admin/employee/edit/$1").'" title="Edit this record" class="tip"><span class="isb-edit"></span></a>';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/employee/roles/$1").'" title="Edit their roles" class="tip"><span class="isb-ok"></span></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/employee/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><span class="isb-delete"></span></a>';
		
		$this->datatables
				->select("ID, FirstName, LastName, Email, UpdatedDateTime, CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->add_column('delete', $oprations, 'ID');		
		return $this->datatables->generate();
	}	
}