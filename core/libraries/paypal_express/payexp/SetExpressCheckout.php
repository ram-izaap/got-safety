<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('PAYPAL_EXPRESS_ROOT', dirname(dirname(__FILE__)) . '/');
//require_once('config/config-sample.php');
require(PAYPAL_EXPRESS_ROOT.'autoload.php');

class SetExpressCheckout {

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
	private $_shipping_discount = 0;
	private $_shipping_charge	= 0;
	private $_tax				= 0;
	private $_return_url		= '';
	private $_cancel_url		= '';
	private $_notify_url		= '';
	private $_sales_channel_id	= 0;
	private $_custom			= array();
    private $_page_design       = array();
	
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

	public function setEC() {

		//set creentials
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

$SECFields = array(
					'token' => '', 								// A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
					'maxamt' => '', 						// The expected maximum total amount the order will be, including S&H and sales tax.
					'returnurl' => $this->_return_url, 							// Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
					'cancelurl' => $this->_cancel_url, 							// Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
					'callback' => '', 							// URL to which the callback request from PayPal is sent.  Must start with https:// for production.
					'callbacktimeout' => '', 					// An override for you to request more or less time to be able to process the callback request and response.  Acceptable range for override is 1-6 seconds.  If you specify greater than 6 PayPal will use default value of 3 seconds.
					'callbackversion' => '', 					// The version of the Instant Update API you're using.  The default is the current version.							
					'reqconfirmshipping' => '0', 				// The value 1 indicates that you require that the customer's shipping address is Confirmed with PayPal.  This overrides anything in the account profile.  Possible values are 1 or 0.
					'noshipping' => '', 						// The value 1 indiciates that on the PayPal pages, no shipping address fields should be displayed.  Maybe 1 or 0.
					'allownote' => '1', 							// The value 1 indiciates that the customer may enter a note to the merchant on the PayPal page during checkout.  The note is returned in the GetExpresscheckoutDetails response and the DoExpressCheckoutPayment response.  Must be 1 or 0.
					'addroverride' => '1', 						// The value 1 indiciates that the PayPal pages should display the shipping address set by you in the SetExpressCheckout request, not the shipping address on file with PayPal.  This does not allow the customer to edit the address here.  Must be 1 or 0.
					'localecode' => '', 						// Locale of pages displayed by PayPal during checkout.  Should be a 2 character country code.  You can retrive the country code by passing the country name into the class' GetCountryCode() function.
					'pagestyle' => isset($this->_page_design['pagestyle'])?$this->_page_design['pagestyle']:'', 							// Sets the Custom Payment Page Style for payment pages associated with this button/link.  
					'hdrimg' => isset($this->_page_design['hdrimg'])?$this->_page_design['hdrimg']:'', 	
					'logoimg'	=> isset($this->_page_design['logoimg'])?$this->_page_design['logoimg']:'',					// URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
					'cartbordercolor' => isset($this->_page_design['cartbordercolor'])?$this->_page_design['cartbordercolor']:'',
					'hdrbordercolor' => isset($this->_page_design['hdrbordercolor'])?$this->_page_design['hdrbordercolor']:'', 					// Sets the border color around the header of the payment page.  The border is a 2-pixel permiter around the header space.  Default is black.  
					'hdrbackcolor' => isset($this->_page_design['hdrbackcolor'])?$this->_page_design['hdrbackcolor']:'', 						// Sets the background color for the header of the payment page.  Default is white.  
					'payflowcolor' => isset($this->_page_design['payflowcolor'])?$this->_page_design['payflowcolor']:'', 						// Sets the background color for the payment page.  Default is white.
					'skipdetails' => '', 						// This is a custom field not included in the PayPal documentation.  It's used to specify whether you want to skip the GetExpressCheckoutDetails part of checkout or not.  See PayPal docs for more info.
					'email' => '', 								// Email address of the buyer as entered during checkout.  PayPal uses this value to pre-fill the PayPal sign-in page.  127 char max.
					'solutiontype' => 'Sole', 						// Type of checkout flow.  Must be Sole (express checkout for auctions) or Mark (normal express checkout)
					'landingpage' => 'Login', 						// Type of PayPal page to display.  Can be Billing or Login.  If billing it shows a full credit card form.  If Login it just shows the login screen.
					'channeltype' => 'Merchant', 						// Type of channel.  Must be Merchant (non-auction seller) or eBayItem (eBay auction)
					'giropaysuccessurl' => '', 					// The URL on the merchant site to redirect to after a successful giropay payment.  Only use this field if you are using giropay or bank transfer payment methods in Germany.
					'giropaycancelurl' => '', 					// The URL on the merchant site to redirect to after a canceled giropay payment.  Only use this field if you are using giropay or bank transfer methods in Germany.
					'banktxnpendingurl' => '',  				// The URL on the merchant site to transfer to after a bank transfter payment.  Use this field only if you are using giropay or bank transfer methods in Germany.
					'brandname' => isset($this->_page_design['channel_name'])?$this->_page_design['channel_name']:'', 							// A label that overrides the business name in the PayPal account on the PayPal hosted checkout pages.  127 char max.
					'customerservicenumber' => '', 				// Merchant Customer Service number displayed on the PayPal Review page. 16 char max.
					'giftmessageenable' => '', 					// Enable gift message widget on the PayPal Review page. Allowable values are 0 and 1
					'giftreceiptenable' => '', 					// Enable gift receipt widget on the PayPal Review page. Allowable values are 0 and 1
					'giftwrapenable' => '', 					// Enable gift wrap widget on the PayPal Review page.  Allowable values are 0 and 1.
					'giftwrapname' => 'Box with Ribbon', 						// Label for the gift wrap option such as "Box with ribbon".  25 char max.
					'giftwrapamount' => '', 					// Amount charged for gift-wrap service.
					'buyeremailoptionenable' => '1', 			// Enable buyer email opt-in on the PayPal Review page. Allowable values are 0 and 1
					'surveyquestion' => '', 					// Text for the survey question on the PayPal Review page. If the survey question is present, at least 2 survey answer options need to be present.  50 char max.
					'surveyenable' => '1', 						// Enable survey functionality. Allowable values are 0 and 1
					'buyerid' => '', 							// The unique identifier provided by eBay for this buyer. The value may or may not be the same as the username. In the case of eBay, it is different. 255 char max.
					'buyerusername' => '', 						// The user name of the user at the marketplaces site.
					'buyerregistrationdate' => '',  			// Date when the user registered with the marketplace.
					'allowpushfunding' => ''					// Whether the merchant can accept push funding.  0 = Merchant can accept push funding : 1 = Merchant cannot accept push funding.			
				);

// Basic array of survey choices.  Nothing but the values should go in here.  
$SurveyChoices = array('Yes', 'No');

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
			'name' => 'Coupon', 	 							// Item description. 127 char max.
			'amt' => -round_amount($this->_discount), 								// Cost of item.
			'number' => '', 							// Item number.  127 char max.
			'qty' => 1, 								// Item qty on order.  Any positive integer.
			'taxamt' => 0				// The unique identifier provided by eBay for this order from the buyer. These parameters must be ordered sequentially beginning with 0 (for example L_EBAYITEMCARTID0, L_EBAYITEMCARTID1). Character length: 255 single-byte characters
			);
	array_push($PaymentOrderItems, $discount_apply);
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
				'shippingamt' => $shippingTotal, 
				'shipdiscamt' => -$this->_shipping_discount,					// Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
				'insuranceoptionoffered' => '', 		// If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
				'handlingamt' => '', 
				'redeemedofferamount' => '',					// Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
				'taxamt' => $taxTotalValue, 						// Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order. 
				'desc' => '', 							// Description of items on the order.  127 char max.
				'custom' => '', 						// Free-form field for your own use.  256 char max.
				'invnum' => '', 						// Your own invoice or tracking number.  127 char max.
				'notifyurl' => $this->_notify_url,  						// URL for receiving Instant Payment Notifications
				'shiptoname' => $this->address_fill('S','name'), 					// Required if shipping is included.  Person's name associated with this address.  32 char max.
				'shiptostreet' => $this->address_fill('S','address'), 					// Required if shipping is included.  First street address.  100 char max.
				'shiptocity' => $this->address_fill('S','city'), 					// Required if shipping is included.  Name of city.  40 char max.
				'shiptostate' => $this->address_fill('S','state'), 					// Required if shipping is included.  Name of state or province.  40 char max.
				'shiptozip' => $this->address_fill('S','zip_code'), 						// Required if shipping is included.  Postal code of shipping address.  20 char max.
				'shiptocountry' => $this->address_fill('S','country'), 					// Required if shipping is included.  Country code of shipping address.  2 char max.
				'shiptophonenum' => $this->address_fill('S','phone'),  				// Phone number for shipping address.  20 char max.
				'notetext' => '', 						// Note to the merchant.  255 char max.  
				'allowedpaymentmethod' => 'InstantPaymentOnly', 			// The payment method type.  Specify the value InstantPaymentOnly.
				'paymentaction' => 'Sale', 					// How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order. 
				'paymentrequestid' => '',  				// A unique identifier of the specific payment request, which is required for parallel payments. 
				'sellerpaypalaccountid' => ''			// A unique identifier for the merchant.  For parallel payments, this field is required and must contain the Payer ID or the email address of the merchant.
				);
				


$Payment['order_items'] = $PaymentOrderItems;
array_push($Payments, $Payment);

$BuyerDetails = array(
						'buyerid' => '', 				// The unique identifier provided by eBay for this buyer.  The value may or may not be the same as the username.  In the case of eBay, it is different.  Char max 255.
						'buyerusername' => '', 			// The username of the marketplace site.
						'buyerregistrationdate' => ''	// The registration of the buyer with the marketplace.
						);
						
// For shipping options we create an array of all shipping choices similar to how order items works.
$ShippingOptions = array();
$Option = array(
				'l_shippingoptionisdefault' => '', 				// Shipping option.  Required if specifying the Callback URL.  true or false.  Must be only 1 default!
				'l_shippingoptionname' => '', 					// Shipping option name.  Required if specifying the Callback URL.  50 character max.
				'l_shippingoptionlabel' => '', 					// Shipping option label.  Required if specifying the Callback URL.  50 character max.
				'l_shippingoptionamount' => '' 					// Shipping option amount.  Required if specifying the Callback URL.  
				);
array_push($ShippingOptions, $Option);
		
$BillingAgreements = array();
$Item = array(
			  'l_billingtype' => 'MerchantInitiatedBilling', 							// Required.  Type of billing agreement.  For recurring payments it must be RecurringPayments.  You can specify up to ten billing agreements.  For reference transactions, this field must be either:  MerchantInitiatedBilling, or MerchantInitiatedBillingSingleSource
			  'l_billingagreementdescription' => 'Billing Agreement', 			// Required for recurring payments.  Description of goods or services associated with the billing agreement.  
			  'l_paymenttype' => 'Any', 							// Specifies the type of PayPal payment you require for the billing agreement.  Any or IntantOnly
			  'l_billingagreementcustom' => ''					// Custom annotation field for your own use.  256 char max.
			  );
array_push($BillingAgreements, $Item);

$PayPalRequest = array(
					   'SECFields' => $SECFields, 
					   'SurveyChoices' => $SurveyChoices, 
					   'BillingAgreements' => $BillingAgreements, 
					   'Payments' => $Payments
					   );

$SetExpressCheckoutResult = $PayPal -> SetExpressCheckout($PayPalRequest);

//echo '<a href="' . $SetExpressCheckoutResult['REDIRECTURL'] . '">Click here to continue.</a><br /><br />';
//echo '<pre />';

return $SetExpressCheckoutResult;

}

function address_fill($type,$key){

	if($type=='S'){
		$val = (isset($this->_shipping_info[$key]) && !empty($this->_shipping_info[$key]))?$this->_shipping_info[$key]:'';
	}elseif($type=='B'){
		$val = (isset($this->_billing_info[$key]) && !empty($this->_billing_info[$key]))?$this->_billing_info[$key]:'';
	}else{
		$val= '';
	}

	return $val;
}

}

?>