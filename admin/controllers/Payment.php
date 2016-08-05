<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Payment extends Admin_controller 
{
	protected $_pay_validation_rules =    array (
		 array('field' => 'paypal_email_id', 'label' => 'Paypal E-mail ID', 'rules' => 'trim|required'),
         array('field' => 'paypal_password', 'label' => 'Paypal Password', 'rules' => 'trim|required'),
         array('field' => 'paypal_signature', 'label' => 'Paypal Singature', 'rules' => 'trim|required'),
		 array('field' => 'auth_login_id', 'label' => 'Test Merchant Login ID', 'rules' => 'trim|required'),
		 array('field' => 'auth_trans_key', 'label' => 'Test Merchant Transaction Key', 'rules' => 'trim|required'),
		);
	 function __construct() 
    {
        parent::__construct();
        
       $this->load->model('payment_model');
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));
       if(!is_logged_in()) 
        {
          redirect("login");
        }
    }
    function index()
    {
    	$this->data['info']=$this->payment_model->get_pay_info("payment_api_credentials");
        if(is_logged_in())
    	 $this->layout->view("payment/add");
        else
            redirect("login");
  		//echo json_encode($response);
    }
    function add()
    {
        if(is_logged_in())
        {
    	if($_POST)
     	{
     		$this->form_validation->set_rules($this->_pay_validation_rules);
     		if($this->form_validation->run())
	        {
				$edit_id ="1";$edit_id1="2";
				$form = $this->input->post();
				$ins_data['api_username'] = $form['paypal_email_id'];
                $ins_data['api_password'] = $form['paypal_signature'];
                $ins_data['api_signature'] = $form['paypal_password'];
				$ins_data['payment_mode'] = $form['paypal_mode'];
               // $ins_data['date_updated'] = date("Y-m-d H:i:s");
				$ins_data1['api_username'] = $form['auth_login_id'];
				$ins_data1['api_password'] = $form['auth_trans_key'];
				$ins_data1['payment_mode'] = $form['auth_mode'];
			//	$ins_data1['date_updated'] = date("Y-m-d H:i:s");
				if(empty($edit_id) || empty($edit_id))
				{
					$ins_data['date_created'] = date("Y-m-d H:i:s");
					$this->payment_model->insert("payment_api_credentials",$ins_data);
                    $this->payment_model->insert("payment_api_credentials",$ins_data1);
				}	
				else
				{
					$this->payment_model->update("payment_api_credentials",$ins_data,array("id" => $edit_id));
                    $this->payment_model->update("payment_api_credentials",$ins_data1,array("id" => $edit_id1));
					$this->session->set_flashdata('up_pay','Payment Info has been updated successfully',TRUE);
				}
				redirect('payment');
	        }
	        else
	        {
	        	$this->data['info']=$this->payment_model->get_pay_info("payment_api_credentials");
	        	$this->layout->view('payment/add');
	        }
     	}
        }
        else
            redirect("login");

    }
    function do_payment()
    {
        $ins = $this->input->post();
        $ins['description'] = $this->input->post('desc');
        $ins['amount'] = $this->input->post('amount');
        //$a = $this->create_auth_cust_profile( $ins );
        $res['customer_id'] = $a['cus_id'];
        $res['profile_id'] = $a['profileid'];
        $res['paymentprofileid'] = $a['paymentprofileid'];
        $res['shippingprofileid'] = $a['shippingprofileid'];
        $b =  $this->create_auth_subscription($res,$ins);
        $c = $this->create_auth_transaction($res,$ins);
        if($a['profileid']!='' && $b['subs_status']=="Success" && $c['trans_status']=="Success")
        {
            //Load Models
            $this->load->model('subscription_model');
            //Create Subscription Table Fields 
            $ins_data['userid'] = $userid;
            $ins_data['subscription_id'] = $b['subs_id'];
            $ins_data['name'] = $ins['description'];
            $ins_data['profile_start_date'] = date("Y-m-d");
            $ins_data['next_billing_date'] = date("Y-m-d",strtotime("+31 days"));
            $ins_data['amount'] = $ins['amount'];
            $ins_data['invoice_no'] = $b['invoice_no'];
            $ins_data['description'] = $ins['description'];
            $ins_data['sub_status'] = 0;
            $ins_data['created_date'] = date('Y-m-d H:i:s');
            $ins_data['last_updated'] = date('Y-m-d H:i:s');
            $this->payment_model->insert("payment_recurring_profiles",$ins_data);
            //Create Customer Profile Table Fields
            $up_data['customerid'] = $a['cus_id'];
            $up_data['profileid'] = $a['profileid'];
            $up_data['payment_pro_id'] = $a['paymentprofileid'];
            $up_data['ship_pro_id'] = $a['shippingprofileid'];
            $up_data['id'] =$userid;
            $this->payment_model->update("users",$up_data,$userid);
            //Create Auth Transaction Table Fields
            $trans_data['userid']= $userid;
            $trans_data['description']= $ins['description'];
            $trans_data['amount']=  $ins['amount'];
            $trans_data['trans_id']= $c['transid'];
            $trans_data['status']= $c['status'];
            $trans_data['payment_mode']= "Authorize";
            $trans_data['date_inserted']= date("Y-m-d H:i:s");
            $this->payment_model->insert("payments",$trans_data);
        }
        else
        {
            $this->session->set_flashdata("signup_fail","Something went wrong. Please try again later.",TRUE);
           $this->layout->view('signup','frontend');
        }
    }
    
}
?>
