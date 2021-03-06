<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Submittedforms_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = '';
    }
    
    
    
    function listing()
    {  
		$user_id =  $this->session->userdata('admin_data')['id'];
		
       $this->_fields = "sf.*,u.name";
       $this->db->from('submitted_forms sf');
       $this->db->join('users u','u.id=sf.client_id');
       
       
       if($user_id !=8){
			$this->db->where('client_id' ,$user_id);
		}
		
		 
      
     
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
				
				case 'sf.title':
                     $this->db->like('sf.title', $value);
                break;
                
                case 'u.name':
                     $this->db->like('u.name', $value);
                break;
                
                
                case 'sf.created_date':
                    $this->db->like('sf.created_date', $value);
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
    
    
	 function get_menu_client($table_name,$where)
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
	
	
	
	function get_employee_name( $employee_id = "" )
	{
		$this->db->select('*');
		$this->db->from('employee');
        $this->db->where("id" ,$employee_id);
		$result = $this->db->get()->row();
		return $result;
		
	}
	
	
	function get_user_details( $id = "" )
	{
		$this->db->select('*');
		$this->db->from('users');
        $this->db->where("id" ,$id);
		$result = $this->db->get()->row();
		return $result;
		
	}
	
	
	
	function view_details($search_field,$search_value)
	{
		
		$result = $this->db->query("select * from submitted_forms as sf JOIN users as u ON u.id = sf.client_id WHERE $search_field = $search_value")->row_array();
		
		return $result;
		
	}
    
    
    
    
}
?>
