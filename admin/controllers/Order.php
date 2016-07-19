<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Order extends Admin_controller {
	
	
   function __construct() 
    {
        parent::__construct();
        
        $this->load->model('order_model');
    }


    function index()
    { 
                 
		 $this->layout->add_javascripts(array('listing', 'rwd-table'));  

		 $this->load->library('listing');        
        
         $this->simple_search_fields = array('id' => 'Order Number','name' =>'Customer Name','order_status'=>'Order Status','payment_type'=>'Payment Type');
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('order/view_order_details/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-eye"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('order_model', 'listing');

        if($this->input->is_ajax_request())
            $this->_ajax_output(array('listing' => $listing), TRUE);
        
        $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
        $this->data['simple_search_fields'] = $this->simple_search_fields;
        $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
        $this->data['per_page'] = $this->listing->_get_per_page();
        $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
        
        $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);        
        
        $this->data['listing'] = $listing;
        
        $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
        
        if(is_logged_in())       
            $this->layout->view("order/order_list");
        else
            redirect("login");
        
    }

    function view_order_details($order_id)
    {
        $this->load->model("checkout_model");

        $result = $this->db->get_where("sales_order",array('id' => $order_id) );
        
        if(!$result->num_rows())
            return FALSE;
        
        $so_details = $result->row_array();

        $product_details = $this->checkout_model->get_product_details_by_sales_order($order_id);

        if(!count($product_details))
            return FALSE;

        $this->data['product_details']    = $product_details;
        $this->data['so_details']         = $so_details;
        $this->data['billing'] = $this->checkout_model->get_address(array("id" => $so_details['billing_address_id'],"type"=>"ba"));
        $this->data['shipping'] = $this->checkout_model->get_address(array("id" => $so_details['shipping_address_id'],"type"=>"sa"));
        $this->data['order_log'] = $this->checkout_model->get_order_log(array('action_id'=>$so_details['id']));
        $this->data['title'] = "Order Information";
        $this->data['crumb'] = "Order Information";
        if(is_logged_in())
            $this->layout->view("order/order_info");
        else
            redirect("login");
    } 
    
    
 }

