<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Login extends App_Controller {
	
	protected $_login_validation_rules =    array (
                                                    array('field' => 'name', 'label' => 'Username', 'rules' => 'trim|required'),
                                                    array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required')
												
												);
												
	
	protected $_signup_validation_rules = array(
													array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|max_length[255]'),
													array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
                                                    array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|max_length[255]'),
                                                    array('field' => 'con_password', 'label' => 'Confirm Password', 'rules' => 'trim|required|matches[password]')
                                                   
												);
												
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker'));
        $this->load->model(array('login_model'));
       
    }

    public function index()
    {
		if($_POST) { 
			
		$this->form_validation->set_rules($this->_login_validation_rules);
       
        if($this->form_validation->run())
        {
            $form = $this->input->post();
           
            $user_data = $this->login_model->user_login($form['name'], $form['password']);
            
            if($user_data == 1)
            { 
				  //$this->service_message->set_flash_message('login_success');
                redirect(" ");
            }
            else{ 
				
				// $this->service_message->set_flash_message('login_unsuccess');
				redirect("login");
			}
            
        }
        
         if($this->input->post()) {
                   
                    $this->data['form_data']      = $_POST; 
                }
        
		}else { 
			
			$this->data['form_data'] = array("name" => "","password" => "");
		}
		
     	$this->layout->view('login','frontend');
        
    }
    
    
    function signup()
	{
		//echo "in";exit;
		
		//print_r($_POST);exit;
		if($_POST) {
			 
          
            $this->load->library('email');
            
            $this->form_validation->set_rules($this->_signup_validation_rules);
            
            if($this->form_validation->run()) {  
                
                $form = $this->input->post();
                
             // print_r($form);exit;
                
                $ins_data                 = array();
                $ins_data['name']        = $form['name'];
                $ins_data['email']  = $form['email'];
                $ins_data['role']  = 2;
                $ins_data['password']  = md5($form['password']);
                $ins_data['created_date']  =  date("Y-m-d H:i:s");
                 $ins_data['is_active']  = 1;
                 $ins_data['language']  = 1;
                
                $add_user    = $this->login_model->insert("users",$ins_data);
               
                if(!empty($add_user)) {
                    //$this->service_message->set_flash_message('signup_success');
                }    
                $url = "http://izaapinnovations.com/got_safety/admin/";
                $msg = "Your Backend Login link as client ".$url."
Client username: ".$form['name']."
Password: ".$form['password']."


Thanks you..";
                
                $this->email->from('admin@gotsafety.com', 'Gotsafety');
				$this->email->to($form['email']);
				$this->email->subject('Signup Successfully');
				$this->email->message($msg);
				$this->email->send();
                
                redirect("login");
            }
            
                if($this->input->post()) {
                   
                    $this->data['form_data']      = $_POST; 
                }
            }
            else
            { 
                
                $this->data['form_data'] = array("name" => "", "email" => "", "password" => "", "con_password" => "");
                
            }
		
		
		 $this->layout->view('signup','frontend');
		
	}
    
    
    
    public function logout()
	{
	   
		$this->session->sess_destroy();
	
		//$this->session->sess_create();
		//$this->service_message->set_flash_message('logout_success');
	
		redirect();
	}
    
    


   
   
	
}
?>
