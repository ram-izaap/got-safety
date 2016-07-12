<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
require_once(COREPATH."controllers/App_controller.php");

class Cart_controller extends App_Controller {

    
    function __construct()
    {
        parent::__construct();
        $this->load->helper("admin_helper");
        $this->load->library('email_manager');
    }

    function submit_order()
    {
      $form = $this->input->post();
            
      $shipment = array();
      $payment = array();
            
      if($this->session->userdata('shipping_info'))
          $shipment   = $this->session->userdata('shipping_info');
      if($this->session->userdata('billing_info'))
          $payment    =  $this->session->userdata('billing_info');

       $user_id = $this->check_existing_user();

       $process_type = 'authorize';

       if(strcmp($form['pay_type'], 'paypal') === 0 )
          $process_type = 'paypal';

       switch( $process_type)
       {

          case 'authorize':

          $cards = array(
                        'payment_type'  => $form['pay_type'],
                        'cc_name'       => $form['cc_name'],
                        'cc_type'       => $form['card_type'],
                        'cc_number'     => $form['cc_number'],
                        'cc_month'      => $form['exp_month'],
                        'cc_year'       => $form['exp_year'],
                        'cc_ccd'        => $form['cc_ccd']
                    );

            $this->session->set_userdata('payment_card_details', $cards);
            
            $this->create_orders('authorize', $user_id);

            $so_id = $this->session->userdata('so_id');

            //if(!$so_id)
                //echo json_encode(array("status"=>"Order Creation Failed."));exit;

            $this->load->library('authorize');
            $shipment_info  = $this->session->userdata('shipping_info');
            $payment = $this->session->userdata('billing_info');
            $card_details = $this->session->userdata('payment_card_details');
            $tax = $this->session->userdata['tax_amt'];
            $shipping_cost = $this->session->userdata['ship_amt'];
            
            

            $amount = round_amount( $this->cart->total() ) + round_amount( $shipping_cost['shipping_amt'] ) + round_amount( $tax['tax_amt'] );
            
            $params = array();
            $params['shipping_info']    = $shipment_info;
            $params['billing_info']     = $payment;
            $params['card_details']     = $card_details;
            $params['payable_amount']   = $amount;
            $params['invoice_num']      = $so_id;
            
            //format a description to attach with order details which will be usefull to identify the order
            $description = '';
            foreach ($this->cart->contents() as $row)
            {
                $temp = isset($row['sku'])?"{$row['sku']}-{$row['qty']}":"{$row['id']}-{$row['qty']}-";
                $description .= (strcmp($description, '') === 0)?$temp:",{$temp}";
            }
            $description = "Item(s):{$description}.";
            /*
             *check if the length of description is greater than 250.
            *Because authorize.net wont allow more than 255 characters
            */
            if(strlen($description)>250 )
                $description = substr($description, 0, 250);
            $params['description']      = $description;

            
            //initialize params
            $this->authorize->initialize($params);
                                
            $auth_status = $this->authorize->process_order();
            $response = $this->authorize->get_response();
            
            if($auth_status === FALSE)
            {
                $update_data = array('order_status' => 'FAILED','paid_status'=>'N');
                $this->db->where('id', $so_id);
                $this->db->update('sales_order', $update_data);
                $error_message = isset($response[3])?$response[3]:'Payment could not be processed.';
                $this->checkout_model->addaction_loginfo('sales_order', 'Payment Declined:'.$error_message, $so_id);
            }
            else
            {

                $update_data = array();
                $update_data['txn_id']          = $response[6];
                $update_data['cc_last_digits']  = $response[50];
                $this->db->where('id', $so_id);
                $this->db->update('sales_order', $update_data);
                $this->is_paid = TRUE;
                $this->paid_amount = $amount;
                $this->after_payment($so_id);
            }

            $this->remove_session();
            break;
       }

       $message = 'success';
       $status = 'success';
       $this->session->set_flashdata('message', 'Your Order has been processed successfully. Thank You.');
       $this->session->set_flashdata('so_id1', $so_id);
       echo json_encode(array('status' => $status, 'message' => $message));

    } 

    function check_existing_user()
    {
      $payment = $this->session->userdata('billing_info');

      $result = $this->db->get_where("users",array("email" => $payment['email']));

      $result = $result->row();

      if(count($result) >0 )
      {
        return $result->id;
      }
      
      else
      {

        $user_data = array(
           'name' => $payment['name'],
           'password' => md5($payment['name']),
           'plan_type' => '',
           'ori_password' => $payment['name'],
           'email' => $payment['email'],
           'language' => 1,
           'role' => 2,
           'phone' => $payment['phone'],
           'employee_limit' => '',
           'is_active' => 1,
           'created_id' => 8,
           'created_date' => date("Y-m-d H:i:s")
           );
        $this->db->insert("users",$user_data);
        $last_insert_id = $this->db->insert_id();
        return $last_insert_id;
      }
    }

    function create_orders($payment_type = '', $user_id)
    {
      $card_details = $this->session->userdata('payment_card_details');
      $ship_cost = $this->session->userdata('ship_amt');
      $tax_cost = $this->session->userdata('tax_amt');

      if($payment_type == '')
         return false;

      $this->update_billing_shipping_address($user_id);

      $shipment_info  = $this->session->userdata('shipping_info');
      $payment_info   = $this->session->userdata('billing_info');

      $total_amount = (float)$this->cart->total()+(float)$ship_cost['shipping_amt']+(float)$tax_cost['tax_amt'];

      $data = array();
      $data['customer_id']            = $user_id;
      $data['order_status']            = "PENDING";
      $data['cart_total']         = $this->cart->total();
      $data['total_amount']         = $total_amount;
      $data['total_items']         = $this->cart->total_items();
      $data['payment_type']         = $payment_type;
      $data['shipping_address_id'] = $shipment_info['shipping_id'];
      $data['billing_address_id'] = $payment_info['billing_id'];
      $data['tax']                = $tax_cost['tax_amt'];
      $data['shipping']           = $ship_cost['shipping_amt'];
      $data['created_date']         = date("Y-m-d H:i:s");


      $so_id = $this->checkout_model->create_sales_order("sales_order", $data);

      $this->session->set_userdata('so_id', $so_id);

      if($so_id)
      {

        foreach($this->cart->contents() as $items)
        {
          $data = array();
          $data['product_id'] = $items['options']['product_id'];
          $data['attr_id'] = $items['attr_id'];
          $data['attr_val_id'] = $items['attr_val_id'];
          $data['item_status'] = "ACCEPTED";
          $data['unit_price'] = $items['price'];
          $data['quantity'] = $items['qty'];
          $data['sales_order_id'] = $so_id;
          $data['created_date'] = date("Y-m-d H:i:s");
          $id = $this->checkout_model->create_sales_order("sales_order_item", $data);

        }

      }
    }

    function update_billing_shipping_address($userid)
    {
      $payment  = $this->session->userdata('billing_info');
      $shipment   = $this->session->userdata('shipping_info');
      $user_id  = $userid;

      $billing_id = $this->create_or_update_address($payment,$userid);
      $payment['billing_id'] = $billing_id;
      $this->session->set_userdata('billing_info', $payment);
      
      $shipping_id = $this->create_or_update_address($shipment,$userid);
      $shipment['shipping_id'] = $shipping_id;
      $this->session->set_userdata('shipping_info', $shipment);
    }

    function create_or_update_address($data = array(),$userid)
    {
    
      $where  = ' WHERE 1=1 ';
      $join = '';
      $where .= isset($data['name'])?("AND address.name='".$this->db->escape_str($data['name'])."' "):('');
      $where .= isset($data['company_name'])?("AND address.company_name='".$this->db->escape_str($data['company_name'])."' "):('');
      $where .= isset($data['email'])?("AND address.email='".$this->db->escape_str($data['email'])."' "):('');
      $where .= isset($data['phone'])?("AND address.phone='".$this->db->escape_str($data['phone'])."' "):('');
      $where .= isset($data['address'])?("AND address.address='".$this->db->escape_str($data['address'])."' "):('');
      $where .= isset($data['city'])?("AND address.city='".$this->db->escape_str($data['city'])."' "):('');
      $where .= isset($data['state'])?("AND address.state='".$this->db->escape_str($data['state'])."' "):('');
      $where .= isset($data['country'])?("AND address.country='".$this->db->escape_str($data['country'])."' "):('');
      $where .= isset($data['zip_code'])?("AND address.zip_code='".$this->db->escape_str($data['zip_code'])."' "):('');
      $where .= isset($data['type'])?("AND address.type='".$this->db->escape_str($data['type'])."' "):('');
    
      $result = $this->db->query("select address.id from address $join $where");
    
      $address_id = 0;
      if($result->num_rows())
      {
        $address_id = $result->row()->id;
      }
      
      else
      {
        $address = array(
            'name'  => $data['name'],
            'company_name'   => isset($data['company_name'])? $data['company_name'] : '',
            'email'   => $data['email'],
            'phone'    => $data['phone'],
            'address'    => $data['address'],
            'state'       => $data['state'],
            'city'        => $data['city'],
            'country'   => $data['country'],
            'zip_code'     => $data['zip_code'],
            'type'  => $data['type'],
            'userid' =>$userid,
            'created_date'  => date("Y-m-d H:i:s")
        );
          
        $this->db->insert('address', $address);
        $address_id = $this->db->insert_id();
      }

      return $address_id;
    }

    function after_payment( $so_id = 0 )
    {

        $order_status = 'COMPLETED';
        $update_data = array();
        $update_data['order_status']    = $order_status;
        $update_data['paid_status']     = $this->is_paid?'Y':'N';
        $this->db->where('id', $so_id);
        $this->db->update('sales_order', $update_data);

        $this->email_manager->send_order_mail($so_id);

    }

    function remove_session()
    {
      $this->session->unset_userdata('shipping_info');
      $this->session->unset_userdata('billing_info');
      $this->session->unset_userdata('so_id');
      $this->session->unset_userdata('payment_card_details');
      $this->session->unset_userdata('ship_amt');
      $this->session->unset_userdata('tax_amt');
      $this->cart->destroy();
    }

    function success( $so_id = 0 )
    {

        if( !$so_id && !$this->session->flashdata('so_id1') )
            redirect('');
        
        $so_id = $so_id?$so_id:$this->session->flashdata('so_id1');
        
        $this->load->model('checkout_model');
        
        $result = $this->db->get_where("sales_order",array('id' => $so_id) );
        
        if(!$result->num_rows())
            redirect('');
        
        $so_details = $result->row_array();


        $records = $this->checkout_model->get_product_details_by_sales_order($so_id);
        if(!count($records))
            redirect('');
        
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
        
        $this->data['product_details']    = $product_details;
        $this->data['so_details']         = $so_details;

        $this->data['billing'] = $this->checkout_model->get_address(array("id" => $so_details['billing_address_id'],"type"=>"ba"));
        $this->data['shipping'] = $this->checkout_model->get_address(array("id" => $so_details['shipping_address_id'],"type"=>"sa"));

        
        $this->layout->view('/checkout/payment_success', 'frontend');
    }

}
?>
