<?php
class Cart_model extends CI_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = '';

    }

    function get_product($pid,$attr_id)
    {
		$result = $this->db->query("select a.name,a.desc,a.add_info,a.img,a.sku,b.attr_val,a.id as id1,b.attr_id,c.price,c.variation_id,d.attr_val_id,d.id,e.id,e.attr_name from products a inner join product_variation d on a.id=d.p_id inner join product_price c on c.variation_id=d.id inner join attribute_value b on b.id=d.attr_val_id inner join attribute e on e.id=b.attr_id where a.id='".$pid."' and b.id='".$attr_id."'");
        return $result->row();
	}

    function get_other_cost($type)
    {
        if($type=="tax_amt")
            $table = "tax";
        else if($type=="ship_amt")
            $table = "shipping_cost";

        $result = $this->db->get($table)->row_array();
        return $result;
    }
}
?>
