<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Posters extends Admin_controller {
	
	protected $_posters_validation_rules = array(
													array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|max_length[255]'),
													array('field' => 'content', 'label' => 'Content', 'rules' => 'trim|required'),
                                                    array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
													
												);
	protected $_posters_content_validation_rules =    array (
                                                   
                                                    array('field' => 'content', 'label' => 'Content', 'rules' => 'trim|required')
                                                    
                                                  );
												
											
	

    function __construct() 
    {
        parent::__construct();
        
        $this->load->model('posters_model');
		$this->load->library('form_validation');
        $this->layout->add_javascripts(array('common'));

        if(!is_logged_in()) 
        {
          redirect("login");
        }
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
        
        $str = '<a href="'.site_url('posters/add_edit_posters/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('posters_model', 'listing');

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
        if(is_logged_in())
        	$this->layout->view("posters/posters_list");
        else
        	redirect("login");
        
        
    }
    
    
    
  
	
	public function add_edit_posters($edit_id = "")
    { 
		
		$user_id =  $this->session->userdata('admin_data')['id']; 
		$role =  $this->session->userdata('admin_data')['role']; 
		
		if($role == '2'){
			$user_id = $this->session->userdata('admin_data')['id'];
		}else 
		{
			$user_id = '8';
		}
		
		$this->data['get_menu'] = $this->posters_model->get_menu("users",array("role" => 2));
			
			if ( isset($_POST['user_id']) )
			{
				$this->form_validation->set_rules('user_id', 'Client', 'required');
			} 
			
		if(is_logged_in()) {
			 $edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			$this->form_validation->set_rules($this->_posters_validation_rules);
			
			
       
        if($this->form_validation->run())
        { 
            $form = $this->input->post();
           
			if(isset($form['is_active'])) { 
				$form['is_active'] = $form['is_active'];	
			}
			else { 
				$form['is_active'] = "0";
			}
			
			if(isset($form['visible_to_all'])) { 
				$form['visible_to_all'] = $form['visible_to_all'];	
			}
			else { 
				$form['visible_to_all'] = "0";
			}
			
			$ins_data = array();
			
			//print $filename;exit;
			
			
            $ins_data['title']       	= $form['title'];
            $ins_data['is_active']  = $form['is_active'];
            $ins_data['content']  = $form['content'];
            
            if($_POST['user_id'] == ""){
				$ins_data['created_user']  = $user_id;
			}else {
				$ins_data['created_user']  = $form['user_id'];
				$ins_data['updated_user']  = $this->session->userdata('admin_data')['id']; 
				$ins_data['visible_to_all']  = $form['visible_to_all'];
			}
            $ins_data['updated_date']  = date("Y-m-d H:i:s");
            
           
			if(empty($edit_id)){
			
			$update_data = $this->posters_model->insert("posters",$ins_data);
           // $this->service_message->set_flash_message('record_insert_success');
		}else {
			
			$update_data = $this->posters_model->update("posters",$ins_data,array("id" => $edit_id));
           // $this->service_message->set_flash_message('record_update_success');
		}
		redirect("posters");    

		}	
			
			 if($edit_id) {
                $edit_data = $this->posters_model->get_lession_data("posters",array("id" => $edit_id));
                
                if(!isset($edit_data[0])) {
                    //$this->service_message->set_flash_message('record_not_found_error');
                    redirect("posters");   
                }
                $this->data['title']          = "EDIT SAFETY POSTERS";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                
            }
            else if($this->input->post()) { 
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD SAFETY POSTERS";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
                
            }
            else
            {
                $this->data['title']     = "ADD SAFETY POSTERS";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("title" => "","is_active" => "","content" => "","user_id" => "","visible_to_all" => ""); 
            }
		
		 
		$this->layout->view('posters/add');
		
		}
        else
        {
            redirect("login");
        }  
    
	}
	
	
	
	function posters_delete()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from posters where id in ('.$id.')');
            $this->db->query('delete from posters_attachment where poster_id in ('.$id.')');
            
           // $this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } 
    
    
    function posters_content()
    {
		
		if(is_logged_in()) {
			
            $info = $this->posters_model->get_info_content("display_content",array("id" => 6));
           
            $this->data['form_data'] = $info;
            
			$this->form_validation->set_rules($this->_posters_content_validation_rules);
			
        if($this->form_validation->run())
        { 
            $form = $this->input->post();
            
			$ins_data = array();
			
            $ins_data['content']  = $form['content'];
            $edit_id                = $_POST['edit_id'];
           
			$social_data = $this->posters_model->update("display_content",$ins_data,array("id" => $edit_id));
            //$this->service_message->set_flash_message('record_update_success');
			
			redirect("posters");    
			
		}	
			$this->data['title']          = "Posters Content";
            $this->data['crumb']        = "Update";
	
		$this->layout->view('posters/posters_content');
		
		}
        else
        {
            redirect("login");
        } 
		
		
		
	}
    
    
   
    
}

