<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Contactus extends Admin_Controller 
{
	
	
	protected $_contact_validation_rules =    array (
                                                   
														array('field' => 'content', 'label' => 'Content', 'rules' => 'trim|required')
                                                    
														);
	
    
    function __construct()
    {
        parent::__construct();  
        
        $this->load->model('contact_model');
       
    }  
    
   
    
    public function index()
    { 
        
         $this->layout->view("contact");
        
    }
    
    
    
     function contact()
    {
		
		if(is_logged_in()) {
			
			
			
            $info = $this->contact_model->get_info("contact_us");
           
            $this->data['form_data'] = $info;
            
			
			$this->form_validation->set_rules($this->_contact_validation_rules);
			
        if($this->form_validation->run())
        { 
            $form = $this->input->post();
            
			
			$ins_data = array();
			
			 
            
            $ins_data['content']  = $form['content'];
            $edit_id                = $_POST['edit_id'];
           
			
			
			$social_data = $this->contact_model->update("contact_us",$ins_data,array("id" => $edit_id));
            //$this->service_message->set_flash_message('record_update_success');
			
			redirect("home");    
			
		}	
			$this->data['title']          = "Contact Us";
            $this->data['crumb']        = "Update";
	
		$this->layout->view('contact/contact_us',$this->data);
		
		}
        else
        {
            redirect("home");
        } 
		
		
		
	}
    
    
    
   
    
}
?>
