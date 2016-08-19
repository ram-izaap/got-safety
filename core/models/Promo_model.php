<?php
require_once(COREPATH."models/App_model.php");
class Promo_model extends App_Model 
{
	function __construct()
  { 
    parent::__construct();
    //$this->_table = 'add_pages';
  }
  public function get_products_sku($table,$where)
  {
  		$this->db->where($where);
  		$this->db->select("sku");
  		$result = $this->db->get($table);
  		return $result->result_array();
  }
  public function get_plans($table,$where)
  {
  		$this->db->where($where);
  		$this->db->select("plan_type,id");
  		$result = $this->db->get($table);
  		return $result->result_array();
  }
  public function insert($table,$data)
  {
  	$this->db->insert($table,$data);
  	return $this->db->insert_id();
  }
  public function update($table,$data,$where)
  {
  	$this->db->where($where);
  	$this->db->update($table,$data);
  	//return $this->db->insert_id();
  }
  public function get_coupons()
  {
  	//$this->db->select();
  	$result = $this->db->get("coupon_codes");
  	return $result->result_array();
  }
  public function delete($table,$where)
  {
  	$this->db->where($where);
  	$this->db->delete($table);
  }
  public function check_code($table,$where="")
  {
  	$result = $this->db->get_where($table,$where);
  	return $result->row_array();
  }
  public function get_promo_data($where)
  {
  	$this->db->select("a.*,b.*,a.id as couponid,b.id as codeid,c.value as offer");
  	$this->db->from("coupon_details a");
  	$this->db->join("coupon_codes b","a.id=b.coupon_id");
  	$this->db->join("coupon_offers_value c","a.id=c.coupon_id");
  	$this->db->where("a.id",$where);
  	$result = $this->db->get();
  	return $result->row_array();
  }
}
?>