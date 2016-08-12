<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Home_model extends App_Model {
    
    
    function __construct()
    { 
        parent::__construct();
        //$this->_table = 'add_pages';

    }
    
    
    function get_info($table_name,$where)
    {
		
		$this->db->select("*");
        $this->db->from($table_name);
        $this->db->where($where);
        return $result = $this->db->get()->result_array();
		
	}
	
	function get_all($table_name,$where)
    {
		$role = $this->session->userdata('admin_data')['role'];

		
		$this->db->select('*');
		$this->db->from($table_name);

		$this->db->where(array('role'=>'2'));

		/*if($role==1)
		{
		  $this->db->where_not_in('name', $where);
		  $this->db->where('role','2');
		}
		else if($role==2)
		{
		  $this->db->where(array('name'=>$where,'role'=>'2'));
		}*/

		$result = $this->db->get()->result_array();

		return $result;
		
	}
	
    
    
    
   
    
}
?>
