<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Forms1_model extends App_Model 
{

    function __construct()
    {
        parent::__construct();
        $this->_table = 'webinars';
    }

    function get_form_content($table_name,$where)
    {
		$result = $this->db->get_where($table_name,$where);
         return $result->row();
	}
	
	
	function get_form_attachment($table_name,$userid)
    {
		
		$this->db->select('*');
		$this->db->from($table_name);
        $this->db->where("(created_user=$userid or visible_to_all=1)");
        $this->db->where("is_display",1);
        $this->db->order_by("id","DESC");
		$result = $this->db->get()->result_array();
		return $result;
		
	}   
 }
?>
