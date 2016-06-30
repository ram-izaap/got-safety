<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Payment extends App_Controller 
{
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
                    array('field' => 'fax', 'label' => 'Fax Number', 'rules' => 'trim|required|numeric|max_length[10]|min_length[6]')
				);
                
     
     protected $payment_method;
     
     function __construct()
     {
        parent::__construct();
        
        $config = api_credentials('sandbox');
        
		// Show Errors
		if($config['Sandbox']){
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}
        
        
        $this->load->model(array('payment_model','login_model'));
        $this->load->library('Paypal_pro',$config);
        
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
            
     		if($this->form_validation->run()){
	                        
	        }
	        else
	        {
	        	$this->layout->view('payment','frontend');
	        }
     	}
     }
     
     //get authorize form while click the authorize option
     function authorize_form()
     {
        
     }
     
     //paypal set express checkout
     function paypal()
     {
        $cancelUrl = base_url()."payment/cancel";
        $returnUrl = base_url()."payment/success";
        $ipn_url   = base_url()."payment/notify";
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
						'amt' => '15', 							
						'currencycode' => 'USD', 					
						'itemamt' => '15', 						  
						'shippingamt' => '0.00', 					
						'shipdiscamt' => '0.00', 				   
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
						'allowpushfunding' => '', 				
						'paymentaction' => 'Sale', 					 
						'paymentrequestid' => '',  				 
						'sellerid' => '', 						
						'sellerusername' => '', 				
						'sellerpaypalaccountid' => ''			
						);
	
				
		$PaymentOrderItems = array();
		$Item = array(
					'name' => 'Plan Subscription', 								
					'desc' => '', 								
					'amt' => '15', 								
					'number' => '', 							
					'qty' => '', 								
					'taxamt' => '0', 							
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
						'amt' => '15', 							
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
    							'amt' => '15', 							 
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
    		   
               $ins_data['user_id']             = $register_id;
               $ins_data['profile_start_date']  = $PayPalResult['PROFILESTARTDATE'];
               $ins_data['payment_status']      = $paymentstatus['payment_status'];
               $ins_data['pending_reason']      = $paymentstatus['pending_reason'];
               $ins_data['trans_id']            = $paymentstatus['transaction_id'];
               $ins_data['amount']              = $PayPalResult['REGULARAMT'];
               $ins_data['payment_method']      = $this->payment_method;
    		   $this->payment_model->insert("payment_recurring_profiles",$ins_data);
               
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
    
    function user_register()
    {
        
        //register user.
        $signup_data      = $this->session->userdata("signup_data");
        
        $folder = $signup_data['name'];
        
        mkdir('./admin/views/repository/files/'.$folder.'', 0755,true);
        
        $register_user_id = $this->login_model->insert("users",$signup_data);
        
     	if(!empty($register_user_id)) {
           // $this->service_message->set_flash_message('signup_success');
        }    
        $url = "http://izaapinnovations.com/got_safety/admin/";
        $msg = "Your Backend Login link as client ".$url." <br>
        	<b>Client Username</b>: ".$signup_data['name']."<br>
			<b>Password</b>: ".$signup_data['password']."<br><br>
			Thanks you..";                
        $this->email->from('admin@gotsafety.com', 'Gotsafety');
		$this->email->to($signup_data['email']);
		$this->email->subject('Signup Successfully');
		$this->email->message($msg);
		$this->email->send();
        
        return $register_user_id;
    }
}
?>