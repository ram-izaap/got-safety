<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Lession extends Admin_controller {
	
	protected $_lession_validation_rules = array(
													array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|max_length[255]'),
													array('field' => 'content', 'label' => 'Content', 'rules' => 'trim|required'),
                                                    array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
													
												);
	protected $_lession_content_validation_rules =    array (
                                                   
                                                    array('field' => 'content', 'label' => 'Content', 'rules' => 'trim|required')
                                                    
                                                  );
												
											
	

    function __construct() 
    {
        parent::__construct();
        
        $this->load->model('lession_model');
		$this->load->library('form_validation');
        $this->layout->add_javascripts(array('common'));
    }


    function index()
    { 
                 
		 $this->layout->add_javascripts(array('listing', 'rwd-table'));  


        $this->load->library('listing');
         

        //init fncts
       //$this->load_settings_data();
        
        $this->simple_search_fields = array(
                                                
                                                'title' => 'Title'
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('lession/add_edit_lession/{id}').'" class="table-link">
                    <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('lession_model', 'listing');

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
        
        
        
        $this->layout->view("lession/lession_list");
        
        
    }
    
    
    
  
	
	public function add_edit_lession($edit_id = "")
    { 
		
		if(is_logged_in()) {
			 $edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			$this->form_validation->set_rules($this->_lession_validation_rules);
			
			
       
        if($this->form_validation->run())
        { 
            $form = $this->input->post();
           // print_r($form);exit;
            
           // print_r($form);exit;
			if(isset($form['is_active'])) { 
				$form['is_active'] = $form['is_active'];	
			}
			else { 
				$form['is_active'] = "0";
			}
			
			
			$ins_data = array();
			
			//print $filename;exit;
			
			
            $ins_data['title']       	= $form['title'];
            $ins_data['is_active']  = $form['is_active'];
            $ins_data['content']  = $form['content'];
            $ins_data['updated_date']  = date("Y-m-d H:i:s");
            
           
			if(empty($edit_id)){
			
			$update_data = $this->lession_model->insert("lession",$ins_data);
           // $this->service_message->set_flash_message('record_insert_success');
		}else {
			
			$update_data = $this->lession_model->update("lession",$ins_data,array("id" => $edit_id));
           // $this->service_message->set_flash_message('record_update_success');
		}
		redirect("lession");    

		}	
			
			 if($edit_id) {
                $edit_data = $this->lession_model->get_lession_data("lession",array("id" => $edit_id));
                
                if(!isset($edit_data[0])) {
                    //$this->service_message->set_flash_message('record_not_found_error');
                    redirect("lession");   
                }
                $this->data['title']          = "EDIT LESSION";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                
            }
            else if($this->input->post()) { 
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD LESSION";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
                
            }
            else
            {
                $this->data['title']     = "ADD LESSION";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("title" => "","is_active" => "","content" => ""); 
            }
		
		 
		$this->layout->view('lession/add');
		
		}
        else
        {
            redirect("home");
        }  
    
	}
	
	
	
	/*  
	
	
	function do_upload()
	{
		$config['upload_path'] = './assets/frontend/images/white_paper';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('back_image'))
		{
			$error = array('error' => $this->upload->display_errors());

			return $error;
			
		}
		else
		{
			$data = array('back_image' => $this->upload->data());
			return $data;
			
		}
	}
	
	*/

	
	function lession_delete()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from lession where id in ('.$id.')');
            $this->db->query('delete from lession_attachment where lession_id in ('.$id.')');
            
           // $this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } 
    
    
    function lesson_content()
    {
		
		if(is_logged_in()) {
			
			
			
            $info = $this->lession_model->get_info("lesson_content");
           
            $this->data['form_data'] = $info;
            
			
			$this->form_validation->set_rules($this->_lession_content_validation_rules);
			
        if($this->form_validation->run())
        { 
            $form = $this->input->post();
            
			
			$ins_data = array();
			
			 
            
            $ins_data['content']  = $form['content'];
            $edit_id                = $_POST['edit_id'];
           
			
			
			$social_data = $this->lession_model->update("lesson_content",$ins_data,array("id" => $edit_id));
            //$this->service_message->set_flash_message('record_update_success');
			
			redirect("lession");    
			
		}	
			$this->data['title']          = "Lesson Content";
            $this->data['crumb']        = "Update";
	
		$this->layout->view('lession/lesson_content');
		
		}
        else
        {
            redirect("home");
        } 
		
		
		
	}
    
    
   
    
}

