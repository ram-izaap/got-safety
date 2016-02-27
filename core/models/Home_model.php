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
    
    
    
   
    
}
?>
