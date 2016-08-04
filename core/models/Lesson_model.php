<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Lesson_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'lession';

    }
    
    
    
    function listing()
    {  
		$date = date('Y-m-d');
		$user_id =  $this->session->userdata('admin_data')['id']; 
		$role =  $this->session->userdata('admin_data')['role']; 
		
		if($role == '2'){
			$user_id = $this->session->userdata('admin_data')['id'];
		}else 
		{
			$user_id = '8';
		}
		
		
        //$this->_fields = "*,id as id, IF(is_active='1','Active','Inactive') as is_active";
        
        
        
        $this->_fields = "l.*,l.id as id,a.language,la.id as laid,la.lang, IF(l.is_active='1','Active','Inactive') as is_active";
       $this->db->from('lession l');
       $this->db->join('lession_attachment a','a.lession_id=l.id', 'left');
       $this->db->join('language la','la.id=a.language','left');
       $this->db->group_by('l.id'); 
       
       
       
        if($role == '2'){
        $this->db->where('l.created_user',$user_id);
        $this->db->where('l.from <=',$date);
        $this->db->where('l.to_date >=',$date);
        }else {
			$this->db->where('l.updated_user',$user_id);
			$this->db->where('l.to_date >=',$date);
		}
       
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                /*case 'title':
                    $this->db->like($key, $value);
                break; */
                
                case 'l.title':
                     $this->db->like('l.title', $value);
                break;
                
                case 'la.lang':
                    $this->db->like('la.lang', $value);
                break;
                 
               
            }
        }
        
        
        return parent::listing();
    }
    
    function get_menu($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
    
    
      function get_lession_data($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
    
    
    
    function insert($table_name,$data)
    {
        return $this->db->insert($table_name,$data);
    }
    
    
    function insert_lesson($table_name,$data)
    {
        $this->db->insert($table_name,$data);
        return $this->db->insert_id();
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
	
	function delete($table_name,$where,$orcondition='')
    {
        $this->db->where($where);
        if(!empty($orcondition)) {
            $this->db->or_where($orcondition);
        }
       return  $this->db->delete($table_name);
    }
    
    
    function get_lession_detail($table_name,$where)
    {
		// $result = $this->db->get_where($table_name,$where);
        //return $result->result_array();
        
        $this->db->select();
        $this->db->from($table_name);
        $this->db->where($where);
        $this->db->or_where('visible_to_all',1);
        $result = $this->db->get();
        return $result->result_array();
		
	}
	
	
	function get_lession_attachment($table_name,$where)
	{
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
	
	
	function get_language_content($table_name,$where)
	{  
		 $result = $this->db->get_where($table_name,$where);
        return $result->row_array();
	}
	
	
	function get_lession_attachment_list($id="")
	{
		
		$result = $this->db->select("a.id as id,l.id as lid,a.language,l.lang,a.title,a.content, IF(a.is_active='1','Active','Inactive') as is_active");
        $this->db->from('language l');
        $this->db->join('lession_attachment a','a.language=l.id', 'right');
        $this->db->group_by('a.id');
		$this->db->where('a.lession_id',$id);
		 return $result = $this->db->get()->result_array();
		
	}
	
	
	function get_language_attachment($where,$like='')
	{

        
        $date = date('Y-m-d');
		$user_id =  $this->session->userdata('user_detail')['id']; 
        $role =  $this->session->userdata('role'); 
        
        if($role == '2')
        {
            $user_id = $this->session->userdata('user_detail')['id'];
        }
        else 
        {
            $user_id = $this->session->userdata('created_user');
        }
		

       $result = $this->db->select("l.id as id,a.language,l.rec_lesson,la.id as laid,la.lang,a.title as att_title,a.content as att_content,a.id as att_id");
       $this->db->from('lession l');
       $this->db->join('lession_attachment a','a.lession_id=l.id', 'left');
       $this->db->join('language la','la.id=a.language','left');
       $this->db->group_by('l.id'); 
       $this->db->order_by('l.rec_lesson','desc');


         $this->db->like('a.title',$like);

        /*if($role == '2')
        {*/

        
        

        $this->db->where('l.to_date >=',$date);

        $this->db->where("(l.created_user=$user_id or l.visible_to_all=1)");


        //$this->db->where('l.created_user',$user_id);

        //$this->db->or_where('l.visible_to_all=1');

        $this->db->where($where);
        
        /*}
        else 
        {

			$this->db->where('l.updated_user',$user_id);
			$this->db->where($where);
			$this->db->where('l.to_date >=',$date);
			
		}*/

		return $result = $this->db->get()->result_array();
        
       
		
	}
	
	
	function get_lession_attachment_details($where)
	{
		
		$result = $this->db->select("*");
        $this->db->from('language l');
        $this->db->join('lession_attachment a','a.language=l.id', 'right');
        $this->db->group_by('a.id');
		$this->db->where($where);
		return $result = $this->db->get()->result_array();
		
	}
	
	
	function get_language($table_name)
    {
		
		$this->db->select("*");
        $this->db->from($table_name);
        $this->db->where('is_active',1);
        return $result = $this->db->get()->result_array();
		
	}
    
    
    
    
    
}
?>
