<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Attribute_value_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = '';

    }
    

    function listing()
    {  
        $date = date('Y-m-d');
        
        $this->_fields = "a.attr_name,b.id,b.attr_id,b.attr_val,IF(b.is_active='1','Active','Inactive') as is_active";
        $this->db->from('attribute a');
        $this->db->join('attribute_value b','a.id=b.attr_id');
       
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'attr_name':
                    $this->db->like($key, $value);
                break;
                case 'attr_val':
                    $this->db->like($key, $value);
                break;
                 
               
            }
        }
        
        
        return parent::listing();
    }  

    function get_attr_data($table_name,$where)
    {
        
         $result = $this->db->get_where($table_name,$where);
         return $result->result_array();
    }
    
}
?>
