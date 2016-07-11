<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Attribute_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'attribute';

    }
    
    
    
    function listing()
    {  
		$date = date('Y-m-d');
		
		
		
        $this->_fields = "*,id as id, IF(is_active='1','Active','Inactive') as is_active";
        
       
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'attr_name':
                    $this->db->like($key, $value);
                break;
                 
               
            }
        }
        
        
        return parent::listing();
    }

    function get_attr_data($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
         return $result->row();
	}
    
    function get_attr_data1($table_name,$where)
    {
        if($where!='')
          $result = $this->db->get_where($table_name,$where);
        else
          $result = $this->db->get($table_name);
         
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
