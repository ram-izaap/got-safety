<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Attachment extends Admin_controller {
	
	protected $_attachment_validation_rules = array(
													//array('field' => 'language', 'label' => 'Language', 'rules' => 'trim|required'),
                                                    array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim'),
                                                    array('field' => 'slide_image', 'label' => 'Image', 'rules' => 'trim')
													
												);
												
												
											
	

    function __construct() 
    {
        parent::__construct();
        
       $this->load->model('attachment_model');
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
        
        $str = '<a href="'.site_url('attachment/add_edit_attachment/{id}').'" class="table-link">
                    <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
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
        
        //$this->data['user_data'] = $this->session->userdata('admin_user_data');
        
        
        $this->layout->view("attachment/attachment_list");
        
        
    }
    
    
    
  
	
	public function add_edit_attachment($edit_id = "")
    {            
		
		if(is_logged_in()) {
		  
             //$this->layout->add_javascripts(array('product'));
             
			$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			$this->data['get_menu'] = $this->attachment_model->get_menu("language");
			
			$this->form_validation->set_rules($this->_attachment_validation_rules);
			 if ( empty($_FILES['f_name']['name']) && empty($_POST['slide_image']) )
			{
				$this->form_validation->set_rules('f_name', 'Image', 'required');
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
			
			
			//print $filename;exit;
			
			if(isset($form['is_active'])) { 
				$form['is_active'] = $form['is_active'];	
			}
			else { 
				$form['is_active'] = "0";
			}
			
			$id  = $this->session->userdata('id');
			
			$ins_data = array();
            $ins_data['lession_id']       	= $id;
            $ins_data['language']          = $form['language'];
            $ins_data['is_active']  = $form['is_active'];
			$ins_data['f_name']  = $filename;
           
			//$this->header_model->update('cub_search_nav_bar',$ins_data);
			if(empty($edit_id)){
			      
                     $social_data = $this->attachment_model->insert("lession_attachment",$ins_data);
                    // $this->service_message->set_flash_message('record_insert_success');
		      }
              else 
              { 
                    $social_data = $this->attachment_model->update("lession_attachment",$ins_data,array("id" => $edit_id));
                    //$this->service_message->set_flash_message('record_update_success');
		      }
		      redirect("attachment");    
		
		}	
			
			 if($edit_id) {
                $edit_data = $this->attachment_model->get_slideimage_detail("lession_attachment",array("id" => $edit_id));
               
                if(!isset($edit_data[0])) {
                    $this->service_message->set_flash_message('record_not_found_error');
                    redirect("attachment");   
                }
                $this->data['title']          = "EDIT ATTACHMENT";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                $this->data['form_data']['slide_image'] = $this->data['form_data']['f_name'];
                
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
                $this->data['form_data'] = array("lession_id" => "","language" => '',"is_active" => "","slide_image" => "","f_name" => "");
                
            }
		    
		    //$this->layout->view('/admin/header/menu/add',$this->data,TRUE); 
		    $this->layout->view('attachment/add',$this->data);
		}
        else
        {
            redirect("admim/login");
        }  
    
	}
	
	
	function do_upload()
	{
		 
		$config['upload_path'] = '../assets/images/admin/lession_attachment';

		$config['allowed_types'] = 'pdf|doc';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
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
	

	
	function attachment_delete()
    {
       
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from lession_attachment where id in ('.$id.')');
            //$this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } 
    
    
    
    function language_unique_check($language,$edit_id) {
        
       
        
        $id  = $this->session->userdata('id');
        
        $get_data = $this->attachment_model->language_check_exists("lession_attachment",array("language" => $language,"lession_id" => $id,"id !=" => $edit_id));
       
       
        if(count($get_data) >0) {
      
          $this->form_validation->set_message('language_unique_check', 'Document already added for this language ');
          return FALSE;
        }
        
       	return TRUE;
    } 
    
    
   
    
}
