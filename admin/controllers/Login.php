<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Login extends Admin_Controller 
{ 
    protected $_login_validation_rules =    array (
            array('field' => 'name', 'label' => 'Username', 'rules' => 'trim|required'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required')
          );
    function __construct()
    {
        parent::__construct();  
         $this->load->library('service_message');
        $this->load->model('login_model');
        $this->layout->add_javascripts(array('common'));
       
    }  
    public function index()
    { 
        $this->login();
    }
    
    public function login()
    {
        $role=1;
        if(is_logged_in()) 
        {
          redirect("home");
        }
       // print_r($_POST);exit;
       $this->form_validation->set_rules($this->_login_validation_rules);
       
        if($this->form_validation->run())
        {  
            $form = $this->input->post();
           

            if($this->login_model->login($form['name'], $form['password'],$role))
            { 
				$this->service_message->set_flash_message('schedule_call_success');
                redirect("home");
            }
        }
      
        $this->layout->view("login/index");
        
        
    }

    public function client()
    {
        $role=2;
        if(is_logged_in()) 
        {
          redirect("home");
        }
       // print_r($_POST);exit;
       $this->form_validation->set_rules($this->_login_validation_rules);
       
        if($this->form_validation->run())
        {  
            $form = $this->input->post();
           

            if($this->login_model->login($form['name'], $form['password'],$role))
            { 
                $this->service_message->set_flash_message('schedule_call_success');
                redirect("home");
            }
        }
      
        $this->layout->view("login/client_index");
        
        
    }
    
    public function logout()
	{
	   
		$this->session->sess_destroy();
	
		//$this->session->sess_create();
		//$this->service_message->set_flash_message('logout_success');
	
		redirect('login');
	}

    public function logout1()
    {
       
        $this->session->sess_destroy();
    
        //$this->session->sess_create();
        //$this->service_message->set_flash_message('logout_success');
    
        redirect('client');
    }
    
}
?>
