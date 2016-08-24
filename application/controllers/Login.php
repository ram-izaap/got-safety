<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Login extends App_Controller {
	
	protected $_login_validation_rules =    array (
            array('field' => 'name', 'label' => 'Username', 'rules' => 'trim|required'),
            array('field' =>'password','label'=>'Password','rules'=>'trim|required'));
												
	
	protected $_signup_validation_rules = array(
            array('field' => 'name', 'label' => 'Client/App Username', 'rules' => 'trim|required|max_length[255]'),
            array('field' => 'email', 'label' => 'Main Contact Email', 'rules' => 'trim|required|valid_email|callback_email_check'),
            array('field' => 'password', 'label' => 'Client/App Password', 'rules' => 'trim|required|max_length[255]'),
            array('field' => 'admin_name', 'label' => 'Client Admin Username', 'rules' => 'trim|required|max_length[255]|callback_name_unique_check'),
            array('field' => 'admin_pwd', 'label' => 'Client Admin Password', 'rules' => 'trim|required|max_length[255]'),
            //array('field' => 'admin_con_pwd', 'label' => 'Confirm Password', 'rules' => 'trim|required|matches[admin_pwd]'),
            array('field' => 'company_name', 'label' => 'Company Name', 'rules' => 'required'),
            array('field' => 'city', 'label' => 'City', 'rules' => 'required'),
            array('field' => 'state', 'label' => 'State', 'rules' => 'required'),
            array('field' => 'zip_code', 'label' => 'Zip Code', 'rules' => 'required'),
            array('field' => 'phone_no', 'label' => 'Company Phone No', 'rules' => 'trim|required|numeric|max_length[12]|min_length[6]'),
            array('field' => 'company_address', 'label' => 'Company Address', 'rules' => 'required'),
            array('field' => 'company_url', 'label' => 'Company URL', 'rules' => 'trim|callback_checkwebsiteurl'),
            array('field' => 'main_contact_no', 'label' => 'Main Contact No', 'rules' => 'trim|numeric|max_length[12]|min_length[6]'),
            //array('field' => 'email_addr', 'label' => 'Email', 'rules' => 'trim|valid_email'),
            array('field' => 'no_of_employees', 'label' => 'No of Employees', 'rules' => 'trim|numeric'),
            array('field' => 'plan_type', 'label' => 'Plan', 'rules' => 'required')
           
        );
	protected $_auth_validation_rules =    array (
                    array('field' => 'fname', 'label' => 'First Name', 'rules' => 'trim|required|min_length[4]|alpha'),		
                    array('field' => 'lname', 'label' => 'Last Name', 'rules' => 'trim|required|min_length[2]|alpha'),
                    array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
                    array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required|alpha'),
                    array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required|alpha'),
                    array('field' => 'zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required|numeric'),
                    array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required|alpha'),
                    array('field' => 'c_number', 'label' => 'Card Number', 'rules' => 'trim|required|numeric|max_length[16]|min_length[16]'),
                    array('field' => 'cvv', 'label' => 'CVV', 'rules' => 'trim|required|numeric|max_length[3]|min_length[3]'),
                    array('field' => 'exp_month', 'label' => 'Expiration Month', 'rules' => 'trim|required'),
                    array('field' => 'exp_year', 'label' => 'Expiration Year', 'rules' => 'trim|required'),
                    array('field' => 'email', 'label' => 'Email-ID', 'rules' => 'trim|required|valid_email'),
                    array('field' => 'phone', 'label' => 'Phone Number', 'rules' => 'trim|required|numeric|max_length[12]|min_length[6]'),
                    array('field' => 'fax', 'label' => 'Fax Number', 'rules' => 'trim|required|numeric|max_length[10]|min_length[6]'),
				);
												
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker'));
        $this->load->model(array('login_model','user_model'));
        $this->load->model('plan_model');

         
    }
    function email_check()
    {
        $email = $this->input->post('email');
        $chk= $this->login_model->email_check($email);
        if($chk)
        {
            $this->form_validation->set_message('email_check', "This Email-ID Already Exists");
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function index()
    {

      if($this->session->userdata('user_id') != "")
       {
            redirect("");
       }
		if($_POST) { 


		$this->form_validation->set_rules($this->_login_validation_rules);
       
        if($this->form_validation->run()){
            $form      = $this->input->post();
            $user_data = $this->login_model->user_login($form['name'], $form['password']);


            
            if($user_data == 1)
            { 
                  //$this->service_message->set_flash_message('login_success');
                if($this->session->userdata('user_detail')['is_active']==1)
                    redirect("");
                else
                {
                    $this->session->unset_userdata('user_detail');
                     $this->session->unset_userdata('user_id');
                    $this->session->set_flashdata("log_fail","Your account has been blocked or Inactive due to pending payment. Please try after some time or contact administrator to resolve.",TRUE);
                    redirect("login");
                }
            }
            else
            { 
                $this->session->unset_userdata('user_detail');
                $this->session->set_flashdata("log_fail","Invalid Username or Password",TRUE);
                redirect("login");
            }
            
        }
        
         if($this->input->post()) {  
            $this->data['form_data'] = $_POST; 
         }
        
		}
        else 
        { 
			$this->data['form_data'] = array("name" => "","password" => "");
		}
		
     	$this->layout->view('login','frontend');
        
    }
    
    
    
    function signup()
    {

        if($this->session->userdata('user_id') != "")
        {
            redirect("");
        }

        if($_POST) 
        {
            $this->load->library('email');
                
            if(isset($_POST['admin_name'])){
                    $this->form_validation->set_rules('admin_name', 'Name', 'trim|required|callback_name_unique_check[]');
            }
            
            if(isset($_POST['email'])){
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_unique_check[]');
            }
             //'pay_mode' in 'field list'
            //$this->form_validation->set_rules($this->_signup_validation_rules);


            
            if($this->form_validation->run())
            {  
                if($this->input->post('plan_type')!=27)
                {
                  $form = $this->input->post();                             
                  $plan_details = $this->user_model->get_plans("plan",array("id" => $form['plan_type']));
                  $this->session->set_userdata("plan_details",$plan_details);
                  $this->session->set_userdata("signup_data",$form);
                  redirect("payment");
                }
                else
                {
                  $form = $this->input->post();

                  $ins_data = array();
                  $ins_data['name']                 = $form['admin_name'];
                  $ins_data['password']             = md5($form['admin_pwd']);
                  $ins_data['no_of_employees']      = $form['no_of_employees'];
                  $ins_data['email']                = $form['email'];
                  $ins_data['company_name']         = $form['company_name'];
                  $ins_data['company_address']      = $form['company_address'];
                  $ins_data['pri_city']      = $form['city'];
                  $ins_data['pri_state']      = $form['state'];
                  $ins_data['pri_zip_code']      = $form['zip_code'];
                  $ins_data['company_phone_no']     = $form['phone_no'];
                  $ins_data['company_url']          = $form['company_url'];
                  $ins_data['main_contact']         = $form['main_contact'];
                  $ins_data['main_contact_no']      = $form['main_contact_no'];
                  $ins_data['main_contact_address'] = $form['main_contact_address'];
                  $ins_data['sec_city']      = $form['city1'];
                  $ins_data['sec_state']      = $form['state1'];
                  $ins_data['sec_zip_code']      = $form['zip_code1'];
                  $ins_data['employee_limit']       = 0;
                  $ins_data['plan_type']            = $form['plan_type'];
                  $ins_data['pay_mode']         = "Others";
                  $ins_data['is_active']            = 0;
                  $ins_data['role']                 = 2;
                  $ins_data['language']             = 1;
                  $ins_data['created_date']         = date("Y-m-d H:i:s");
                  $ins_data['created_id']           = 0;

                  $this->admin_user_id = $this->login_model->insert("users",$ins_data);

                  $user_data = array();
                  $user_data['name']          = $form['name'];
                  $user_data['password']      = md5($form['password']);
                  $user_data['created_date']  = date("Y-m-d H:i:s");
                  $user_data['is_active']     = 0;
                  $user_data['role']          = 3;
                  $user_data['created_id']    = $this->admin_user_id;
             
                  $register_user_id = $this->login_model->insert("users",$user_data);

                  $furl  = base_url();
                  
                  $aurl  = base_url()."admin/client";

                  $msg='';
                    
                  $msg  .= " Your Frontend Login link as client ".$furl." <br>
                             <b>Username</b>: ".$user_data['name']."<br>
                             <b>Password</b>: ".$form['password']."<br><br>
                             ";
                  $msg  .= " Your Backend Login link as client ".$aurl." <br>
                             <b>Client Username</b>: ".$form['admin_name']."<br>
                             <b>Password</b>: ".$form['admin_pwd']."<br><br>
                             Thanks you..";                
                    //$this->user_email($ins_data['email'],'Signup Successfully',$msg);
                    
                  $config['protocol'] = 'sendmail';
                  $config['mailpath'] = '/usr/sbin/sendmail';
                  $config['charset']  = 'iso-8859-1';
                  $config['wordwrap'] = TRUE;
                  $config['mailtype'] = "html";
                  
                  $this->email->set_mailtype("html");  
                  $this->email->from('admin@gotsafety.com', 'Gotsafety');
                  $this->email->to($ins_data['email']);
                  $this->email->subject("Signup Detail Information");
                  $this->email->message($msg);
                  $this->email->send();

                  $this->session->set_flashdata('signup_succ','User Profile has been created sucessfully.',TRUE);
                  
                  $this->data['form_data'] = array("name" => "", "email" => "", "password" => "", "con_password" => "","admin_name" =>"","admin_pwd"=>"","admin_con_pwd"=>"","company_name" =>"","phone_no" =>"","company_address" =>"","company_url" =>"","main_contact" =>"","main_contact_no" =>"","email_addr" =>"", "main_contact_address" =>"", "no_of_employees"=>"","plan_type" =>"","city"=>"","state"=>"","zip_code"=>"","city1"=>"","state1"=>"","zip_code1"=>"","promo_code"=>"");        
                  $folder = $form['admin_name'];
                  $dir = '../../admin/views/repository/files/'.$folder;
                  if(!file_exists($dir)) {
                    mkdir('./admin/views/repository/files/'.$folder, 0755,true); 
                  }
                  redirect("login/signup");

                }
            }
            if($this->input->post()){
                $this->data['form_data']      = $_POST; 
            }
        }
        else
        {
            $this->data['form_data'] = array("name" => "", "email" => "", "password" => "", "con_password" => "","admin_name" =>"","admin_pwd"=>"","admin_con_pwd"=>"","company_name" =>"","phone_no" =>"","company_address" =>"","company_url" =>"","main_contact" =>"","main_contact_no" =>"","email_addr" =>"", "main_contact_address" =>"", "no_of_employees"=>"","plan_type" =>"","city"=>"","state"=>"","zip_code"=>"","city1"=>"","state1"=>"","zip_code1"=>"","promo_code"=>"");        
        }
        $this->data['plan_data']      = $this->db->query("SELECT * FROM plan WHERE is_active=1 ORDER BY FIELD(plan_type, 'Enterprice Plan')")->result_array();     
        $this->layout->view('signup','frontend');
        
    }


    
    
    
    public function logout()
	{
	   
		$this->session->sess_destroy();		
		$this->session->unset_userdata('user_detail');
	
		//$this->session->sess_create();
		//$this->service_message->set_flash_message('logout_success');
	
		redirect();
	}
    
    function payment()
    {
    	$ses_data = $this->session->userdata;
    	$this->layout->view('payment','frontend');
    }

    function do_payment()
    {

    	if($_POST)
     	{
     		$this->form_validation->set_rules($this->_auth_validation_rules);
     		if($this->form_validation->run())
	        {
				$ins = $this->input->post();
		        $ins['description'] = 'Plan - Silver';//$this->input->post('desc');
		        $ins['amount'] = "50";//$this->input->post('amount');
		       	/*$a = $this->create_auth_cust_profile( $ins );
		      	$res['customer_id'] = $a['cus_id'];
		      	$res['profileid'] = $a['profileid'];
		        $res['paymentprofileid'] = $a['paymentprofileid'];
		        $res['shippingprofileid'] = $a['shippingprofileid'];*/
		        $res['profileid']=time();
		        $res['paymentprofileid']=time();
		        $res['shippingprofileid']=time();
		        $res['customer_id']=time();
		        $b =  $this->create_auth_subscription($res,$ins);
		        $c = $this->create_auth_transaction($res,$ins);
		        if($res['profileid']!='' && $b['subs_status']=="Success" && $c['trans_status']=="Success")
		        {
		        	$usr_data['name']     = $this->session->userdata['admin_name'];
	                $usr_data['email']    = $this->session->userdata['email'];
	                $usr_data['role']	  = 2;
	                $usr_data['password'] = md5($this->session->userdata['password']);
	                $usr_data['created_date']  =  date("Y-m-d H:i:s");
					$usr_data['is_active']  = 1;
					$usr_data['language']  = 1;
					$usr_data['created_id']  = 8;
				 	$folder = $usr_data['name'];
				 	$dir = '../../admin/views/repository/files/'.$folder;
				 	if(!file_exists($dir))	
		        		mkdir($dir, 0755,true);
                	$userid = $this->login_model->insert("users",$usr_data);
                	if(!empty($add_user)) 
	                {
	                    //$this->service_message->set_flash_message('signup_success');
	                }    
	                $url = base_url()."admin/client";
	               /* $msg = "Your Backend Login link as client ".$url." <br>
	                	<b>Client Username</b>: ".$this->session->userdata['name']."<br>
						<b>Password</b>: ".$this->session->userdata['password']."<br><br>
						Thanks you..";                
	                $this->email->from('admin@gotsafety.com', 'Gotsafety');
					$this->email->to( $usr_data['email'] );
					$this->email->subject('Signup Successfully');
					$this->email->message($msg);
					$this->email->send();*/
		            //Load Models
		            $this->load->model('payment_model');
		            //Create Subscription Table Fields 
		            $ins_data['userid'] = $userid;
		            $ins_data['subscription_id'] = $b['subs_id'];
		            $ins_data['name'] = $ins['description'];
		            $ins_data['startDate'] = date("Y-m-d");
		            $ins_data['amount'] = $ins['amount'];
		            $ins_data['invoice_no'] = $b['invoice_no'];
		            $ins_data['description'] = $ins['description'];
		            $ins_data['sub_status'] = 0;
		            $ins_data['created_date'] = date('Y-m-d H:i:s');
		            $ins_data['last_updated'] = date('Y-m-d H:i:s');
		            $this->payment_model->insert("authorize_subscription",$ins_data);
		            //Create Customer Profile Table Fields
                    $up_data['userid'] = $userid;
		            $up_data['customerid'] = $res['customer_id'];
		            $up_data['profileid'] = $res['profileid'];
		            $up_data['payment_pro_id'] = $res['paymentprofileid'];
		            $up_data['ship_pro_id'] = $res['shippingprofileid'];
		            $this->payment_model->insert("client_subscription",$up_data);
		            //Create Auth Transaction Table Fields
		            $trans_data['userid']= $userid;
		            $trans_data['description']= $ins['description'];
		            $trans_data['amount']=  $ins['amount'];
		            $trans_data['trans_id']= $c['transid'];
		            $trans_data['status']= $c['trans_status'];
		            $trans_data['payment_mode']= "Authorize";
		            $trans_data['date_inserted']= date("Y-m-d H:i:s");
		            $this->payment_model->insert("payments",$trans_data);
		            $this->session->set_flashdata("signup_succ","User Profile has been created sucessfully.",TRUE);
		            $this->data['form_data'] = array("name" => "", "email" => "", "password" => "", "con_password" => "");        
					redirect("login/signup");
		        }
		        else
		        {
		            $this->session->set_flashdata("signup_fail","Something went wrong. Please try again later.",TRUE);
		         	$this->data['form_data'] = array("name" => "", "email" => "", "password" => "", "con_password" => "");        
					redirect("login/signup");
		        }
	        }	
	        else
	        {
	        	$this->layout->view('payment','frontend');
	        }
     	}
    }


    function create_auth_transaction($res,$ins)
    {
        $this->load->library('authorize_net');
        $auth_net = array(
            'x_card_num'            => $ins['c_number'], // Visa
            'x_exp_date'            =>  $ins['exp_month'].'/'.$ins['exp_year'],
            'x_card_code'           =>  $ins['cvv'],
            'x_description'         =>  $ins['description'],
            'x_amount'              =>  $ins['amount'],
            'x_first_name'          =>  $ins['fname'],
            'x_last_name'           =>  $ins['lname'],
            'x_address'             =>  $ins['address'],
            'x_city'                =>  $ins['city'],
            'x_state'               =>  $ins['state'],
            'x_zip'                 =>  $ins['zipcode'],
            'x_country'             =>  $ins['country'],
            'x_phone'               =>  $ins['phone'],
            'x_fax'                 =>  $ins['fax'],
            'x_email'               =>  $ins['email'],
            'x_customer_ip'         =>  $this->input->ip_address(),
            'x_cust_id'             =>  $res['customer_id']
            );
        $this->authorize_net->setData($auth_net);

        // Try to AUTH_CAPTURE
        if( $this->authorize_net->authorizeAndCapture() )
        {
           $this->data['trans_status'] = "Success";
           $this->data['transid'] = $this->authorize_net->getTransactionId();
           $this->data['approval'] = $this->authorize_net->getApprovalCode();
        }
        else
        {
            $this->data['trans_status']= "Fail";
            $this->data['error'] = $this->authorize_net->getError() . '</p>';
        }
        return $this->data;
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
    function create_auth_cust_profile($post)
    {
        $this->data['cus_id'] = time();
        $this->load->library('authorizecimlib');
        // Create the basic profile
        $this->authorizecimlib->set_data('merchantCustomerId',  $this->data['cus_id']);
        $this->authorizecimlib->set_data('email', $post['email'] );
        $this->authorizecimlib->set_data('description', $post['description']);

        $this->data['profileid'] = $this->authorizecimlib->create_customer_profile();

        // Create the Payment Profile
        $this->authorizecimlib->set_data('customerProfileId', $this->data['profileid']);
        $this->authorizecimlib->set_data('billToFirstName', $post['fname']);
        $this->authorizecimlib->set_data('billToLastName', $post['lname']);
        $this->authorizecimlib->set_data('billToAddress', $post['address']);
        $this->authorizecimlib->set_data('billToCity',$post['city']);
        $this->authorizecimlib->set_data('billToState',$post['state']);
        $this->authorizecimlib->set_data('billToZip',$post['zipcode']);
        $this->authorizecimlib->set_data('billToCountry',$post['country']);
        $this->authorizecimlib->set_data('billToPhoneNumber', $post['phone']);
        $this->authorizecimlib->set_data('billToFaxNumber',$post['fax']);
        $this->authorizecimlib->set_data('cardNumber', $post['c_number']);
        $this->authorizecimlib->set_data('expirationDate', $post['exp_month'].'-'.$post['exp_year']);
        $this->data['paymentprofileid'] = $this->authorizecimlib->create_customer_payment_profile();
        // Create the shipping profile
        $this->authorizecimlib->set_data('customerProfileId', $this->data['profileid']);
        $this->authorizecimlib->set_data('shipToFirstName', $post['fname']);
        $this->authorizecimlib->set_data('shipToLastName',$post['lname'] );
        $this->authorizecimlib->set_data('shipToAddress', $post['address']);
        $this->authorizecimlib->set_data('shipToCity', $post['city']);
        $this->authorizecimlib->set_data('shipToState', $post['state']);
        $this->authorizecimlib->set_data('shipToZip', $post['zipcode']);
        $this->authorizecimlib->set_data('shipToCountry', $post['country']);
        $this->authorizecimlib->set_data('shipToPhoneNumber', $post['phone']);
        $this->authorizecimlib->set_data('shipToFaxNumber', $post['fax']);
        $this->data['shippingprofileid'] = $this->authorizecimlib->create_customer_shipping_profile();
        $this->authorizecimlib->set_data('merchantCustomerId', $this->data['cus_id']);
        $this->authorizecimlib->set_data('customerProfileId', $this->data['profileid']);
        $this->authorizecimlib->set_data('customerPaymentProfileId', $this->data['paymentprofileid']);
        $this->authorizecimlib->set_data('customerShippingAddressId', $this->data['shippingprofileid']);
        return $this->data;    	
    }
    


	function name_unique_check($name,$edit_id)
     {
        
        $get_data = $this->user_model->check_exists("users",array("name" => $name));
       
       
        if(count($get_data) >0) {
      
          $this->form_validation->set_message('name_unique_check', 'Username already exists');
          return FALSE;
        }
        
        return TRUE;
    } 
    
    
     function email_unique_check($email,$edit_id)
     {
        
        $get_data = $this->user_model->check_exists("users",array("email" => $email));
       
       
        if(count($get_data) >0) {
      
          $this->form_validation->set_message('email_unique_check', 'Email already exists');
          return FALSE;
        }
        
        return TRUE;
    } 

     function checkwebsiteurl($string_url)
    {
        $url = $this->input->post("company_url");
        if($url!='')
        {
            $reg_exp = "@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i";
            if(preg_match($reg_exp, $string_url) == TRUE){
             return TRUE;
            }
            else{
             $this->form_validation->set_message('checkwebsiteurl', 'URL is invalid format');
             return FALSE;
            }
        }
    } 
  
   public function coupon_apply()
   {
    $code = $this->input->post('code');
    $plan = $this->input->post('plan');
    coupon_apply($code,$plan);
   }
   public function del_coupon()
   {
      $this->session->unset_userdata('coupon_details');
      $this->session->userdata['signup_data']['promo_code'] ="";
      //$id = $this->input->post('id');
      //$this->login_model->delete("coupon_applied",array("id"=>$id));
   }
   
	
}
?>

