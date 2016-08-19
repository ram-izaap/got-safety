<?php
//safe_include(COREPATH."models/app_model.php");

require_once(COREPATH."models/App_model.php");

class Subscribers_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'users';
    }

    
     function listing()
    {  
        $date = date('Y-m-d');
        $user_id =  $this->session->userdata('admin_data')['id']; 
        $role =  $this->session->userdata('admin_data')['role']; 
        
        if($role == '2'){
            $user_id = $this->session->userdata('admin_data')['id'];
        }else 
        {
            $user_id = '8';
        }
        
        
        $this->_fields = "p.plan_type as plan_name,p.plan_amount,u.*,u.id as id,prp.*,prp.id as prp_id,prp.user_id,IF(u.is_active='1','Active','Inactive') as is_active,IF(prp.payment_method='authorize',prp.subscription_id,prp.profile_id)as profile_id";
        
        
        
       //$this->_fields = "prp.*,u.id as userid,u.*";
       $this->db->from('users u');
       $this->db->join('payment_recurring_profiles prp','prp.user_id=u.id');
       $this->db->join('plan p','p.id=u.plan_type');
       $this->db->group_by('u.id'); 

        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                /*case 'title':
                    $this->db->like($key, $value);
                break; */
                
                case 'u.name':
                     $this->db->like('u.name', $value);
                break;
                
                case 'p.plan_type':
                    //$this->db->like('prp.profile_id', $value);
                    $this->db->like('p.plan_type', $value);
                break;
                 
               
            }
        }
        
        
        return parent::listing();
    }
    function get_user_info($id)
    {
       $this->db->select("u.*,u.id as user_id,p.plan_type as plan_name,p.plan_amount,p.plan_desc,prp.profile_status,prp.profile_id,prp.subscription_id,prp.payment_method");
       $this->db->from('users u');
       $this->db->join('payment_recurring_profiles prp','prp.user_id=u.id');
       $this->db->join('plan p','p.id=u.plan_type');
       $this->db->where('u.id',$id);
       $this->db->group_by('u.id'); 
       $query = $this->db->get()->result_array();
        return $query;
    }
    function get_user_trans($id)
    {
        $this->db->select("*");
         $this->db->where('user_id',$id);
        $query = $this->db->get('payment_transaction_history');
        return $query->result_array();
    }
    function get_user_trans($id)
    {
        $this->db->where('user_id',$id);
        return $this->db->get('coupon_applied')->row_array();
    }
    
}
?>