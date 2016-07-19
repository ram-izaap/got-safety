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

    function get_all_products($cat,$limit,$offset)
    {
        if($limit!='' || $offset!='')
         $limit1 = 'limit '.$offset.','.$limit;

        else
         $limit1='';

        if($cat!='')
            $where = 'a.cat="'.$cat.'" and';
        else
            $where='';

        $result = $this->db->query("select a.img,a.name,a.sku,a.id,a.is_active,a.attr_id,a.updated_date,group_concat(b.id) as id1,group_concat(b.p_id) as p_id1,group_concat(b.attr_val_id) as attr_val_id,group_concat(c.price) as price,group_concat(d.attr_val) as attr_val,group_concat(d.id) as id4,group_concat(d.is_active) as active1 from products a left join product_variation b on a.id=b.p_id inner join product_price c on c.variation_id=b.id inner join attribute_value d on d.id=b.attr_val_id where $where d.is_active=1 and a.is_active=1 group by a.sku order by c.price $limit1");
        return $result->result_array();
    }

    function get_product_count($table_name,$where)
    {
         $result = $this->db->query('select b.cat,b.id,b.attr_id,b.name,count(DISTINCT(b.id)) as cnt,c.attr_id as attr_id1 from products b inner join attribute_value c on b.attr_id=c.attr_id where b.cat='.$where['cat'].' and b.is_active=1 and c.is_active=1');    
         return $result->row();
    }

    function get_product_by_id($pid)
    {
        $result = $this->db->query("select a.id,a.cat,a.name,a.desc,a.sku,b.cat_name,a.add_info,a.img, IF(a.is_active='1','Active','Inactive') as is_active from products a inner join category b on a.cat=b.id where a.id='".$pid."'");
        return $result->row_array();
    }
    
    function get_attr_by_id($pid)
    {
        $result = $this->db->query("select a.attr_name,b.id ,c.id as id1,b.attr_val,c.attr_val_id,d.price from attribute a inner join attribute_value b on a.id=b.attr_id inner join product_variation c on c.attr_val_id=b.id inner join product_price d on d.variation_id=c.id where c.p_id='".$pid."' and b.is_active=1 order by d.price");
        return $result->result_array();
    }
}
?>
