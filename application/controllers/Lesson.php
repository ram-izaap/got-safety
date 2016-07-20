<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Lesson extends App_Controller {
	
	
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
        $this->load->model(array('lession_model'));
        $this->load->model(array('contact_model'));
        //echo $this->layout->get_img_dir();
    }

  /*  public function index()
    {
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}
		
		
		
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
		
		
		
		
		$this->data['list_data'] = $this->lession_model->get_lession_detail("lession",array("created_user"=> $user_id,"is_active" => 1));
		$this->data['lesson_content'] = $this->lession_model->get_info("lesson_content");
		$this->data['img_url']=$this->layout->get_img_dir();
     	$this->layout->view('lesson/lesson','frontend');
        
    } */
    
    
   /* public function get_lesson_data()
    {
		$this->data['img_url']=$this->layout->get_img_dir();
		$lession_id = $this->input->post('view_param');
		
		$this->data['view_link'] = $this->lession_model->get_lession_attachment("lession_attachment",array("lession_id" => $lession_id,"is_active" => 1));
		
		$this->data['view_content'] = $this->lession_model->get_lession_attachment("lession",array("id" => $lession_id,"is_active" => 1));

		$response['html_view'] = $this->load->view('lesson/lesson_attachment',$this->data,TRUE);
  
		echo json_encode($response);
		
		
	} */
	
	
	
	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}
		
		
		$this->data['get_attachment'] = $this->lession_model->get_language_attachment(array("l.is_active" => 1,"a.language" => 1));
		
		$this->data['get_language'] = $this->lession_model->get_language("language");
		
		
		$this->data['img_url']=$this->layout->get_img_dir();
     	$this->layout->view('lesson/lesson','frontend');
		
	}
	
	
	 public function get_lesson_data()
	 {
		 $lesson_id = $this->input->get('lesson_id');
		 $attachment_id = $this->input->get('attachment_id');
		 $language_id = $this->input->get('language_id');
		 
		 $this->session->set_userdata('lesson_id',$lesson_id);
		 $less_id = $this->session->userdata('lesson_id');
		 
		 $this->data['atachment_detail'] = $this->lession_model->get_lession_attachment_details(array("a.lession_id" => $lesson_id,"a.is_active" => 1));
		 
		 $this->data['language_content'] = $this->lession_model->get_language_content("lession_attachment",array("id" => $attachment_id,"language" => $language_id,"is_active" => 1));
		 
		 $this->data['get_language'] = $this->lession_model->get_language("language");
		 
		 $this->data['img_url']=$this->layout->get_img_dir();
		 $this->layout->view('lesson/lesson_data','frontend');
		 
		
	 }
	 
	 
	
	public function ajax_lesson_display()
    {
		$language_id = $this->input->post('language_id');
		
		
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}
		
		
		$this->data['get_attachment'] = $this->lession_model->get_language_attachment(array("l.is_active" => 1,"a.language" => $language_id));
		
		$this->data['get_language'] = $this->lession_model->get_language("language");

		$response['html_view'] = $this->load->view('lesson/ajax_lesson_display',$this->data,TRUE);
  
		echo json_encode($response);
		
		
	}
	
	
	public function ajax_attachment_display()
    {
		$language_id = $this->input->post('language_id');
		$lesson_id = $this->session->userdata('lesson_id');
		
		
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}
		
		$this->data['atachment_detail'] = $this->lession_model->get_lession_attachment_details(array("a.lession_id" => $lesson_id,"a.is_active" => 1));
		 
		 $this->data['language_content'] = $this->lession_model->get_language_content("lession_attachment",array("lession_id" => $lesson_id,"language" => $language_id,"is_active" => 1));
		 
		$this->data['get_language'] = $this->lession_model->get_language("language");

		$response['html_view'] = $this->load->view('lesson/ajax_attachment_display',$this->data,TRUE);
  
		echo json_encode($response);
		
		
	}
	


   
   
	
}
?>
