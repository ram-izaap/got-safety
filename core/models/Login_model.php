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
        return $this->db->get()->row_array();
         
    }
    
    
    function insert($table_name,$data)
    {
        
       $data['password'] = md5($data['password']); 
      if($table_name=="users")
      {
        $this->db->insert($table_name,$data);
        return $this->db->insert_id();
      }
      else
        return $this->db->insert($table_name,$data);
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
    
}

?>
