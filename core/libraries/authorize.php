<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorize
{
	private $gateway_url 		= null;
	public $x_login 			= null;
	public $x_tran_key 			= null;	
	public $environment 		= null;
	private $response			= array();
	private $error_message		= '';
	
	private $_payable_amount 	= 0;
	private $_shipping_info 	= array();
	private $_billing_info  	= array();
	private $_card_details  	= array();
	private $_sales_channel_id	= 0;
	private $_invoice_num		= 0;
	private $_description		= '';
	
	//for refund
	private $_txn_id = '';
	private $_cc_last_digits = '';
	private $_refund_amount = 0;
	
	private $_save_profile 	= FALSE;
	private $_use_profile 	= FALSE;
	private $_user_id = 0;
	
	private $CI;
	
	function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function initialize($params = array())
	{
		if(!count($params))
			return FALSE;
	
		foreach ($params as $key => $val)
		{
			$key = "_{$key}";
			if (isset($this->$key))
				$this->$key = $val;
		}
		
	}
	
	private function set_credentials()
	{
		//set credentials
		$this->gateway_url 	= "https://test.authorize.net/gateway/transact.dll";
		$this->x_login 		= "69LkC6bcJ";
		$this->x_tran_key 	= "7J8pJb299FfcRV3L";
	}
    
	function process_order($data='')
	{
		try
		{
			//set creentials
			$this->set_credentials();
			
			if(is_null($this->gateway_url) || is_null($this->x_login) || is_null($this->x_tran_key))
				throw new Exception('Unable to process your order.');
			
			if($this->_use_profile)
			{
				$this->CI->load->library('authorize_net');
				
				$args = array();
				$args['customerProfileId'] = 27309729;
				$args['customerPaymentProfileId'] = 24923507;
				//$args['cardCode'] = 223;
				$args['amount'] = (float)$this->_payable_amount;
				$args['order'] = array('invoiceNumber' =>"58268");
				$transaction =  $this->CI->authorize_net->create_transaction($args);
				
				if($transaction === FALSE)
					throw new Exception($this->CI->error_message);
				
				$transaction = xml_obj_to_array($transaction);
				$this->response[3] = $transaction['response_reason_text'];
				$this->response[6] = isset($transaction['transaction_id'])?$transaction['transaction_id']:'';
				$this->response[50] = isset($transaction['account_number'])?$transaction['account_number']:'';
				
				
			}
			else
			{

				if (!is_array($this->_shipping_info) || !is_array($this->_billing_info) || !is_array($this->_card_details))
					throw new Exception('The billing or billing Info is not valid.');
					
				if (!count($this->_shipping_info) || !count($this->_billing_info) || !count($this->_card_details))
					throw new Exception('The billing or billing Info is not valid.');
					
				if( floor($this->_payable_amount) == 0 )
					throw new Exception('Payment Amount is not valid.');
				
				//prepare post values
				$post_values = array(
				
						"x_login"				=> $this->x_login,
						"x_tran_key"			=> $this->x_tran_key,
							
						"x_version"				=> "3.1",
						"x_delim_data"			=> "TRUE",
						"x_delim_char"			=> "|",
						"x_relay_response"		=> "FALSE",
							
						"x_type"				=> "AUTH_CAPTURE",
						"x_method"				=> "CC",
						"x_card_num"			=> $this->_card_details['cc_number'],//4007000000027
						"x_exp_date"			=> $this->_card_details['cc_month'].$this->_card_details['cc_year'],//"0115"
							
						"x_amount"				=> (float)$this->_payable_amount,//"19.99"
						"x_invoice_num"			=> $this->_invoice_num,
						"x_description"			=> $this->_description,
						"x_customer_ip"			=> $_SERVER['REMOTE_ADDR'],
							
						"x_first_name"			=> $this->_billing_info['name'],
						"x_address"				=> $this->_billing_info['address'],
						"x_city"				=> $this->_billing_info['city'],
						"x_state"				=> $this->_billing_info['state'],
						"x_zip"					=> $this->_billing_info['zip_code'],
						"x_country"				=> $this->_billing_info['country'],
				
						"x_ship_to_first_name"	=> $this->_shipping_info['name'],
						"x_ship_to_address"		=> $this->_shipping_info['address'],
						"x_ship_to_city"		=> $this->_shipping_info['city'],
						"x_ship_to_state"		=> $this->_shipping_info['state'],
						"x_ship_to_zip"			=> $this->_shipping_info['zip_code'],
						"x_ship_to_country"		=> $this->_shipping_info['country']
						// Additional fields can be added here as outlined in the AIM integration
						// guide at: http://developer.authorize.net
				);

				$post_string = "";
				foreach( $post_values as $key => $value )
				{
					$post_string .= "$key=" . urlencode( $value ) . "&";
				}
				$post_string = rtrim( $post_string, "& " );


					
				$request = curl_init($this->gateway_url); // initiate curl object
				curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
				curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
				curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
				curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
				$post_response = curl_exec($request); // execute curl post and store results in $post_response
					
				// additional options may be required depending upon your server configuration
				// you can find documentation on curl options at http://www.php.net/curl_setopt
				curl_close ($request); // close curl object
					
				// This line takes the response and breaks it into an array using the specified delimiting character
				$this->response = explode($post_values["x_delim_char"],$post_response);
			}

			$status_message = isset($this->response[3])?$this->response[3]:'';
			
			if( strcmp($status_message, 'This transaction has been approved.') !== 0)
				throw new Exception($this->response[3]);

			if($this->_save_profile)
			{

				$this->create_profile();				
			}
			return TRUE;
			
		}
		catch(Exception $e)
		{
			$this->error_message = $e->getMessage();
			
			return FALSE;
		}
		
	}
	
	function refund()
	{
		
		try
		{
			//set creentials
			$this->set_credentials();
			
			if(is_null($this->x_login) || is_null($this->x_tran_key))
				throw new Exception('Unable to process your order.');

			if(strcmp($this->_cc_last_digits, '') === 0 || strcmp($this->_txn_id, '') === 0 || !$this->_refund_amount)
				throw new Exception('Invalid request.');
				
			$post_url = ($this->environment == 'live')?"https://secure2.authorize.net/gateway/transact.dll":"https://test.authorize.net/gateway/transact.dll";
				
			$post_values = array(
						
					// the API Login ID and Transaction Key must be replaced with valid values
					"x_login"			=> $this->x_login,
					"x_tran_key"		=> $this->x_tran_key,
			
					"x_version"			=> "3.1",
					"x_delim_data"		=> "TRUE",
					"x_delim_char"		=> "|",
					"x_relay_response"	=> "FALSE",
			
					"x_type"			=> "CREDIT",
					"x_amount"			=> $this->_refund_amount,
					"x_trans_id"		=> $this->_txn_id,
						
					"x_method"			=> "CC",
					"x_card_num"		=> $this->_cc_last_digits						
			);
			
			$post_string = "";
			foreach( $post_values as $key => $value )
			{
				$post_string .= "$key=" . urlencode( $value ) . "&";
			}
			$post_string = rtrim( $post_string, "& " );
			
			$request = curl_init($post_url); // initiate curl object
			curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
			curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
			curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
			$post_response = curl_exec($request); // execute curl post and store results in $post_response
			// additional options may be required depending upon your server configuration
			// you can find documentation on curl options at http://www.php.net/curl_setopt
			curl_close ($request); // close curl object
			
			// This line takes the response and breaks it into an array using the specified delimiting character
			$response_array = explode($post_values["x_delim_char"],$post_response);
			
			$this->response = $response_array;
			
			if(isset($response_array[3]))
			{
				if($response_array[3] == "This transaction has been approved.")
					return TRUE;
				
				//add custom message if error-code is 54
				if( $response_array[2] == 54 )
					$response_array[3] = "This payment is still being processed and can not be refunded yet.Please try again later.";
				
				throw new Exception($response_array[3]);
			}
			
			throw new Exception("Your refund request is failed.");
			
			
		}
		catch (Exception $e)
		{
			$this->error_message = $e->getMessage();
				
			return FALSE;
		}
	}
	
	function get_response()
	{
		return $this->response;
	}
	
	function get_error_message()
	{
		return $this->error_message;
	}
    
	function create_profile()
	{
		$this->CI->load->library('authorize_net');
		
		
		//create or fetch customer prfile_id
		$profile_id = $this->CI->authorize_net->create_customer_profile($this->_user_id);
		
		if(!$profile_id)
		{
			$this->error_message = $this->CI->error_message;
			return FALSE;
		}
		
		//update profile ID
		update_usermeta('authorize_profile_id', $profile_id, $this->_user_id);
		
		$args = array();
		
		if(isset($this->_billing_info['name']))
			$args['firstName'] 		= $this->_billing_info['name'];
		
		
		
		if(isset($this->_billing_info['address']))
			$args['address'] 		= $this->_billing_info['address'];
		
		
		if(isset($this->_billing_info['city']))
			$args['city'] 			= $this->_billing_info['city'];
		
		if(isset($this->_billing_info['state']))
			$args['state'] 			= $this->_billing_info['state'];
		
		if(isset($this->_billing_info['zip_code']))
			$args['zip'] 			= $this->_billing_info['zip_code'];
		
		if(isset($this->_billing_info['country']))
			$args['country'] 		= $this->_billing_info['country'];
		
		$args['customerProfileId'] 	= $profile_id;
		$args['merchantCustomerId'] = $this->_user_id;
		$args['payment_type'] 		= "credit_card";
			
		//credit_card
		if(isset($this->_card_details['cc_number']))
			$args['cardNumber'] 	= $this->_card_details['cc_number'];
		
		if(isset($this->_card_details['cc_year']) && isset($this->_card_details['cc_month']))
			$args['expirationDate'] = $this->_card_details['cc_year'].'-'.sprintf("%02s", $this->_card_details['cc_month']);  //"2015-10"
		
		if(isset($this->_card_details['cc_ccd']))
			$args['cardCode'] 		= $this->_card_details['cc_ccd'];
			
		//echo '<pre>';print_r($args);die;
		$payment_profile_id = $this->CI->authorize_net->add_payment_profile($args);
		
		
		if(! $payment_profile_id)
		{
			$this->error_message = $this->CI->error_message;
			return FALSE;
		}
		
		//insert into user table
		$insert_data = array();
		$insert_data['profile_id'] = $payment_profile_id;
		$insert_data['type'] = 'payment';
		$insert_data['user_id'] = $this->_user_id;
		$insert_data['card_no'] = substr($this->_card_details['cc_number'], -4);
		$insert_data['created_id'] = getAdminUserId();
		$insert_data['created_time'] = date("Y-m-d H:i:s", local_to_gmt());
		$insert_data['updated_id'] = getAdminUserId();
		$insert_data['updated_time'] = date("Y-m-d H:i:s", local_to_gmt());
		
		$this->CI->db->insert('authorize_cim', $insert_data);
		
		return TRUE;
		
		
	}
}

/* End of file Authorize.php */