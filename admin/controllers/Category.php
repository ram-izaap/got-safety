<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Category extends Admin_controller {
	
	protected $_category_validation_rules = array(
                 array('field' => 'cat_name', 'label' => 'Category', 'rules' => 'trim|required|callback_check_duplicate_category')
			 );
	
												
   function __construct() 
    {
        parent::__construct();
        
        $this->load->model('category_model');
		$this->load->library('form_validation');
        if(!is_logged_in()) 
        {
          redirect("login");
        }
    }


    function index()
    { 
                 
		 $this->layout->add_javascripts(array('listing', 'rwd-table'));  

		 $this->load->library('listing');        
        
         $this->simple_search_fields = array('cat_name' => 'Category');
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('category/add_category/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('category_model', 'listing');

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
            $this->layout->view("category/category_list");
        else
            redirect("login");
        
    }
    
    public function add_category($edit_id = "")
    { 

       if(is_logged_in()) {

       	$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
		
		$this->form_validation->set_rules($this->_category_validation_rules);

			
		if($this->form_validation->run())
        { 
            $form = $this->input->post();
           
			
			$ins_data = array();			
			
            $ins_data['cat_name']  = $form['cat_name'];
            $ins_data['updated_date']  = date("Y-m-d H:i:s");
            
            if(empty($edit_id))
            {
            	$update_data = $this->category_model->insert("category",$ins_data);
            }
            else 
            {
            	$update_data = $this->category_model->update("category",$ins_data,array("id" => $edit_id));
            }
		     redirect("category");
		}	
			
			 if($edit_id) {
                $edit_data = $this->category_model->get_cat_data("category",array("id" => $edit_id));
                
                if(!isset($edit_data[0])) {
                    //$this->service_message->set_flash_message('record_not_found_error');
                    redirect("category");   
                }
                $this->data['title']          = "EDIT CATEGORY";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                
            }
            else if($this->input->post()) { 
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD CATEGORY";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
                
            }
            else
            {
                $this->data['title']     = "ADD CATEGORY";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("cat_name" => ""); 
            }
		
		 
		$this->layout->view('category/add');
		
		}
        else
        {
            redirect("login");
        }  
    
	}
	
	
	function category_delete()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from category where id in ('.$id.')');
            return true;  
        }
    }

    function check_duplicate_category()
    {
        $cat_name = $this->input->post('cat_name');

        $edit_id = $this->input->post('edit_id');
        if($edit_id!='')
           $edit_data = $this->category_model->get_cat_data("category",array("cat_name" => $cat_name,"id" => $edit_id));
        else
            $edit_data = $this->category_model->get_cat_data("category",array("cat_name" => $cat_name));
        
        if (count($edit_data) > 0) 
        {
           $this->form_validation->set_message('check_duplicate_category', 'This category already exists. Please enter a new category.');
           return FALSE;
        } 
        else 
        {
           return TRUE;
        }
    } 
 }

