<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fileorder_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_fileservices_orders";
		$this->tbl_services = "gsm_fileservices";
        $this->tbl_apis = "gsm_apis";
        $this->tbl_members = "gsm_members";
	}
    
    public function count_where($params) 
    {
		$this->db->from($this->tbl_name)->where($params);
        return  $this->db->count_all_results();
    }      
	
	public function get_where($params) 
	{
        $query = $this->db->get_where($this->tbl_name, $params);
        return $query->result_array();
    }    
    
	public function get_where_in(array $id) 
	{
		$this->db->select("$this->tbl_name.ID, $this->tbl_name.FileName, $this->tbl_services.Title", TRUE);
		$this->db->from($this->tbl_name);
		$this->db->join($this->tbl_services, "$this->tbl_name.FileServiceID=$this->tbl_services.ID", "inner");
		
		$this->db->where_in("$this->tbl_name.ID", $id);
        $query = $this->db->get();
        return $query->result_array();
    }	
    
    public function get_all_pending_orders()
    {
		$this->db->select("$this->tbl_apis.LibraryID, $this->tbl_apis.Host, $this->tbl_apis.Username, $this->tbl_apis.ApiKey")
		->select("$this->tbl_services.ToolID, $this->tbl_name.*")
		->from($this->tbl_apis)
		->join($this->tbl_services, "$this->tbl_apis.ID = $this->tbl_services.ApiID")
		->join($this->tbl_name, "$this->tbl_services.ID = $this->tbl_name.FileServiceID")
		->where(array("$this->tbl_name.Status" => "Pending", "$this->tbl_name.ReferenceID" => NULL))
		->order_by("$this->tbl_name.ID", "ASC");
		
        $query = $this->db->get();
        return $query->result_array();        
    }
    
	public function get_requested_pending_orders() 
	{
		$this->db->select("$this->tbl_apis.LibraryID, $this->tbl_apis.Host, $this->tbl_apis.Username, $this->tbl_apis.ApiKey")
		->select("$this->tbl_services.ToolID, $this->tbl_name.ID, $this->tbl_name.ReferenceID, $this->tbl_name.IMEI")
		->select("$this->tbl_members.Email, $this->tbl_members.FirstName, $this->tbl_members.LastName, $this->tbl_name.MemberID")
		->from($this->tbl_apis)
		->join($this->tbl_services, "$this->tbl_apis.ID = $this->tbl_services.ApiID")
		->join($this->tbl_name, "$this->tbl_services.ID = $this->tbl_name.FileServiceID")
		->join($this->tbl_members, "$this->tbl_name.MemberID = $this->tbl_members.ID")
		->where("$this->tbl_name.Status", "Pending")
		->where("`$this->tbl_name`.`ReferenceID` IS NOT NULL", NULL, false)
		->order_by("$this->tbl_name.ID", "ASC");
		
        $query = $this->db->get();
        return $query->result_array();
    }    
        
	public function bulk($params = false)
	{
		$this->db->select("gsm_fileservices.Title,gsm_fileservices_orders.IMEI,gsm_fileservices_orders.ID,gsm_fileservices_orders.Note");
		$this->db->from("gsm_fileservices_orders");
		$this->db->join("gsm_fileservices","gsm_fileservices_orders.FileServiceID = gsm_fileservices.ID","inner");
		if($params > 0 )
		{
			$this->db->where($params);
		}
		$query = $this->db->get();
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
        return $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->tbl_name, array('ID' => $id));                
    }
	
	public function get_filenames($data)
	{
		$this->db->select("FileName");
		$this->db->from($this->tbl_name);
		$this->db->where_in('ID',$data);
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	function get_datatable($access)
	{
		$this->load->library('datatables');
		$oprations = '';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/fileorder/edit/$1").'" title="Edit this record" class="tip"><span class="isb-edit"></span></a>';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/fileorder/cancel/$1").'" title="Cancel this order" class="tip"><span class="isb-cancel" onclick="return confirm(\'Are you sure to cancel record \');" ></span></a>';		
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/fileorder/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><span class="isb-delete"></span></a>';
		
		$this->datatables				
				->select("$this->tbl_name.ID, $this->tbl_name.IMEI, $this->tbl_services.Title, $this->tbl_name.Email, $this->tbl_name.Comments, $this->tbl_name.Status, $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->tbl_services, "$this->tbl_name.FileServiceID=$this->tbl_services.ID", "inner")
				//->add_column('select', '<input type="checkbox" name="Chk[]" value="$1" class="chksel">', "$this->tbl_name.ID")
				->add_column('delete', $oprations, "$this->tbl_name.ID");		
		return $this->datatables->generate();
	}
	
	public function get_file_data($id)
	{
		$this->load->library('datatables');
		$this->datatables				
				->select("$this->tbl_name.ID, $this->tbl_name.IMEI, $this->tbl_services.Title, $this->tbl_name.Email, $this->tbl_name.Note, $this->tbl_name.Status, $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->tbl_services, "$this->tbl_name.FileServiceID=$this->tbl_services.ID", "inner")
				->where("$this->tbl_name.MemberID",$id);
					
		return $this->datatables->generate();
	}	
	
	public function get_file_data_select($id,$status)
	{
		$this->load->library('datatables');
		$this->datatables				
				->select("$this->tbl_name.ID, $this->tbl_name.IMEI, $this->tbl_services.Title, $this->tbl_name.Email, $this->tbl_name.Note, $this->tbl_name.Status, $this->tbl_name.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join($this->tbl_services, "$this->tbl_name.FileServiceID=$this->tbl_services.ID", "inner")
				->where("$this->tbl_name.MemberID",$id)
				->where("$this->tbl_name.Status",$status);
					
		return $this->datatables->generate();
	}	
}