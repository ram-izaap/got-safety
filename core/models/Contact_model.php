<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Contact_model extends App_Model {
    
    
    function __construct()
    { 
        parent::__construct();
        //$this->_table = 'add_pages';

    }
    
    
    function insert($table_name,$data)
    {
        return $this->db->insert($table_name,$data);
    }
    
    
    function update($table_name,$data,$where)
    { 
        $this->db->where($where);
        return $this->db->update($table_name,$data);
    }
    
    
    function get_info($table_name)
    {
		
		$this->db->select("*");
        $this->db->from($table_name);
        return $result = $this->db->get()->result_array();
		
	}
    
    
    
   
    
}
?>
