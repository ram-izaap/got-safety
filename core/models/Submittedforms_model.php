<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Submittedforms_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = '';
    }
    
    
    
    /*function listing()
    {  
		$user_id =  $this->session->userdata('admin_data')['id'];
		
       $this->_fields = "ld.*,u.name";
       $this->db->from('submitted_forms ld');
       $this->db->join('employee l','l.id=ld.employee_id');
       $this->db->join('users u','u.id=ld.client_id');
       
       
       if($user_id !=8){
			$this->db->where('client_id' ,$user_id);
		}
		
		 $this->session->set_userdata('search_field',$this->criteria['search_type']);
		 $this->session->set_userdata('search_value',$this->criteria['search_text']);
      
     
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'l.employee_name':
                     $this->db->like('l.employee_name', $value);
                break;
                
               
                case 'ld.created_date':
                    $this->db->like('ld.created_date', $value);
                break;
                case 'u.name':
                    $this->db->like('u.name', $value);
                break;
                case 'ld.emp_id':
                    $this->db->like('ld.emp_id', $value);
                break;
                 
               
            }
        }
        
        
        return parent::listing();
    }*/

    function listing()
    {  
        $user_id =  $this->session->userdata('admin_data')['id'];
        
       $this->_fields = "u.id,f.id as form_id,u.name,f.type,f.filename,f.client_id,f.created_date";
       $this->db->from('users u');
       $this->db->join('forms f','f.client_id=u.id');

       $this->db->order_by("f.created_date","desc");

       

       
       if($user_id !=8)
       {
            $this->db->where('u.id' ,$user_id);
        }
        
         $this->session->set_userdata('search_field',$this->criteria['search_type']);
         $this->session->set_userdata('search_value',$this->criteria['search_text']);
      
     
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
               
                
                case 'u.name':
                    $this->db->like('u.name', $value);
                break;
                case 'f.created_date':
                    $this->db->like('f.created_date', $value);
                break;

                case 'f.type':
                    $this->db->like('f.type', $value);
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
		
		$result = $this->db->query("SELECT u.name, f.* FROM users u INNER JOIN forms f ON f.client_id = u.id where f.id=$search_value")->row_array();
		
		//$result = $this->db->query("select * from submitted_forms as ld JOIN employee as l ON l.id = ld.employee_id JOIN users as u ON u.id = ld.client_id JOIN lession as le ON le.id=ld.lesson_id WHERE $search_field LIKE '%$search_value%'")->result_array();
		
		return $result;
		
	}
    
    
    
    
}
?>
