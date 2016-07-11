<?php
class Product1_model extends CI_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'products';

    }

    function get_product($table_name,$where)
    {
		if($where=='')

		  $result = $this->db->get($table_name);
        else
          $result = $this->db->get_where($table_name,$where);
         
         return $result->result_array();
	}

    function get_all_products($cat)
    {
        if($cat!='')
            $where = 'where a.cat="'.$cat.'"';
        else
            $where='';

        $result = $this->db->query("select a.img,a.name,a.id,a.is_active,a.attr_id,b.id as id1,b.p_id as p_id1,b.attr_val_id,c.price from products a left join product_variation b on a.id=b.p_id inner join product_price c on c.variation_id=b.id $where");
        return $result->result_array();
    }

    function get_product_count($table_name,$where)
    {
         $this->db->select('count(*) as cnt');    
         $result = $this->db->get_where($table_name,$where);
         return $result->row();
    }

    function get_product_by_id($pid)
    {
        $result = $this->db->query("select a.id,a.cat,a.name,a.desc,a.sku,b.cat_name,a.add_info,a.img, IF(a.is_active='1','Active','Inactive') as is_active from products a inner join category b on a.cat=b.id where a.id='".$pid."'");
        return $result->row_array();
    }
    
    function get_attr_by_id($pid)
    {
        $result = $this->db->query("select a.attr_name,b.id ,c.id as id1,b.attr_val,c.attr_val_id,d.price from attribute a inner join attribute_value b on a.id=b.attr_id inner join product_variation c on c.attr_val_id=b.id inner join product_price d on d.variation_id=c.id where c.p_id='".$pid."'");
        return $result->result_array();
    }
}
?>
