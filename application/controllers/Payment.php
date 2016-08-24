<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Payment extends App_Controller 
{
	protected $_auth_validation_rules =    array (
    array('field'=>'fname','label'=>'First Name','rules'=>'trim|required|min_length[4]|alpha'),		
    array('field' => 'lname', 'label' => 'Last Name', 'rules' => 'trim|required|min_length[2]|alpha'),
    array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
    array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required|alpha|callback_alpha_dash_space'),
    array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required|alpha'),
    array('field' => 'zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required|numeric|max_length[5]'),
    array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required|alpha'),
    array('field' => 'c_number', 'label' => 'Card Number', 'rules' => 'trim|required|numeric|max_length[16]|min_length[16]'),
    array('field' => 'cvv', 'label' => 'CVV', 'rules' => 'trim|required|numeric|max_length[3]|min_length[3]'),
    array('field'=>'exp_month', 'label' => 'Expiration Month', 'rules' => 'trim|required'),
    array('field' => 'exp_year', 'label' => 'Expiration Year', 'rules' => 'trim|required'),
    array('field'=>'email', 'label' => 'Email-ID', 'rules' => 'trim|required|valid_email'),
    array('field' => 'phone', 'label' => 'Phone Number', 'rules' => 'trim|required|numeric|max_length[12]|min_length[6]')
    //array('field' => 'fax', 'label' => 'Fax Number', 'rules' => 'trim|required|numeric|max_length[10]|min_length[6]')
    );
    
    protected $_paypal_validation_rules =    array (
    array('field'=>'firstname','label'=>'First Name','rules'=>'trim|required|alpha'),		
    array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim|required|alpha'),
    array('field' => 'pay_address', 'label' => 'Address', 'rules' => 'trim|required'),
    array('field' => 'pay_city', 'label' => 'City', 'rules' => 'trim|required|alpha|callback_alpha_dash_space'),
    array('field' => 'pay_state', 'label' => 'State', 'rules' => 'trim|required|alpha'),
    array('field' => 'pay_zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required|numeric|max_length[5]'),
    array('field' => 'pay_country', 'label' => 'Country', 'rules' => 'trim|required|alpha'),
    array('field' => 'pay_email', 'label' => 'Email-ID', 'rules' => 'trim|required|valid_email'),
    array('field' => 'pay_phone', 'label' => 'Phone Number', 'rules' => 'trim|required|numeric|max_length[12]|min_length[6]')
    //array('field' => 'pay_fax', 'label' => 'Fax Number', 'rules' => 'trim|required|numeric|min_length[6]')
);
                
    protected $fname         = '';
    protected $lname         = '';
    protected $address       = '';
    protected $city          = '';
    protected $state         = '';
    protected $zipcode       = '';
    protected $country       = ''; 
    protected $u_email       = '';
    protected $phone         = '';
    protected $fax           = ''; 
    protected $admin_user_id = '';
     
     
     protected $payment_method;
     
     
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
        
       	$this->load->library('authorize_net',$config1);
       	$this->load->library('authorize_arb',$config1);
		// Show Errors

		if($config['Sandbox'])
		{
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}
        
        
        $this->load->model(array('payment_model','login_model','user_model'));
        $this->load->library('Paypal_pro',$config);
        
        $this->payment_method = '';
     }           
                
	 public function index()
     {
     	$this->layout->view('payment/index','frontend');
     }
     
       
   function gettranslist()
   {
        $this->authorize_arb->startData('batch');
        // Locally-defined reference ID (can't be longer than 20 chars)
        $refId = substr(md5( microtime() . 'ref' ), 0, 20);
        $firstSettlementDate = date("Y-m-01")."T00:00:00";
        $lastSettlementDate =  date("Y-m-31")."T00:00:00";
        $this->authorize_arb->addData('refId', $refId);
        $this->authorize_arb->addData('firstSettlementDate',$firstSettlementDate);
        $this->authorize_arb->addData('lastSettlementDate',$lastSettlementDate);
        $this->authorize_arb->send();
       // echo "<pre>";
      //  print_r($this->authorize_arb->getName());
      //  exit;
        /*foreach ($this->authorize_arb->getName() as $value) 
        {
            foreach($this->authorize_arb->getBatchId()->batch as $batch)
            {
                echo $batch->batchId."<br>---Start---<br><br>";
                $this->authorize_arb->startData('trans');
                $this->authorize_arb->addData('refId', $refId);
                $this->authorize_arb->addData('batchId',$batch->batchId);
                $this->authorize_arb->send();
                foreach ($this->authorize_arb->getTransList() as $trans) 
                {
                    if($trans->subscription->id!='')
                    echo $trans->subscription->id."<br>";
                }
                echo "<br><br>---End---<br><br>";
            }
        }
        //echo "<pre>";print_r($this->authorize_arb->getName());
        exit; */
   }
   
     public function check()
     {
     	if($_POST){
     	  
     		$this->form_validation->set_rules($this->_auth_validation_rules);
            
     		if($this->form_validation->run()){
	                        
	        }
	        else
	        {
	        	redirect('payment');
	        	//$this->layout->view('payment','frontend');
	        }
     	}
     }
     
     //get authorize form while click the authorize option
     function authorize_form()
     {
       
        if($_POST)
     	{
     		$this->form_validation->set_rules($this->_auth_validation_rules);
     		if($this->form_validation->run())
	        {
				$ins = $this->input->post();
		        $ins['description'] = $this->input->post('plan_name');
		    	$ins['amount'] = $this->input->post('plan_cost');
		        $res['profileid']=uniqid();
		        $res['customer_id']=time();
		        $b =  $this->create_auth_subscription($res,$ins);
                
		        if($res['profileid']!='' && $b['subs_status']=="Success")
                {
                    $userid = $this->user_register();
		        	/*$usr_data1['name']=$this->session->userdata['signup_data']['name'];
	                $usr_data['email']= $this->session->userdata['signup_data']['email'];
	                $usr_data['role']= 2;
	                $usr_data1['password']=md5($this->session->userdata['signup_data']['password']);
	                $usr_data['created_date']  =  date("Y-m-d H:i:s");
					$usr_data['is_active']  = 0;
					$usr_data['language']  = 1;

                    $usr_data['admin_name']  = $this->session->userdata['signup_data']['admin_name'];
                    $usr_data['admin_pwd']  = md5($this->session->userdata['signup_data']['admin_pwd']);
                    $usr_data['company_name']  =$this->session->userdata['signup_data']['company_name'];
                    $usr_data['company_phone_no'] = $this->session->userdata['signup_data']['phone_no'];
                    $usr_data['company_address'] = $this->session->userdata['signup_data']['admin_name']['company_address'];
                    $usr_data['company_url'] = $this->session->userdata['signup_data']['company_url'];
                    $usr_data['main_contact'] = $this->session->userdata['signup_data']['main_contact'];
                    $usr_data['main_contact_no'] = $this->session->userdata['signup_data']['admin_name']['main_contact_no'];
                    $usr_data['main_email_addr'] = $this->session->userdata['signup_data']['admin_name']['email_addr'];
                    $usr_data['main_contact_address'] = $this->session->userdata['signup_data']['main_contact_address'];
                    $usr_data['no_of_employees'] = $this->session->userdata['signup_data']['no_of_employees'];*/
					$this->fname  = $this->input->post('fname');
					$this->lname  = $this->input->post('lname');
					$this->address  = $this->input->post('address');
					$this->city  = $this->input->post('city');
					$this->state  =$this->input->post('state');
					$this->country  = $this->input->post('country');
					$this->zipcode  = $this->input->post('zipcode');
					$this->phone  = $this->input->post('phone');
					$this->fax  = $this->input->post('fax');
				 	/*$folder = $usr_data['name'];
				 	$dir = './admin/views/repository/files/'.$folder;
				 	if(!file_exists($dir))	
		        		mkdir($dir, 0755,true);*/
                	//$up_user = $this->login_model->update("users",$usr_data,array("id"=>$userid));
                 //   $cl_id = $this->login_model->insert("users",$usr_data1);
                	if(!empty($add_user)) 
                    {
	                    //$this->service_message->set_flash_message('signup_success');
	                }    
	              /*   $url = "http://izaapinnovations.com/got_safety/admin/";
                    $msg ="Hi ".ucfirst($this->session->userdata['signup_data']['name']).",\n\tYour payment has been initiated and Authorize,net consume few hours to authenticate(Maximum time : 24 hours). Once payment authenticated we can activate your profile and trigger confirmation mail to you.\n\n";
                    $msg .= "Your Backend Login link as client ".$url." \n\nClient Admin Username: ".$this->session->userdata['signup_data']['name']."\nPassword: ".$this->session->userdata['signup_data']['password']."\n\nThank you.";                     
	                $this->email->from('admin@gotsafety.com', 'Gotsafety');
					$this->email->to( $usr_data['email'] );
					$this->email->subject('Signup Successfully');
					$this->email->message($msg);
					$this->email->send();*/
		            //Load Models
		            $this->load->model('payment_model');
		            //Create Subscription Table Fields 
		            $ins_data['user_id'] = $this->admin_user_id;
		            $ins_data['profile_id'] = $res['profileid'];
		            $ins_data['plan_id'] = $ins['plan_id'];         
		            $ins_data['customer_id'] = $res['customer_id'];
		            $ins_data['profile_start_date'] = date("Y-m-d");
		            $ins_data['next_billing_date'] = date("Y-m-d",strtotime("+32 days"));
		            $ins_data['subscription_id'] = $b['subs_id'];
		            $ins_data['invoice_no'] = $b['invoice_no'];
					$ins_data['amount'] = $ins['amount'];
		            $ins_data['profile_status'] = "Inactive";
		            $ins_data['payment_status'] = "Completed";
		            $ins_data['last_payment_date'] = date('Y-m-d H:i:s');
		            $ins_data['last_payment_amt'] = $ins['amount'];
		            $ins_data['payment_method'] = "Authorize";
		            $this->payment_model->insert("payment_recurring_profiles",$ins_data);
		            //Create Auth Transaction Table Fields
		            $trans_data['user_id']= $userid;
		            $trans_data['profile_id']= $b['subs_id'];
		            $trans_data['last_payment_amt']=  $ins['amount'];
		            $trans_data['last_payment_date']=  date("Y-m-d H:i:s");
		            $trans_data['created_date']=  date("Y-m-d H:i:s");
		            $trans_data['trans_id']= 0;
		            $trans_data['status']= 'Pending';
		            $trans_data['mode']= "Authorize";
		            $this->payment_model->insert("payment_transaction_history",$trans_data);
                    $coupon = $this->session->userdat('coupon_details');
                   
		            $_SESSION['signup_succ']="User Profile has been created sucessfully.";
		            $this->data['form_data'] = array("name" => "", "email" => "", "password" => "", "con_password" => "");        
					$this->load->view("payment/success");
		        }
		        else if($b['subs_status']=="Fail")
		        {
		            $_SESSION['signup_fail'] = $b['error'];
		         	//$this->data['form_data'] = array("name" => "", "email" => "", "password" => "", "con_password" => "");        
					redirect("cancel");
		        }
	        }
	        else
	        {
	        	$this->layout->view('payment/index','frontend');
	        }
	    }
     }


     function create_auth_transaction($res,$ins)
    {
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
		    'payment' => array(   'creditCard'=>array(
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
                                'city'   => $post['city'],
                                'state'  => $post['state'],
                                'zip'     => $post['zipcode'],
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
     
     
     //paypal set express checkout
     function paypal()
     {
        $this->form_validation->set_rules($this->_paypal_validation_rules);
        
 		if($this->form_validation->run()){
            
            $this->session->set_userdata("bill_addr",$_POST);
            
            $cancelUrl = base_url()."payment/cancel";
            $returnUrl = base_url()."payment/success";
            $ipn_url   = base_url()."payment/notify";
            $plan_details = $this->session->userdata('plan_details');
            if(!empty($this->session->userdata('coupon_details')))
            {
                $p_amt  = $this->session->userdata('coupon_details')['total'];
            }
            else
            {
                $p_amt = $plan_details[0]['plan_amount'];
            }
    		$SECFields    = array(
    							'token' => '', 								
    							'maxamt' => '', 						
    							'returnurl' => $returnUrl, 							
    							'cancelurl' => $cancelUrl, 												 						 			
    							'surveyquestion' => '', 					
    							'surveyenable' => '', 																										
    						 );
    		
    		$Payments = array();
    		$Payment = array(
			'amt' => $p_amt, 							
			'currencycode' => 'USD', 					
			'itemamt' => $p_amt,  						
			'notifyurl' => $ipn_url			
		);
    	
    				
    		$PaymentOrderItems = array();
    		$Item = array(
    					   'name' => ucfirst($plan_details[0]['plan_type']), 								
    					   'desc' => strip_tags($plan_details[0]['plan_desc']), 								
    					   'amt' => $p_amt
                          );
    		array_push($PaymentOrderItems, $Item);
    		
    		
    		$Payment['order_items'] = $PaymentOrderItems;
    		
    		array_push($Payments, $Payment);
    		
    		$BillingAgreements = array();
    		$Item = array(
    					  'l_billingtype' => 'RecurringPayments', 							
    					  'l_billingagreementdescription' => 'SubscriptionPlans', 			  
    					  'l_paymenttype' => 'Any', 												
    					  );
    		array_push($BillingAgreements, $Item);
    		
    		$PayPalRequestData = array(
                						'SECFields' => $SECFields, 
                						'Payments' => $Payments, 
                						'BillingAgreements' => $BillingAgreements
                					  );
    					
    		$PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);
    		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])){
    			$errors = array('Errors'=>$PayPalResult['ERRORS']);
    			$this->load->view('payment/paypal/error',$errors);
    		}
    		else
    		{
                  if(!count($PayPalResult['ERRORS'])) {
                     $PayPalResult['payment_method'] = 'paypal';
                     $this->session->set_userdata("payment_method",$PayPalResult);
                     redirect($PayPalResult['REDIRECTURL']);
                  }
    		 }
       } 
       else
        {
        	$this->layout->view('payment/index','frontend');
        }
   }
     
     //paypal succcess get express checkout details
     function success()
     {
        
        $form = $this->session->userdata("bill_addr");
            
        $this->fname   = $form['firstname'];
        $this->lname   = $form['lastname'];
        $this->u_email = $form['pay_email'];
        $this->address = $form['pay_address'];
        $this->city    = $form['pay_city'];
        $this->state   = $form['pay_state'];
        $this->zipcode = $form['pay_zipcode'];
        $this->country = $form['pay_country'];
        $this->fax     = $form['pay_fax'];
        $this->phone   = $form['pay_phone'];
        
        $payment_session = $this->session->userdata('payment_method');
        $this->payment_method = $payment_session['payment_method'];
        
        if($payment_session['payment_method'] == 'paypal') {
            $token           = (isset($_REQUEST['token']))?$_REQUEST['token']:""; 
    		$PayPalResult    = $this->paypal_pro->GetExpressCheckoutDetails($token);
    		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])){
    			$errors = array('Errors'=>$PayPalResult['ERRORS']);
    			$this->load->view('payment/paypal/error',$errors);
    		}
    		else
    		{
              $this->session->set_userdata("Paypal_express",$PayPalResult);
    		  $this->Do_express_checkout_payment($token);
    		}
        }
     }
     
     
     //payment cancel 
     function cancel()
     {
        $this->layout->add_stylesheets("custom");
        $this->layout->view("payment/cancel");
     }
     	
	function Do_express_checkout_payment($token)
	{
	   
        $ipn_url   = base_url()."payment/notify";
	    $paypal_express = $this->session->userdata('Paypal_express');
        
        $plan_details = $this->session->userdata('plan_details');
        if(!empty($this->session->userdata('coupon_details')))
        {
            $p_amt  = $this->session->userdata('coupon_details')['total'];
        }
        else
        {
            $p_amt = $plan_details[0]['plan_amount'];
        }
        
		$DECPFields = array(
							'token' => $token, 								
							'payerid' => $paypal_express['PAYERID'], 							
							'returnfmfdetails' => '', 										
							'buyermarketingemail' => '', 				 				
						   );
		$Payments = array();
		$Payment  = array(
    						'amt' => $p_amt, 							
    						'currencycode' => 'USD', 					
    						'itemamt' => '', 						  
    						'shippingamt' => '0.00', 					
                            'taxamt' => '0.00', 						 						
    						'notifyurl' => $ipn_url 											 
						);
			
		$PaymentOrderItems = array();
		$Item = array();
		array_push($PaymentOrderItems, $Item);
		
	
		$Payment['order_items'] = $PaymentOrderItems;
		
		
		array_push($Payments, $Payment);
		
		$UserSelectedOptions = array();
									 
		$PayPalRequestData   = array(
        							'DECPFields' => $DECPFields, 
        							'Payments' => $Payments, 
        							'UserSelectedOptions' => $UserSelectedOptions
    						      );
						
		$PayPalResult     = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);
		
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])){
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			$this->load->view('payment/paypal/error',$errors);
		}
		else
		{
		   //payment status
           $paypal_status = array();
		   foreach($PayPalResult['PAYMENTS'] as $pkey => $pvalue) {
		      $paypal_status['payment_status'] = $pvalue['PAYMENTSTATUS'];
              $paypal_status['transaction_id'] = $pvalue['TRANSACTIONID'];
              $paypal_status['amt']            = $pvalue['AMT'];
              $paypal_status['pending_reason'] = $pvalue['PENDINGREASON'];
		   }
		    $this->session->set_userdata("payment_status",$paypal_status);
		    $this->Create_recurring_payments_profile($token,$paypal_express['PAYERID']);
		}
	}
	
    function Create_recurring_payments_profile($token,$payerid)
	{
	   
	    $paypal_token = $this->session->userdata('Paypal_express');
        $plan_details = $this->session->userdata('plan_details');
        if(!empty($this->session->userdata('coupon_details')))
        {
            $p_amt  = $this->session->userdata('coupon_details')['total'];
        }
        else
        {
            $p_amt = $plan_details[0]['plan_amount'];
        }
       
		$CRPPFields      = array('token' => $token);	
		$ProfileDetails  = array('profilestartdate' => date("Y-m-d H:i:s"));			
		$ScheduleDetails = array(
        							'desc' => 'SubscriptionPlans', 								
        							'maxfailedpayments' => '5', 					  
        							'autobilloutamt' => 'AddToNextBilling' 			
					            );	
		$BillingPeriod   = array(
        							'billingperiod' => 'Month', 						
        							'billingfrequency' => '1', 					 
        							'totalbillingcycles' => '12', 				  
        							'amt' => $p_amt, 							 
        							'currencycode' => 'USD', 												
    						     );								
		$PayerInfo      = array(
        							'email' => $this->u_email, 								
        							'payerid' => $payerid, 							
        							'payerstatus' => $paypal_token['PAYERSTATUS']						
						       );
						
		$PayerName      = array(						
    							     'firstname' => $this->fname, 							
    							     'middlename' => '', 						
    							     'lastname' => $this->lname						
						       );
						
		$BillingAddress = array(
    								'street' => $this->address, 					
    								'street2' => '', 						
    								'city' => $this->city, 						
    								'state' => $this->state, 							
    								'countrycode' => 'US', 				
    								'zip' => $this->zipcode, 					
    								'phonenum' => $this->phone				
							   );
						
		$PayPalRequestData = array(
        							'CRPPFields' => $CRPPFields, 
        							'ProfileDetails' => $ProfileDetails, 
        							'ScheduleDetails' => $ScheduleDetails, 
        							'BillingPeriod' => $BillingPeriod, 
        							'PayerInfo' => $PayerInfo, 
        							'PayerName' => $PayerName, 
        							'BillingAddress' => $BillingAddress, 
						         );	
						
		$PayPalResult = $this->paypal_pro->CreateRecurringPaymentsProfile($PayPalRequestData);
		
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])){
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			$this->load->view('payment/paypal/error',$errors);
		}
		else
		{  
           $this->Get_recurring_payments_profile_details($PayPalResult['PROFILEID']);           
		}	
	}
	
	
	function Get_recurring_payments_profile_details($profileid)
	{
		$GRPPDFields       = array('profileid' => $profileid);
		$PayPalRequestData = array('GRPPDFields' => $GRPPDFields);
        
        $plan_details = $this->session->userdata('plan_details');
        if(!empty($this->session->userdata('coupon_details')))
        {
            $p_amt  = $this->session->userdata('coupon_details')['total'];
        }
        else
        {
            $p_amt = $plan_details[0]['plan_amount'];
        }
		$PayPalResult = $this->paypal_pro->GetRecurringPaymentsProfileDetails($PayPalRequestData);
		
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])){
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			$this->load->view('payment/paypal/error',$errors);
		}
		else
		{ 
		  
		   $paymentstatus    = $this->session->userdata("payment_status");
           
           $ins_data = array();
           $ins_data['profile_id']          = $PayPalResult['PROFILEID'];
           $ins_data['profile_status']      = $PayPalResult['STATUS'];
           $ins_data['next_billing_date']   = $PayPalResult['NEXTBILLINGDATE'];
           if(isset($PayPalResult['LASTPAYMENTDATE'])){
             $ins_data['last_payment_date'] = $PayPalResult['LASTPAYMENTDATE'];
             $ins_data['last_payment_amt']  = $PayPalResult['LASTPAYMENTAMT'];
           }
               
           if(isset($paymentstatus['payment_status']) && (($paymentstatus['payment_status'] == 'Completed') || $paymentstatus['payment_status'] == 'Pending')) {
           
               $register_id = $this->user_register();
               
    		   
               $ins_data['user_id']             = $this->admin_user_id;
               $ins_data['plan_id']             = $plan_details[0]['id'];
               $ins_data['profile_start_date']  = $PayPalResult['PROFILESTARTDATE'];
               $ins_data['payment_status']      = "pending";
               $ins_data['pending_reason']      = $paymentstatus['pending_reason'];
               $ins_data['trans_id']            = $paymentstatus['transaction_id'];
               $ins_data['amount']              = $PayPalResult['REGULARAMT'];
               $ins_data['payment_method']      = $this->payment_method;
    		   $this->payment_model->insert("payment_recurring_profiles",$ins_data);
               
               $this->layout->add_stylesheets("custom");
               $this->layout->view("payment/success");
           }
           else
           {
               $this->payment_model->update("payment_recurring_profiles",$ins_data,array("profile_id" => $PayPalResult['PROFILEID']));
               
               //insert payment history
               $payment_history = array();
               $payment_history['profile_id']        = $PayPalResult['PROFILEID'];
               $payment_history['last_payment_date'] = $PayPalResult['LASTPAYMENTDATE'];
               $payment_history['last_payment_amt']  = $PayPalResult['LASTPAYMENTAMT'];
               $this->payment_model->insert("payment_transaction_history",$payment_history);
           }
         
		}	
	}

    function notify()
    {
        if(isset($_POST)) 
        {
            if(isset($_POST['ipn_track_id']) && !empty($_POST['ipn_track_id'])) 
            {
                $payment_status = (isset($_POST['payment_status']))?$_POST['payment_status']:"pending";
                $profile_id     = (isset($_POST['recurring_payment_id']))?$_POST['recurring_payment_id']:"";
                $txn_type       = (isset($_POST['txn_type']))?$_POST['txn_type']:"";
                
                if(!empty($profile_id)){
                    //update initial payment status
                    $this->db->query("update payment_recurring_profiles set payment_status='".$payment_status."' where profile_id='".$profile_id."'");
                    
                    //get user for this profile
                    $user = $this->db->query("select r.user_id,u.email,u.name from payment_recurring_profiles r inner join users u on u.id=r.user_id where r.profile_id='".$profile_id."'")->row_array();
                    
                    //update user profile active
                    $this->db->query("update users set is_active=1 where id='".$user['user_id']."'");
                    $ipn_data = json_encode($_POST);
                    $this->db->query("update payment_transaction_history set txn_type='".$txn_type."', paypal_ipn='".$ipn_data."' where profile_id='".$profile_id."'");
                    
                    //send mail to user for active profile notification
                    $msg  = "Hi".ucfirst($user['name']).",";
                    $msg .= "<br /> <br />";
                    $msg .= "Your Profile has been  Activated successfully. now you can access your plans in <a href='".site_url()."'>Got Safety</a>";
                    $this->user_email($user['email'],'Profile Activation',$msg);
                } 
            }
        }
    }
    function NotifyURLForAuthourize()
    {
        if($_POST)
        {
            $response = json_encode($_POST);
            $sub_id = $_POST['x_subscription_id'];
            $status = $_POST['x_response_reason_text'];
            $up_data['trans_id'] = $_POST['x_trans_id'];
            $up_data['paypal_ipn'] = $response;
            $user = $this->db->query("select r.user_id,u.email,u.name from payment_recurring_profiles r inner join users u on u.id=r.user_id where r.subscription_id='".$sub_id."'")->row_array();
            if($_POST['x_response_code'] == 1)
            {
               $up_data['status'] = $status;
               $up_data1['is_active'] = 1;
               $subject = "Your Profile has been activated.";
               $msg  = "Hi".ucfirst($user['name']).",\n\n";
               $msg .= "Your Profile has been  Activated successfully. now you can access your plans in <a href='".site_url()."'>Got Safety</a>";
            }
            elseif($_POST['x_response_code'] == 2)
            {
                $up_data['status'] = $status;
                $up_data1['is_active'] = 0;
                $msg  = "Hi".ucfirst($user['name']).",\n\n";
                $msg .= "Your Profile has not activated due to ".strttolower($status).". Please try again.";
                $subject = "Your Profile has not activated.";
            }
            $this->user_model->update("payment_transaction_history",$up_data,array("subscription_id"=>$sub_id));
            $this->user_model->update("users",$up_data1,array("id"=>$user['user_id']));
            $this->user_email($user['email'],$subject,$msg);
        }
    }
    
    
   function user_register()
   {
       $form = $this->session->userdata("signup_data");
       $coupon = $this->session->userdata("coupon_details");
        
        $get_plan=$this->user_model->get_plans("plan",array("id" => $form['plan_type']));

        
        $ins_data = array();
        $ins_data['name']                 = $form['admin_name'];
        $ins_data['password']             = md5($form['admin_pwd']);
        $ins_data['no_of_employees']      = $form['no_of_employees'];
        $ins_data['email']                = $form['email'];

        $ins_data['fname']  = $this->fname;
        $ins_data['lname']  = $this->lname;
        $ins_data['address']= $this->address;
        $ins_data['state']  = $this->state;
        $ins_data['city']   = $this->city;
        $ins_data['zipcode']= $this->zipcode;
        $ins_data['fax']    = $this->fax;
        $ins_data['phone']  = $this->phone;


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
        
        
        $ins_data['employee_limit']       = $get_plan[0]['emp_limit'];
        $ins_data['plan_type']            = $form['plan_type'];
        $ins_data['is_active']            = 0;
        $ins_data['role']                 = 2;
        $ins_data['language']             = 1;
        $ins_data['created_date']         = date("Y-m-d H:i:s");
        $ins_data['created_id']           = 0;
       
       
	 	$folder                    = $form['admin_name'];	
        
        $path   = '../../admin/views/repository/files/'.$folder;
        
        if(!file_exists($path))
         {

        
            mkdir('./admin/views/repository/files/'.$folder, 0755,true);
                    
            $this->admin_user_id = $this->login_model->insert("users",$ins_data);  
            
            $user_data = array();

            $user_data['name']          = $form['name'];
            $user_data['password']      = md5($form['password']);
            $user_data['created_date']  = date("Y-m-d H:i:s");
    		$user_data['is_active']     = 0;
            $user_data['role']          = 3;
            $user_data['created_id']    = $this->admin_user_id;

            if($coupon)
            {
             $cp_data['user_id'] = $this->admin_user_id;
             $cp_data['code'] = $coupon['code'];
             $cp_data['coupon_id'] = $coupon['coupon_id'];
             $cp_data['plan_id'] = $form['plan_type'];
             $cp_data['order_id'] = 0;
             $cp_data['org_amount'] = $coupon['plan_amount'];
             $cp_data['discount_amount'] = $coupon['discount_amount'];
             $cp_data['total'] = $coupon['total'];
             $coupon_id = $this->login_model->insert("coupon_applied",$cp_data); 
            }
             
            $register_user_id = $this->login_model->insert("users",$user_data); 
             
            $furl  = base_url();
            
            $aurl  = base_url()."admin/client";
            
            $msg   = "Your payment has been initiated and ".ucfirst($this->payment_method)." consume few hours to authenticate(Maximum time : 24 hours). Once payment authenticated we can activate your profile and trigger confirmation mail to you.\n\n";
            $msg  .= " Your Frontend Login link as client ".$furl." <br>
            	     <b>Username</b>: ".$user_data['name']."<br>
        		     <b>Password</b>: ".$user_data['password']."<br><br>
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
        	$this->email->subject("Signup Successfully");
        	$this->email->message($msg);
        	$this->email->send();
            
            return $this->admin_user_id;
             
      }  
   } 
  
  function user_email($email,$subject,$message)
  {
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = "html";
        
        $this->email->from('admin@gotsafety.com', 'Gotsafety');
    	$this->email->to($email);
    	$this->email->subject($subject);
    	$this->email->message($message);
    	$this->email->send();
        
        return true;
         

  }  

  function alpha_dash_space($str)
  {
    return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
  } 
}
?>