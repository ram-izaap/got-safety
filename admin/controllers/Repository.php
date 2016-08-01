<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Repository extends Admin_controller {
	
	

    function __construct() 
    {
        parent::__construct();
        
        $this->load->model('home_model');
         
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));

       if(!is_logged_in()) 
        {
          redirect("login");
        }
    }


    function index()
    { 
		$user_name = $this->session->userdata('admin_data')['name'];
		$data = $this->home_model->get_all("users",$user_name);
		
			
		$this->data['folder'] = $user_name;
        $this->data['img_url']=$this->layout->get_img_dir();
        foreach($data as $s){
			$array[] = $s['name'];
				$names = implode('|',$array);  
				}
				
				
				//str_replace(find,replace,string,count) 
				$this->data['result'] = $names ;
				//print_r($this->data['result']);exit;
        if(is_logged_in())
        	$this->layout->view("repository/elfinder");
        else
        	redirect("login");
        
        
    }
    
    
    
}

