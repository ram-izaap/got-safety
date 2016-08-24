<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class User extends Admin_Controller 
{
	protected $_user_validation_rules = array(
				array('field' => 'name', 'label' => 'Client/App Username', 'rules' => 'trim|required|max_length[255]'),
				array('field' => 'email', 'label' => 'Main Contact Email', 'rules' => 'trim|required|valid_email|callback_email_check'),
				array('field' => 'admin_name', 'label' => 'Client Admin Username', 'rules' => 'required'),
				array('field' => 'company_name', 'label' => 'Company Name', 'rules' => 'required'),
				array('field' => 'pri_city', 'label' => 'City', 'rules' => 'required'),
				array('field' => 'pri_state', 'label' => 'State', 'rules' => 'required'),
				array('field' => 'pri_zip_code', 'label' => 'Zip Code', 'rules' => 'required'),
	            array('field' => 'company_phone_no', 'label' => 'Company Phone No', 'rules' => 'trim|required|numeric|max_length[12]|min_length[6]'),
	            array('field' => 'company_address', 'label' => 'Company Address', 'rules' => 'required'),
	            array('field' => 'company_url', 'label' => 'Company URL', 'rules' => 'trim|callback_checkwebsiteurl'),
	            array('field' => 'main_contact_no', 'label' => 'Main Contact No', 'rules' => 'trim|numeric|max_length[12]|min_length[6]'),
	            //array('field' => 'main_email_addr', 'label' => 'Email', 'rules' => 'trim|valid_email'),
	            array('field' => 'no_of_employees', 'label' => 'No of Employees', 'rules' => 'trim|numeric'),
	            array('field' => 'plan_name', 'label' => 'Plan', 'rules' => 'required'),
	            array('field' => 'profile_img', 'label' => 'Image', 'rules' => 'callback_do_upload'),
                array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
													
			);
    
    public $upload_data = array();

    protected $_user_detail_validation_rules = array(
		            array('field' => 'profile_img', 'label' => 'File', 'rules' => 'callback_do_upload')
		          );

    protected $_payment_detail_validation_rules = array(
					array('field' => 'c_number', 'label' => 'Card Number',
						 'rules' => 'trim|required|max_length[16]|min_length[16]|numeric'),
					array('field' => 'cvv', 'label' => 'CVV', 'rules' => 'trim|required|max_length[3]|min_length[3]|numeric'),
				);
    
    
    
    function __construct()
    {
        parent::__construct();  
        $config = api_credentials('sandbox','paypal');
        $config1 = api_credentials('TEST','authorize');
        if($config1['mode']=="TEST")
        {
        	$config1['api_url'] = 'https://test.authorize.net/gateway/transact.dll';
			$config1['arb_api_url'] = 'https://apitest.authorize.net/xml/v1/request.api';
        }
        else
        {
        	$config1['api_url'] = 'https://authorize.net/gateway/transact.dll';
			$config1['arb_api_url'] = 'https://api.authorize.net/xml/v1/request.api';
        }
        
		// Show Errors
		if($config['Sandbox']){
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}
        
        if($config1['mode']=="TEST")
        {
        	$config1['api_url']     = 'https://test.authorize.net/gateway/transact.dll';
			$config1['arb_api_url'] = 'https://apitest.authorize.net/xml/v1/request.api';
        }
        else
        {
        	$config1['api_url']     = 'https://authorize.net/gateway/transact.dll';
			$config1['arb_api_url'] = 'https://api.authorize.net/xml/v1/request.api';
        }
        
       	$this->load->library('authorize_net',$config1);
       	$this->load->library('authorize_arb',$config1);
        
        $this->load->model('user_model');
        $this->load->library('Paypal_pro',$config);
        $this->load->library('email');
        $this->payment_method = ''; 

        if(!is_logged_in()) 
        {
          redirect("login");
        }      
       
    }  
    
   
    
    public function index()
    { 
        $this->layout->add_javascripts(array('listing', 'rwd-table'));  
        $this->load->library('listing');

        $this->simple_search_fields = array('name' => 'Name');
         
        $this->_narrow_search_conditions = array("start_date");

        $str = '<a href="'.site_url('user/add_edit_user/{id}').'" class="table-link">
                    <span class="fa-stack">
                        
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>'.
                '<a class="table-link employee_view" client_id={id}>
                    <span class="fa-stack" >
                        <i class="fa fa-eye"></i>
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
        
        
        if(is_logged_in())
        	$this->layout->view("user/user_list");
        else
        	redirect("login");
        
    }
	public function add_edit_user($edit_id = "")
    { 
		if(is_logged_in()) 
		{
			$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;			
			$this->form_validation->set_rules($this->_user_validation_rules);
			$id =  $this->session->userdata('admin_data')['id'];
            $role =  $this->session->userdata('admin_data')['role'];            
			$this->data['get_menu'] = $this->user_model->get_language("language");
			$this->data['get_plans'] = $this->user_model->get_plans("plan",array("is_active"=>"1"));
			$role =  $this->session->userdata('admin_data')['role'];  
            
            if($role == "1")
            { 
			  if (!isset($_POST['language']) )
			  { 
				 $this->form_validation->set_rules('language', 'Language', 'required');
			  } 
		    }
		
		if(isset($_POST['name'])) 
		{
			$this->form_validation->set_rules('name', 'Client/App Username', 'trim|required|callback_name_unique_check['.$edit_id.']');
		}
		if(isset($_POST['admin_name'])) 
		{
			$this->form_validation->set_rules('admin_name', 'Client Admin Username', 'trim|required|callback_admin_name_unique_check['.$edit_id.']');
		}
		if(isset($_POST['email'])) 
		{
			$this->form_validation->set_rules('email', 'Client Admin Email', 'trim|required|valid_email|callback_email_unique_check['.$edit_id.']');
		}

		if(isset($_POST['admin_pwd']) && $_POST['admin_pwd'] == "" && $edit_id=="") 
        {
        	$this->form_validation->set_rules("admin_pwd","Client Admin Password","required");
        } 

        if(isset($_POST['password']) && $_POST['password'] == "" && $edit_id=="") 
        {
        	$this->form_validation->set_rules("password","Client/App Password","required");
        } 


        /*if(isset($_POST['profile_img']) && $_POST['profile_img']!='')
        {
        	$this->form_validation->set_rules("profile_img","Image","callback_do_upload");
        }*/

        $this->upload_data=array();
		
        if($this->form_validation->run())
        { 
            $form = $this->input->post();

            if(count($this->upload_data))
			{ 
				$filename = (isset($this->upload_data['profile_img']['file_name']))?$this->upload_data['profile_img']['file_name']:"";
			}
			else
			{
				$filename = (isset($_POST['slide_image']))?$_POST['slide_image']:"";
			} 
            
			if(isset($form['is_active'])) 
			{ 
				$form['is_active'] = $form['is_active'];	
			}
			else 
			{ 
				$form['is_active'] = "0";
			}
			
			$ins_data = $ins_data1 = array();			

			$edit_data = $this->user_model->get_lession_data("users",array("id" => $edit_id));
			$get_user_data = $this->user_model->get_lession_data("users",array("created_id" =>$edit_data[0]['id']));
			$get_plan=$this->user_model->get_plans("plan",array("id" => $form['plan_name']));
			

            $ins_data1['name']       	= $form['name'];

            if($form['password'] == "") 
            { 
            	$ins_data1['password']  = $get_user_data[0]['password'];
            }
            else 
            {
			    $ins_data1['password']  = md5($form['password']);
			}

           if($form['admin_pwd'] == "") 
            { 
            	$ins_data['password']  = $edit_data[0]['password'];
            }
            else 
            {
			    $ins_data['password']  = md5($form['admin_pwd']);
			}

			$ins_data['email']  = $form['email'];

            $ins_data['name']  = $form['admin_name'];

            $ins_data['profile_img'] = $filename;

			$ins_data['company_name']  = $form['company_name'];
			$ins_data['company_address'] = $form['company_address'];
            $ins_data['pri_city']      = $form['pri_city'];
            $ins_data['pri_state']      = $form['pri_state'];
            $ins_data['pri_zip_code']      = $form['pri_zip_code'];
            $ins_data['company_phone_no'] = $form['company_phone_no'];
            $ins_data['company_url'] = $form['company_url'];
            $ins_data['main_contact'] = $form['main_contact'];
            $ins_data['main_contact_no'] = $form['main_contact_no'];
            $ins_data['main_contact_address'] = $form['main_contact_address'];
            $ins_data['sec_city']      = $form['sec_city'];
            $ins_data['sec_state']      = $form['sec_state'];
            $ins_data['sec_zip_code']      = $form['sec_zip_code'];
            $ins_data['no_of_employees'] = $form['no_of_employees'];

            $ins_data['role']  = 2;

            $ins_data1['role'] = 3;

            $emp_limit = $get_plan[0]['emp_limit'];
			$plan_amt = $get_plan[0]['plan_amount'];
            
            $ins_data['employee_limit']  = $emp_limit;

            $ins_data['plan_type']       	= $form['plan_name'];
            $ins_data['pay_mode']       	= "Others";

            $ins_data['is_active']  = $ins_data1['is_active'] =  $form['is_active'];

            if($role==1)
              $ins_data['created_id']  =  $this->session->userdata("admin_data")['id'];

            $ins_data['created_date']=$ins_data1['created_date']= date("Y-m-d H:i:s");

            
            if ( isset($_POST['language']) )
			{
           	 	$ins_data['language']  = implode(",",$form["language"]);
			}
			else 
			{
				$ins_data['language'] = $edit_data[0]['language'];
			}
           
			if(empty($edit_id))
			{
				$url = base_url().'client';
		        $msg = "Your Backend Login link as client ".$url." \n\nClient Username: ".$form['name']."\nPassword: ".$form['password']."\n\nThank you.";
	            $this->email->from('admin@gotsafety.com', 'Gotsafety');
				$this->email->to( $form['email'] );
				$this->email->subject('Signup Successfully');
				$this->email->message($msg);
				$this->email->send();
				$folder = $form['admin_name'];
				mkdir('./views/repository/files/'.$folder.'', 0755,true);			
				
				/* Client Insertion */
				$update_data = $this->user_model->insert("users",$ins_data);
				$last_insert_id = $this->db->insert_id();
                
                /* User Insertion */  
				$ins_data1['created_id'] = $last_insert_id;
				$update_data = $this->user_model->insert("users",$ins_data1);

				 /* Create Subscription Profile*/
				 $sub_data['user_id'] = $last_insert_id;
				 $sub_data['profile_id'] = rand();
				 $sub_data['plan_id'] = $form['plan_name'];
				 $sub_data['profile_start_date']= date("Y-m-d H:i:s");
				 $sub_data['next_billing_date']=date("Y-m-d H:i:s",strtotime("+31 days"));
				 $sub_data['amount'] = $plan_amt;
				 $sub_data['profile_status'] = "Active";
				 $sub_data['payment_status'] = "Completed";
				 $sub_data['payment_method'] = "Others";
				 $sub_insert_data = $this->user_model->insert("payment_recurring_profiles",$sub_data);
				 /*End Subscription Profile*/
           		// $this->service_message->set_flash_message('record_insert_success');
			}
			else
			{
				$update_data = $this->user_model->update("users",$ins_data,array("id" => $edit_id));
				$update_data = $this->user_model->update("users",$ins_data1,array("created_id" => $edit_id));
           		// $this->service_message->set_flash_message('record_update_success');
			}
			if($role==1)
			  redirect("user");
			  else
			  redirect("user/add_edit_user/".$edit_id."");    
		}	
			
			 if($edit_id) 
			 {
                $edit_data = $this->user_model->get_lession_data("users",array("id" => $edit_id));

                $get_user_data = $this->user_model->get_lession_data("users",array("created_id" => $edit_id));

                $edit_data1 = $get_user_data1 = array();
                
                $edit_data1 = array("id"=>$edit_data[0]['id'],"admin_name" =>$edit_data[0]['name'],"email"=>$edit_data[0]['email'],"profile_img"=>$edit_data[0]['profile_img'],"company_name"=>$edit_data[0]['company_name'],"company_address"=>$edit_data[0]['company_address'],"company_phone_no"=>$edit_data[0]['company_phone_no'],"company_address"=>$edit_data[0]['company_address'],"company_url"=>$edit_data[0]['company_url'],"main_contact"=>$edit_data[0]['main_contact'],"main_contact_no"=>$edit_data[0]['main_contact_no'],"main_contact_address"=>$edit_data[0]['main_contact_address'],"no_of_employees"=>$edit_data[0]['no_of_employees'],"plan_type"=>$edit_data[0]['plan_type'],"language"=>$edit_data[0]['language'],"is_active"=>$edit_data[0]['is_active'],"pri_city"=>$edit_data[0]['pri_city'],"pri_state"=>$edit_data[0]['pri_state'],"pri_zip_code"=>$edit_data[0]['pri_zip_code'],"sec_city"=>$edit_data[0]['sec_city'],"sec_state"=>$edit_data[0]['sec_state'],"sec_zip_code"=>$edit_data[0]['sec_zip_code']);
                $get_user_data1 = array("name"=>$get_user_data[0]['name']);

                if(!isset($edit_data[0])) 
                {
                    redirect("user");   
                }
                if($role== 1) 
                {
					$this->data['title']          = "EDIT CLIENT";
				} 
				else 
				{
					$this->data['title']          = "EDIT";
				}
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = array_merge($edit_data1,$get_user_data1);

                
             }
            
             else if($this->input->post()) 
             { 
                $this->data['form_data'] = $_POST;
                
                if($role== 1) 
                {
					$this->data['title']          = "ADD CLIENT";
				} 
				
				else 
				{
					$this->data['title']          = "ADD";
				}

                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
                $this->data['form_data']['ori_password'] = "";
                
             }

             else
             {
                if($role== 1) 
                {
					$this->data['title']          = "ADD CLIENT";
				} 
				else 
				{
					$this->data['title']          = "ADD";
				}
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("name" => "","is_active" => "","email" => "","password" => "","ori_password" => "","admin_name" =>"","admin_pwd"=>"","company_name" =>"","company_phone_no" =>"","company_address" =>"","company_url" =>"","main_contact" =>"","main_contact_no" =>"","main_email_addr" =>"", "main_contact_address" =>"", "no_of_employees"=>"","language" => "","employee_limit" => "","pri_city"=>"","pri_state"=>"","pri_zip_code"=>"","sec_city"=>"","sec_state"=>"","sec_zip_code"=>""); 
             }

             $this->layout->view('user/add');
		
		}
        else
        {
            redirect("login");
        }  
    }
	
	
	
	function user_delete()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) 
        {
        	$this->db->query('delete from users where id in ('.$id.')');
            $this->db->query('delete from users where created_id in ('.$id.')');
            return true;  
        }
    }
    
    
    
    function profile($edit_id = "")
    {
		$user_id =  $edit_id; 
		$role =  $this->session->userdata('admin_data')['role']; 			
					
		if(is_logged_in()) 
		{
		  $edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;

          $edit_data = $this->user_model->get_lession_data("users",array("id" => $edit_id));
		  
		  $this->form_validation->set_rules($this->_user_detail_validation_rules);
			
		   $this->upload_data = array();

	        if($this->form_validation->run())
	        {
	            $form = $this->input->post();

                
				if(count($this->upload_data))
				{ 

	              $filename = (isset($this->upload_data['profile_img']['file_name']))?$this->upload_data['profile_img']['file_name']:"";
				}
				else
				{

					$filename = (isset($_POST['slide_image']))?$_POST['slide_image']:"";
				} 
							
				$ins_data = $ins_data1 = array();
	            
				
	            $ins_data['name']       	= $form['name'];
	           
	            
	            if($form['password'] == "") 
	            { 
	            	$ins_data['password']  = $edit_data[0]['password'];
	            }
	            else 
	            {
					$ins_data['password']  = md5($form['password']);
				}

				if($form['user_pwd'] == "") 
	            { 
	            	$ins_data1['password']  = $get_user_data[0]['password'];
	            }
	            else 
	            {
					$ins_data1['password']  = md5($form['user_pwd']);
				}

				if(isset($form['is_active'])) 
				{ 
					$form['is_active'] = $form['is_active'];	
				}
				else 
				{ 
					$form['is_active'] = "0";
				}

	            $ins_data['name']  = $form['name'];
				

	            $ins_data['profile_img']  = $filename;

	            $ins_data['is_active'] = $form['is_active'];

	            $social_data = $this->user_model->update("users",$ins_data,array("id" => $edit_id));

			    redirect("home");    
			
			}	
			
			 if($edit_id) 
			 {
                $edit_data = $this->user_model->get_user_data("users",array("id" => $edit_id));

                if(!isset($edit_data[0])) 
                {
                    //$this->service_message->set_flash_message('record_not_found_error');
                    redirect("home");   
                }

                $this->data['title']          = "EDIT INSPECTION";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                $this->data['form_data']['slide_image'] = $this->data['form_data']['profile_img'];
                
             }
             else if($this->input->post()) 
             {
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
            redirect("login");
        }  
		
		
	} 
    
    
    function do_upload()
	{
		if(isset($_FILES['profile_img']['name']) && !empty($_FILES['profile_img']['name']) && $_FILES['profile_img']['name']!='')
		{ 
			$config['upload_path'] = '../assets/images/frontend/users/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size']	= '2048';
			$config['overwrite'] = FALSE;
            $config['file_name'] = $_FILES['profile_img']['name'];

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('profile_img'))
			{ 
				$error = array('error' => $this->upload->display_errors());
				$this->form_validation->set_message("do_upload",$error['error']);
				return false;
			}
			else
			{ 
				$data = array('profile_img' => $this->upload->data());
				@unlink("../assets/images/frontend/users/".$_POST['slide_image']);
                $this->upload_data = $data;
				return $data;
			}
		}
		else if(isset($_FILES['profile_img']['name']) && empty($_FILES['profile_img']['name']) && isset($_POST['slide_image']) && $_POST['slide_image']=='')
	    {
	        $this->form_validation->set_message("do_upload","The Image Filed is required");
	        return false;
	    }
	    else
	    {
	       return true;
	    }
	}


	
	
	
	function user_plan_detail($id)
	{
		$this->data['grid']=$this->user_model->gettransactionlist("payment_transaction_history a",array("user_id"=>$id));
		$this->data['form_data']['c_number'] = "";
		$this->data['form_data']['cvv'] = "";
		$this->data['plan_detail'] = $this->user_model->get_user_plan_data($id);
		$this->data['plans'] = $this->user_model->get_plans("plan",'');
		//print_r($this->data['plan_detail']);exit;
		if(is_logged_in())
			$this->layout->view('user/user_plan_detail');
		else
			redirect("login");
		
	}
    function cancel_subscription($id,$status)
	{
	   
		$get_sub_id = $this->user_model->get_subscription_id($id);
		$pay_method = (isset($get_sub_id['payment_method']))?$get_sub_id['payment_method']:"";
		if(strtolower($pay_method)=="authorize")
		{
			//Auhtorize Cancel Subscription
			$sub_id = $get_sub_id['subscription_id'];
			//$this->load->library('authorize_arb');
			$this->authorize_arb->startData('cancel');
			$refId = substr(md5( microtime() . 'ref' ), 0, 20);
			$this->authorize_arb->addData('refId', $refId);
			$this->authorize_arb->addData('subscriptionId', $sub_id);
			if( $this->authorize_arb->send())
			{
				$ref_id=$this->authorize_arb->getRefId();
				$ins_data['profile_status'] = "Inactive";
				$this->user_model->update("payment_recurring_profiles",$ins_data,
					array("user_id"=>$id));
			}
			else
			{
				 $this->authorize_arb->getError() . '</p>';
			}
		}
		else if(strtotlower($pay_method)=="paypal")
		{
			$profileid = (isset($get_sub_id['profile_id']))?$get_sub_id['profile_id']:"";
            if(!empty($profileid)) 
            {
                
    			$MRPPSFields = array('profileid' => $profileid,'action'=> ucfirst($status));
    						   
    			$PayPalRequestData = array('MRPPSFields' => $MRPPSFields);
    			
    			$PayPalResult = $this->paypal_pro->ManageRecurringPaymentsProfileStatus($PayPalRequestData);
                
    			if($this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
    			{
    			    $status = ($status!= 'reactivate')?ucfirst($status):"Active"; 
    				$ins_data['profile_status'] = $status;
    				$this->user_model->update("payment_recurring_profiles",$ins_data, array("user_id"=>$id));
    			}
		   }
		}
		redirect("user/user_plan_detail/$id");
	}
    
	function renew_subscription($id)
	{
		if($_POST['submit'])
		{
		  
			if($_POST['pay_method']=="Authorize")
			{
				$this->data['form_data'] = $_POST;
				$form = $this->input->post();
				$this->form_validation->set_rules($this->_payment_detail_validation_rules);
				if($this->form_validation->run()){
				    
	        		$users_data = $this->user_model->get_users($id);
	        		$ins['phone'] = $users_data[0]['mobile'];
	        		$ins['fax'] = $users_data[0]['fax'];
	        		$ins['email'] = $users_data[0]['email'];
	        		$ins['fname'] = $users_data[0]['fname'];
	        		$ins['lname'] = $users_data[0]['lname'];
	        		$ins['address'] = $users_data[0]['address'];
	        		$ins['city'] = $users_data[0]['city'];
	        		$ins['state'] = $users_data[0]['state'];
	        		$ins['zipcode'] = $users_data[0]['zipcode'];
	        		$ins['country'] = $users_data[0]['country'];
	        		$amt = $this->input->post('amount');
	        		$ins['c_number'] = $this->input->post('c_number');
	        		$ins['cvv'] = $this->input->post('cvv');

	        		$ins['description'] = $this->input->post('desc');
			        $ins['amount'] = $amt;
			        $ins['exp_month'] = $this->input->post('exp_month');
			        $ins['exp_year'] = $this->input->post('exp_year');
	        		$p_id = $this->input->post('plan_name');
	        		$userid = $_SESSION['admin_data']['id'];
	        		$res['profileid']=time();
			        $res['customer_id']=rand();
	        		$b =  $this->create_auth_subscription($res,$ins);
	        		$up_data['profile_id'] = $res['profileid'];
	        		$up_data['customer_id'] = $res['customer_id'];
	        		$up_data['plan_id'] = $p_id;
	        		$up_data['amount'] = $amt;
	        		$up_data['profile_status'] = "Active";
	        		$ins_data['plan_type'] = $p_id;
	        		if($res['profileid']!='' && $b['subs_status']=="Success"){
			        	$up_data['invoice_no'] = $b['invoice_no'];
			        	$up_data['subscription_id'] = $b['subs_id'];
	        			$this->user_model->update("payment_recurring_profiles",$up_data,
	        				array("user_id"=>$id));
	        			$this->user_model->update("users",$ins_data,array("id"=>$id));
	        			$_SESSION["renew_succ"]="<strong>Success!</strong>
	        				Your Subscription has been renewed.";
	        		}
	        		else
	        		{
	        			$_SESSION["renew_succ"]="<strong>Sorry!</strong>Something went wrong.";
	        		}
	        		$_POST="";
	        	}
	        }
	        else
	        {
	        	$userdetail    = $this->user_model->get_user_plan_data($id);
	        	$p_id           = $this->input->post('plan_name');
                $plan_detail    = $this->user_model->get_plan(array("id" => $p_id));
	        	
                $profile_status = $this->input->post('profile_status');
                $change_reason  = $this->input->post('change_reason');
                $profileid      = $this->input->post('profile_id');
                $MRPPSFields    = array('profileid' => $profileid,'action'=>"reactivate");
		        $URPPFields     = array('profileid' => $profileid,'amt'=>"100");
                $URPPFields     = array(
                						   'profileid' => $profileid, 							
                						   'note' => $change_reason, 								
                						   'desc' => $plan_detail['plan_desc'], 					
                						   'subscribername' => '', 						
                						   'profilereference' => '', 					
                						   'additionalbillingcycles' => '', 			
                						   'amt' => $plan_detail['plan_amount'], 		
                						   'outstandingamt' => '', 						  
                						   'autobilloutamt' => '', 						
                						   'maxfailedpayments' => '', 					
                						   'profilestartdate' => date("Y-m-d H:i:s")	
						                 );
		
        		  $BillingAddress = array(
            							'street' => '', 						
            							'street2' => '', 						
            							'city' => '', 							
            							'state' => '', 							
            							'countrycode' => '', 					
            							'zip' => '', 							
            							'phonenum' => '' 						
        						     );
        		
        		
        		  $BillingPeriod = array(
                    						'trialbillingperiod' => '', 
                    						'trialbillingfrequency' => '', 
                    						'trialtotalbillingcycles' => '', 
                    						'trialamt' => '', 
                    						'billingperiod' => '', 						
                    						'billingfrequency' => '', 					 
                    						'totalbillingcycles' => '', 				  
                    						'amt' => '', 								 
                    						'currencycode' => '', 						
        					            );
        		
        		  $CCDetails   = array(
                    						'creditcardtype' => '', 					
                    						'acct' => '', 								  
                    						'expdate' => '', 							
                    						'cvv2' => '', 								
                    						'startdate' => '', 							
                    						'issuenumber' => ''							
        					              );
        		
        		   $PayerInfo  = array(
            						      'email'     => $userdetail[0]['email'], 								
                						  'firstname' => $userdetail[0]['fname'], 							
                						  'lastname'  => $userdetail[0]['lname']							
            					       );	
            					
            		$PayPalRequestData  = array(
                    							'URPPFields' => $URPPFields, 
                    							'BillingAddress' => $BillingAddress, 
                    						//	'ShippingAddress' => $ShippingAddress, 
                    							'BillingPeriod' => $BillingPeriod, 
                    							'CCDetails' => $CCDetails, 
                    							'PayerInfo' => $PayerInfo
            						          );
            						
            		$PayPalResult = $this->paypal_pro->UpdateRecurringPaymentsProfile($PayPalRequestData);
            		
            		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
            		{
            			$errors = array('Errors'=>$PayPalResult['ERRORS']);
                        print_r($PayPalResult);
            			$this->load->view('paypal/error',$errors);
            		}
            		else
            		{
            			$ins_data['profile_status'] = "Active";
                        $ins_data['plan_id']        = $p_id;
						$this->user_model->update("payment_recurring_profiles",$ins_data, array("user_id" => $id));
            		}
  
				
	        }
        	redirect("user/user_plan_detail/$id");
		}
	}
    
   
    function create_auth_subscription($res,$post)
    {
        $this->load->library('authorize_arb');
        $this->authorize_arb->startData('create');
        // Locally-defined reference ID (can't be longer than 20 chars)
        $refId = substr(md5( microtime() . 'ref' ), 0, 20);
        $this->authorize_arb->addData('refId', $refId);
        $this->data['invoice_no'] = rand(0,9999999999);
        $subscription_data = array(
            'name' => $post['description'],
            'paymentSchedule' => array(
                'interval' => array(
                    'length' => 1,
                    'unit' => 'months',
                    ),
                'startDate' => date('Y-m-d'),
                'totalOccurrences' => 9999,
                //'trialOccurrences' => 0,
                ),
            'amount' => $post['amount'],
            //'trialAmount' => 0.00,
            'payment' => array(
                'creditCard' => array(
                    'cardNumber' => $post['c_number'],
                    'expirationDate' => $post['exp_year']."-".$post['exp_month'],
                    'cardCode' => $post['cvv'],
                    ),
                ),
            'order' => array(
                'invoiceNumber' => $this->data['invoice_no'],
                'description' =>  $post['description'],
                ),
            'customer' => array(
                'id' => $res['customer_id'],
                'email' => $post['email'],
                'phoneNumber' => $post['phone'],
                ),
            'billTo' => array(
                'firstName' => $post['fname'],
                'lastName' => $post['lname'],
                'address' => $post['address'],
                'city' => $post['city'],
                'state' => $post['state'],
                'zip' => $post['zipcode'],
                'country' => $post['country'],
                ),
            );

        $this->authorize_arb->addData('subscription', $subscription_data);
        if( $this->authorize_arb->send() )
        {
            $this->data['subs_status'] = "Success";
            $this->data['subs_id'] =  $this->authorize_arb->getId();
        }
        else
        {
            $this->data['subs_status'] = "Fail";
            $this->data['error'] = $this->authorize_arb->getError();
        }
        
        return $this->data;
    }
    
    
    
    
    
     function name_unique_check($name,$edit_id)
     {
        $get_data = $this->user_model->check_exists("users",array("name" => $name,"created_id !=" => $edit_id));
       
       
        if(count($get_data) >0) 
        {
          $this->form_validation->set_message('name_unique_check', 'Username already exists');
          return FALSE;
        }
        return TRUE;
     } 

     function admin_name_unique_check($name,$edit_id)
     {
        $get_data = $this->user_model->check_exists("users",array("name" => $name,"id !=" => $edit_id));
       
       
        if(count($get_data) >0) 
        {
          $this->form_validation->set_message('admin_name_unique_check', 'Username already exists');
          return FALSE;
        }
        return TRUE;
     } 
    
    
     function email_unique_check($email,$edit_id)
     {
        
        $get_data = $this->user_model->check_exists("users",array("email" => $email,"id !=" => $edit_id));

        if(count($get_data) >0) 
        {
          $this->form_validation->set_message('email_unique_check', 'Email already exists');
          return FALSE;
        }
        
        return TRUE;
     }

    function checkwebsiteurl($string_url)
    {
    	$company_url = $this->input->post("company_url");
    	
    	if($company_url!='')
    	{
           $reg_exp = "@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i";
           if(preg_match($reg_exp, $string_url) == TRUE)
           {
             return TRUE;
           }
           else
           {
             $this->form_validation->set_message('checkwebsiteurl', 'URL is invalid format');
             return FALSE;
           }
       }
    }  
 }
?>