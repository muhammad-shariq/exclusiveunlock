<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class servicemodel_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name="gsm_models";
		$this->brnd_name = "gsm_brands";
	}
	
	public function get_where($params) 
	{
        $query = $this->db->get_where($this->tbl_name, $params);
        return $query->result_array();
    }

   /*public function get_mep()
   {
   	$this->db->from("gsm_mep");
	$this->db->where('Status','Enabled');
	$query = $this->db->get();
	return $query->result_array();
   }*/

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
    	   
        $this->db->update($this->tbl_name, $data, array('ModelID' => $id));
    }
	
	public function update_roles($data, $id)
	{
		$this->db->update( "hr_modules_access", $data, array('ID' => $id));
	}
	
	public function disabled_roles($data, $servicemodelid)
	{		
		$this->db->update( "hr_modules_access", $data, array('servicemodelID' => $servicemodelid));
	}

    public function delete($id)
    {
        $this->db->delete($this->tbl_name, array('ModelID' => $id));                
    }
	
	//delete all if parent brand is deleted
	public function delete_BrandModel($id)
    {
        $this->db->delete($this->tbl_name, array('BrandID' => $id));                
    }
	
	
	function get_datatable($access)
	{
		$this->load->library('datatables');
		$oprations = '';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/servicemodel/edit/$1").'" title="Edit this record" class="tip"><span class="isb-edit"></span></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/servicemodel/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><span class="isb-delete"></span></a>';
		
		$this->datatables
				->select("gsm_models.ModelID, gsm_models.Title,gsm_brands.Title As BrandTitle,gsm_models.Status, gsm_models.UpdatedDateTime, gsm_models.CreatedDateTime", TRUE)
				->from($this->tbl_name)
				->join("gsm_brands","gsm_brands.BrandID = gsm_models.BrandID")
				->add_column('delete', $oprations, 'gsm_models.ModelID');		
		return $this->datatables->generate();
	}	
}