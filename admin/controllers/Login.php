<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/admin_controller.php");

class Login extends Admin_Controller 
{ 
    protected $_login_validation_rules =    array (
                                                    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|xss_clean'),
                                                    array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|xss_clean|min_length[4]|max_length[20]|alpha_dash')
                                                  );
    function __construct()
    {
        parent::__construct();  
        
        $this->load->model('login_model');
       
    }  
    public function index()
    { 
        $this->login();
    }
    
    public function login()
    {
       
       $this->form_validation->set_rules($this->_login_validation_rules);
       
        if($this->form_validation->run())
        {
            $form = $this->input->post();

            if($this->login_model->login($form['email'], $form['password']))
            {
                redirect("admin/dashboard");
            }
            
        }
        
        $this->layout->view("login/index");
        
    }
    
    public function logout()
	{
	   
		$this->session->sess_destroy();
	
		$this->session->sess_create();
		$this->service_message->set_flash_message('logout_success');
	
		redirect('admin/login');
	}
    
}
?>
