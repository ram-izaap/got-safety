<?php
//require_once("libraries/models/App_model.php");
safe_include(COREPATH."models/App_model.php");
class Transaction_model extends App_Model 
{
	public function __construct()
  {
    parent::__construct();
    $this->_table = 'authorize_subscription_transaction';
	}
  public function gettransactionbyid($table,$where=null)
  {
  	$this->db->select('a.*,b.name,b.email');
    $this->db->join('users b','b.id=a.userid');
		$result = $this->db->get_where($table,$where);
    return $result->result_array();
  }  
}
    
    