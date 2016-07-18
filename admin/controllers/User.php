<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class User extends Admin_Controller 
{
	protected $_user_validation_rules = array(
				//array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|max_length[255]'),
				//array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
				array('field' => 'employee_limit', 'label' => 'No.of employee', 'rules' => 'trim|required'),
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
        
		// Show Errors
		if($config['Sandbox']){
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}
        $this->load->model('user_model');
        $this->load->library('Paypal_pro',$config);        
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
            redirect("admim/login");
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
		$this->data['form_data']['c_number'] = "";
		$this->data['form_data']['cvv'] = "";
		$this->data['plan_detail'] = $this->user_model->get_user_plan_data($id);
		$this->data['plans'] = $this->user_model->get_plans();
		 //print_r($this->data['plan_detail']);exit;
		$this->layout->view('user/user_plan_detail');
		
	}
    function cancel_subscription($id)
	{
		$get_sub_id = $this->user_model->get_subscription_id($id);
		$pay_method = $get_sub_id[0]['payment_method'];
		if($pay_method=="Authorize")
		{
			//Auhtorize Cancel Subscription
			$sub_id = $get_sub_id[0]['subscription_id'];
			$this->load->library('authorize_arb');
			$this->authorize_arb->startData('cancel');
			$refId = substr(md5( microtime() . 'ref' ), 0, 20);
			$this->authorize_arb->addData('refId', $refId);
			$this->authorize_arb->addData('subscriptionId', $sub_id);
			if( $this->authorize_arb->send() )
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
		else
		{
			$profileid = "I-V8R3WTLVBVR4";
			$MRPPSFields = array('profileid' => $profileid,'action'=>"suspend");
						   
			$PayPalRequestData = array('MRPPSFields' => $MRPPSFields);
			
			$PayPalResult = $this->paypal_pro->ManageRecurringPaymentsProfileStatus($PayPalRequestData);
			
			if($this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
			{
				$ins_data['profile_status'] = "Inactive";
				$this->user_model->update("payment_recurring_profiles",$ins_data,
					array("user_id"=>$id));
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
				if($this->form_validation->run())
	        	{
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
	        		if($res['profileid']!='' && $b['subs_status']=="Success")
			        {
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
	        	$plan_detail = $this->user_model->get_user_plan_data($id);
	        	$plan_id = $plan_detail[0]['plan_id'];
	        	$p_id = $this->input->post('plan_name');
	        	if($plan_detail==$p_id)
	        	{
	        		//if plan is not changed just update amount
		        	$profileid = trim($plan_detail[0]['profile_id']);
		        	$MRPPSFields = array('profileid' => $profileid,'action'=>"reactivate");
		        	$URPPFields = array('profileid' => $profileid,'amt'=>"100");
					$PayPalRequestData = array('MRPPSFields' => $MRPPSFields);				
					$PayPalRequestData1 = array('URPPFields' => $URPPFields);
					$PayPalResult = $this->paypal_pro->ManageRecurringPaymentsProfileStatus($PayPalRequestData);
					//$PayPalResult1 = $this->paypal_pro->UpdateRecurringPaymentsProfile($PayPalRequestData1);
					//echo "<pre>";print_r($PayPalResult1);
					//exit;
					if($this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
					{
						$ins_data['profile_status'] = "Active";
						$this->user_model->update("payment_recurring_profiles",$ins_data,
							array("user_id"=>$id));
					}
				}
				else
				{
					//if plan is changed create new profile
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
