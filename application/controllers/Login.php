<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Login extends App_Controller {
	
	protected $_login_validation_rules =    array (
                                                    array('field' => 'name', 'label' => 'Username', 'rules' => 'trim|required'),
                                                    array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required')
												
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
    
    
    public function logout()
	{
	   
		$this->session->sess_destroy();
	
		//$this->session->sess_create();
		//$this->service_message->set_flash_message('logout_success');
	
		redirect();
	}
    
    


   
   
	
}
?>
