<?php

require_once(COREPATH."models/App_model.php");
class Api_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
       

    }
    
    function login($name = "",$password = "")
	{
		$where=array('name'=>$name,'password'=>md5($password));
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where("(role = 2 OR role = 3)");
		$this->db->where($where);
		return $this->db->get()->row_array();
		
	}
    
    function get_lessons( $client_id  = 0 )
    {
			
	    $date = date('Y-m-d');		
    	$sql = "SELECT * FROM lession 
    				WHERE ( created_user = '{$client_id}' OR visible_to_all = '1' ) 
    				 AND to_date >= '{$date}'";

    	return $this->db->query( $sql )->result_array();
		
	}

	function get_lesson_attachments( $lesson_id = 0 )
    {
		$result = $this->db->get_where('lession_attachment', array("lession_id" => $lesson_id,"is_active" => 1) );
        return $result->result_array();
	}

	function get_docs( $table_name, $where =array() )
    {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($where);
		 $this->db->or_where('visible_to_all',1);
		$this->db->order_by('created_date','DESC');
		$query = $this->db->get()->result_array();
		return $query;
	}


	function get_posters( $client_id  = 0 )
    {
			
	    $date = date('Y-m-d');		
    	$sql = "SELECT * FROM posters 
    				WHERE ( created_user = '{$client_id}' OR visible_to_all = '1' )";

    	return $this->db->query( $sql )->result_array();
		
	}

	function get_poster_attachments( $poster_id = 0 )
    {
		$result = $this->db->get_where('posters_attachment', array("poster_id" => $poster_id,"is_active" => 1) );
        return $result->result_array();
	}


	 function get_webinars( $client_id  = 0 )
    {
			
	    $date = date('Y-m-d');		
    	$sql = "SELECT * FROM webinars 
    				WHERE ( created_user = '{$client_id}' OR visible_to_all = '1' )";

    	return $this->db->query( $sql )->result_array();
		
	}

	function get_employees( $client_id = 0 )
    {
		$result = $this->db->get_where('employee', array("created_user" => $client_id,"is_active" => 1) );
        return $result->result_array();
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
		 $this->db->or_where('visible_to_all',1);
		$this->db->order_by('created_date','DESC');
		$query = $this->db->get()->result_array();
		return $query;
	}
	
	
	/*function get_lession_detail($table_name,$where)
    {
		// $result = $this->db->get_where($table_name,$where);
        //return $result->result_array();
        
        $this->db->select(); function get_webinars_detail($table_name,$where)
    {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($where);
		 $this->db->or_where('all',1);
		$this->db->order_by('created_date','DESC');
		$query = $this->db->get()->result_array();
		return $query;
	}
        $this->db->from($table_name);
        $this->db->where($where);
        $this->db->or_where('all',1);
        $result = $this->db->get();
        return $result->result_array();
		
	} */
	
	
	
	
	
	
	
	
	function insert($table_name,$data)
    {
        return $this->db->insert($table_name,$data);
    }
   
   /**  Get all content to dispaly in frontend **/
	
	function get_content($table_name,$where)
	{
		$result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
	
	
	function get_menu_detail($table_name,$where)
    {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($where);
		 $this->db->or_where('visible_to_all',1);
		$this->db->order_by('created_date','DESC');
		$query = $this->db->get()->result_array();
		return $query;
	}
	
	function get_poster_detail($table_name,$where)
    {
		// $result = $this->db->get_where($table_name,$where);
        //return $result->result_array();
        
        $this->db->select();
        $this->db->from($table_name);
        $this->db->where($where);
        $this->db->or_where('all',1);
        $result = $this->db->get();
        return $result->result_array();
		
	}
	
	
	
    
    
}
?>
