<?php 

//safe_include("controllers/app_controller.php");
safe_include("libraries/controllers/Cart_controller.php");
class Checkout extends Cart_controller {

    
    function __construct()
    {
        parent::__construct();
        $this->load->library("cart");
        $this->load->model("checkout_model");
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
            $this->data['cat_data'][$key]['p_count'] = $this->data['p_count']->cnt;
        }
        $this->data['title'] = "Checkout";

        $this->data['billing_information'] = $this->load->view("checkout/billing_information",$this->data,true);

        $this->data['shipping_information'] = $this->load->view("checkout/shipping_information",$this->data,true);

        $this->data['payment_information'] = $this->load->view("checkout/payment_information",$this->data,true);

        $this->data['order_information'] = $this->load->view("checkout/order_information",$this->data,true);
        
        $this->layout->view("checkout/checkout","frontend");

        
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

    
}