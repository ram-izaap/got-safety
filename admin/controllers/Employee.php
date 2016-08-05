<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Employee extends Admin_controller {
	
	protected $_employee_validation_rules = array(
				//array('field' => 'emp_id', 'label' => 'Employee ID', 'rules' => 'trim|required|callback_language_unique_check['.$edit_id.']'),
				array('field' => 'employee_email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
                array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
               );
					
    function __construct() 
    {
        parent::__construct();
        
       $this->load->model('employee_model');
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));
       $this->data['img_url']=$this->layout->get_img_dir();
       if(!is_logged_in()) 
        {
          redirect("login");
        }
    }


    function index()
    {
		//$this->output->enable_profiler(true);
		
        $this->layout->add_javascripts(array('listing', 'rwd-table'));  

        $this->load->library('listing');

        //init fncts
        //$this->load_settings_data();
        
        $this->simple_search_fields = array(
                        'employee_name' => 'Name',
                        'employee_email' => 'Email',
                        'emp_id' => 'Employee ID',
                        'name' => 'Client');
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('employee/add_edit_employee/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('employee_model', 'listing');

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
            $this->layout->view("employee/employee_list");
        else
            redirect("login");
               
        
    }
    
    
    
  
	
	public function add_edit_employee($edit_id = "")
    {            
		
		$user_id =  $this->session->userdata('admin_data')['id']; 
		$role =  $this->session->userdata('admin_data')['role']; 
		
		if($role == '2'){
			$user_id = $this->session->userdata('admin_data')['id'];
		}else 
		{
			$user_id = '8';
		}
		
		
		if ( isset($_POST['user_id']) ){
			
			$this->session->set_userdata('client_id',$_POST['user_id']);
			
		}else {
			
			$this->session->set_userdata('client_id',$user_id);
		}
		
		$this->data['get_menu'] = $this->employee_model->get_menu_client("users",array("role" => 2));
		//print_r($this->data['get_menu']);exit;
			
			if ( isset($_POST['user_id']) && $edit_id =="" )
			{ 
				$this->form_validation->set_rules('user_id', 'Client', 'required|callback_max_limit_unique_check');
			}
			
			if ( isset($_POST['emp_id']) )
			{ 
				$this->form_validation->set_rules('emp_id', 'Employee ID', 'required|callback_employee_id_unique_check['.$edit_id.']');
			}
			
			if($role == 2 && $edit_id =="") {
				
				 $this->form_validation->set_rules('employee_name', 'Name', 'required|callback_max_limit_unique_check');
				
			}else {
				$this->form_validation->set_rules('employee_name', 'Name', 'trim|required');
				
			}
			
		
		if(is_logged_in()) {
		  
            
			$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			
			$this->form_validation->set_rules($this->_employee_validation_rules);
			
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
            $ins_data['employee_name']       	= Ucfirst($form['employee_name']);
            $ins_data['employee_email']          = $form['employee_email'];
            $ins_data['is_active']  = $form['is_active'];
            if($_POST['user_id'] == ""){
				$ins_data['created_user']  = $user_id;
			}else {
				$ins_data['created_user']  = $form['user_id'];
				$ins_data['updated_user']  = $this->session->userdata('admin_data')['id']; 
				
			}
            $ins_data['created_date']  = date("Y-m-d H:i:s");
            $ins_data['emp_id']  = $form['emp_id'];
			//$ins_data['video_file']  = $filename;
           
			//$this->header_model->update('cub_search_nav_bar',$ins_data);
			if(empty($edit_id)){
			      
                     $social_data = $this->employee_model->insert("employee",$ins_data);
                    // $this->service_message->set_flash_message('record_insert_success');
		      }
              else 
              {  echo 
                    $social_data = $this->employee_model->update("employee",$ins_data,array("id" => $edit_id));
                    //$this->service_message->set_flash_message('record_update_success');
		      }
		      redirect("employee");    
		
		}	
			
			 if($edit_id) {
                $edit_data = $this->employee_model->get_slideimage_detail("employee",array("id" => $edit_id));
               
                if(!isset($edit_data[0])) {
                   // $this->service_message->set_flash_message('record_not_found_error');
                    redirect("employee");   
                }
                $this->data['title']          = "EDIT EMPLOYEE";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                //$this->data['form_data']['slide_image'] = $this->data['form_data']['video_file'];
                
            }
            else if($this->input->post()) {
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD EMPLOYEE";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
            }
            else
            {
                $this->data['title']     = "ADD EMPLOYEE";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("employee_name" => "","employee_email" => '',"is_active" => "","emp_id" => "");
                
            }
		    
		    
		    $this->layout->view('employee/add');
		}
        else
        {
            redirect("login");
        }  
    
	}
	

	
	function employee_delete()
    {
       
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from employee where id in ('.$id.')');
            //$this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } 
    
  
  
  
   function max_limit_unique_check($client_id) 
   {
        //echo $client_id;exit;
        if(is_numeric($client_id)){
			
			$client_id = $client_id;
			
		}
		else {
			$client_id = $this->session->userdata('admin_data')['id'];
		}
        
        $get_data = $this->employee_model->limit_check_exists("users",array("id" => $client_id));
      
       
        if($get_data != 1) {
      
          $this->form_validation->set_message('max_limit_unique_check', 'Client exists max limit');
          return FALSE;
        }
        
       	return TRUE;
    } 
    
    
    
     function employee_id_unique_check($emp_id,$edit_id) 
     {
        $client_id  = $this->session->userdata('client_id');
        //print_r($client_id);exit;
        
        $get_data = $this->employee_model->employee_id_check_exists("employee",array("emp_id" => $emp_id,"created_user" => $client_id,"id !=" => $edit_id));
       
       //print_r($get_data);exit;
        if(count($get_data) >0) {
      
          $this->form_validation->set_message('employee_id_unique_check', 'Employee ID already added');
          return FALSE;
        }
        
       	return TRUE;
    } 
    
    
    
    
    public function bulk_upload()
    {            
		if(is_logged_in())
        {
            //$this->layout->view("employee/employee_list");        
		    if(!empty($_FILES['employee']['tmp_name']))
            { 
				$data['result'] = $this->employee_model->upload_csv();
				if($data['result'])
                {
				    redirect("employee");
				}
	       }
		  $this->layout->view('employee/bulk_upload');
        }
        else
            redirect("login");
    
	}
	

    
   
    
}

