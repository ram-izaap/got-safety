<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//define('PAYPAL_EXPRESS_ROOT', dirname(dirname(__FILE__)) . '/');
//require_once('config/config-sample.php');
require(PAYPAL_EXPRESS_ROOT.'autoload.php');

class DoExpressCheckoutPayment {

	private $CI;
	private $error_message 	= '';
	private $fields			= array();
	private $payment_mode 	= TRUE;
	private $environment 	= '';
	private $business 		= null;
	private $paypal_url 	= null;
	private $api_username 	= null;
	private $api_password 	= null;
	private $api_signature 	= null;
				
	private $_shipping_info 	= array();
	private $_billing_info  	= array();
	private $_cart  			= array();
	private $_discount  		= 0;
	private $_coupon  		= 0;
	private $_shipping_discount = 0;
	private $_shipping_charge	= 0;
	private $_tax				= 0;
	private $_return_url		= '';
	private $_cancel_url		= '';
	private $_notify_url		= '';
	private $_sales_channel_id	= 0;
	private $_custom			= array();

	private $_token 	= '';
	private $_payer_id	= '';
	
	//for refund
	private $_txn_id = '';
	private $_refund_amount = 0;

	function __construct()
	{
		$this->CI =& get_instance();
		//set creentials
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

	   //get paypal info
		$result = $this->CI->db->get("payment_api_credentials")->row_array();
	
		if(!isset($result['api_username']) || !isset($result['api_password']) || !isset($result['api_signature']) )
			return FALSE;
	
		//set credentials
		$this->payment_mode = $result['payment_mode'];
		$this->api_username = $result['api_username'];
		$this->api_password = $result['api_password'];
		$this->api_signature= $result['api_signature'];

	}

public function getEC() {


	$this->set_credentials();
		
  //Here we call GetExpressCheckoutDetails to obtain payer information from PayPal 
	$PayPalConfig = array(
					'Sandbox' => $this->payment_mode,
					'APIUsername' => trim($this->api_username),
					'APIPassword' => trim($this->api_password),
					'APISignature' => trim($this->api_signature),
					'APIVersion' => '97.0',
					'APISubject' => '',
                    'PrintHeaders' => false, 
					'LogResults' => false, 
					'LogPath' => '',
					);
		
	$PayPal = new angelleye\PayPal\PayPal($PayPalConfig);

	$GECDResult = $PayPal -> GetExpressCheckoutDetails($this->_token);

	return $GECDResult;

}	

public function doEC() {	

$this->set_credentials();
		
	$PayPalConfig = array(
					'Sandbox' => $this->payment_mode,
					'APIUsername' => trim($this->api_username),
					'APIPassword' => trim($this->api_password),
					'APISignature' => trim($this->api_signature),
					'APIVersion' => '97.0',
					'APISubject' => '',
                    'PrintHeaders' => false, 
					'LogResults' => false, 
					'LogPath' => '',
					);

$PayPal = new angelleye\PayPal\PayPal($PayPalConfig);


$DECPFields = array(
					'token' => $this->_token, 					// Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
					'payerid' => $this->_payer_id, 				// Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
					'returnfmfdetails' => '', 					// Flag to indiciate whether you want the results returned by Fraud Management Filters or not.  1 or 0.
					'giftmessage' => '', 						// The gift message entered by the buyer on the PayPal Review page.  150 char max.
					'giftreceiptenable' => '', 					// Pass true if a gift receipt was selected by the buyer on the PayPal Review page. Otherwise pass false.
					'giftwrapname' => '', 						// The gift wrap name only if the gift option on the PayPal Review page was selected by the buyer.
					'giftwrapamount' => '', 					// The amount only if the gift option on the PayPal Review page was selected by the buyer.
					'buyermarketingemail' => '', 				// The buyer email address opted in by the buyer on the PayPal Review page.
					'surveyquestion' => '', 					// The survey question on the PayPal Review page.  50 char max.
					'surveychoiceselected' => '',  				// The survey response selected by the buyer on the PayPal Review page.  15 char max.
					'allowedpaymentmethod' => 'InstantPaymentOnly', 				// The payment method type. Specify the value InstantPaymentOnly.
					'buttonsource' => '' 						// ID code for use by third-party apps to identify transactions in PayPal. 
				);

$PaymentOrderItems = array();	
$itemTotalValue = 0;
$taxTotalValue = 0;
foreach($this->_cart as $val){

	$itemTotalValue += $val['price'] * $val['qty'];

	$Item = array(
			'name' => $val['name'], 							// Item name. 127 char max.
			'desc' => strip_tags($val['desc']), 							// Item description. 127 char max.
			'amt' => $val['price'], 								// Cost of item.
			'number' => $val['options']['product_id'], 							// Item number.  127 char max.
			'qty' => $val['qty'], 								// Item qty on order.  Any positive integer.
			'taxamt' => 0, 							// Item sales tax
			'itemurl' => '', 							// URL for the item.
			'itemcategory' => '', 				// One of the following values:  Digital, Physical
			'itemweightvalue' => '', 					// The weight value of the item.
			'itemweightunit' => '', 					// The weight unit of the item.
			'itemheightvalue' => '', 					// The height value of the item.
			'itemheightunit' => '', 					// The height unit of the item.
			'itemwidthvalue' => '', 					// The width value of the item.
			'itemwidthunit' => '', 					// The width unit of the item.
			'itemlengthvalue' => '', 					// The length value of the item.
			'itemlengthunit' => '',  					// The length unit of the item.
			'ebayitemnumber' => '', 					// Auction item number.  
			'ebayitemauctiontxnid' => '', 			// Auction transaction ID number.  
			'ebayitemorderid' => '',  				// Auction order ID number.
			'ebayitemcartid' => ''					// The unique identifier provided by eBay for this order from the buyer. These parameters must be ordered sequentially beginning with 0 (for example L_EBAYITEMCARTID0, L_EBAYITEMCARTID1). Character length: 255 single-byte characters
			);
		array_push($PaymentOrderItems, $Item);
}

if(!empty($this->_discount) && $this->_discount!=0){
	$itemTotalValue += -round_amount($this->_discount);
	$discount_apply = array(
			'name' => 'Discount', 	 							// Item description. 127 char max.
			'amt' => -round_amount($this->_discount), 								// Cost of item.
			'number' => '', 							// Item number.  127 char max.
			'qty' => 1, 								// Item qty on order.  Any positive integer.
			'taxamt' => 0				// The unique identifier provided by eBay for this order from the buyer. These parameters must be ordered sequentially beginning with 0 (for example L_EBAYITEMCARTID0, L_EBAYITEMCARTID1). Character length: 255 single-byte characters
			);
	array_push($PaymentOrderItems, $discount_apply);
}

if(!empty($this->_coupon) && $this->_coupon!=0){
	$itemTotalValue += -round_amount($this->_coupon);
	$coupon_apply = array(
			'name' => 'Coupon', 	 							// Item description. 127 char max.
			'amt' => -round_amount($this->_coupon), 								// Cost of item.
			'number' => '', 							// Item number.  127 char max.
			'qty' => 1, 								// Item qty on order.  Any positive integer.
			'taxamt' => 0,
			'desc'=>$_SESSION['coupon_details']['code']		// The unique identifier provided by eBay for this order from the buyer. These parameters must be ordered sequentially beginning with 0 (for example L_EBAYITEMCARTID0, L_EBAYITEMCARTID1). Character length: 255 single-byte characters
			);
	array_push($PaymentOrderItems, $coupon_apply);
}


$shippingTotal = round_amount($this->_shipping_charge);
$taxTotalValue = round_amount($this->_tax);
$discountTotal = round_amount($this->_discount);
$orderTotal    = $itemTotalValue + $taxTotalValue + $shippingTotal;
$orderTotal    = $orderTotal - $this->_shipping_discount;  



$Payments = array();
$Payment = array(
				'amt' => round_amount($orderTotal), 							// Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
				'currencycode' => 'USD', 					// A three-character currency code.  Default is USD.
				'itemamt' => $itemTotalValue, 						// Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.  
				'shippingamt' => $shippingTotal, 					// Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
				'shipdiscamt' => -$this->_shipping_discount,                     //Shipping discount
				'insuranceoptionoffered' => '', 		// If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
				'handlingamt' => '',
				'redeemedofferamount' => '', 					// Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
				'taxamt' => $taxTotalValue, 						// Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order. 
				'desc' => 'This is a test order.', 							// Description of items on the order.  127 char max.
				'custom' => http_build_query($this->_custom), 						// Free-form field for your own use.  256 char max.
				'invnum' => '', 						// Your own invoice or tracking number.  127 char max.
				'notifyurl' => $this->_notify_url,  						// URL for receiving Instant Payment Notifications
				'shiptoname' => $this->address_fill('S','name'), 					// Required if shipping is included.  Person's name associated with this address.  32 char max.
				'shiptostreet' => $this->address_fill('S','address'), 					// Required if shipping is included.  First street address.  100 char max.
				'shiptocity' => $this->address_fill('S','city'), 					// Required if shipping is included.  Name of city.  40 char max.
				'shiptostate' => $this->address_fill('S','state'), 					// Required if shipping is included.  Name of state or province.  40 char max.
				'shiptozip' => $this->address_fill('S','zip_code'), 						// Required if shipping is included.  Postal code of shipping address.  20 char max.
				'shiptocountry' => $this->address_fill('S','country'), 					// Required if shipping is included.  Country code of shipping address.  2 char max.
				'shiptophonenum' => $this->address_fill('S','phone'),  				// Phone number for shipping address.  20 char max.
				'notetext' => 'This is a test note before ever having left the web site.', 						// Note to the merchant.  255 char max.  
				'allowedpaymentmethod' => 'InstantPaymentOnly', 			// The payment method type.  Specify the value InstantPaymentOnly.
				'paymentaction' => 'Sale', 					// How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order. 
				'paymentrequestid' => '',  				// A unique identifier of the specific payment request, which is required for parallel payments. 
				'sellerpaypalaccountid' => ''			// A unique identifier for the merchant.  For parallel payments, this field is required and must contain the Payer ID or the email address of the merchant.
				);
				



$Payment['order_items'] = $PaymentOrderItems;
array_push($Payments, $Payment);				

$UserSelectedOptions = array(
							 'shippingcalculationmode' => '', 	// Describes how the options that were presented to the user were determined.  values are:  API - Callback   or   API - Flatrate.
							 'insuranceoptionselected' => '', 	// The Yes/No option that you chose for insurance.
							 'shippingoptionisdefault' => '', 	// Is true if the buyer chose the default shipping option.  
							 'shippingoptionamount' => '', 		// The shipping amount that was chosen by the buyer.
							 'shippingoptionname' => '', 		// Is true if the buyer chose the default shipping option...??  Maybe this is supposed to show the name..??
							 );

$PayPalRequest = array(
					   'DECPFields' => $DECPFields, 
					   'Payments' => $Payments
					   );

$PayPalResult = $PayPal -> DoExpressCheckoutPayment($PayPalRequest);

return $PayPalResult;

}

function address_fill($type,$key){

	if($type=='S'){
		$val = (isset($this->_shipping_info[$key]) && !empty($this->_shipping_info[$key]))?$this->_shipping_info[$key]:'';
	}elseif($type=='B'){
		$val = (isset($this->_billing_info[$key]) && !empty($this->_billing_info[$key]))?$this->_billing_info[$key]:'';
	}else{
		$val= '';
	}

	return $val='';
}

}

?>