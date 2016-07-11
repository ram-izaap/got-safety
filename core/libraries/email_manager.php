<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_manager
{
	private $_CI;
	private $_cc = array();
	private $_bcc = array();

	public function __construct($options = array())
	{
		$this->_CI = & get_instance();
		$this->_CI->error_message = '';

		foreach ($options as $key => $value) 
		{
			$key = "_{$key}";
			if (isset($this->$key))
				$this->$key = $value;	
		}
		
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
	
	public function send_email($to, $toname, $from, $from_name, $subject, $message, $cc = array(),$attachments = array())
	{
		$this->_CI->config->load('email_config');
	
		$this->_CI->load->library('email', $this->_CI->config->item('email'));

		$this->_CI->email->clear(TRUE);
		
		$this->_CI->email->set_newline("\r\n");
	
		$this->_CI->email->from($from,$from_name);
		$this->_CI->email->to($to);
		$this->_CI->email->cc( array_merge($cc, $this->_cc) );
		$this->_CI->email->bcc($this->_bcc);

		$this->_CI->email->subject($subject);
		$this->_CI->email->message($message);
		foreach ($attachments as $file)
			$this->_CI->email->attach($file);
		
		if ( ! $this->_CI->email->Send())
			return FALSE;
		
		return TRUE;
	}
	
	function send_order_mail($so_id = 0, $status = null)
	{
		
		if(!$so_id)
			return FALSE;
	
		//get sales_order details
		$this->_CI->load->model('checkout_model');

		$result = $this->db->get_where("sales_order",array('id' => $so_id) );
        
        if(!$result->num_rows())
            return FALSE;
        
        $so_details = $result->row_array();
		
		$records = $this->checkout_model->get_product_details_by_sales_order($so_id);
        if(!count($records))
           return FALSE;
        
        $product_details = array();
        foreach ($records as $record)
        {
            $product_details[$record['product_id']]['sku']          = $record['sku'];
            $product_details[$record['product_id']]['name']         = $record['product_name'];
            $product_details[$record['product_id']]['sell_price']   = $record['unit_price'];
            if(isset($product_details[$record['product_id']]['quantity']))
                $product_details[$record['product_id']]['quantity'] += $record['quantity'];
            else
                $product_details[$record['product_id']]['quantity'] = $record['quantity'];
        }
        
        $data['so_details']         = $so_details;
        $data['status']				= $status;
        $data['product_details']    = $product_details;
        $data['billing'] = $this->checkout_model->get_address(array("id" => $so_details['billing_address_id'],"type"=>"ba"));
        $data['shipping'] = $this->checkout_model->get_address(array("id" => $so_details['shipping_address_id'],"type"=>"sa"));

        
        //$data['mail_type']			= 'customer';
		$data['so_id']				= $so_id;
		$data['message'] 			= $this->_CI->load->view('checkout/order-confirmation', $data, TRUE);
		
		$message = $this->_CI->load->view('checkout/system_email_template', $data, TRUE);
		
		if( strcmp($status,'FAILED') !== 0 ) 
		{	
			$mail_title = "Order Info - #{$so_id}";
		}
		else
		{
			$mail_title = "Order Info - #{$so_id} - Failed";
		}

		$this->send_email($data['billing']['email'], '', 'gavaskarizaap@gmail.com', 'gavaskar', "Order Confirmation Mail", $message);
		 
		$this->checkout_model->addaction_loginfo('sales_order', 'Order confirmation mail has been sent to customer', $so_id);

	}


	function send_fraudulent_order_mail($so_id = 0, $status = null)
	{
		
		if(!$so_id)
			return FALSE;
	
		//get sales_order details
		$this->_CI->load->model('sales_order_model');
		$result = $this->_CI->sales_order_model->get_where(array('id' => $so_id));
		
		if(!$result->num_rows())
			return FALSE;
		
		$result_set = $this->_CI->sales_order_model->check_fradulent($so_id);
        if( !count($result_set) )
        	return FALSE;

		$so_details = $result->row_array();
		
		//now get address
		$address_info = getAdddressBySoId($so_id, 'B', 'both');
		if(!$address_info)
			return FALSE;
		
		$address = $address_info['data']; 
		$formatted_address = $address_info['html']; 
		
		if(!isset($address['email']) && empty($address['email']))
			return FALSE;
		
		$email = $address['email'];
		$sales_channel_id = $so_details['sales_channel_id'];
		
		$path = is_null($sales_channel_id)?('email/'):("email/{$sales_channel_id}/");
		
		$data = array();
		$data['so_id'] 		= $so_id;
		$data['customer_name'] 	= trim($address['first_name'].' '.$address['last_name']);
		$data['message'] 	= $this->_CI->load->view($path.'fraudulent_order', $data, TRUE);
		$data['mail_type']	= 'customer';
		$data['so_id']		= $so_id;
		
		$message = $this->_CI->load->view($path.'system_email_template', $data, TRUE);
		
		$mail_title = "Fraudulent Order - #{$so_id}";
		

		//get email details
		$email_details = get_settings($sales_channel_id, 'general');
		if($email_details)
		{
			$this->send_email($email, '', $email_details['email_id'], $email_details['from_name'], "{$email_details['site_name']} - {$mail_title} ", $message, array($email_details['email_id']));
			actionLogAdd('sales_order','Fraudulent notification-email has been sent to customer.',$so_id);
		}
			
		return TRUE;
	}

	function send_po_email($so_id = null, $po_id = 0)
	{
		$this->_CI->load->model('sales_order_model');
		$this->_CI->load->model('purchase_model');
        $this->_CI->load->model('vendor_model');
		$this->_CI->load->model('purchase_order_prices_model');
		$this->_CI->load->library('encrypt');
		$this->_CI->config->load('support');
		
		if($po_id)
		{
            $po_details = $this->_CI->purchase_model->get_where(array('id' => $po_id))->row_array();
        
            if( !count($po_details) )
                return FALSE;
            
			$pos = array($po_id => $po_details['vendor_id']);
		}
		else
		{
			//get external vendors po_id as key and vendor_id as value
			$pos = $this->_CI->sales_order_model->get_external_vendors($so_id);
		}
		
		$result = $this->_CI->sales_order_model->get_where(array('id' => $so_id));
		
		if(!$result->num_rows() && (int)$so_id)
			return FALSE;
		

		if(!count($pos))
			return FALSE;
		
		$inc = 1;
		$so_details = array();
		$shipping_address = '';
		foreach($pos as $po_id => $vid)
		{
			$rows   = $this->_CI->purchase_model->get_po_item_details($po_id);
          
            if(!count($rows))
				continue;

			//check if the sales order status is HOLD
			$temp = current($rows);
			if($inc == 1 )
			{
				$so_id = (int)$temp['sales_order_id'];
				if($so_id)
				{
					$so_details = $this->_CI->sales_order_model->get_where(array('id' => $so_id))->row_array();
					if(strcmp($so_details['order_status'], 'HOLD') === 0)
						return FALSE;
				}
				
				$shipping_address = get_address_by_contact_id($temp['shipping_address_id'], 'html');
					if(!count($shipping_address))
						return FALSE;
			}
			
			if(strcmp($temp['po_type'], 'AUTO') === 0 AND strcmp($temp['ship_type'], 'STOCKED') === 0)
				continue;

			if(strcmp($temp['po_type'], 'MANUAL') === 0 && !(int)$temp['sales_order_id'])
			{
				$path = 'email/manual_po/';
				$this->_sales_channel_id = 1;
			}
			else
			{
				//check expected ship-date flag
				$this->_CI->load->helper('shipping');
				$shipment_flags = get_shipments_flag_by_ESD($temp['sales_order_id'], $vid);
				
				if( in_array(0, $shipment_flags) )
					return TRUE;
				
				$sales_channel_id = $so_details['sales_channel_id'];
				$path = is_null($sales_channel_id)?('email/'):("email/{$sales_channel_id}/");
			}

			if(!$this->_sales_channel_id)
				$this->_sales_channel_id = $so_details['sales_channel_id'];
			
            $vendor = $this->_CI->vendor_model->get_where(array('id' => $vid))->row_array();
              
			$data = array();
			$data['po_id']				= $po_id;
			$data['product_details'] 	= $rows;
			$data['shipping_address']  	= $shipping_address;
			$data['shipment_service']  	= $temp['shipment_service'];
			$data['shipping_type']  	= $temp['shipment_method'];
			$enc_data					= $this->_CI->encrypt->encode($so_id.",".$po_id.",".$temp['shipment_id']);
			$admin_url 					= $this->_CI->config->item('admin_url', 'support');

			$general_settings = get_settings($this->_sales_channel_id, 'general');
			$data['admin_url'] 			= "{$general_settings['admin_url']}/vendor_respond/add/$enc_data";
			$data['attachments']	    = $this->get_po_attachements($po_id);
            $data['po_info']			= $vendor['po_info'];
            $data['vendor']			    = $vendor;

            $this->_CI->load->model('purchase_model');
            $po_details  = $this->_CI->purchase_model->get_where(array('id' => $po_id))->row_array();
           	
            $data['po_message']			=  $po_details['po_message'];

			$data['message'] 			= $this->_CI->load->view('email/po/hh-purchase-order', $data, TRUE);
            
           	$total = 0;
            foreach ($data['product_details'] as $row)
            {
			     $total += ($row['quantity']*$row['unit_price']);
            }

            $data['sub_total'] = (float)$total;

            //get reconciled charges
		    $data['reconciled_charges'] = $this->_CI->purchase_order_prices_model->get_total_charge_by_po($po_id);

		    //get drop-ship fee
		    $data['dropship_fee'] = $this->_CI->purchase_model->get_dropship_fee($po_id);

		    $data['order_total'] = ($data['sub_total']+$data['reconciled_charges']+$data['dropship_fee']);
            $this->data = array(
                            'channel_details'   => $general_settings,
							'po_details' 		=> $po_details,
							'shipping_address' 	=> $data['shipping_address'],
							'billing_address' 	=> $data['shipping_address'],
							'item_details' 		=> $data['product_details'],
							'sub_total'         => $data['sub_total'],
                            'dropship_fee'      => $data['dropship_fee'],
                            'order_total'       => $data['order_total'],
                            'po_message'		=> $data['po_message'],
                            'vendor'			=> $vendor
							);
                           
           $content = $this->_CI->load->view('print/invoice_po', $this->data, TRUE);
                            
            $this->_CI->load->library('pdf');
            $pdf = $this->_CI->pdf->load();
            $pdf_path = BASEPATH_HTDOCS.'images/temp/'.'PO'.time().'.pdf';
            $pdf->WriteHTML($content); // write the HTML into the PDF
            $pdf->Output($pdf_path, 'F'); // save to file
            
            //Based on Sourced list
            $sourced_list = array('HH','HL','ZING');

            if(isset($vendor['sourced']) && in_array($vendor['sourced'],$sourced_list)){

            	$tmplat_path = 'email/po/'.$vendor['sourced'].'_';
            }else{
            	$tmplat_path = 'email/po/HH_';
            }

			$message = $this->_CI->load->view($tmplat_path.'email_template', $data, TRUE);
			
			//sales channel id change based on vendor sourced
			if(isset($vendor['sourced']) && $vendor['sourced']=='HL')
				$this->_sales_channel_id=12;
			elseif(isset($vendor['sourced']) && $vendor['sourced']=='ZING')
				$this->_sales_channel_id=3;
			else
				$this->_sales_channel_id=1;
			
			//get email details
			$email_details = get_settings($this->_sales_channel_id, 'general');
			
			if(strcmp($temp['vendor_order_type'], 'email') === 0 && $temp['order_email'])
			{
				$cc_email = array($email_details['email_id'],'ram.izaap@gmail.com');

				if(strcmp($temp['po_type'], 'MANUAL') === 0){
					$admin_email = get_adminuser_details_by_id(getAdminUserId());

					if($admin_email)
						$cc_email[] = $admin_email['email'];
				}

				$attachments = array();
                $attachments[]= $pdf_path;
				$this->send_email($temp['order_email'], '', $email_details['email_id'], $email_details['from_name'], "{$email_details['site_name']} - Purchase Order#{$po_id}", $message, $cc_email, $attachments);
				actionLogAdd('purchase',"PO#{$po_id} : Purchase order mail has been sent to vendor \"{$temp['vendor_name']}\".",$po_id);
			}
            //unlink($pdf_path);
			$inc++;

		}
		
		return TRUE;
	}

	function send_shipment_confirmation($ship_id = null)
	{
	
		if(!$ship_id)
			return FALSE;
	
		//get sales_order details
		$this->_CI->load->model('shipment_model');
		$this->_CI->load->model('sales_order_model');
		
		$result = $this->_CI->shipment_model->get_where(array('id' => $ship_id));
		if(!$result->num_rows())
			return FALSE;
		$result = $result->row_array();
		$so_id 		= $result['sales_order_id'];
		$vendor_id  = $result['vendor_id'];
		$tracking_no = $result['tracking'];
		$shipment_service = $result['shipment_service'];
		
		$result = $this->_CI->sales_order_model->get_where(array('id' => $so_id));
	
		if(!$result->num_rows())
			return FALSE;
	
		$so_details = $result->row_array();

		//chech Shipping confirmation email 
		$shipping_confirm_mail = get_ordermeta('shipping_email', $so_id);
		if($shipping_confirm_mail && $shipping_confirm_mail=='N')
			return FALSE;
	
		//now get address
		$address_info = getAdddressBySoId($so_id, 'S', 'both');
		if(!$address_info)
			return FALSE;
	
		$address = $address_info['data'];
		$formatted_address = $address_info['html'];
	
		if(!isset($address['email']) && empty($address['email']))
			return FALSE;
	
		$email = $address['email'];
		$sales_channel_id = $so_details['sales_channel_id'];
	
		$payment = array();
		$payment['shipping_cost'] 	= (float)$so_details['total_shipping'];
		$payment['discount'] 		= (float)$so_details['total_discount'];
		$payment['total'] 			= (float)$so_details['total_amount'];
		$payment['total_tax'] 		= (float)$so_details['total_tax'];
		$payment['cart_total'] 		= (float)$so_details['total_amount']+(float)$so_details['total_discount']-(float)$so_details['total_shipping']-(float)$so_details['total_tax'];
	
			
		//get products from sales_order_id
		$records = $this->_CI->sales_order_model->get_product_details_by_sales_order($so_id);
		if(!count($records))
			return FALSE;
	
		$product_details = array();
		foreach ($records as $record)
		{
			if($record['vendor_id'] != $vendor_id)
				continue;
			
			$product_details[$record['product_id']]['sku'] 			= $record['sku'];
			$product_details[$record['product_id']]['name'] 		= $record['product_name'];
			$product_details[$record['product_id']]['sell_price'] 	= $record['unit_price'];
			if(isset($product_details[$record['product_id']]['quantity']))
				$product_details[$record['product_id']]['quantity'] += $record['quantity'];
			else
				$product_details[$record['product_id']]['quantity'] = $record['quantity'];
		}
	
	
		$path = is_null($sales_channel_id)?('email/'):("email/{$sales_channel_id}/");
	
		$data = array();
		$data['so_id']				= $so_id;
		$data['tracking_no']		= $tracking_no;
		$data['shipment_service']	= $shipment_service;
		$data['product_details'] 	= $product_details;
		$data['address']  			= $address;
		$data['formatted_address']  = $formatted_address;
		$data['payment']			= $payment;
		$data['message'] 			= $this->_CI->load->view($path.'hh-shipment', $data, TRUE);
		$data['mail_type']			= 'customer';
		$data['so_id']				= $so_id;
	
		$message = $this->_CI->load->view($path.'system_email_template', $data, TRUE);
		
		//get email details
		$email_details = get_settings($sales_channel_id, 'general');
		if($email_details)
		{
			//check if sales rep is associated with this order and email_copy flag is enabled.
			$cc = array($email_details['email_id']);
			
			//get sales rep and cc email list
			$cc_list = $this->get_cc_email_list($so_id,$cc);

			if( isset($this->_CI->user_data['id']) )
            {
            	$temp_email = get_usermeta('order_email', $this->_CI->user_data['id']);

            	if( strcmp(trim($temp_email), '') !== 0)
            		$email = $temp_email;

            }

			$this->send_email($email, '', $email_details['email_id'], $email_details['from_name'], "{$email_details['site_name']} - Shipment Info ", $message, $cc_list);
			actionLogAdd('shipment',"Shipment #{$ship_id}: Shipment confirmation mail has been sent to customer.",$ship_id);
		}
			
		return TRUE;
	}
	function send_backorder_shipment($ship_id = null)
	{
	
		if(!$ship_id)
			return FALSE;
		
		//get sales_order details
		$this->_CI->load->model('shipment_model');
		$this->_CI->load->model('sales_order_model');
		
		$result = $this->_CI->shipment_model->get_where(array('id' => $ship_id));
		if(!$result->num_rows())
			return FALSE;
		$result = $result->row_array();
		$so_id 		= $result['sales_order_id'];
		$vendor_id  = $result['vendor_id'];
		$tracking_no = $result['tracking'];
		$shipment_service = $result['shipment_service'];
		
		$result = $this->_CI->sales_order_model->get_where(array('id' => $so_id));
	
		if(!$result->num_rows())
			return FALSE;
	
		$so_details = $result->row_array();
	
		//now get address
		$address_info = getAdddressBySoId($so_id, 'S', 'both');
		if(!$address_info)
			return FALSE;
	
		$address = $address_info['data'];
		$formatted_address = $address_info['html'];
	
		if(!isset($address['email']) && empty($address['email']))
			return FALSE;
	
		$email = $address['email'];
		$sales_channel_id = $so_details['sales_channel_id'];
	
		$payment = array();
		$payment['shipping_cost'] 	= (float)$so_details['total_shipping'];
		$payment['discount'] 		= (float)$so_details['total_discount'];
		$payment['total'] 			= (float)$so_details['total_amount'];
		$payment['total_tax'] 		= (float)$so_details['total_tax'];
		$payment['cart_total'] 		= (float)$so_details['total_amount']+(float)$so_details['total_discount']-(float)$so_details['total_shipping']-(float)$so_details['total_tax'];
	
			
		//get products from sales_order_id
		$records = $this->_CI->sales_order_model->get_product_details_by_sales_order($so_id);
		if(!count($records))
			return FALSE;
	
		$product_details = array();
		foreach ($records as $record)
		{
			if($record['vendor_id'] != $vendor_id)
				continue;
			
			$product_details[$record['product_id']]['sku'] 			= $record['sku'];
			$product_details[$record['product_id']]['name'] 		= $record['product_name'];
			$product_details[$record['product_id']]['sell_price'] 	= $record['unit_price'];
			if(isset($product_details[$record['product_id']]['quantity']))
				$product_details[$record['product_id']]['quantity'] += $record['quantity'];
			else
				$product_details[$record['product_id']]['quantity'] = $record['quantity'];
		}
	
	
		$path = is_null($sales_channel_id)?('email/'):("email/{$sales_channel_id}/");
	
		$data = array();
		$data['so_id']				= $so_id;
		$data['tracking_no']		= $tracking_no;
		$data['shipment_service']	= $shipment_service;
		$data['product_details'] 	= $product_details;
		$data['formatted_address']  = $formatted_address;
		$data['payment']			= $payment;
		$data['message'] 			= $this->_CI->load->view($path.'hh-backorder-shipment', $data, TRUE);
		$data['mail_type']			= 'customer';
		$data['so_id']				= $so_id;
	
		$message = $this->_CI->load->view($path.'system_email_template', $data, TRUE);
		
		//get email details
		$email_details = get_settings($sales_channel_id, 'general');
		if($email_details)
		{
			$this->send_email($email, '', $email_details['email_id'], $email_details['from_name'], "Regarding your Zing Anything order", $message, array($email_details['email_id']));
			actionLogAdd('shipment','Shipment #{'.$ship_id.'}: Back Order Shipment mail has been sent to customer.',$ship_id);
		}
			
		return TRUE;
	}
	
	function send_refund_confirmation($refund_id)
	{
		$this->_CI->load->model('refund_model');
		
		$refund_details = $this->_CI->refund_model->get_refund_details($refund_id);
		
		if(!count($refund_details))
			return FALSE;
		
		$data['so_id'] 		= $refund_details['sales_order_id'];
		$data['amount']		= $refund_details['refunded_amount'];
		$data['name']		= $refund_details['name'];
		$email				= $refund_details['email'];
		$sales_channel_id 	= $refund_details['sales_channel_id'];
		$refund_products = $this->_CI->refund_model->get_refund_products_with_qty($refund_id);
		
		//get products from sales_order_id
		$records = $this->_CI->sales_order_model->get_product_details_by_sales_order($data['so_id']);
		
		if(!count($records))
			return FALSE;
		
		$product_details = array();
		foreach ($records as $record)
		{
			if(!isset($refund_products[$record['product_id']]))
				continue;
			
			$product_details[$record['product_id']]['sku'] 			= $record['sku'];
			$product_details[$record['product_id']]['name'] 		= $record['product_name'];
			$product_details[$record['product_id']]['sell_price'] 	= $record['unit_price'];
			$product_details[$record['product_id']]['quantity'] 	= $refund_products[$record['product_id']];
			
		}
		
		$data['product_details']= $product_details;
		
		if(!empty($email))
		{
			$data['message'] 	= $this->_CI->load->view("email/{$sales_channel_id}/hh-refund", $data, TRUE);
			$message = $this->_CI->load->view("email/{$sales_channel_id}/system_email_template", $data, TRUE);
	
			//get email details
			$email_details = get_settings($sales_channel_id, 'general');
			if($email_details)
			{
				$this->send_email($email, '', $email_details['email_id'], $email_details['from_name'], "{$email_details['site_name']} - Refund Request ", $message, array($email_details['email_id']));
				actionLogAdd('refunds',"Refund Confirmation mail has been sent to customer.",$refund_id);
			}
		}
	
		return true;
	}
	
	function send_sign_up_confirmation($data = array())
	{
		//send email to user.
		$data['name'] 		= "{$data['first_name']} {$data['first_name']}";
		$data['email'] 		= $data['email'];
		$data['password'] 	= $data['passwd'];
		
		$data['message'] = $this->_CI->load->view('email/'.$this->_CI->sales_channel_id.'/welcome-html', $data, TRUE);
		
		$message = $this->_CI->load->view('email/'.$this->_CI->sales_channel_id.'/system_email_template', $data, TRUE);
		
		$this->load->helper('email_config');
		$email_details = get_settings($this->_CI->sales_channel_id, 'general');
		if($email_details)
		{
			if(!$this->send_email($data['email'], $data['name'], $email_details['email_id'], $email_details['from_name'], "Welcome to {$email_details['site_name']}", $message))
			{
				$this->_CI->error_message = "Email sending is failed.";
				return FALSE;
			}
				
		}
			
		return TRUE;
	}
	
	function get_po_attachements($po_id)
	{
		$this->_CI->db->select('*');
		$this->_CI->db->from('purchase_order_attachments');
		$this->_CI->db->where('purchase_order_id', $po_id);
		$query = $this->_CI->db->get();
		
		if(!$query->num_rows())
			return FALSE;
		
		$layout = get_settings($this->_sales_channel_id, 'layout');
		$result = $query->result_array();
		$attachments = array();
		foreach ($result as $row)
		{
			$attachments[] = array('filename' => str_replace("$po_id/", '', $row['file_name']), 'link' => "{$layout['po_attachment_url']}{$row['file_name']}");
		}
		
		return $attachments;
	}
	
	function get_sales_rep_email_id( $so_id=0 )
	{
		$this->_CI->load->model('sales_rep_model');
		$result = $this->_CI->sales_rep_model->get_sales_rep_by_so( $so_id );
		
		if( !count($result) )
			return FALSE;
		
		if( strcmp($result['email_copy'], 'N') === 0 )
			return FALSE;
		
		if( strcmp(trim($result['email']), '') === 0 )
			return FALSE;
		
		return $result['email'];
	}

	function get_cc_email_list($so_id=0,$cc=array() ){

		$sales_rep_email_id = $this->get_sales_rep_email_id( $so_id );
		if( $sales_rep_email_id !== FALSE )
			$this->_bcc[] = $sales_rep_email_id;			

		//get cc emails for usermeta
		$cc_emails = array();
		if(count($this->_CI->user_data)){
			$ccemails = get_usermeta('cc_emails', $this->_CI->user_data['id']);

			if($ccemails){
				$cc_emails = explode(',',$ccemails);
			}
	    }	
	    
	    $cc_emails = array_merge($cc_emails, $cc);
	    
	    return $cc_emails;
	}

}