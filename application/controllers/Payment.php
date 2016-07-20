<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Payment extends App_Controller 
{
	protected $_auth_validation_rules =    array (
    array('field'=>'fname','label'=>'First Name','rules'=>'trim|required|min_length[4]|alpha'),		
    array('field' => 'lname', 'label' => 'Last Name', 'rules' => 'trim|required|min_length[2]|alpha'),
    array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
    array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required|alpha'),
    array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required|alpha'),
    array('field' => 'zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required|numeric|max_length[6]|min_length[6]'),
    array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required|alpha'),
    array('field' => 'c_number', 'label' => 'Card Number', 'rules' => 'trim|required|numeric|max_length[16]|min_length[16]'),
    array('field' => 'cvv', 'label' => 'CVV', 'rules' => 'trim|required|numeric|max_length[3]|min_length[3]'),
    array('field'=>'exp_month', 'label' => 'Expiration Month', 'rules' => 'trim|required'),
    array('field' => 'exp_year', 'label' => 'Expiration Year', 'rules' => 'trim|required'),
    array('field'=>'email', 'label' => 'Email-ID', 'rules' => 'trim|required|valid_email'),
    array('field' => 'phone', 'label' => 'Phone Number', 'rules' => 'trim|required|numeric|max_length[12]|min_length[6]'),
    array('field' => 'fax', 'label' => 'Fax Number', 'rules' => 'trim|required|numeric|max_length[10]|min_length[6]')
				);
                
     
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
        $this->load->library('paypal_lib');
        $this->payment_method = '';
     }           
                
	 public function index()
     {
     	$this->layout->view('payment/index','frontend');
     }
     
     
     public function check()
     {
     	if($_POST){
     	  
     		$this->form_validation->set_rules($this->_auth_validation_rules);
            
     		if($this->form_validation->run())
     		{
	                        
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
		       	/*$a = $this->create_auth_cust_profile( $ins );
		      	
		      	$res['profileid'] = $a['profileid'];
		        $res['paymentprofileid'] = $a['paymentprofileid'];
		        $res['shippingprofileid'] = $a['shippingprofileid'];*/
		        $res['profileid']=uniqid();
		        //$res['paymentprofileid']=time();
		        //$res['shippingprofileid']=time();
		        $res['customer_id']=time();
		        $b =  $this->create_auth_subscription($res,$ins);
		        //$c = $this->create_auth_transaction($res,$ins);
		        if($res['profileid']!='' && $b['subs_status']=="Success")
		        {
		        	$usr_data['name']=$this->session->userdata['signup_data']['name'];
	                $usr_data['email']= $this->session->userdata['signup_data']['email'];
	                $usr_data['role']= 2;
	                $usr_data['password']=md5($this->session->userdata['signup_data']['password']);
	                $usr_data['created_date']  =  date("Y-m-d H:i:s");
					$usr_data['is_active']  = 0;
					$usr_data['language']  = 1;
					$usr_data['fname']  = $this->input->post('fname');
					$usr_data['lname']  = $this->input->post('lname');
					$usr_data['address']  = $this->input->post('address');
					$usr_data['city']  = $this->input->post('city');
					$usr_data['state']  =$this->input->post('state');
					$usr_data['country']  = $this->input->post('country');
					$usr_data['zipcode']  = $this->input->post('zipcode');
					$usr_data['phone']  = $this->input->post('phone');
					$usr_data['fax']  = $this->input->post('fax');
				 	$folder = $usr_data['name'];
				 	$dir = './admin/views/repository/files/'.$folder;
				 	if(!file_exists($dir))	
		        		mkdir($dir, 0755,true);
                	$userid = $this->login_model->insert("users",$usr_data);
                	if(!empty($add_user)) 
	                {
	                    //$this->service_message->set_flash_message('signup_success');
	                }    
	                $url = "http://izaapinnovations.com/got_safety/admin/";
	                $msg = "Your Backend Login link as client ".$url." <br>
	                	<b>Client Username</b>: ".$this->session->userdata['name']."<br>
						<b>Password</b>: ".$this->session->userdata['password']."<br><br>
						Thanks you..";                
	                $this->email->from('admin@gotsafety.com', 'Gotsafety');
					$this->email->to( $usr_data['email'] );
					$this->email->subject('Signup Successfully');
					$this->email->message($msg);
					$this->email->send();
		            //Load Models
		            $this->load->model('payment_model');
		            //Create Subscription Table Fields 
		            $ins_data['user_id'] = $userid;
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
		            $_SESSION['signup_succ']="User Profile has been created sucessfully.";
		            $this->data['form_data'] = array("name" => "", "email" => "", "password" => "", "con_password" => "");        
					redirect("login/signup");
		        }
		        else if($b['subs_status']=="Fail")
		        {
		            $_SESSION['signup_fail'] = $b['error'];
		         	//$this->data['form_data'] = array("name" => "", "email" => "", "password" => "", "con_password" => "");        
					redirect("payment");
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
     
     
     //paypal set express checkout
     function paypal()
     {
        $cancelUrl = base_url()."payment/cancel";
        $returnUrl = base_url()."payment/success";
        $ipn_url   = base_url()."payment/notify";
        
        $plan_details = $this->session->userdata('plan_details');
        //$plan_details = $plan_details['plan_details'];
        
		$SECFields = array(
							'token' => '', 								
							'maxamt' => '', 						
							'returnurl' => $returnUrl, 							
							'cancelurl' => $cancelUrl, 							
							'callback' => '', 						
							'callbacktimeout' => '', 					
							'callbackversion' => '', 												
							'reqconfirmshipping' => '', 				
							'noshipping' => '', 						
							'allownote' => '', 							
							'addroverride' => '', 						
							'localecode' => '', 						
							'pagestyle' => '', 							  
							'hdrimg' => '', 							
							'hdrbordercolor' => '', 					  
							'hdrbackcolor' => '', 						  
							'payflowcolor' => '', 						
							'skipdetails' => '', 						
							'email' => '', 								
							'solutiontype' => '', 						
							'landingpage' => '', 						
							'channeltype' => '', 						
							'giropaysuccessurl' => '', 					
							'giropaycancelurl' => '', 					
							'banktxnpendingurl' => '',  				
							'brandname' => '', 							
							'customerservicenumber' => '', 				
							'giftmessageenable' => '', 					
							'giftreceiptenable' => '', 					
							'giftwrapenable' => '', 					
							'giftwrapname' => '', 						
							'giftwrapamount' => '', 					
							'buyeremailoptionenable' => '', 			
							'surveyquestion' => '', 					
							'surveyenable' => '', 						
							'totaltype' => '', 							
							'notetobuyer' => '', 													
							'buyerid' => '', 							
							'buyerusername' => '', 						
							'buyerregistrationdate' => '',  			
							'allowpushfunding' => ''								
						);
		
		$SurveyChoices = array('Choice 1', 'Choice2', 'Choice3', 'etc');
		
		$Payments = array();
		$Payment = array(
						'amt' => $plan_details['plan_amount'], 							
						'currencycode' => 'USD', 					
						'itemamt' => $plan_details['plan_amount'], 						  
						'shippingamt' => '', 					
						'shipdiscamt' => '', 				   
						'insuranceoptionoffered' => '', 		
						'handlingamt' => '', 					
						'taxamt' => '', 						 
						'desc' => '', 							
						'custom' => '', 						
						'invnum' => '', 						
						'notifyurl' => $ipn_url, 						
						'shiptoname' => '', 					
						'shiptostreet' => '', 					
						'shiptostreet2' => '', 					
						'shiptocity' => '', 					
						'shiptostate' => '', 					
						'shiptozip' => '', 						
						'shiptocountrycode' => '', 				
						'shiptophonenum' => '',  				
						'notetext' => '', 						  
						'allowedpaymentmethod' => '', 			
						'allowpushfunding' => '', 				
						'paymentaction' => 'Sale', 					 
						'paymentrequestid' => '',  				 
						'sellerid' => '', 						
						'sellerusername' => '', 				
						'sellerpaypalaccountid' => ''			
						);
	
				
		$PaymentOrderItems = array();
		$Item = array(
					'name' => ucfirst($plan_details['plan_type']), 								
					'desc' => strip_tags($plan_details['plan_desc']), 								
					'amt' => $plan_details['plan_amount'], 								
					'number' => '', 							
					'qty' => '', 								
					'taxamt' => '', 							
					'itemurl' => '', 							
					'itemweightvalue' => '', 					
					'itemweightunit' => '', 					
					'itemheightvalue' => '', 					
					'itemheightunit' => '', 					
					'itemwidthvalue' => '', 					
					'itemwidthunit' => '', 						
					'itemlengthvalue' => '', 					
					'itemlengthunit' => '',  					
					'itemurl' => '', 							
					'itemcategory' => '', 						
					'ebayitemnumber' => '', 					  
					'ebayitemauctiontxnid' => '', 				  
					'ebayitemorderid' => '',  					
					'ebayitemcartid' => ''						
					);
		array_push($PaymentOrderItems, $Item);
		
		
		$Payment['order_items'] = $PaymentOrderItems;
		
		array_push($Payments, $Payment);
		
		$BuyerDetails = array(  'buyerid' => '', 			
								'buyerusername' => '', 			
								'buyerregistrationdate' => ''	
								);
								
		$ShippingOptions = array();
		$Option = array(
						'l_shippingoptionisdefault' => '', 				
						'l_shippingoptionname' => '', 					
						'l_shippingoptionlabel' => '', 					
						'l_shippingoptionamount' => '' 					  
						);
		array_push($ShippingOptions, $Option);
			
		
		$BillingAgreements = array();
		$Item = array(
					  'l_billingtype' => 'RecurringPayments', 							
					  'l_billingagreementdescription' => 'SubscriptionPlans', 			  
					  'l_paymenttype' => 'Any', 							
					 // 'l_billingagreementcustom' => ''					
					  );
		array_push($BillingAgreements, $Item);
		
		$PayPalRequestData = array(
            						'SECFields' => $SECFields, 
            						'SurveyChoices' => $SurveyChoices, 
            						'Payments' => $Payments, 
            						'BuyerDetails' => $BuyerDetails, 
            						'ShippingOptions' => $ShippingOptions, 
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
     
     //paypal succcess get express checkout details
     function success()
     {
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
        
     }
     	
	function Do_express_checkout_payment($token)
	{
	   
        $ipn_url   = base_url()."payment/notify";
	    $paypal_express = $this->session->userdata('Paypal_express');
        
        $plan_details = $this->session->userdata('plan_details');
        
		$DECPFields = array(
							'token' => $token, 								
							'payerid' => $paypal_express['PAYERID'], 							
							'returnfmfdetails' => '', 					
							'giftmessage' => '', 						
							'giftreceiptenable' => '', 					
							'giftwrapname' => '', 						
							'giftwrapamount' => '', 					
							'buyermarketingemail' => '', 				
							'surveyquestion' => '', 					
							'surveychoiceselected' => '',  				
							'allowedpaymentmethod' => '' 				
						);
						
		
		$Payments = array();
		$Payment  = array(
						'amt' => $plan_details['plan_amount'], 							
						'currencycode' => 'USD', 					
						'itemamt' => '', 						  
						'shippingamt' => '0.00', 					
						'shipdiscamt' => '', 					
						'insuranceoptionoffered' => '', 		
						'handlingamt' => '', 					
						'taxamt' => '0.00', 						 
						'desc' => '', 							
						'custom' => '', 						
						'invnum' => '', 						
						'notifyurl' => $ipn_url, 						
						'shiptoname' => '', 					
						'shiptostreet' => '', 					
						'shiptostreet2' => '', 					
						'shiptocity' => '', 					
						'shiptostate' => '', 					
						'shiptozip' => '', 						
						'shiptocountrycode' => '', 				
						'shiptophonenum' => '',  				
						'notetext' => '', 						  
						'allowedpaymentmethod' => '', 			
						'paymentaction' => '', 					 
						'paymentrequestid' => '',  				 
						'sellerid' => '', 						
						'sellerusername' => '', 				
						'sellerregistrationdate' => '', 		
						'softdescriptor' => '', 				
						'transactionid' => ''					 
						);
			
		$PaymentOrderItems = array();
		$Item = array(
					'name' => '', 								
					'desc' => '', 								
					'amt' => '', 								
					'number' => '', 							
					'qty' => '', 								
					'taxamt' => '', 						
					'itemurl' => '', 							
					'itemweightvalue' => '', 					
					'itemweightunit' => '', 					
					'itemheightvalue' => '', 				
					'itemheightunit' => '', 				
					'itemwidthvalue' => '', 					
					'itemwidthunit' => '', 					
					'itemlengthvalue' => '', 					
					'itemlengthunit' => '',  				
					'itemurl' => '', 							
					'itemcategory' => '', 					
					'ebayitemnumber' => '', 					
					'ebayitemauctiontxnid' => '', 			
					'ebayitemorderid' => '',  				
					'ebayitemcartid' => ''					
					);
		array_push($PaymentOrderItems, $Item);
		
	
		$Payment['order_items'] = $PaymentOrderItems;
		
		
		array_push($Payments, $Payment);
		
		$UserSelectedOptions = array(
									 'shippingcalculationmode' => '', 	
									 'insuranceoptionselected' => '', 	
									 'shippingoptionisdefault' => '', 	  
									 'shippingoptionamount' => '', 		
									 'shippingoptionname' => '', 		
									 );
									 
		$PayPalRequestData = array(
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
       
		$CRPPFields   = array('token' => $token);
						
		$ProfileDetails = array(
        							'subscribername' => '', 					
        							'profilestartdate' => date("Y-m-d H:i:s"), 					
        							'profilereference' => '' 					
						        );
						
		$ScheduleDetails = array(
        							'desc' => 'SubscriptionPlans', 								
        							'maxfailedpayments' => '5', 					  
        							'autobilloutamt' => 'AddToNextBilling' 			
					            );
						
		$BillingPeriod = array(
    							'trialbillingperiod' => '', 
    							'trialbillingfrequency' => '', 
    							'trialtotalbillingcycles' => '', 
    							'trialamt' => '', 
    							'billingperiod' => 'Month', 						
    							'billingfrequency' => '1', 					 
    							'totalbillingcycles' => '12', 				  
    							'amt' => $plan_details['plan_amount'], 							 
    							'currencycode' => 'USD', 					
    							'shippingamt' => '0', 					
    							'taxamt' => '0' 							
						     );
						
		$ActivationDetails = array(
        							'initamt' => '', 						
        							'failedinitamtaction' => '', 			
						         );
						
		$CCDetails = array(
							'creditcardtype' => '', 					
							'acct' => '', 								  
							'expdate' => '', 							
							'cvv2' => '', 								
							'startdate' => '', 							
							'issuenumber' => ''							
						);
						
		$PayerInfo = array(
							'email' => $paypal_token['EMAIL'], 								
							'payerid' => $payerid, 							
							'payerstatus' => $paypal_token['PAYERSTATUS'], 						
							'business' => '' 						
						  );
						
		$PayerName = array(
							'salutation' => '', 						
							'firstname' => $paypal_token['FIRSTNAME'], 							
							'middlename' => '', 						
							'lastname' => $paypal_token['LASTNAME'], 							
							'suffix' => ''							
						   );
						
		$BillingAddress = array(
								'street' => 'West Street', 					
								'street2' => '', 						
								'city' => 'Florida', 						
								'state' => 'Florida', 							
								'countrycode' => 'US', 				
								'zip' => '32005', 					
								'phonenum' => '' 				
							  );
							
		$ShippingAddress = array(
								'shiptoname' => '', 					
								'shiptostreet' => '', 					
								'shiptostreet2' => '', 					
								'shiptocity' => '', 					
								'shiptostate' => '', 					
								'shiptozip' => '', 						
								'shiptocountry' => '', 				    
								'shiptophonenum' => ''					
								);
								
		$PayPalRequestData = array(
        							'CRPPFields' => $CRPPFields, 
        							'ProfileDetails' => $ProfileDetails, 
        							'ScheduleDetails' => $ScheduleDetails, 
        							'BillingPeriod' => $BillingPeriod, 
        							'ActivationDetails' => $ActivationDetails, 
        							'CCDetails' => $CCDetails, 
        							'PayerInfo' => $PayerInfo, 
        							'PayerName' => $PayerName, 
        							'BillingAddress' => $BillingAddress, 
        							'ShippingAddress' => $ShippingAddress
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
		$GRPPDFields = array('profileid' => $profileid);
					   
		$PayPalRequestData = array('GRPPDFields' => $GRPPDFields);
        
         $plan_details = $this->session->userdata('plan_details');
		
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
           
               //$register_id = $this->user_register();
    		   
               $ins_data['user_id']             = $plan_details['user_id'];
               $ins_data['plan_id']             = $plan_details['id'];
               $ins_data['profile_start_date']  = $PayPalResult['PROFILESTARTDATE'];
               $ins_data['payment_status']      = $paymentstatus['payment_status'];
               $ins_data['pending_reason']      = $paymentstatus['pending_reason'];
               $ins_data['trans_id']            = $paymentstatus['transaction_id'];
               $ins_data['amount']              = $PayPalResult['REGULARAMT'];
               $ins_data['payment_method']      = $this->payment_method;
    		   $this->payment_model->insert("payment_recurring_profiles",$ins_data);
               //$ipn =   $this->paypal_lib->validate_ipn();
              // print_r($ipn); exit;
               redirect('login/payment'); 
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
        
    }
    
    
}
?>