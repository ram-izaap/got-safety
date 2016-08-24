<?php 

safe_include("libraries/controllers/Cart_controller.php");
class Paypal_exp extends Cart_controller {

	 
	public function __construct()
	{
		parent::__construct();

		$this->load->library('paypal_express/payexp/SetExpressCheckout',array(),'SetExpressCheckout');
		$this->load->library('paypal_express/payexp/DoExpressCheckoutPayment',array(),'DoExpressCheckoutPayment');
		$this->load->library("cart");
		$this->load->model("checkout_model");
		
	}
	
	public function index()
	{
		$this->setCheckout();
	}

	function setCheckout(){
		
		try
		{
		    //Shiiping and billing Information
			
			$shipment = $this->session->userdata('shipping_info');

			$params = $this->common_params("get_express_check");

			$this->SetExpressCheckout->initialize($params);

			$response = $this->SetExpressCheckout->setEC();

			//print_r($response);exit;

  			if((strcmp($response['ACK'],'Success')===0 || strcmp($response['ACK'],'SuccessWithWarning')===0 ) && !empty($response['TOKEN'])){

  				//$redirect_url="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=".$response->Token;
  		    	redirect($response['REDIRECTURL']);
  		    }
  		    else
  		    {		
  				$msg="";
  				if(is_array($response['ERRORS']) && !empty($response['ERRORS'])){
  					$i=1;	
  					foreach($response['ERRORS'] as $error){

  						$msg .=  $i.". ".$error['L_SHORTMESSAGE']."<br> <b>Details : </b> ".$error['L_LONGMESSAGE']."<br>";
  						$i++; 
  					}

  				}else{
  					$msg .="Your request has been failed.";
  				}

				throw new Exception($msg);
  			}
  				
  			
		}
		catch(Exception $e)
		{
			$form = $e->getMessage();
		}
		
		$data['msg'] = $form;
		
		$this->load->view('/checkout/chk_index',$data);
	}
	
	function get_express_check(){

		try
		{
			if(!isset($_REQUEST['token']) && !isset($_REQUEST['PayerID']))
				throw new Exception("Your Token or PayerId not avilable!");


			if(strcmp($_REQUEST['token'],'')=== 0 && strcmp($_REQUEST['PayerID'],'')===0)
				throw new Exception("Your Token and PayerId should not be empty!");


			$params['token']    = $_REQUEST['token'];
			$params['payer_id'] = $_REQUEST['PayerID'];

			

			$this->DoExpressCheckoutPayment->initialize($params);

			$response = $this->DoExpressCheckoutPayment->getEC();



			//echo "<pre>"; print_r($response); exit;

			if((strcmp($response['ACK'],'Success') !==0  || strcmp($response['ACK'],'SuccessWithWarning')!==0 ) && strcmp($response['TOKEN'],'')===0 ){
				
				$msg="";
  				if(is_array($response['ERRORS']) && !empty($response['ERRORS'])){
  					$i=1;	
  					foreach($response['ERRORS'] as $error){

  						$msg .=  $i.". ".$error['L_SHORTMESSAGE']."<br> <b>Details : </b> ".$error['L_LONGMESSAGE']."<br>";
  						$i++; 
  					}

  				}else{

  					$msg .="Your request has been failed.";
  				}


				throw new Exception($msg);
			}


			if(empty($response['PAYERID']))
				throw new Exception("PayerID not found!");

			/*
			if(strcmp($response['PAYERSTATUS'],'verified')!==0 )
				throw new Exception("Payer status has been not verified");

			if(strcmp($response['ADDRESSSTATUS'],'Confirmed')!==0 )
				throw new Exception("Your Shipping Address has been not confirmed");
            */



			$this->session->set_userdata("express_check_token",$params);


			$this->success();
			//echo "<pre>"; print_r($billing_address);print_r($shipping_address); exit;
		}
		catch(Exception $e)
		{
			$data['msg'] = $e->getMessage();
			$this->load->view('/checkout/chk_index',$data);
		}	
	}

	function success(){

		try
		{ 
			$shipment = array();
		    $payment = array();
		    
		    if($this->session->userdata('shipping_info'))
		        $shipment   = $this->session->userdata('shipping_info');
		    if($this->session->userdata('billing_info'))
		        $payment    =  $this->session->userdata('billing_info');

		     $user_id = $this->check_existing_user();

		    $this->create_orders('paypal', $user_id);
			
			$so_id = $this->session->userdata('so_id');

			$update_data = array();
			$update_data['paid_status'] 	= 'N';

			$this->db->where('id', $so_id);
            $this->db->update('sales_order', $update_data);
			
			$payment['so_id'] = $so_id;
			$this->session->set_userdata('billing_info',$payment);


			$params = $this->common_params("success");

			$expchk = $this->session->userdata("express_check_token");

			$params['token'] = $expchk['token'];
			$params['payer_id'] = $expchk['payer_id'];

			
			$this->DoExpressCheckoutPayment->initialize($params);

			$response = $this->DoExpressCheckoutPayment->doEC();

			//echo "<pre>"; print_r($response);exit;

			if((strcmp($response['ACK'],'Success')!==0 || strcmp($response['ACK'],'SuccessWithWarning')!==0 ) && strcmp($response['TOKEN'],'')===0){
				
				$msg="";
  				if(is_array($response['ERRORS']) && !empty($response['ERRORS'])){
  					$i=1;	
  					foreach($response['ERRORS'] as $error){

  						$msg .=  $i.". ".$error['L_SHORTMESSAGE']."<br> <b>Details : </b> ".$error['L_LONGMESSAGE']."<br>";
  						$i++; 
  					}

  				}else{
  					$msg .="Your request has been failed.";
  				}


				throw new Exception($msg);
			}

			//remove the session data
			
			//$this->remove_session();
			
			$this->session->unset_userdata('express_check_token');

			$so_id = 0;

			if(!empty($response['REQUESTDATA']['PAYMENTREQUEST_0_CUSTOM']))
			{
				parse_str($response['REQUESTDATA']['PAYMENTREQUEST_0_CUSTOM'], $custom);
				$so_id = $custom['so_id'];
			}


			if(!$so_id)
				redirect('');
				
			$this->session->set_flashdata('so_id1', $so_id);
	    	$this->session->set_flashdata('message', 'Your Order has been processed successfully.');
	    	redirect('checkout/success');
			
		}
		catch(Exception $e)
		{
			$data['msg'] = $e->getMessage();
			$this->load->view('/checkout/chk_index',$data);
		}		
	}

	function common_params($return_url){

			//$total_tax 			= calculate_tax();
			$shipment 			= $this->session->userdata('shipping_info');
			$payment 			= $this->session->userdata('billing_info');
			$ship_cost = $this->session->userdata('ship_amt');
            $tax_cost = $this->session->userdata('tax_amt');


			$params = array();
  			//$params['sales_channel_id'] = $this->sales_channel_id;
  			$params['shipping_info'] 	= $shipment;
  			$params['billing_info'] 	= $payment;
  			$params['cart'] 			= $this->cart->contents();
  			$params['discount'] 		= 0;
  			$params['coupon'] 		= $this->session->userdata('coupon_details')['discount_amount'];
  			$params['shipping_discount']= 0;
  			$params['shipping_charge'] 	= $ship_cost['shipping_amt'];
  			$params['tax'] 				= $tax_cost['tax_amt'];
  			$params['return_url']		= site_url('paypal_exp/'.$return_url);
  			$params['cancel_url']		= site_url('paypal_exp/cancel');
  			$params['notify_url']		= site_url('paypal_exp/ipn');

  			if($return_url == 'success'){
	  			$custom = array();
	  			$custom['so_id'] 	= $payment['so_id'];
	  			$custom['email'] 	= $payment['email'];
	  			$custom['country'] 	= $payment['country'];
	  			$params['custom']   = $custom;
	  		}	

  		return 	$params;
  	}

	
	
	function cancel(){
		$data['msg'] = "<html><head><title>Canceled</title></head>
							<body>
							<div align='center'>
								<h1 class='prodDesc gray'>
									<b>The order was cancelled.</b>
								</h1>
							</div>";
		$data['msg'] .= "</body></html>";
		$this->load->view('/checkout/chk_index',$data);
	}

	function ipn()
	{
		
		//$this->load->model('address_model');
		//$this->address_model->insert(array('ipn'=>json_encode($_POST)),"ipnchck");
		
		$this->load->library("paypal_lib");
		$params = array();
		$params['sales_channel_id'] = $this->sales_channel_id;

		$this->paypal_lib->initialize($params);

		$this->paypal_lib->ipn();

	}

}

/* End of file cart.php */
/* Location: ./system/application/controllers/paypal.php */
