<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal_lib
{
	private $CI;
	private $error_message 	= '';
	private $fields			= array();
	private $environment 	= 'sandbox';
	private $business 		= null;
	private $paypal_url 	= null;
	private $api_username 	= null;
	private $api_password 	= null;
	private $api_signature 	= null;
				
	private $_shipping_info 	= array();
	private $_billing_info  	= array();
	private $_cart  			= array();
	private $_discount  		= 0;
	private $_shipping_charge	= 0;
	private $_tax				= 0;
	private $_return_url		= '';
	private $_cancel_url		= '';
	private $_notify_url		= '';
	private $_sales_channel_id	= 0;
	private $_custom			= array();
	
	//for refund
	private $_txn_id = '';
	private $_refund_amount = 0;
	
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
		if(!$this->_sales_channel_id)
			return FALSE;
	
		//get payment mode
		$payment_settings 		= get_settings($this->_sales_channel_id, 'payment');
		$this->environment 		= isset($payment_settings['mode'])?$payment_settings['mode']:'';
	
		//get paypal info
		$this->CI->db->where('channel_id', $this->_sales_channel_id);
		$this->CI->db->where('environment', $this->environment);
		$result = $this->CI->db->get("paypal_info")->row_array();
	
		if(!isset($result['business']) || !isset($result['paypal_url']) || !isset($result['api_username']) || !isset($result['api_password']) || !isset($result['api_signature']) )
			return FALSE;
	
		//set credentials
		$this->business 	= $result['business'];
		$this->paypal_url 	= $result['paypal_url'];
		$this->api_username = $result['api_username'];
		$this->api_password = $result['api_password'];
		$this->api_signature= $result['api_signature'];
	}
	
    function process()
	{
	
		try
		{
			//set creentials
			$this->set_credentials();
			
			if(is_null($this->business) || is_null($this->paypal_url) || is_null($this->api_username) || is_null($this->api_password) || is_null($this->api_signature))
				throw new Exception('Unable to process your order.');
			
			if(!is_array($this->_cart) || !count($this->_cart))
				throw new Exception("Please specify cart info.");
			
			if(!is_array($this->_billing_info) || !count($this->_billing_info))
				throw new Exception("Please specify billing info.");
			
			if(!is_array($this->_shipping_info) || !count($this->_shipping_info))
				throw new Exception("Please specify shipping info.");
			
			if(strcmp($this->_return_url, '') === 0)
				throw new Exception("Please specify return url.");
			
			if(strcmp($this->_cancel_url, '') === 0)
				throw new Exception("Please specify cancel url.");
			
			if(strcmp($this->_notify_url, '') === 0)
				throw new Exception("Please specify notify url.");
			
			//Add cart data
			$i=1;
			foreach($this->_cart as $val)
			{
				$this->add_field('item_name_'.$i, $val['name']);
				$this->add_field('item_number_'.$i, $val['id']);
				$this->add_field('quantity_'.$i, $val['qty']);
				$this->add_field('amount_'.$i, price_format($val['sell_price']));
			
				$i++;
			}
			
			//add basic required fields
			$this->add_field('cmd', '_cart');
			$this->add_field('upload', '1');
			$this->add_field('business', $this->business);
			$this->add_field('rm','2'); // Return method = POST
			
			//add discount
			$this->add_field('discount_amount_cart', round_amount($this->_discount));
			//add shipping and handling
			$this->add_field('handling_cart',  round_amount($this->_shipping_charge));
			//add tax
			$this->add_field('tax_cart',  round_amount($this->_tax));
			//prepare query string of custom data
			$this->add_field('custom', http_build_query($this->_custom));
			//add return url
			$this->add_field('return', $this->_return_url);
			//add cancel url
			$this->add_field('cancel_return', $this->_cancel_url);
			//add notify url
			$this->add_field('notify_url', $this->_notify_url);
			
			return $this->get_form();
			
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
				
			if(is_null($this->business) || is_null($this->paypal_url) || is_null($this->api_username) || is_null($this->api_password) || is_null($this->api_signature))
				throw new Exception('Unable to process your order.');
			
			if( strcmp($this->_txn_id, '') === 0)
				throw new Exception("Partial Refund Amount is not specified");
			
			$params = array();
			$params['USER']			= $this->api_username;
			$params['PWD']			= $this->api_password;
			$params['SIGNATURE']	= $this->api_signature;
			$params['METHOD']		= 'RefundTransaction';
			$params['VERSION']		= '51.0';
			$params['TRANSACTIONID']= $this->_txn_id;
			$params['REFUNDTYPE'] 	= ($this->_refund_amount)?'Partial':'Full';
			$params['CURRENCYCODE'] = 'USD';
			$params['NOTE'] 		= 'refund:'.$this->_txn_id;
			
			if(strcmp($params['REFUNDTYPE'], 'Partial') === 0)
			{
				if(!$this->_refund_amount)
					throw new Exception("Partial Refund Amount is not specified");
				
				$params['AMT'] = price_format($this->_refund_amount);
			}
			
			$query_string = http_build_query($params);
			
			
			$API_Endpoint = "https://api-3t.paypal.com/nvp";
			if("sandbox" === $this->environment || "beta-sandbox" === $this->environment)
				$API_Endpoint = "https://api-3t.".$this->environment.".paypal.com/nvp";
			
			// Set the curl parameters.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			
			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			
			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
			
			// Get response from the server.
			$result = curl_exec($ch);
			
			if(!$result)
				throw new Exception("{$params['METHOD']}_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
			
			
			// Extract the response details.
			parse_str($result, $response);
			
			if((0 == count($response)) || !array_key_exists('ACK', $response))
				throw new Exception("Invalid HTTP Response for POST request to $API_Endpoint.");
			
			if( strcmp("SUCCESS", strtoupper($response["ACK"])) === 0 || strcmp("SUCCESSWITHWARNING", strtoupper($response["ACK"])) === 0 )
				return TRUE;
			
			throw new Exception("Refund request is failed.");
			
		}
		catch(Exception $e)
		{
			$this->error_message = $e->getMessage();
			
			return FALSE;
		}
		
	}
	
	
	function ipn()
	{
		try 
		{
			$response = $_POST;
			parse_str($response['custom'], $custom);
			
			$this->CI->load->model('checkout_model');
			$this->CI->load->library('email_manager');


			$so_id = isset($custom['so_id'])?(int)$custom['so_id']:0;            
            $this->CI->checkout_model->addaction_loginfo('sales_order', 'IPN Call from Paypal.'.json_encode($response), $so_id);

			if( !isset($custom['so_id']) )
				throw new Exception('Invalid sales order id');
			
			$so_id = $custom['so_id'];
			
			$result = $this->CI->db->get("payment_api_credentials")->row_array();

			if(!isset($result['payment_mode']))
			    return FALSE;

			$this->environment 		= isset($result['payment_mode'])?$result['payment_mode']:'';
			
			
			
			if ($this->validate_ipn($so_id) && (($this->environment == 'live' && $response['payment_status'] == 'Completed') || $this->environment == 'sandbox'))
			{
				$order_status = 'COMPLETED';
		
				//update sales_order
				$txn = array(
						'order_status' => $order_status,
						'paid_status' => 'Y',
						'txn_id' => $response['txn_id']
				);
				$this->CI->db->where('id', $so_id);
                $this->CI->db->update('sales_order', $txn);
				$this->CI->email_manager->send_order_mail($so_id);
			}
						
			else if($this->validate_ipn() && $this->environment == 'live' && $response['payment_status'] == 'Failed')
			{
				$txn = array(
							'order_status' => 'FAILED',
							'paid_status' => 'N'
				);

				$this->CI->db->where('id', $so_id);
                $this->CI->db->update('sales_order', $txn);

				$this->CI->email_manager->send_order_mail($so_id, 'FAILED');
				$this->CI->checkout_model->addaction_loginfo('sales_order', 'IPN validation failed.Notification email on "Unsuccessful-Payment" sent to customer.', $so_id);

			}
			
			return TRUE;
		}
		catch(Exception $e)
		{
			$this->error_message = $e->getMessage();
				
			return FALSE;
		}
		
		
	}
	
	function validate_ipn($so_id = 0)
	{
		
		// STEP 1: read POST data
	 
		// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
		// Instead, read raw POST data from the input stream.
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) 
		{
			$keyval = explode ('=', $keyval);
			if (count($keyval) == 2)
				$myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		
		// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
		$req = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc')) 
		{
			$get_magic_quotes_exists = true;
		}
		foreach ($myPost as $key => $value) 
		{
			if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) 
			{
				$value = urlencode(stripslashes($value));
			} 
			else 
			{
				$value = urlencode($value);
			}
			$req .= "&$key=$value";
		}
		
		//$qs = array('cmd'=>'_notify-validate')+$_POST;
		
		//$req = http_build_query($qs);
		
		$API_Endpoint = "https://www.paypal.com/cgi-bin/webscr";
		if("sandbox" === $this->environment || "beta-sandbox" === $this->environment)
			$API_Endpoint = "https://www.".$this->environment.".paypal.com/cgi-bin/webscr";
		
		$ch = curl_init($API_Endpoint);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		
		if( !($res = curl_exec($ch)) )
			$this->error_message = "Got " . curl_error($ch) . " when processing IPN data";

		curl_close($ch);
		
		if (strcmp ($res, "VERIFIED") == 0) 
		{
			return $res;
		} 
		else if (strcmp ($res, "INVALID") == 0) 
		{
			if($so_id)
				//actionLogAdd('sales_order', 'IPN validation is failed.'.$this->error_message, $so_id);
				$this->CI->checkout_model->addaction_loginfo('sales_order', 'IPN validation is failed.'.$this->error_message, $so_id);

			
			return FALSE;
		}
		
	}
	
	function add_field($field, $value)
	{
		$this->fields["$field"] = $value;
	}
	
	function get_form()
	{
		$str = "";
		$str .= "<html>\n";
		$str .= "<head><title>Processing Payment...</title></head>\n";
		$str .= "<body onLoad=\"document.forms['paypal_form'].submit();\">\n";
		$str .= "<center><h2>Please wait, your order is being processed and you";
		$str .= " will be redirected to the paypal website.</h2></center>\n";
		$str .= "<form method=\"post\" name=\"paypal_form\" ";
		$str .= "action=\"".$this->paypal_url."\">\n";
	
		foreach ($this->fields as $name => $value) {
			$str .= "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
		}
		$str .= "<center><br/><br/>If you are not automatically redirected to ";
		$str .= "paypal within 5 seconds...<br/><br/>\n";
		$str .= "<input type=\"submit\" value=\"Click Here\" class=\"cart-button blue\" ></center>\n";
	
		$str .= "</form>\n";
		$str .= "</body></html>\n";
	
		return $str;
	
	}
	
	function get_error_message()
	{
		return $this->error_message;
	}
}

/* End of file Authorize.php */