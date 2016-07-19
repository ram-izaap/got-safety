<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Attach extends Admin_controller {
	
	protected $_attach_validation_rules = array(
													//array('field' => 'type', 'label' => 'Type', 'rules' => 'trim|required'),
                                                    array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim'),
                                                    array('field' => 'slide_image', 'label' => 'Lesson', 'rules' => 'trim'),
                                                    array('field' => 'slide_image2', 'label' => 'Quiz', 'rules' => 'trim')
													
												);
												
												
											
	

    function __construct() 
    {
        parent::__construct();
        
       $this->load->model('attach_model');
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));
    }


    function index()
    {
		//$this->output->enable_profiler(true);
		if(isset($_GET['id']))
       $this->session->set_userdata('id',$_GET['id']);
       
        $this->layout->add_javascripts(array('listing', 'rwd-table'));  

        $this->load->library('listing');

        //init fncts
        //$this->load_settings_data();
        
        $this->simple_search_fields = array(
                                                'language' => 'Language'
                                                
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('attach/add_edit_attach/{id}').'" class="table-link">
                    <span class="fa-stack">
                        
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('attach_model', 'listing');

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
        
        //$this->data['user_data'] = $this->session->userdata('admin_user_data');
        
        if(is_logged_in())
        	$this->layout->view("attach/attach_list");
        else
        	redirect("login");
        
        
    }
    
    
    
  
	
	public function add_edit_attach($edit_id = "")
    {            
		
		if(is_logged_in()) {
		  
			$user_id =  $this->session->userdata('admin_data')['id']; 
			
			$get_menu = $this->attach_model->get_language_list("users",array('id'=>$user_id));
			
			$this->data['lang_list'] = $get_menu[0]['language'];
             
			$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			$this->data['get_menu'] = $this->attach_model->get_menu("language");
			
			$this->form_validation->set_rules($this->_attach_validation_rules);
			 if ( empty($_FILES['f_name']['name']) && empty($_POST['slide_image']) )
			{
				$this->form_validation->set_rules('f_name', '5 X 9', 'required');
			} 
			
			 if ( empty($_FILES['f_name_quiz']['name']) && empty($_POST['slide_image2']) )
			{
				$this->form_validation->set_rules('f_name_quiz', '5 X 11', 'required');
			} 
			
			if(isset($_POST['language'])) {
					$this->form_validation->set_rules('language', 'Language', 'trim|required|callback_language_unique_check['.$edit_id.']');
			}
       
        if($this->form_validation->run())
        { 
           
            $form = $this->input->post();

		//print_r($_FILES['f_name']['name']);exit;
			
			if(!empty($_FILES['f_name']['tmp_name'])){ 
			  $upload_data = $this->do_upload();
	
              $filename = (isset($upload_data['f_name']['file_name']))?$upload_data['f_name']['file_name']:"";
			}else{
				$filename = (isset($_POST['slide_image']))?$_POST['slide_image']:"";
			}
			
			
			if(!empty($_FILES['f_name_quiz']['tmp_name'])){ 
			  $upload_data2 = $this->do_upload2();
	
              $filename2 = (isset($upload_data2['f_name_quiz']['file_name']))?$upload_data2['f_name_quiz']['file_name']:"";
			}else{
				$filename2 = (isset($_POST['slide_image2']))?$_POST['slide_image2']:"";
			}
			
			
			//print $filename;exit;
			
			if(isset($form['is_active'])) { 
				$form['is_active'] = $form['is_active'];	
			}
			else { 
				$form['is_active'] = "0";
			}
			
			$id  = $this->session->userdata('id');
			
			$ins_data = array();
            $ins_data['poster_id']       	= $id;
            $ins_data['language']          = $form['language'];
           // $ins_data['type']          = $form['type'];
            $ins_data['is_active']  = $form['is_active'];
			$ins_data['f_name']  = $filename;
			$ins_data['f_name_quiz']  = $filename2;
           
			//$this->header_model->update('cub_search_nav_bar',$ins_data);
			if(empty($edit_id)){
			      
                     $social_data = $this->attach_model->insert("posters_attachment",$ins_data);
                    // $this->service_message->set_flash_message('record_insert_success');
		      }
              else 
              { 
                    $social_data = $this->attach_model->update("posters_attachment",$ins_data,array("id" => $edit_id));
                    //$this->service_message->set_flash_message('record_update_success');
		      }
		      redirect("attach");    
		
		}	
			
			 if($edit_id) {
                $edit_data = $this->attach_model->get_slideimage_detail("posters_attachment",array("id" => $edit_id));
               
                if(!isset($edit_data[0])) {
                    $this->service_message->set_flash_message('record_not_found_error');
                    redirect("attach");   
                }
                $this->data['title']          = "EDIT ATTACHMENT";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                $this->data['form_data']['slide_image'] = $this->data['form_data']['f_name'];
                $this->data['form_data']['slide_image2'] = $this->data['form_data']['f_name_quiz'];
                
            }
            else if($this->input->post()) {
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD ATTACHMENT";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
            }
            else
            {
                $this->data['title']     = "ADD ATTACHMENT";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("poster_id" => "","language" => '',"is_active" => "","slide_image" => "","f_name" => "","slide_image2" => "","f_name_quiz" => "");
                
            }
		    $this->data['img_url']=$this->layout->get_img_dir();
		    //$this->layout->view('/admin/header/menu/add',$this->data,TRUE); 
		    $this->layout->view('attach/add');
		}
        else
        {
            redirect("login");
        }  
    
	}
	
	
	function do_upload()
	{
		 
		$config['upload_path'] = '../assets/images/frontend/posters_attachment';

		$config['allowed_types'] = 'pdf|doc';
		$config['max_size']	= '3000';
		
		
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('f_name'))
		{ 
			$error = array('error' => $this->upload->display_errors());

			return $error;
			
		}
		else
		{
			$data = array('f_name' => $this->upload->data());
			return $data;
			
		}
		
	}
	
	
	function do_upload2()
	{
		 
		$config['upload_path'] = '../assets/images/frontend/posters_attachment';

		$config['allowed_types'] = 'pdf|doc';
		$config['max_size']	= '3000';
		
		
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('f_name_quiz'))
		{ 
			$error = array('error' => $this->upload->display_errors());

			return $error;
			
		}
		else
		{
			$data = array('f_name_quiz' => $this->upload->data());
			return $data;
			
		}
		
	}
	

	
	function attach_delete()
    {
       if(is_logged_in())
       {
        	$this->layout->view("attach/attach_list");
       
       	 $id = ($_POST['id'])?$_POST['id']:"";
        	if(!empty($id)) {
            
            $this->db->query('delete from posters_attachment where id in ('.$id.')');
            //$this->service_message->set_flash_message('record_delete_success');
            return true;  
        	}
        }
        else
        	redirect("login");
    } 
    
    
    
    function language_unique_check($language,$edit_id) 
    {
        
       
        
        $id  = $this->session->userdata('id');
        
        $get_data = $this->attach_model->language_check_exists("posters_attachment",array("language" => $language,"poster_id" => $id,"id !=" => $edit_id));
       
       
        if(count($get_data) >0) {
      
          $this->form_validation->set_message('language_unique_check', 'Document already added for this language ');
          return FALSE;
        }
        
       	return TRUE;
    } 
    
    
   
    
}

