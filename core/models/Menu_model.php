<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Menu_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        //$this->_table = 'webinars';

    }
   
    function delete($table_name,$where,$orcondition='')
    {
        $this->db->where($where);
        if(!empty($orcondition)) {
            $this->db->or_where($orcondition);
        }
       return  $this->db->delete($table_name);
    }
    
   
	function get_all($table_name,$where)
    {
		
		$this->db->select('*');
		$this->db->from($table_name);
        $this->db->where($where);
        $this->db->or_where("all",1);
        $this->db->order_by("id","ASC");
		$result = $this->db->get()->result_array();
		return $result;
		
	}
	
	
    function get_content($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
    
    
    
}
?>
