<?php
//require_once("libraries/models/App_model.php");
safe_include(COREPATH."models/App_model.php");
class Attachment_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'lession_attachment';

    }
    
    
    
    function listing()
    {  
		
		$id  = $this->session->userdata('id');
		
        $this->_fields = "*,id as id, IF(is_active='1','Active','Inactive') as is_active";
        
		$this->db->where('lession_id',$id);
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
    
    
    function update($table_name,$data,$where)
    { 
        $this->db->where($where);
        return $this->db->update($table_name,$data);
    }
    
    function get_header_info($table_name)
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
    
    
    
    
    
}
?>
