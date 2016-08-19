<?php
require_once(COREPATH."models/App_model.php");

class Order_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = '';

    }
    
    function listing()
    {  
        $date = date('Y-m-d');
        $this->_fields = "so.id,so.customer_id,so.order_status,so.created_date,so.total_amount,so.total_items,so.payment_type,u.name";
        $this->db->from('sales_order so');
        $this->db->join('users u','so.customer_id=u.id');
        
       
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'id':
                    $this->db->like('so.id', $value);
                break;
                case 'name':
                    $this->db->like('u.name', $value);
                break;
                case 'order_status':
                    $this->db->like('so.order_status', $value);
                break;
                case 'payment_type':
                    $this->db->like('so.payment_type', $value);
                break;
            }
        }
        
        
        return parent::listing();
    }
     public function get_coupons($order_id)
    {
        $this->db->where("order_id",$order_id);
        return $this->db->get("coupon_applied")->row_array();
    }
}
?>
