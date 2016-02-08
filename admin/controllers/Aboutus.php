<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Aboutus extends Admin_Controller 
{
	
	
	protected $_about_validation_rules =    array (
                                                   
														array('field' => 'content', 'label' => 'Content', 'rules' => 'trim|required')
                                                    
														);
	
    
    function __construct()
    {
        parent::__construct();  
        
        $this->load->model('about_model');
       
    }  
    
   
    
    public function index()
    { 
        
         $this->layout->view("about");
        
    }
    
    
    
     function about()
    {
		
		if(is_logged_in()) {
			
			
			
            $info = $this->about_model->get_info("about_us");
           
            $this->data['form_data'] = $info;
            
			
			$this->form_validation->set_rules($this->_about_validation_rules);
			
        if($this->form_validation->run())
        { 
            $form = $this->input->post();
            
			
			$ins_data = array();
			
			 
            
            $ins_data['content']  = $form['content'];
            $edit_id                = $_POST['edit_id'];
           
			
			
			$social_data = $this->about_model->update("about_us",$ins_data,array("id" => $edit_id));
            //$this->service_message->set_flash_message('record_update_success');
			
			redirect("home");    
			
		}	
			$this->data['title']          = "About Us";
            $this->data['crumb']        = "Update";
	
		$this->layout->view('about/about_us');
		
		}
        else
        {
            redirect("home");
        } 
		
		
		
	}
    
    
    
   
    
}
?>
