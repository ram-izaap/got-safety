<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Home extends Admin_Controller 
{
    
    function __construct()
    {
        parent::__construct();  
        if(!is_logged_in()) 
        {
          redirect("login");
        }
        
        //$this->load->model('login_model');
       
    }  
    
   
    
    public function index()
    { 
    	if(is_logged_in())
       		$this->layout->view("home");
       	else
       		redirect("login");
        
    }
    
    
    
   
    
}
?>
