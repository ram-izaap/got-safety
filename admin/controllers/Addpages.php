<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Addpages extends Admin_controller {
	
	protected $_addpages_validation_rules = array(
													//array('field' => 'page_id', 'label' => 'Page', 'rules' => 'trim|required'),
													array('field' => 'page_title', 'label' => 'Page Title', 'rules' => 'trim|required'),
													array('field' => 'content', 'label' => 'content', 'rules' => 'trim|required'),
                                                    array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
                                                    
													
												);
												
												
											
	

    function __construct() 
    {
        parent::__construct();
        
       $this->load->model('addpages_model');
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));
       if(!is_logged_in()) 
        {
          redirect("login");
        }
       
       //echo $this->layout->get_img_dir();
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
                                                'page_title' => 'Page Title'
                                                
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('addpages/add_edit_pages/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('addpages_model', 'listing');

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
            $this->layout->view("addpages/addpages_list");
        else
            redirect("login");
        
        
    }
    
    
    
  
	
	public function add_edit_pages($edit_id = "")
    {            
		
		if(is_logged_in()) {
		  
             //$this->layout->add_javascripts(array('product'));
             
			$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			$this->data['get_menu'] = $this->addpages_model->get_menu("page");
			
			if(isset($_POST['page_id'])) {
					$this->form_validation->set_rules('page_id', 'Page', 'trim|required|callback_page_unique_check['.$edit_id.']');
			}
			
			$this->form_validation->set_rules($this->_addpages_validation_rules);
			
        if($this->form_validation->run())
        { 
           
            $form = $this->input->post();

		//print_r($_FILES['f_name']['name']);exit;
			
			
			
			//print $filename;exit;
			
			if(isset($form['is_active'])) { 
				$form['is_active'] = $form['is_active'];	
			}
			else { 
				$form['is_active'] = "0";
			}
			
			//$id  = $this->session->userdata('id');
			
			$ins_data = array();
           
            $ins_data['page_id']          = $form['page_id'];
            $ins_data['content']          = $form['content'];
            $ins_data['page_title']          = Ucfirst($form['page_title']);
            $ins_data['is_active']  = $form['is_active'];
			
           
			//$this->header_model->update('cub_search_nav_bar',$ins_data);
			if(empty($edit_id)){
			      
                     $social_data = $this->addpages_model->insert("add_pages",$ins_data);
                    // $this->service_message->set_flash_message('record_insert_success');
		      }
              else 
              { 
                    $social_data = $this->addpages_model->update("add_pages",$ins_data,array("id" => $edit_id));
                    //$this->service_message->set_flash_message('record_update_success');
		      }
		      redirect("addpages");    
		
		}	
			
			 if($edit_id) {
                $edit_data = $this->addpages_model->get_slideimage_detail("add_pages",array("id" => $edit_id));
               
                if(!isset($edit_data[0])) {
                    $this->service_message->set_flash_message('record_not_found_error');
                    redirect("addpages");   
                }
                $this->data['title']          = "EDIT PAGES";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];

                
            }
            else if($this->input->post()) {
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD PAGES";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
            }
            else
            {
                $this->data['title']     = "ADD PAGES";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("page_id" => "","content" => '',"is_active" => "","page_title" => "");
                
            }
		    
		    //$this->layout->view('/admin/header/menu/add',$this->data,TRUE); 
		    $this->layout->view('addpages/add');
		}
        else
        {
            redirect("login");
        }  
    
	}
	
	

	
	function addpages_delete()
    {
       
       if(is_logged_in())
       {
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) 
        {
            
            $this->db->query('delete from add_pages where id in ('.$id.')');
            //$this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
        else
            redirect("login");
    } 
    
    
    
    function page_unique_check($page_id,$edit_id)
     {
        if(is_logged_in())
        {
         
        $get_data = $this->addpages_model->page_check_exists("add_pages",array("page_id" => $page_id,"is_active" => 1,"id !=" => $edit_id));
       
       
        if(count($get_data) >0) 
        {
      
          $this->form_validation->set_message('page_unique_check', 'Content was added already ');
          return FALSE;
        }
        
       	return TRUE;
        }
        else
            redirect("login");
    } 
    
    
   
    
}

