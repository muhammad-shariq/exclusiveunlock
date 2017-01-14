<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "gsm_members";
		$this->tbl_credits = "gsm_credits";
        $this->tbl_member_fileservices = "gsm_member_fileservices";
        $this->tbl_member_methods = "gsm_member_methods";
        $this->tbl_methods = "gsm_methods";
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

    public function update($data, $id)
    {
    	if(array_key_exists("Password", $data))
		{
			if($data["Password"] != null )
			{
				$data["Password"] = md5($data["Password"]);
			}
			else 
			{
				unset($data['Password']);
			}
		}   	   
        $this->db->update($this->tbl_name, $data, array('ID' => $id));
    }
	
    ############ Insert All IMEI METHOD Prices Individually ############
    
	public function insert_method($data)
	{
		$this->db->insert($this->tbl_member_methods,$data);
	}
	
    ############ Insert All File METHOD Prices Individually ############
    
	public function insert_filemethod($data)
	{
		$this->db->insert($this->tbl_member_fileservices, $data);
	}
	
	############## DElETE RECORDS of IMEI METHODS PRICES #############
	
	public function delete_method($id)
	{
		 $this->db->delete($this->tbl_member_methods, array('MemberID' => $id)); 
	}
	
	############## DElETE RECORDS of FILE METHODS PRICES #############
	
	public function delete_filemethod($id)
	{
		 $this->db->delete($this->tbl_member_fileservices, array('MemberID' => $id)); 
	}
	
	############### Get IMEI Method Price Individually ###################
	
	public function get_all_method_member($id)
	{
		$this->db->select("$this->tbl_member_methods.*,$this->tbl_methods.Title");
		$this->db->from($this->tbl_member_methods);
		$this->db->join($this->tbl_methods,"$this->tbl_methods.ID = $this->tbl_member_methods.MethodID","inner");
		$this->db->where("$this->tbl_member_methods.MemberID", $id);
		$query = $this->db->get();
		return $query->result_array();		
	}
	
	############### Get File Service Method Price Individually ###################
	
	public function get_all_file_member_price($id = 0)
	{
		$this->db->select("$this->tbl_member_fileservices.*,gsm_fileservices.Title");
		$this->db->from($this->tbl_member_fileservices);
		$this->db->join("gsm_fileservices","gsm_fileservices.ID = $this->tbl_member_fileservices.FileServiceID","inner");
		$this->db->where("$this->tbl_member_fileservices.MemberID", $id);
		$query = $this->db->get();
		//die($this->db->last_query());
        return $query->result_array();
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
			$oprations .= '<a href="'.site_url("admin/member/edit/$1").'" title="Edit this record" class="tip"><span class="isb-edit"></span></a>
					<a href="'.site_url("admin/member/editfilemethodprice/$1").'" title="Edit File Method Price" class="tip"><span class="isb-empty_document"></span></a>
					<a href="'.site_url("admin/member/editmethodprice/$1").'" title="Edit Method Price this record" class="tip"><span class="isb-target"></span></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/member/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><span class="isb-delete"></span></a>';

		## Get Credits of member ##
		$credits = "SELECT SUM(`Amount`) FROM $this->tbl_credits C WHERE `C`.`MemberID` = $this->tbl_name.ID";

		$this->datatables
				->select("ID", TRUE)
				->select("CONCAT(`FirstName`, ' ', `LastName`) FUllName, `Mobile`, `Email`, ($credits) Credits", FALSE)
				->select("`Status`, `CreatedDateTime`", TRUE)
				->from($this->tbl_name)
				->add_column('delete', $oprations, "ID");		
		return $this->datatables->generate();
	}	
}