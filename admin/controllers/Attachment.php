<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Attachment extends Admin_controller {
	
	protected $_attachment_validation_rules = array(
			array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
			array('field' => 'content', 'label' => 'Content', 'rules' => 'trim|required'),
			array('field' => 'type', 'label' => 'Type', 'rules' => 'trim|required'),
      array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim'),
      array('field' => 'f_name', 'label' => 'File', 'rules' => 'callback_do_upload'),
      array('field' => 'f_name_quiz', 'label' => 'File', 'rules' => 'callback_do_upload2'),
      array('field' => 'slide_image', 'label' => 'Lesson', 'rules' => 'trim'),
      array('field' => 'slide_image2', 'label' => 'Quiz', 'rules' => 'trim')
    );
												
		public $upload_data  = array();
    public $upload_data1  = array();

    function __construct() 
    {
        parent::__construct();
        
       $this->load->model('attachment_model');
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));
       if(!is_logged_in()) 
        {
          redirect("login");
        }
    }


    function index()
    {
		
    		if(is_logged_in()) 
    		{

           if(isset($_GET['id']))
           
            $this->session->set_userdata('id',$_GET['id']);
            $this->layout->add_javascripts(array('listing', 'rwd-table'));  
            $this->load->library('listing');
            $this->simple_search_fields = array('l.lang' => 'Language');
             
            $this->_narrow_search_conditions = array("start_date");
            
            $str = '<a href="'.site_url('attachment/add_attachment/{id}').'" class="table-link">
                        <span class="fa-stack">
                            
                            <i class="fa fa-pencil"></i>
                        </span>
                    </a>';
     
            $this->listing->initialize(array('listing_action' => $str));

            $listing = $this->listing->get_listings('attachment_model', 'listing');

            if($this->input->is_ajax_request())
                $this->_ajax_output(array('listing' => $listing), TRUE);
            
            $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
            $this->data['simple_search_fields'] = $this->simple_search_fields;
            $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
            $this->data['per_page'] = $this->listing->_get_per_page();
            $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
            $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);        
            $this->data['listing'] = $listing;
            $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);        
            $this->layout->view("attachment/attachment_list");
        }
        
        redirect("login");
		}
    
    
    
  
	
  public function add_attachment($edit_id = "")
  {           
	  
		if(isset($_GET['id']))
       $this->session->set_userdata('id',$_GET['id']);
		
		if(is_logged_in()) 
		{
		  $this->data['img_url']=$this->layout->get_img_dir();

			$user_id =  $this->session->userdata('admin_data')['id'];      
      $get_menu= $this->attachment_model->get_language_list("users",array('id'=>$user_id));
			$this->data['lang_list'] = $get_menu[0]['language'];       
			$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			$this->data['get_menu'] = $this->attachment_model->get_menu("language");
			$this->form_validation->set_rules($this->_attachment_validation_rules);

			 $fname_ip = $this->input->post('fname_ip');
			 $fquiz_ip = $this->input->post('fquiz_ip');
			if($this->input->post('type')=="2" || $this->input->post('type')=="3")
			{
				if($this->input->post('l_url')!='' || $this->input->post('q_url')!='')
				{
					$this->form_validation->set_rules('l_url', 'lesson url', 'required');
					$this->form_validation->set_rules('q_url', 'quiz url', 'required');
				}
				else if(empty($_FILES['f_name']['name']) || empty($_FILES['f_name_quiz']['name']))
				{
					if($fname_ip=="" || $fquiz_ip=="")
					{
					 $this->form_validation->set_rules('f_name', 'lesson', 'required');
					 $this->form_validation->set_rules('f_name_quiz', 'Quiz', 'required');
					}
				}
			}

			if($this->input->post('type')=="1")
			{
				if (empty($_FILES['f_name']['name']) && empty($_POST['slide_image']) )
				{
          $this->form_validation->set_rules('f_name', 'lesson', 'required');
				} 
				
				if (empty($_FILES['f_name_quiz']['name']) && empty($_POST['slide_image2']) )
				{
					$this->form_validation->set_rules('f_name_quiz', 'Quiz', 'required');
				} 
			}	
			if(isset($_POST['language'])) 
			{
					$this->form_validation->set_rules('language', 'Language', 'trim|required|callback_language_unique_check['.$edit_id.']');
			}

      $this->upload_data = array();
       
        if($this->form_validation->run())
        { 
          $form = $this->input->post();
					
          if(count($this->upload_data) )
          { 
              $filename = (isset($this->upload_data['f_name']['file_name']))?$this->upload_data['f_name']['file_name']:"";
          }

					else
					{
						$filename = (isset($_POST['slide_image']))?$_POST['slide_image']:"";
					}					

					if(count($this->upload_data1) )
          { 
              $filename = (isset($this->upload_data1['f_name_quiz']['file_name']))?$this->upload_data1['f_name_quiz']['file_name']:"";
          }
					else
					{
						$filename2=(isset($_POST['slide_image2']))?$_POST['slide_image2']:"";
					}			
					if(isset($form['is_active'])) 
					{ 
						$form['is_active'] = $form['is_active'];	
					}
					else
					{ 
						$form['is_active'] = "0";
					}

					$id  = $this->session->userdata('id');
					if($id !="") 
          {
						$id  = $this->session->userdata('id');
					}
          else
          {
						
						$get_lesson_id = $this->attachment_model->get_lesson_id("lession_attachment",array("id" => $edit_id));
						$id = $get_lesson_id[0]['lession_id']; 
					}

					$ins_data = array();
					$ins_data['lession_id']       	= $id;
          $ins_data['language']          = $form['language'];
          $ins_data['title']          = $form['title'];
          $ins_data['content']          = $form['content'];
          $ins_data['type']          = $form['type'];
          $ins_data['is_active']  = $form['is_active'];

          if($this->input->post('type')=="1")
          {
						$ins_data['f_name']  = $filename;
						$ins_data['f_name_quiz']  = $filename2;
						$ins_data['l_url']  = "";
						$ins_data['q_url']  = "";
					}
					else
					{
						if($filename2!='' && $filename!='')
						{
							$ins_data['f_name']  = $filename;
						  $ins_data['f_name_quiz']  = $filename2;
						}
						$ins_data['l_url']  = $form['l_url'];
						$ins_data['q_url']  = $form['q_url'];
					}
					if(empty($edit_id))
					{
				    $social_data = $this->attachment_model->insert("lession_attachment",$ins_data);
	        	$this->session->set_flashdata("lesson_succ","Lesson added successfully",TRUE);
			    }
	        else 
	        { 
	          $social_data = $this->attachment_model->update("lession_attachment",$ins_data,array("id" => $edit_id));
	         $this->session->set_flashdata("lesson_succ","Lesson added successfully",TRUE);
			    }
			    redirect("lesson/add_lesson/$id");    
				}	
			 	if($edit_id)
			 	{
          $edit_data = $this->attachment_model->get_slideimage_detail("lession_attachment",array("id" => $edit_id));   
          if(!isset($edit_data[0])) 
          {
            $this->service_message->set_flash_message('record_not_found_error');
            redirect("attachment");   
          }
          $this->data['title']          = "EDIT ATTACHMENT";
          $this->data['crumb']        = "Edit";
          $this->data['form_data']      = (array)$edit_data[0];
          $this->data['form_data']['slide_image'] = $this->data['form_data']['f_name'];
          $this->data['form_data']['slide_image2']=$this->data['form_data']['f_name_quiz']; 
       	}
        else if($this->input->post()) 
        {
    			$this->data['form_data'] = $_POST;
          $this->data['title']     = "ADD ATTACHMENT";
          $this->data['crumb']   = "Add";
          $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
        }
        else
        {
          $this->data['title']     = "ADD ATTACHMENT";
          $this->data['crumb']   = "Add";
          $this->data['form_data'] = array("lession_id" => "","language" => '',"is_active" => "","slide_image" => "","f_name" => "","slide_image2" => "","f_name_quiz" => "","type" => "","l_url" => "","q_url" => "","title" => "","content" => "");
        }    
		    $this->layout->view('attachment/add');
		}
    else
    {
      redirect("admim/login");
    }  
    
	}
	
	
	function do_upload()
	{
    if($_POST['l_url']=='' && $_POST['q_url']=='')
    {
		 
  		if(!empty($_FILES['f_name']['name']) && $_FILES['f_name']['name']!='')
      {
          $error=array();;
          $config['upload_path'] = '../assets/images/admin/lession_attachment';

          if($_POST['type']!='1')
          {
            $config['allowed_types'] = 'audio|video';
            $config['max_size'] = '5120';
          }
          else
          {
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '2048';
          }

          
          $config['overwrite'] = FALSE;
          $config['file_name'] = $_FILES['f_name']['name'];
      
          $this->load->library('upload', $config);

          if (!$this->upload->do_upload("f_name"))
          {
            $error1 = array('error' => $this->upload->display_errors());
            $this->form_validation->set_message("do_upload",$error1['error']);
            return false;
          }
          else
          {
              $data1 = array("f_name" => $this->upload->data());
              @unlink("../assets/images/admin/lession_attachment".$_POST['slide_image']);
              $this->upload_data = $data1;
              return $data1;
          }
        }
        else if(empty($_FILES['f_name']['name']) && $_POST['slide_image']=='')
        {
          $this->form_validation->set_message("do_upload","The Name Field is required");
          return false;
        }
        else
        {
          return true;
        }
    }
		
	}
	
	
	function do_upload2()
	{
    if($_POST['l_url']=='' && $_POST['q_url']=='')
    {
  		if(!empty($_FILES['f_name_quiz']['name']) && $_FILES['f_name_quiz']['name']!='')
      {

        $config['upload_path'] = '../assets/images/admin/lession_attachment';
        
        if($_POST['type']!='1')
        {
          $config['allowed_types'] = 'audio|video';
          $config['max_size'] = '5120';
        }
        else
        {
          $config['allowed_types'] = 'pdf';
          $config['max_size'] = '2048';
        }

        $config['overwrite'] = FALSE;
        $config['file_name'] = $_FILES['f_name_quiz']['name'];
    
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("f_name_quiz"))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->form_validation->set_message("do_upload2",$error['error']);
            return false;
        }
        else
        {
            $data = array("f_name_quiz" => $this->upload->data());
            @unlink("../assets/images/admin/lession_attachment".$_POST['slide_image2']);
            $this->upload_data1 = $data;
            return $data;
        }
      }
      else if(empty($_FILES['f_name_quiz']['name']) && $_POST['slide_image2']=='')
      {
        $this->form_validation->set_message("do_upload2","The Quiz Field is required");
        return false;
      }
      else
      {
        return true;
      }
    }

  }
	
	

	
	function attachment_delete()
  {
       
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from lession_attachment where id in ('.$id.')');
            return true;  
        }
  } 
    
    
    
  function language_unique_check($language,$edit_id) 
  {
        
        $id  = $this->session->userdata('id');
        
        $get_data = $this->attachment_model->language_check_exists("lession_attachment",array("language" => $language,"lession_id" => $id,"id !=" => $edit_id));
       
        if(count($get_data) >0) 
        {
      
          $this->form_validation->set_message('language_unique_check', 'Document already added for this language ');
          return FALSE;
        }
        
       	return TRUE;
  } 
}

