<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Payment_model extends App_Model 
{
 function __construct()
    {
        parent::__construct();
        $this->_table = 'payment_info';
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
	function get_pay_info($table_name,$where)
    {
		$result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
	
	
    
}    