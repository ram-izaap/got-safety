<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Plan extends Admin_controller {
	
	protected $_plan_validation_rules = array(
         array('field' => 'plan_type', 'label' => 'Plan', 'rules' => 'trim|required|callback_check_duplicate_plan'),
         array('field' => 'emp_limit', 'label' => 'Employee Limit', 'rules' => 'trim|required|numeric'),
	     array('field' => 'plan_amount', 'label' => 'Price', 'rules' => 'trim|required|numeric'),
         array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
											 );
	
												
   function __construct() 
    {
        parent::__construct();
        
        $this->load->model('plan_model');
		$this->load->library('form_validation');
    }


    function index()
    { 
                 
		 $this->layout->add_javascripts(array('listing', 'rwd-table'));  

		 $this->load->library('listing');        
        
         $this->simple_search_fields = array('plan_type' => 'Name');
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('plan/add_plan/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('plan_model', 'listing');

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
        
        
        
        $this->layout->view("plans/plan_list");
        
    }
    
    public function add_plan($edit_id = "")
    { 

       if(is_logged_in()) {

       	$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
		
		$this->form_validation->set_rules($this->_plan_validation_rules);
			
		if($this->form_validation->run())
        { 
            $form = $this->input->post();
           
			if(isset($form['is_active'])) { 
				$form['is_active'] = $form['is_active'];	
			}
			else { 
				$form['is_active'] = "0";
			}
			
			$ins_data = array();			
			
            $ins_data['plan_type']       	= $form['plan_type'];
            $ins_data['plan_amount']       	= $form['plan_amount'];
            $ins_data['plan_desc']       	= $form['plan_desc'];
            $ins_data['emp_limit']          = $form['emp_limit'];
            $ins_data['plan_directory']  = $form['plan_directory'];
            $ins_data['is_active']  = $form['is_active'];
            $ins_data['updated_date']  = date("Y-m-d H:i:s");
            
            if(empty($edit_id))
            {
            	$update_data = $this->plan_model->insert("plan",$ins_data);
            }
            else 
            {
            	$update_data = $this->plan_model->update("plan",$ins_data,array("id" => $edit_id));
            }
		     redirect("plan");
		}	
			
			 if($edit_id) {
                $edit_data = $this->plan_model->get_plan_data("plan",array("id" => $edit_id));
                
                if(!isset($edit_data[0])) {
                    //$this->service_message->set_flash_message('record_not_found_error');
                    redirect("plans");   
                }
                $this->data['title']          = "EDIT PLAN";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                
            }
            else if($this->input->post()) { 
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD PLAN";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
                
            }
            else
            {
                $this->data['title']     = "ADD PLAN";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("plan_type" => "","plan_amount" =>"","plan_desc" => "","plan_directory" => "","is_active" => "","emp_limit" => ""); 
            }
		
		 
		$this->layout->view('plans/add');
		
		}
        else
        {
            redirect("home");
        }  
    
	}
	
	
	function plan_delete()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from plan where id in ('.$id.')');
            return true;  
        }
    }
    function check_duplicate_plan()
    {
        $plan_name = $this->input->post('plan_type');

        $edit_id = $this->input->post('edit_id');
        if($edit_id!='')
            $edit_data = $this->plan_model->get_plan_data("plan",array("plan_type" => $plan_name,"id" => $edit_id));
        else
            $edit_data = $this->plan_model->get_plan_data("plan",array("plan_type" => $plan_name));
        
        if (count($edit_data) > 0) 
        {
           $this->form_validation->set_message('check_duplicate_plan', 'This plan already exists. Please enter a new plan.');
           return FALSE;
        } 
        else 
        {
          return TRUE;
        }
    }  
 }

