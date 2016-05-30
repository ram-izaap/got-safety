<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Webinars_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'webinars';

    }
    
    
    
    function listing()
    {  
		$user_id =  $this->session->userdata('admin_data')['id']; 
		$role =  $this->session->userdata('admin_data')['role']; 
		
		if($role == '2'){
			$user_id = $this->session->userdata('admin_data')['id'];
		}else 
		{
			$user_id = '8';
		}
		
		$id  = $this->session->userdata('id');
		
        $this->_fields = "*,id as id, IF(is_active='1','Active','Inactive') as is_active";
        
        if($role == '2'){
        $this->db->where('created_user',$user_id);
        }else {
			$this->db->where('updated_user',$user_id);
		}
        
		
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'title':
                    $this->db->like($key, $value);
                break;
                 
               
            }
        }
        
        
        return parent::listing();
    }
    
     function get_slideimage_detail($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
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
    
    function get_menu($table_name)
    {
		
		$this->db->select("*");
        $this->db->from($table_name);
        return $result = $this->db->get()->result_array();
		
	}
	 function get_menu_webinars($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
	
	
	
    function delete($table_name,$where,$orcondition='')
    {
        $this->db->where($where);
        if(!empty($orcondition)) {
            $this->db->or_where($orcondition);
        }
       return  $this->db->delete($table_name);
    }
    
    
     function language_check_exists($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
	
	function get_webinars_most($table_name,$where)
    {
		
		$this->db->select('*');
		$this->db->from($table_name);
        $this->db->where($where);
         $this->db->or_where("visible_to_all",1);
        $this->db->order_by("id","desc");
        $this->db->limit(0,1);
		$result = $this->db->get()->result_array();
		return $result;
		
	}
	
	function get_webinars_all($table_name,$where)
    {
		
		$this->db->select('*');
		$this->db->from($table_name);
        $this->db->where($where);
        $this->db->or_where("visible_to_all",1);
        $this->db->order_by("id","ASC");
		$result = $this->db->get()->result_array();
		return $result;
		
	}
	
	
	function get_webinars_attachment($table_name,$where)
	{
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
    
    
    
    
}
?>
