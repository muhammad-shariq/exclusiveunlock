<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fileservices_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_fileservices";
        $this->tbl_apis = "gsm_apis";
        $this->tbl_orders = "gsm_fileservices_orders";
        $this->tbl_member_services = "gsm_member_fileservices";
	}
	
	public function get_where($params) 
	{
        $query = $this->db->get_where($this->tbl_name, $params);
        return $query->result_array();
    }  

    public function get_where_fileservices_orders($params) 
	{
        $query = $this->db->get_where($this->tbl_orders, $params);
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
    
    public function count_where($params) 
    {
		$this->db->from($this->tbl_name)->where($params);
        return  $this->db->count_all_results();
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
	
	public function get_member_price($member_id, $service_id)
	{
        $this->db->select("$this->tbl_member_services.Price, $this->tbl_name.DeliveryTime, $this->tbl_name.Description, $this->tbl_name.AllowExtension")
        ->from($this->tbl_name)
        ->join($this->tbl_member_services, "$this->tbl_name.ID = $this->tbl_member_services.FileServiceID", "inner")
        ->where(array("$this->tbl_member_services.MemberID" => $member_id, "$this->tbl_member_services.FileServiceID" => $service_id));
        $query = $this->db->get();
        return $query->result_array();
	}
	
	public function insert_batch_filemethods($data)
	{
		$this->db->insert_batch("gsm_filemember_methods", $data); 
	}

    public function update($data, $id)
    {   
        $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }

    public function delete($id)
    {
        $this->db->delete($this->tbl_name, array('ID' => $id));                
    }
    
	public function delete_file_api($api_id)
    {
        $this->db->delete($this->tbl_name, array('ApiID' => $api_id));                
    }
	
	function get_datatable($access)
	{
		$this->load->library('datatables');
		$oprations = '';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/fileservices/edit/$1").'" title="Edit this record" class="tip"><span class="isb-edit"></span></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/fileservices/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><span class="isb-delete"></span></a>';
		
		$this->datatables
				->select("ID, Title, Price, Status,CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->add_column('delete', $oprations, 'ID');		
		return $this->datatables->generate();
	}	
	
	public function get_history($id,$status)
	{
		$sql = "SELECT `gsm_fileservices_orders`.`ID`, `gsm_fileservices_orders`.`IMEI`, 
		`gsm_fileservices`.`Title`, `gsm_fileservices_orders`.`Email`, `gsm_fileservices_orders`.`Note`, 
		`gsm_fileservices_orders`.`Status`, `gsm_fileservices_orders`.`CreatedDateTime` 
		FROM (`gsm_fileservices_orders`) INNER JOIN `gsm_fileservices` ON 
		`gsm_fileservices_orders`.`FileServiceID`=`gsm_fileservices`.`ID` WHERE 
		`gsm_fileservices_orders`.`MemberID` = '$id' AND `gsm_fileservices_orders`.`Status` = '$status' ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_history_list($id,$status)
	{
		$sql = "SELECT `gsm_fileservices_orders`.`ID`, `gsm_fileservices_orders`.`IMEI`, 
		`gsm_fileservices`.`Title`, `gsm_fileservices_orders`.`Email`, `gsm_fileservices_orders`.`Note`, 
		`gsm_fileservices_orders`.`Status`, `gsm_fileservices_orders`.`CreatedDateTime` 
		FROM (`gsm_fileservices_orders`) INNER JOIN `gsm_fileservices` ON 
		`gsm_fileservices_orders`.`FileServiceID`=`gsm_fileservices`.`ID` WHERE 
		`gsm_fileservices_orders`.`MemberID` = '$id' AND `gsm_fileservices_orders`.`Status` = '$status' ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}