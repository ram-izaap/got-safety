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
                            'created_user'      => $result['created_id']
                            
                          
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
   
   
   
   
   
   public function logout()
   {
        $this->session->sess_destroy();
   }
    
}

?>
