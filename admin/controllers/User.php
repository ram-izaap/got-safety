<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class User extends Admin_Controller 
{
	protected $_user_validation_rules = array(
				//array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|max_length[255]'),
				//array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
				
                array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
													
												);
    
    
    protected $_user_detail_validation_rules = array(
					array('field' => 'name', 'label' => 'Name', 'rules' => 'trim'),
					array('field' => 'email', 'label' => 'Email', 'rules' => 'trim'),
					array('field' => 'phone', 'label' => 'Phone No', 'rules' => 'trim|required'));
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
				$this->data['get_plans'] = $this->user_model->get_plans("plan","");
				$role =  $this->session->userdata('admin_data')['role'];  
              if($role == "1"){ 
				if (!isset($_POST['language']) )
					{ 
						$this->form_validation->set_rules('language', 'Language', 'required');
					} 
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
			 $get_plan=$this->user_model->get_plans("plan",array("id" => $form['plan_name']));
			$emp_limit = $get_plan[0]['emp_limit'];
			$plan_amt = $get_plan[0]['plan_amount'];
            $ins_data['name']       	= $form['name'];
            $ins_data['plan_type']       	= $form['plan_name'];

            $ins_data['is_active']  = $form['is_active'];
            $ins_data['email']  = $form['email'];
            $ins_data['pay_mode']       	= "Others";
            $ins_data['employee_limit']  = $emp_limit;
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
			}
			else 
			{
				$ins_data['language'] = $edit_data[0]['language'];
			}
           
			if(empty($edit_id))
			{
				$url = "http://izaapinnovations.com/got_safety/admin/";
		        $msg = "Your Backend Login link as client ".$url." \n\nClient Username: ".$form['name']."\nPassword: ".$form['password']."\n\nThank you.";
	            $this->email->from('admin@gotsafety.com', 'Gotsafety');
				$this->email->to( $form['email'] );
				$this->email->subject('Signup Successfully');
				$this->email->message($msg);
				$this->email->send();
				$folder = $form['name'];
				mkdir('./views/repository/files/'.$folder.'', 0755,true);			
				$update_data = $this->user_model->insert("users",$ins_data);
				 /* Create Subscription Profile*/
				 $sub_data['user_id'] = $update_data;
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
            redirect("login");
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
		 //print_r($_FILES);exit;
		//$user_id = $this->uri->segment(3);
		$user_id =  $edit_id; 
		$role =  $this->session->userdata('admin_data')['role']; 
		
		
		
		//$this->data['get_menu'] = $this->inspection_model->get_menu_inspection("users",array("role" => 2));
		//print_r($this->data['get_menu']);exit;
			
			
		
		if(is_logged_in()) 
		{
		  
            
			$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			
			 if ( empty($_FILES['profile_img']['name']) && empty($_POST['slide_image']) )
			{ 
				$this->form_validation->set_rules('profile_img', 'Profile Image', 'required');
			} 
			
			
			$this->form_validation->set_rules($this->_user_detail_validation_rules);
			
        if($this->form_validation->run())
        {
            $form = $this->input->post();
			if(!empty($_FILES['profile_img']['tmp_name']))
			{ 
			  $upload_data = $this->do_upload();
              $filename = (isset($upload_data['profile_img']['file_name']))?$upload_data['profile_img']['file_name']:"";
			}
			else
			{
				$filename = (isset($_POST['slide_image']))?$_POST['slide_image']:"";
			} 
			//echo $filename."1";exit;
			
			
			
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
           
			if(empty($edit_id))
			{
			      
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
            redirect("login");
        }  
		
		
	} 
    
    
    function do_upload()
	{
		 
		$config['upload_path'] = '../assets/images/frontend/users';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|bmp';
		$config['max_size']	= '10000';
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
            if(!empty($profileid)) {
                
    			$MRPPSFields = array('profileid' => $profileid,'action'=> ucfirst($status));
    						   
    			$PayPalRequestData = array('MRPPSFields' => $MRPPSFields);
    			
    			$PayPalResult = $this->paypal_pro->ManageRecurringPaymentsProfileStatus($PayPalRequestData);
                
    			if($this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])){
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
		if($_POST['submit']){
		  
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
                //print_r($plan_detail);
	        	$p_id           = $this->input->post('plan_name');
                $plan_detail    = $this->user_model->get_plan(array("id" => $p_id));
	        	
                $profile_status = $this->input->post('profile_status');
                $change_reason  = $this->input->post('change_reason');
                
                //
	        	//	if($plan_detail['plan_name']==$p_id){
	        		
		        	$profileid          = $this->input->post('profile_id');
                    
		        	$MRPPSFields        = array('profileid' => $profileid,'action'=>"reactivate");
		        	$URPPFields         = array('profileid' => $profileid,'amt'=>"100");
                    
                    $URPPFields         = array(
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
            		
            		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])){
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
  
					//	}
				
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
