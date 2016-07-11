<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Product_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = '';

    }
    
    
    
    function listing()
    {  
		$date = date('Y-m-d');
		$this->_fields = "a.id,a.attr_id,a.cat,a.name,a.desc,a.sku,b.cat_name, IF(a.is_active='1','Active','Inactive') as is_active";
        $this->db->from('products a');
        $this->db->join('category b','a.cat=b.id');
        
       
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'cat_name':
                    $this->db->like($key, $value);
                break;
                case 'name':
                    $this->db->like($key, $value);
                break;
                case 'sku':
                    $this->db->like($key, $value);
                break;            }
        }
        
        
        return parent::listing();
    }
    
    
    
    
    function get_product_data($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
         return $result->result_array();
	}

    function get_product_by_id($pid)
    {
        $result = $this->db->query("select a.id,a.cat,a.name,a.desc,a.sku,b.cat_name,a.add_info,a.img, IF(a.is_active='1','Active','Inactive') as is_active from products a inner join category b on a.cat=b.id where a.id='".$pid."'");
        return $result->row_array();
    }

    function get_attr_by_id($pid)
    {
        $result = $this->db->query("select a.attr_name,b.attr_val,c.attr_val_id,d.price from attribute a inner join attribute_value b on a.id=b.attr_id inner join product_variation c on c.attr_val_id=b.id inner join product_price d on d.variation_id=c.id where c.p_id='".$pid."'");
        return $result->result_array();
    }

    function get_attr_price($pid)
    {
        $result = $this->db->query("select a.attr_val_id,a.id,b.price,b.variation_id from product_variation a inner join product_price b on a.id=b.variation_id where a.p_id='".$pid."'");
        return $result->result_array();
    }
    
    function get_attr_id($attr_val_id,$pid)
    {
       $result = $this->db->query("select attr_val_id,id from product_variation where p_id='".$pid."' and attr_val_id='".$attr_val_id."'");
       return $result->row();
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
