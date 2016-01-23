<?php 
class Login_Model extends CI_Model
{
   protected $table = "";
   
   function __construct()
   {
     parent::__construct();
   }
   public function login($email, $password)
   {
     $this->load->model('admin_user_model'); 

     $pass = md5($password);
     
     $user = $this->user_model->login_check($email,$pass);
     
      if(count($user)>0)
      {      
        $this->session->set_userdata('admin_data', $user);
        
        return true;
      }
      
      return false;
   }
   
   public function logout()
   {
        $this->session->sess_destroy();
   }
    
}

?>