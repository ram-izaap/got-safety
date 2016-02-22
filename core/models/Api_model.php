<?php

require_once(COREPATH."models/App_model.php");
class Api_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
       

    }
    
    
    /**  get all users list  **/
    
    function get_user_list($table_name,$where)
    {
		$result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
    
    
     /**  get particular users details  **/
    
    function get_user_detail($table_name,$where)
    {
		
		$result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
	
	
	/** Login **/


	function login($name = "",$password = "")
	{
		$where=array('name'=>$name,'password'=>md5($password));
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($where);
		$query = $this->db->get()->result_array();
		
		
		if(count($query)>0){
			
			if($query[0]["is_active"] == 1){
				
				return $query;
			}
			/* User blocked */
			return 0;
			
		}
		/* password,name mismatch */
		return -1;
		
		
	}
	
	/** Get all lesson list **/
	
	function get_all_lesson_list($table_name,$where)
	{
		$result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	
	}
	
	/**  Search lesson details  **/
    
    function search_result($table_name,$title="")
    {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->like('title', $title);
		$query = $this->db->get()->result_array();
		return $query;
	}
	
	
	 /**  get particular details  **/
    
    function get_detail($table_name,$where)
    {
		$result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
	
	/**  Get lession content to dispaly in frontend **/
	
	function get_lession_content($table_name)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get()->result_array();
		return $query;
	}
  
   /**  get Webinars details  **/
    
    function get_webinars_detail($table_name,$where)
    {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->order_by('created_date','DESC');
		$query = $this->db->get()->result_array();
		return $query;
	}
    
    
}
?>
