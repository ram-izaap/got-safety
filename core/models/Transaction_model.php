<?php
//require_once("libraries/models/App_model.php");
safe_include(COREPATH."models/App_model.php");
class Transaction_model extends App_Model 
{
	public function __construct()
  {
    parent::__construct();
    $this->_table = '';
	}
  public function gettransactionbyid($table,$where=null)
  {
  	$this->db->select('a.*,b.name,b.email');
    $this->db->join('users b','b.id=a.userid');
		$result = $this->db->get_where($table,$where);
    return $result->result_array();
  }  
  
  
  
  
    function listing()
    {  
        
	   $this->_fields = "ph.*,l.name,ph.id as id,l.email";
	   $this->db->from('payment_transaction_history ph');
	   $this->db->join('users l','l.id=ph.user_id');
	   //$this->db->group_by('ph.id'); 
	
		$id =  $this->session->userdata('admin_data')['id'];
		$role =  $this->session->userdata('admin_data')['role'];
		
		if($role == '1'){
        $this->db->where('1',1);
        }else {
			$this->db->where('ph.user_id',$id);
		}	 
		
		
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'profile_id':
                    $this->db->like('profile_id', $value);
                break;
                 
               
            }
        }
        
        
        return parent::listing();
    }
    
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
}
    
    
