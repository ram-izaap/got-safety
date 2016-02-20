<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Webinars extends Admin_controller {
	
	protected $_webinars_validation_rules = array(
													array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required'),
                                                    array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim'),
                                                    array('field' => 'slide_image', 'label' => 'Image', 'rules' => 'trim')
													
												);
												
												
											
	

    function __construct() 
    {
        parent::__construct();
        
       $this->load->model('webinars_model');
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
        
        $str = '<a href="'.site_url('webinars/add_edit_webinars/{id}').'" class="table-link">
                    <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('webinars_model', 'listing');

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
        
        
        $this->layout->view("webinars/webinars_list");
        
        
    }
    
    
    
  
	
	public function add_edit_webinars($edit_id = "")
    {            
		
		$user_id =  $this->session->userdata('admin_data')['id']; 
		$role =  $this->session->userdata('admin_data')['role']; 
		
		if($role == '2'){
			$user_id = $this->session->userdata('admin_data')['id'];
		}else 
		{
			$user_id = '8';
		}
		
		
		$this->data['get_menu'] = $this->webinars_model->get_menu_webinars("users",array("role" => 2));
		//print_r($this->data['get_menu']);exit;
			
			if ( isset($_POST['user_id']) )
			{
				$this->form_validation->set_rules('user_id', 'Client', 'required');
			} 
		
		if(is_logged_in()) {
		  
            
			$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			
			$this->form_validation->set_rules($this->_webinars_validation_rules);
			
        if($this->form_validation->run())
        {
          
            $form = $this->input->post();
            
			if(!empty($_FILES['video_file']['tmp_name'])){ 
			  $upload_data = $this->do_upload();
	
              $filename = (isset($upload_data['video_file']['file_name']))?$upload_data['video_file']['file_name']:"";
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
			
			
			$ins_data = array();
            $ins_data['title']       	= Ucfirst($form['title']);
            $ins_data['link']          = $form['link'];
            $ins_data['is_active']  = $form['is_active'];
            if($_POST['user_id'] == ""){
				$ins_data['created_user']  = $user_id;
			}else {
				$ins_data['created_user']  = $form['user_id'];
				$ins_data['updated_user']  = $this->session->userdata('admin_data')['id']; 
			}
            $ins_data['created_date']  = date("Y-m-d");
			$ins_data['video_file']  = $filename;
           
			//$this->header_model->update('cub_search_nav_bar',$ins_data);
			if(empty($edit_id)){
			      
                     $social_data = $this->webinars_model->insert("webinars",$ins_data);
                    // $this->service_message->set_flash_message('record_insert_success');
		      }
              else 
              {  echo 
                    $social_data = $this->webinars_model->update("webinars",$ins_data,array("id" => $edit_id));
                    //$this->service_message->set_flash_message('record_update_success');
		      }
		      redirect("webinars");    
		
		}	
			
			 if($edit_id) {
                $edit_data = $this->webinars_model->get_slideimage_detail("webinars",array("id" => $edit_id));
               
                if(!isset($edit_data[0])) {
                    $this->service_message->set_flash_message('record_not_found_error');
                    redirect("webinars");   
                }
                $this->data['title']          = "EDIT WEBINARS";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                $this->data['form_data']['slide_image'] = $this->data['form_data']['video_file'];
                
            }
            else if($this->input->post()) {
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD WEBINARS";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
            }
            else
            {
                $this->data['title']     = "ADD WEBINARS";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("title" => "","link" => '',"is_active" => "","slide_image" => "","video_file" => "","user_id" => "");
                
            }
		    
		    
		    $this->layout->view('webinars/add');
		}
        else
        {
            redirect("admim/login");
        }  
    
	}
	
	
	function do_upload()
	{
		 
		$config['upload_path'] = '../assets/images/admin/webinars';

		$config['allowed_types'] = 'mp4|3gp|gif|mp3';
		$config['max_size']	= '';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('video_file'))
		{ 
			$error = array('error' => $this->upload->display_errors());

			return $error;
			
		}
		else
		{
			$data = array('video_file' => $this->upload->data());
			return $data;
			
		}
		
	}
	

	
	function webinars_delete()
    {
       
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from webinars where id in ('.$id.')');
            //$this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } 
    
  
   
    
}

