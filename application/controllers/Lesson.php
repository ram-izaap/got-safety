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

    protected $_lesson_suggest_validation_rules = array(
															array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|max_length[255]'),
															array('field' => 'company', 'label' => 'Company', 'rules' => 'trim|required'),
												            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
												            array('field' => 'phone_no', 'label' => 'Phone No', 'rules' => 'trim|required|numeric|max_length[12]|min_length[6]'),
												            array('field' => 'contact_time', 'label' => 'Contact Time', 'rules' => 'trim|required')
												        );

    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker'));
        $this->load->model(array('lesson_model'));
        $this->load->model(array('contact_model'));

         if($this->session->userdata('user_id') == "")
        {
            redirect("");
        }

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
		
		
		
		
		$this->data['list_data'] = $this->lesson_model->get_lession_detail("lession",array("created_user"=> $user_id,"is_active" => 1));
		$this->data['lesson_content'] = $this->lesson_model->get_info("lesson_content");
		$this->data['img_url']=$this->layout->get_img_dir();
     	$this->layout->view('lesson/lesson','frontend');
        
    } */
    
    
   /* public function get_lesson_data()
    {
		$this->data['img_url']=$this->layout->get_img_dir();
		$lession_id = $this->input->post('view_param');
		
		$this->data['view_link'] = $this->lesson_model->get_lession_attachment("lession_attachment",array("lession_id" => $lession_id,"is_active" => 1));
		
		$this->data['view_content'] = $this->lesson_model->get_lession_attachment("lession",array("id" => $lession_id,"is_active" => 1));

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
		
		
		$this->data['get_attachment'] = $this->lesson_model->get_language_attachment(array("l.is_active" => 1,"a.is_active" => 1,"a.language" => 1));
		
		$this->data['get_language'] = $this->lesson_model->get_language("language");
		
		$data['title'] = "Lesson Suggestion";
		
	    $data['form_data'] = array("name" => "","company" =>"","email" => "","phone_no" => "","lesson_suggestion" => "","contact_time" => ""); 

		$this->data['lesson_suggestion'] = $this->load->view("lesson/lesson_suggestion",$data,true);

		$this->data['img_url']=$this->layout->get_img_dir();
     	$this->layout->view('lesson/lesson','frontend');
		
	}
	
	
	 public function get_lesson_data()
	 {
		 $lesson_id = $this->input->post('lesson_id');
		 $attachment_id = $this->input->post('attachment_id');
		 $language_id = $this->input->post('language_id');
		 
		 $this->session->set_userdata('lesson_id',$lesson_id);
		 $less_id = $this->session->userdata('lesson_id');

		 $this->session->set_userdata('language_id',$language_id);
		 $languageid = $this->session->userdata('language_id');
		 
		 $this->data['atachment_detail'] = $this->lesson_model->get_lession_attachment_details(array("a.lession_id" => $lesson_id,"a.is_active" => 1,"l.is_active" => 1));
		 
		 $this->data['language_content'] = $this->lesson_model->get_language_content("lession_attachment",array("id" => $attachment_id,"language" => $language_id,"is_active" => 1));
		 
		 $this->data['get_language'] = $this->db->query("select a.lang,a.id,b.language from language a inner join lession_attachment b on a.id=b.language where b.lession_id=".$lesson_id." and a.is_active=1 and b.is_active=1")->result_array();

		 $this->data['selected_language'] = $language_id;

		 $this->data['lesson_id'] = $lesson_id;
		 
		 $this->data['img_url']=$this->layout->get_img_dir();
		 $content = $this->load->view('lesson/lesson_data',$this->data,TRUE);
		 $status = 'success';
         echo json_encode(array('status'=>$status,'content'=>$content));
		 
	 }
	 
	 
	
	public function ajax_lesson_display()
    {
		$language_id = $this->input->post('language_id');
		$title = $this->input->post('title');
		
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}	
		
		$this->data['get_attachment'] = $this->lesson_model->get_language_attachment(array("l.is_active" => 1,"a.is_active"=>1,"a.language" => $language_id),$title);
		
		$this->data['get_language'] = $this->lesson_model->get_language("language");

		$response['html_view'] = $this->load->view('lesson/ajax_lesson_display',$this->data,TRUE);
		echo json_encode($response);
		
		
	}
	
	
	public function ajax_attachment_display()
    {
		$language_id = $this->input->post('language_id');
		
		$lesson_id = $this->session->userdata('lesson_id');
		
		
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2)
		{
			$user_id = $this->session->userdata('user_id');
		}
		else
		{
			$user_id = $this->session->userdata('created_user');
		}
		
		$this->data['atachment_detail'] = $this->lesson_model->get_lession_attachment_details(array("a.lession_id" => $lesson_id,"a.is_active" => 1,"l.is_active" => 1));
		 
		$this->data['language_content'] = $this->lesson_model->get_language_content("lession_attachment",array("lession_id" => $lesson_id,"language" => $language_id,"is_active" => 1));
		 
		$this->data['get_language'] = $this->lesson_model->get_language("language");

		$this->data['lesson_id'] = $lesson_id;

		$response['html_view'] = $this->load->view('lesson/ajax_attachment_display',$this->data,TRUE);
  
		echo json_encode($response);
		
		
	}

	public function lesson_suggestion()
	{
		$this->form_validation->set_rules($this->_lesson_suggest_validation_rules);
            
            if($this->form_validation->run())
            {  
                $form = $this->input->post(); 
                $ins_data['name'] = $form['name'];                             
                $ins_data['company'] = $form['company'];
                $ins_data['email'] = $form['email'];
                $ins_data['phone_no'] = $form['phone_no'];
                $ins_data['lesson_suggestion'] = $form['lesson_suggestion'];
                $ins_data['contact_time'] = $form['contact_time'];
                $ins_data['lesson_id'] = $lesson_id = $this->session->userdata('lesson_id');
                $ins_data['user_id'] = $this->session->userdata['created_user'];
                $ins_data['created_date'] = date("Y-m-d H:i:s");
                
                $languageid = $this->session->userdata('language_id');
                $this->db->insert("lesson_suggestion",$ins_data);

                if(isset($lesson_id) && !empty($lesson_id))
                {
                  $get_lesson_content = $this->db->get_where("lession_attachment",array("lession_id"=>$lesson_id,"language"=>$languageid))->row();
                
                  $ins_data['lesson_name'] = $get_lesson_content->title;
                }
                
                $data['lesson_data'] = $ins_data;
                $message = $this->load->view('lesson/system_email_template', $data, TRUE);

                $this->config->load('email_config');
                $this->load->library('email',$this->config->item('email'));

                $this->email->clear(TRUE);
		        $this->email->set_mailtype("html");

		        $this->email->set_newline("\r\n");
                $this->email->from('admin@gotsafety.com', 'Gotsafety');
				$this->email->to($form['email'] );
				$this->email->subject('Lesson Suggestion');
				$this->email->message($message);
				$this->email->send();

                $this->session->set_flashdata("lession_suggestion_succ","Thank you for your suggestion",TRUE);

                $this->session->unset_userdata("language_id");
                $this->session->unset_userdata("lesson_id");

                $data['form_data'] = array("name" => "","company" =>"","email" => "","phone_no" => "","lesson_suggestion" => "","contact_time" => "");
                
                $data['title'] = "Lesson Suggestion";
            	$status = "success";
            	$content = $this->load->view("lesson/lesson_suggestion",$data,TRUE);

            	echo json_encode(array("status"=>$status,"content"=>$content));
            }

            else
            {
            	if($this->input->post()) 
		        { 
		        	$data['form_data'] = $_POST;
		        
		        }
		        else
		        {
		            $data['form_data'] = array("name" => "","company" =>"","email" => "","phone_no" => "","lesson_suggestion" => "","contact_time" => ""); 
		        }

            	$data['title'] = "Lesson Suggestion";
            	$status = "failure";
            	$content = $this->load->view("lesson/lesson_suggestion",$data,TRUE);

            	echo json_encode(array("status"=>$status,"content"=>$content));
            }
        }
}
?>
