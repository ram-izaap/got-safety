<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Osha extends Admin_controller {
	
	protected $_osha_validation_rules = array(
													array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
                                                    array('field' => 'is_display', 'label' => 'Is display', 'rules' => 'trim'),
                                                    array('field' => 'slide_image', 'label' => 'Image', 'rules' => 'trim')
													
												);
												
	protected $_osha_content_validation_rules =    array (
                                                   
                                                    array('field' => 'content', 'label' => 'Content', 'rules' => 'trim|required')
                                                    
                                                  );											
											
	

    function __construct() 
    {
        parent::__construct();
        
       $this->load->model('osha_model');
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));
    }


    function index()
    {
		//$this->output->enable_profiler(true);
		
        $this->layout->add_javascripts(array('listing', 'rwd-table'));  

        $this->load->library('listing');

        //init fncts
        //$this->load_settings_data();
        
        $this->simple_search_fields = array(
                                                'title' => 'Title'
                                                
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('osha/add_edit_osha/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('osha_model', 'listing');

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
        	$this->layout->view("osha/osha_list");
        else
        	redirect("login");
        
        
    }
    
    
    
  
	
	public function add_edit_osha($edit_id = "")
    {            
		//print_r($_POST);exit;
		$user_id =  $this->session->userdata('admin_data')['id']; 
		$role =  $this->session->userdata('admin_data')['role']; 
		
		if($role == '2'){
			$user_id = $this->session->userdata('admin_data')['id'];
		}else 
		{
			$user_id = '8';
		}
		//print_r($_FILES);exit;
		
		$this->data['get_menu'] = $this->osha_model->get_menu_osha("users",array("role" => 2));
		//print_r($this->data['get_menu']);exit;
			
			if ( isset($_POST['user_id']) )
			{
				$this->form_validation->set_rules('user_id', 'Client', 'required');
			} 
		
		if(is_logged_in()) {
		  
            
			$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			
			 if ( empty($_FILES['pdf_file']['name']) && empty($_POST['slide_image']) )
			{ 
				$this->form_validation->set_rules('pdf_file', 'File', 'required');
			} 
			
			
			$this->form_validation->set_rules($this->_osha_validation_rules);
			
        if($this->form_validation->run())
        {
          
            $form = $this->input->post();
           
            
			if(!empty($_FILES['pdf_file']['tmp_name'])){ 
			  $upload_data = $this->do_upload();
	
              $filename = (isset($upload_data['pdf_file']['file_name']))?$upload_data['pdf_file']['file_name']:"";
			}else{
				$filename = (isset($_POST['slide_image']))?$_POST['slide_image']:"";
			} 
			
			
			//print $filename;exit;
			
			if(isset($form['is_display'])) { 
				$form['is_display'] = $form['is_display'];	
			}
			else { 
				$form['is_display'] = "0";
			}
			
			if(isset($form['visible_to_all'])) { 
				$form['visible_to_all'] = $form['visible_to_all'];	
			}
			else { 
				$form['visible_to_all'] = "0";
			}
			
			$ins_data = array();
            $ins_data['title']       	= Ucfirst($form['title']);
            $ins_data['is_display']  = $form['is_display'];
            if($_POST['user_id'] == ""){
				$ins_data['created_user']  = $user_id;
			}else {
				$ins_data['created_user']  = $form['user_id'];
				$ins_data['updated_user']  = $this->session->userdata('admin_data')['id']; 
				$ins_data['visible_to_all']  = $form['visible_to_all'];
			}
            $ins_data['created_date']  = date("Y-m-d");
			$ins_data['pdf_file']  = $filename;
           
			if(empty($edit_id)){
			      
                     $social_data = $this->osha_model->insert("cal_osha",$ins_data);
                    // $this->service_message->set_flash_message('record_insert_success');
		      }
              else 
              {  echo 
                    $social_data = $this->osha_model->update("cal_osha",$ins_data,array("id" => $edit_id));
                    //$this->service_message->set_flash_message('record_update_success');
		      }
		      redirect("osha");    
		
		}	
			
			 if($edit_id) {
                $edit_data = $this->osha_model->get_slideimage_detail("cal_osha",array("id" => $edit_id));
               
                if(!isset($edit_data[0])) {
                    //$this->service_message->set_flash_message('record_not_found_error');
                    redirect("osha");   
                }
                $this->data['title']          = "EDIT CAL / OSHA DOCUMENTATION";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                $this->data['form_data']['slide_image'] = $this->data['form_data']['pdf_file'];
                
            }
            else if($this->input->post()) {
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD CAL / OSHA DOCUMENTATION";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
            }
            else
            {
                $this->data['title']     = "ADD CAL / OSHA DOCUMENTATION";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("title" => "","is_display" => "","slide_image" => "","pdf_file" => "","user_id" => "","visible_to_all" => "");
                
            }
		    
		    $this->data['img_url']=$this->layout->get_img_dir();
		    $this->layout->view('osha/add');
		}
        else
        {
            redirect("login");
        }  
    
	}
	
	
	function do_upload()
	{
		 
		$config['upload_path'] = '../assets/images/frontend/call_osha';

		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '3000';
		
		
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('pdf_file'))
		{ 
			$error = array('error' => $this->upload->display_errors());

			return $error;
			
		}
		else
		{
			$data = array('pdf_file' => $this->upload->data());
			return $data;
			
		}
		
	}
	

	
	function osha_delete()
    {
       
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from cal_osha where id in ('.$id.')');
            //$this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } 
    
    
    function osha_content()
    {
		
		if(is_logged_in()) {
			
            $info = $this->osha_model->get_info_content("display_content",array("id" => 2));
           
            $this->data['form_data'] = $info;
            
			$this->form_validation->set_rules($this->_osha_content_validation_rules);
			
        if($this->form_validation->run())
        { 
            $form = $this->input->post();
            
			
			$ins_data = array();
			
            $ins_data['content']  = $form['content'];
            $edit_id                = $_POST['edit_id'];
			
			$social_data = $this->osha_model->update("display_content",$ins_data,array("id" => $edit_id));
            //$this->service_message->set_flash_message('record_update_success');
			
			redirect("osha");    
			
		}	
			$this->data['title']          = "Cal / Osha Content";
            $this->data['crumb']        = "Update";
	
		$this->layout->view('osha/osha_content');
		
		}
        else
        {
            redirect("login");
        } 
		
	}
    
  
   
    
}

