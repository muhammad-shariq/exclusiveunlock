<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class menu_model extends CI_Model
{

	public function __construct()
	{
		parent:: __construct();
		$this->tbl_name = "cms_nav_menu_items";
	}
	
	public function get($params)
	{		
		$this->db->from($this->tbl_name);
		$this->db->order_by("SortOrder", "ASC");
		if(count($params)>0)
			$this->db->where($params);
		$query = $this->db->get();
		return $query->result_array();
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
	
	public function get_all_menus()
	{
		$this->db->from('cms_nav_menus');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_menu_tree()
	{
		$tree = array();
		$res = $this->get_all_menus();
		foreach ($res as $key => $value)
		{
			$tree[$key] = array(
				'ID' => $value['ID'],
    			'Title' => $value['Title']
			);
			$tree[$key]['children'] = $this->menu_showNested(array("MenuID"=>$value['ID'],"ParentID"=>0));
		}
		return $tree;
	}
	
	
	function get_tree($params,$id)
	{
		$tree = array();
		$res = $this->get_menus($id);
		//echo $id;
		foreach ($res as $key => $value)
		{
			$tree[$key] = array('ID' => $value['ID'],
    						'Title' => $value['Title']
			);
			$tree[$key]['children'] = $this->menu_showNested($params);
		}
		return $tree;
	}
	
	function get_menus($id)
	{
		$this->db->cache_on();
		$this->db->from('cms_nav_menus');
		$this->db->where('ID',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	/* Function menu_showNested
	 * @desc Create inifinity loop for nested list from database
	 * @return echo string
	 */
	private function menu_showNested($params)
	{
		$tree = array();
		$dataset = $this->get($params);
		foreach ($dataset as $key => $value)
		{
			$tree[$key] = $value;
			$tree[$key]['children'] = $this->menu_showNested(array("MenuID"=>$value['MenuID'],"ParentID"=>$value['ID']));
		}
		return $tree;
	}
	
	public function UpdateMenuOrder($data)
	{
		$json = json_decode($data['JsonData']);		
		$this->UpdateMenuOrderArray($data['MenuID'],0, $json);
	}

	//Insert Menu Order Json
	private function UpdateMenuOrderArray($menu_id,$parent_id,$array)
	{
		//Base case: an empty array produces no list
		if (empty($array)) return;
		$i=0;
		//Recursive Step: make a list with child lists
		foreach ($array as $key => $subArray)
		{
			$i++;
			$id = $subArray->id;
			$data['SortOrder'] = ($parent_id===0?$i:intval($parent_id."".$i));			
			$data['ParentID'] = $parent_id;
			$data['MenuID'] = $menu_id;
			$data['UpdatedDateTime'] = date("Y-m-d H:i:s");
			$this->update($data, $id);
			if (isset($subArray->children))
				$this->UpdateMenuOrderArray($menu_id,$subArray->id,$subArray->children);
		}
	}
		
	function get_datatable($access)
	{
		$this->load->library('datatables');
		$oprations = '';
		if($access['edit'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/menu/edit/$1").'" title="Edit this record" class="tip"><span class="isb-edit"></span></a>';
		if($access['delete'] == 'Y')
			$oprations .= '<a href="'.site_url("admin/menu/delete/$1").'" title="Delete this record" class="tip" onclick="return confirm(\'Are sure want to delete this record?\');"><span class="isb-delete"></span></a>';

		$this->datatables
				->select("ID, Title, Url, SortOrder,UpdatedDateTime, CreatedDateTime, Status", TRUE)
				->from($this->tbl_name)
				->add_column('delete', $oprations, 'ID');		
		return $this->datatables->generate();
	}	
}