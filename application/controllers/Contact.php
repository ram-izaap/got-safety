<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Contact extends App_Controller {
	
	protected $_enquiry_validation_rules = array( 
                                                        array('field' => 'first_name', 'label' => 'First Name',  'rules' => 'trim|required'),
                                                        array('field' => 'last_name', 'label' => 'Last Name',  'rules' => 'trim|required'),
                                                        array('field' => 'number', 'label' => 'Number',  'rules' => 'trim|required'),
                                                        array('field' => 'company', 'label' => 'Company',  'rules' => 'trim|required'),
                                                        array('field' => 'best_time', 'label' => 'Best Time to Contact','rules' => 'trim'),
                                                        array('field' => 'suggestion','label' => 'Suggestion','rules' => 'trim'),
                                                        array('field' => 'email',  'rules' => 'trim|required|valid_email')
                                                      );
	
	
	
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker'));
        $this->load->model(array('contact_model'));
        //echo $this->layout->get_img_dir();
    }

    public function index()
    {

		$this->data['img_url']=$this->layout->get_img_dir();
		
		$this->data['info'] = $this->contact_model->get_info("contact_us");
     	$this->layout->view('contact/contact','frontend');
        
    }
    
    
    
     public function enquiry()
    {	
		
		
         if($_POST) {
			 
          
            $this->load->library('email');
            
            $this->form_validation->set_rules($this->_enquiry_validation_rules);
            
            if($this->form_validation->run()) {  
                
                $form = $this->input->post();
               
                $ins_data                 = array();
                $ins_data['first_name']   = $form['first_name'];
                $ins_data['last_name']    = $form['last_name'];
                $ins_data['email']        = $form['email'];
                $ins_data['company'] 	  = $form['company'];
                $ins_data['number']       = $form['number'];
                $ins_data['best_time']    = $form['best_time'];
                $ins_data['suggestion']    = $form['suggestion'];
               
                
                $add_enquiry     = $this->contact_model->insert("enquiry",$ins_data);
              
                $this->email->from('sarandoss@izaaptech.in', 'Got Safety');
				$this->email->to($form['email']);
				$this->email->subject('Enquiry');
				$this->email->message('Thank you');
				$this->email->send();
                
                redirect("");
            }
            
                if($this->input->post()) {
                   
                    $this->data['form_data']      = $_POST; 
                }
            }
            else
            { 
                
                $this->data['form_data'] = array("first_name" => "","last_name" => "", "email" => "", "company" => "", "number" => "","best_time" => "","suggestion" => "");
                
            }
		
		
     	$this->layout->view('contact/enquiry','frontend');
        
    }


   
   
	
}
?>
