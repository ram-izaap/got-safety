<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class User extends Admin_Controller 
{
	protected $_user_validation_rules = array(
													array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|max_length[255]'),
													array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
													array('field' => 'employee_limit', 'label' => 'No.of employee', 'rules' => 'trim|required'),
                                                    array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
													
												);
    
    
    protected $_user_detail_validation_rules = array(
													array('field' => 'name', 'label' => 'Name', 'rules' => 'trim'),
													array('field' => 'email', 'label' => 'Email', 'rules' => 'trim'),
													array('field' => 'phone', 'label' => 'Phone No', 'rules' => 'trim|required')
													
													
												);
    
    
    
    function __construct()
    {
        parent::__construct();  
        
        $this->load->model('user_model');
        
       
    }  
    
   
    
    public function index()
    { 
        $this->layout->add_javascripts(array('listing', 'rwd-table'));  


        $this->load->library('listing');
         

        //init fncts
       //$this->load_settings_data();
        
        $this->simple_search_fields = array(
                                                
                                                'name' => 'Name'
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('user/add_edit_user/{id}').'" class="table-link">
                    <span class="fa-stack">
                        
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('user_model', 'listing');

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
        
        
        
        $this->layout->view("user/user_list");
        
    }
    
    
    
    public function add_edit_user($edit_id = "")
    { 
		//print_r($_POST);exit;
		
		if(is_logged_in()) {
			 $edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			$this->form_validation->set_rules($this->_user_validation_rules);
			
			$id =  $this->session->userdata('admin_data')['id'];
            $role =  $this->session->userdata('admin_data')['role'];
            
		$this->data['get_menu'] = $this->user_model->get_language("language");
		
		$role =  $this->session->userdata('admin_data')['role'];  
              if($role == "1"){ 
				if (!isset($_POST['language']) )
					{ 
						$this->form_validation->set_rules('language', 'Language', 'required');
					} 
		}
		
        if($this->form_validation->run())
        { 
            $form = $this->input->post();
            //print_r($form);exit;
            
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
            $ins_data['employee_limit']  = $form['employee_limit'];
            if($form['password'] == "") { 
	
					$ins_data['password']  = $edit_data[0]['password'];
            }else {
				
				$ins_data['password']  = md5($form['password']);
			}
            //$ins_data['ori_password']  = $form['password'];
            $ins_data['role']  = 2;
            $ins_data['created_date']  = date("Y-m-d H:i:s");
            $ins_data['created_id']  = 8;
            
            if ( isset($_POST['language']) )
			{
            $ins_data['language']  = implode(",",$form["language"]);
		}else {
			$ins_data['language'] = $edit_data[0]['language'];
		}
           
			if(empty($edit_id)){
				
				$folder = $form['name'];
				mkdir('./views/repository/files/'.$folder.'', 0755,true);
			
			$update_data = $this->user_model->insert("users",$ins_data);
           // $this->service_message->set_flash_message('record_insert_success');
		}else {
			
			$update_data = $this->user_model->update("users",$ins_data,array("id" => $edit_id));
           // $this->service_message->set_flash_message('record_update_success');
		}
		redirect("user");    

		}	
			
			 if($edit_id) {
                $edit_data = $this->user_model->get_lession_data("users",array("id" => $edit_id));
                
                if(!isset($edit_data[0])) {
                    //$this->service_message->set_flash_message('record_not_found_error');
                    redirect("user");   
                }
                if($role== 1) {
					$this->data['title']          = "EDIT CLIENT";
				} else {
					$this->data['title']          = "EDIT";
				}
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                
            }
            else if($this->input->post()) { 
                $this->data['form_data'] = $_POST;
                if($role== 1) {
					$this->data['title']          = "ADD CLIENT";
				} else {
					$this->data['title']          = "ADD";
				}
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
                $this->data['form_data']['ori_password'] = "";
                
            }
            else
            {
                if($role== 1) {
					$this->data['title']          = "ADD CLIENT";
				} else {
					$this->data['title']          = "ADD";
				}
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("name" => "","is_active" => "","email" => "","password" => "","ori_password" => "","language" => "","employee_limit" => ""); 
            }
		
		 
		$this->layout->view('user/add');
		
		}
        else
        {
            redirect("home");
        }  
    
	}
	
	
	
	function user_delete()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from users where id in ('.$id.')');
             $this->db->query('delete from users where created_id in ('.$id.')');
            
           // $this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    }
    
    
    
    function profile($edit_id = "")
    {
		 
		//$user_id = $this->uri->segment(3);
		$user_id =  $edit_id; 
		$role =  $this->session->userdata('admin_data')['role']; 
		
		
		
		//$this->data['get_menu'] = $this->inspection_model->get_menu_inspection("users",array("role" => 2));
		//print_r($this->data['get_menu']);exit;
			
			
		
		if(is_logged_in()) {
		  
            
			$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			
			 if ( empty($_FILES['profile_img']['name']) && empty($_POST['slide_image']) )
			{ 
				$this->form_validation->set_rules('profile_img', 'Profile Image', 'required');
			} 
			
			
			$this->form_validation->set_rules($this->_user_detail_validation_rules);
			
        if($this->form_validation->run())
        {
			
          
            $form = $this->input->post();
           
            
			if(!empty($_FILES['profile_img']['tmp_name'])){ 
			  $upload_data = $this->do_upload();
	
              $filename = (isset($upload_data['profile_img']['file_name']))?$upload_data['profile_img']['file_name']:"";
			}else{
				$filename = (isset($_POST['slide_image']))?$_POST['slide_image']:"";
			} 
			
			
			
			
			$ins_data = array();
            $edit_data = $this->user_model->get_user_data("users",array("id" => $edit_id));
			
            $ins_data['name']       	= $form['name'];
           
            $ins_data['email']  = $form['email'];
            $ins_data['phone']  = $form['phone'];
            
            if($form['password'] == "") { 
	
					$ins_data['password']  = $edit_data[0]['password'];
            }else {
				
				$ins_data['password']  = md5($form['password']);
			}
            //$ins_data['ori_password']  = $form['password'];
           $ins_data['profile_img']  = $filename;
           
			if(empty($edit_id)){
			      
                     $social_data = $this->user_model->insert("users",$ins_data);
                    // $this->service_message->set_flash_message('record_insert_success');
		      }
              else 
              {  
                    $social_data = $this->user_model->update("users",$ins_data,array("id" => $edit_id));
                    //$this->service_message->set_flash_message('record_update_success');
		      }
		      redirect("home");    
		
		}	
			
			 if($edit_id) {
                $edit_data = $this->user_model->get_user_data("users",array("id" => $edit_id));
               
                if(!isset($edit_data[0])) {
                    //$this->service_message->set_flash_message('record_not_found_error');
                    redirect("home");   
                }
                $this->data['title']          = "EDIT INSPECTION";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                $this->data['form_data']['slide_image'] = $this->data['form_data']['profile_img'];
                
            }
            else if($this->input->post()) {
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD INSPECTION";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
            }
            else
            {
                $this->data['title']     = "ADD INSPECTION";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("name" => "","email" => "","slide_image" => "","profile_img" => "");
                
            }
		    
		    $this->data['img_url']=$this->layout->get_img_dir();
		    $this->layout->view('user/profile');
		}
        else
        {
            redirect("admim/login");
        }  
		
		
	} 
    
    
    function do_upload()
	{
		 
		$config['upload_path'] = '../assets/images/frontend/users';

		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '3000';
		
		
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('profile_img'))
		{ 
			$error = array('error' => $this->upload->display_errors());

			return $error;
			
		}
		else
		{
			$data = array('profile_img' => $this->upload->data());
			return $data;
			
		}
		
	}
	
	
	
	function user_plan_detail($id)
	{
		 $this->data['plan_detail'] = $this->user_model->get_user_plan_data($id);
		 //print_r($this->data['plan_detail']);exit;
		 $this->layout->view('user/user_plan_detail');
		
	}
    
    
   
    
}
?>
