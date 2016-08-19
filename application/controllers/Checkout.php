<?php 

//safe_include("controllers/app_controller.php");
safe_include("libraries/controllers/Cart_controller.php");
class Checkout extends Cart_controller {

    
    function __construct()
    {
        parent::__construct();
        $this->load->library("cart");
        $this->load->model("checkout_model");

        if($this->session->userdata('user_detail')['role']!=2 || $this->session->userdata('user_id') == "")
        {
            redirect("");
        }

    }

    function index()
    {


        $this->load->model("product1_model");

        $country_list = $this->checkout_model->get_data("countries");
        $state_list = $this->checkout_model->get_data("states");

        $this->data['countries'] = $country_list;
        $this->data['states'] = $state_list;

        $this->load->model("cart_model");

        $tax = $this->cart_model->get_other_cost("tax_amt"); 
        
        $ship_cost = $this->cart_model->get_other_cost("ship_amt");

        if(!$this->session->userdata('tax_amt')) 
            $tax_amt = $this->session->set_userdata("tax_amt",$tax);

        if(!$this->session->userdata('ship_amt')) 
            $ship_amt = $this->session->set_userdata("ship_amt",$ship_cost);



        $this->data['cat_data'] = $this->product1_model->get_product("category",NULL);
        $this->data['img_url'] = get_img_dir();
        foreach($this->data['cat_data'] as $key=>$value)
        {
            $this->data['p_count'] = $this->product1_model->get_product_count("products",array("cat" =>$value['id'],"is_active"=>1));
            $this->data['cat_data'][$key]['p_count'] = count($this->data['p_count']);
        }

        if($this->session->userdata("email1")!='' && !$this->session->userdata('billing_info') && !$this->session->userdata('shipping_info')) 
         { 

            $userid = $this->session->userdata("user_id");

            $email = $this->session->userdata("email1");

            $billing_address = $this->checkout_model->get_address1(array("type"=>"ba","userid"=>$userid));

            $billing_info = array(
               'name' => $billing_address['name'],
               'company_name' => $billing_address['company_name'],
               'email' => $this->session->userdata("email1"),
               'phone' => $billing_address['phone'],
               'address' => $billing_address['address'],
               'state' => $billing_address['state'],
               'city' => $billing_address['city'],
               'country' => $billing_address['country'],
               'zip_code' => $billing_address['zip_code'],
               'type' => 'ba'
            );

            $this->session->set_userdata('billing_info', $billing_info);

            

            $shipping_address = $this->checkout_model->get_address1(array("type"=>"sa","userid"=>$userid));

            $shipping_info = array(
               'name' => $shipping_address['name'],
               'company_name' => $shipping_address['company_name'],
               'email' => $shipping_address['email'],
               'phone' => $shipping_address['phone'],
               'address' => $shipping_address['address'],
               'state' => $shipping_address['state'],
               'city' => $shipping_address['city'],
               'country' => $shipping_address['country'],
               'zip_code' => $shipping_address['zip_code'],
               'type' => "sa"

           );

          $this->session->set_userdata('shipping_info', $shipping_info);
         }
         
        $this->data['title'] = "Checkout";

        $this->data['billing_information'] = $this->load->view("checkout/billing_information",$this->data,true);

        $this->data['shipping_information'] = $this->load->view("checkout/shipping_information",$this->data,true);

        $this->data['payment_information'] = $this->load->view("checkout/payment_information",$this->data,true);

        $this->data['order_information'] = $this->load->view("checkout/order_information",$this->data,true);

        if(count($this->cart->contents()) > 0)
           $this->layout->view("checkout/checkout","frontend");
        else
          redirect('');


    } 

    function save_billing_address()
    {
        $form = $this->input->post();

        $billing_info = array(
           'name' => $form['name'],
           'company_name' => $form['company_name'],
           'email' => $form['email'],
           'phone' => $form['phone'],
           'address' => $form['address'],
           'state' => $form['state'],
           'city' => $form['city'],
           'country' => $form['country'],
           'zip_code' => $form['zip_code'],
           'type' => 'ba'

       );
        $this->session->set_userdata('billing_info', $billing_info);
        $content = $this->load->view("checkout/billing_information",$this->session->userdata('billing_info'),true);
        $status="success";
        echo json_encode(array("status"=>$status,"content"=>$content));

    }  

    function save_shipping_address()
    {
        $form = $this->input->post();

        $shipping_info = array(
           'name' => $form['name'],
           'company_name' => $form['company_name'],
           'email' => $form['email'],
           'phone' => $form['phone'],
           'address' => $form['address'],
           'state' => $form['state'],
           'city' => $form['city'],
           'country' => $form['country'],
           'zip_code' => $form['zip_code'],
           'type' => "sa"

       );

        $this->session->set_userdata('shipping_info', $shipping_info);
        $content = $this->load->view("checkout/shipping_information",$this->session->userdata('shipping_info'),true);
        $status="success";
        echo json_encode(array("status"=>$status,"content"=>$content));

    }

    function set_billing_address()
    {
      $country_list = $this->checkout_model->get_data("countries");
      $state_list = $this->checkout_model->get_data("states");
      $this->data['countries'] = $country_list;
      $this->data['states'] = $state_list;
      $this->data['billing_info'] = $this->session->userdata('billing_info');
      $content = $this->load->view("checkout/billing_information_list",$this->data,true);
      $status="success";
      echo json_encode(array("status"=>$status,"content"=>$content,"type"=>"billing"));
    } 

    function set_shipping_address()
    {
      $country_list = $this->checkout_model->get_data("countries");
      $state_list = $this->checkout_model->get_data("states");
      $this->data['countries'] = $country_list;
      $this->data['states'] = $state_list;
      $this->data['shipping_info'] = $this->session->userdata('shipping_info');
      $content = $this->load->view("checkout/shipping_information_list",$this->data,true);
      $status="success";
      echo json_encode(array("status"=>$status,"content"=>$content,"type"=>"shipping"));
    }
    public function shop_coupon_apply()
    {
      $code = $this->input->post("code");
      $sku = explode(",",$this->input->post("sku"));
      $sub_amt = $this->input->post("sub_amt");
      $user_id = $this->session->userdata('user_detail')['id'];
      $get_data = $this->checkout_model->get_coupon_data($code);
      $chk = $this->checkout_model->check_coupon_applied($user_id,$get_data['c_id']);
      if(!$this->session->userdata('coupon_details'))
      {
        $amt = $get_data['value'];
        $p_sku = explode(",",$get_data['offer']);
        if($get_data)
        {
           /*For All Orders*/
           if($get_data['offer_type']=="1")
           {
              if($get_data['offer'] < $sub_amt)
              {
                if($get_data['discount_type']=="1")
                {
                  $t_amt = $sub_amt - $amt;
                  $ans = $get_data['value'];
                }
                else
                {
                  $t_amt = $sub_amt - (($sub_amt / 100) * $amt);
                  $ans = (($sub_amt / 100) * $amt);
                }
              }
              else
              {
                echo "Less";
                exit;
              }
            }
            /*For Shipping*/
            else if($get_data['offer_type']=="2")
            {
              if($get_data['discount_type']=="1")
                {
                  $t_amt = $sub_amt - $amt;
                  $ans = $get_data['value'];
                }
                else
                {
                  $t_amt = $sub_amt - (($sub_amt / 100) * $amt);
                  $ans = (($sub_amt / 100) * $amt);
                }
            }
            /*For Specific Products Only*/
            else if($get_data['offer_type']=="3")
            {
              if(!array_intersect($sku,$p_sku))
              {
                if($get_data['discount_type']=="1")
                {
                  $t_amt = $sub_amt - $amt;
                  $ans = $get_data['value'];
                }
                else
                {
                  $t_amt = $sub_amt - (($sub_amt / 100) * $amt);
                  $ans = (($sub_amt / 100) * $amt);
                }
              }
              else
              {
                echo "Not Matched";
                exit;
              }
            }
            $ins_data['user_id'] = $user_id;
            $ins_data['code'] = $code;
            $ins_data['coupon_id'] = $get_data['c_id'];
            $ins_data['plan_id'] = 0;
            $ins_data['offer_type'] = $get_data['offer_type'];
            $ins_data['org_amount'] = $sub_amt;
            $ins_data['discount_amount'] = $ans;
            $ins_data['total'] = $t_amt;
            //$cid = $this->checkout_model->insert("coupon_applied",$ins_data);
            $this->session->set_userdata('coupon_details',$ins_data);
            $this->data['coupon']=array("code"=>$code,"ans"=>$ans);
            $this->load->view("coupon_applied",$this->data);
        }
        else
          echo "Invalid";
      }
      else
          echo "Already";

    }   
}