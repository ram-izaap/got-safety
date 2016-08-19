<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Client extends Admin_Controller 
{
	protected $_user_validation_rules = array(
	//array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|max_length[255]'),
	//array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required|valid_email'),
	//array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'),
    array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
	
);
    
    function __construct()
    {
        parent::__construct();  
        
        $this->load->model('client_model','user_model');
        if(!is_logged_in()) 
        {
          redirect("login");
        }
       
    }  
    
   
    
    public function index()
    { 
        $this->layout->add_javascripts(array('listing', 'rwd-table'));  


        $this->load->library('listing');
         
		if(isset($_GET['id']))
			$this->session->set_userdata('admin_client_id',$_GET['id']);
       
        //init fncts
       //$this->load_settings_data();
        
        $this->simple_search_fields = array(
                                                
                                                'name' => 'Name'
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('client/add_edit_user/{id}').'" class="table-link">
                    <span class="fa-stack">
                        
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('client_model', 'listing');

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
            $this->layout->view("client/client_list");
        else
            redirect("login");
        
    }
    
    
    
    public function add_edit_user($edit_id = "")
    { 
		
		if(is_logged_in()) {
			 $edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			$this->form_validation->set_rules($this->_user_validation_rules);
			
			$id  = $this->session->userdata('admin_client_id');
			
			if (isset($_POST['password']) &&  $edit_id =="" )
			{ 
				$this->form_validation->set_rules('password', 'Password', 'required');
			} 
					
					
			if(isset($_POST['name'])) 
			{
					$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_name_unique_check['.$edit_id.']');
			}
			
			if(isset($_POST['email'])) 
			{
					$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_unique_check['.$edit_id.']');
			}
       
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
			 $edit_data = $this->user_model->get_lession_data("users",array("id" => $edit_id));
			
            $ins_data['name']       	= $form['name'];
            $ins_data['is_active']  = $form['is_active'];
            $ins_data['email']  = $form['email'];
            if($form['password'] == "") { 
	
					$ins_data['password']  = $edit_data[0]['password'];
            }else {
				
				$ins_data['password']  = md5($form['password']);
			}
            //$ins_data['ori_password']  = $form['password'];
            $ins_data['role']  = 3;
            $ins_data['created_date']  = date("Y-m-d H:i:s");
            $ins_data['created_id']  = $id;
            
           
			if(empty($edit_id)){
			
			$update_data = $this->user_model->insert("users",$ins_data);
           // $this->service_message->set_flash_message('record_insert_success');
		}else {
			
			$update_data = $this->user_model->update("users",$ins_data,array("id" => $edit_id));
           // $this->service_message->set_flash_message('record_update_success');
		}
		redirect("client");    

		}	
			
			 if($edit_id) {
                $edit_data = $this->user_model->get_lession_data("users",array("id" => $edit_id));
                
                if(!isset($edit_data[0])) {
                    //$this->service_message->set_flash_message('record_not_found_error');
                    redirect("client");   
                }
                $this->data['title']          = "EDIT USER";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                
            }
            else if($this->input->post()) { 
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD USER";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
                $this->data['form_data']['ori_password'] = "";
                
            }
            else
            {
                $this->data['title']     = "ADD USER";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("name" => "","is_active" => "","email" => "","password" => "","ori_password" => ""); 
            }
		
		 
		$this->layout->view('client/add');
		
		}
        else
        {
            redirect("login");
        }  
    
	}
	
	
	
	function client_delete()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from users where id in ('.$id.')');
            
           // $this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } 
    
    
     function name_unique_check($name,$edit_id)
     {
        
        $get_data = $this->user_model->check_exists("users",array("name" => $name,"id !=" => $edit_id));
       
       
        if(count($get_data) >0) {
      
          $this->form_validation->set_message('name_unique_check', 'Username already exists');
          return FALSE;
        }
        
       	return TRUE;
    } 
    
    
     function email_unique_check($email,$edit_id)
     {
        
        $get_data = $this->user_model->check_exists("users",array("email" => $email,"id !=" => $edit_id));
       
       
        if(count($get_data) >0) {
      
          $this->form_validation->set_message('email_unique_check', 'Email already exists');
          return FALSE;
        }
        
       	return TRUE;
    } 
    
    
    
   
    
}
?>
