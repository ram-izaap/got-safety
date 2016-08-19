<?php 
class Login_Model extends CI_Model
{
   protected $table = "";
   
   function __construct()
   {
     parent::__construct();
   }
   public function login($name, $password)
   { 

     $this->load->model('admin_user_model'); 

     $pass = md5($password);
     
     $user = $this->login_model->login_check($name,$pass);
     
      if(count($user)>0)
      {      
        $this->session->set_userdata('admin_data', $user);
        
        return true;
      }
      
      return false;
   }
   
   
   
   
   public function user_login($name, $password)
   {
	   $pass = md5($password);
	  // $where = array('name'=>$name,'password'=>$pass,"role"=>2);
	   $where = array('name'=>$name,'password'=>$pass);
		$this->db->select("*");
        $this->db->from('users');
        $this->db->where($where);
        $this->db->where("(role = 2 OR role = 3)");
        $result = $this->db->get()->row_array();
        
        if(count($result) > 0){
			
			 $this->session->set_userdata('user_detail', $result);
        
				$this->session->set_userdata(array(
        
                            'user_id'       => $result['id'],
                            'user_name'      => $result['name'],
                            'role'      => $result['role'],
                            'email1'      => $result['email'],
                            'created_user'      => $result['created_id'],
                            'employee_limit'      => $result['employee_limit']
                            
                          
                    ));
			return 1;
		}
    return 2;
        
   }
   
	public function login_check($name,$pass)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('name', $name);
        $this->db->where('password', $pass);
        $this->db->where("(role = 1 OR role = 2)");
        return $this->db->get()->row_array();
         
    }
    
    
    function insert($table_name,$data)
    {
      if($table_name=="users")
      {
        $data['password'] = md5($data['password']);
        $this->db->insert($table_name,$data);
        return $this->db->insert_id();
      }
      else
      {
        $this->db->insert($table_name,$data);
        return $this->db->insert_id();
      }
    }
    public function delete($table,$where)
    {
      $this->db->where($where);
      $this->db->delete($table);
    }
    public function check_coupon_applied($table,$where)
    {
      $this->db->where($where);
      $result = $this->db->get($table);
      return $result->row_array();
    }
      
   public function logout()
   {
        $this->session->sess_destroy();
   }
   function email_check($mail)
   {
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('email', $mail);
      if($this->db->get()->num_rows() > 0)
        return true;
      else
        return false;
   }
   public function code_apply($code,$plan)
   {
    $this->db->select("a.id,a.value,a.plans,a.order_type,a.discount_type,c.plan_amount");
    $this->db->from("coupon_details a");
    $this->db->join("coupon_codes b","a.id=b.coupon_id");
    $this->db->join("plan c","c.id=".$plan);
    $this->db->where("b.code",$code);
    $this->db->like("a.plans",$plan);
    $this->db->where("a.order_type","2");
    $result = $this->db->get();
    return $result->row_array();
   }
    
}

?>
