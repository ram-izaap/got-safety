<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Payment extends Admin_controller 
{
	protected $_pay_validation_rules =    array (
		 array('field' => 'paypal_email_id', 'label' => 'Paypal E-mail ID', 'rules' => 'trim|required|valid_email'),
		 array('field' => 'auth_login_id', 'label' => 'Test Merchant Login ID', 'rules' => 'trim|required'),
		 array('field' => 'auth_trans_key', 'label' => 'Test Merchant Transaction Key', 'rules' => 'trim|required'),
		  array('field' => 'live_auth_login_id', 'label' => 'Production Merchant Transaction Key', 'rules' => 'trim|required'),
		   array('field' => 'live_auth_trans_key', 'label' => 'Production Merchant Transaction Key', 'rules' => 'trim|required'),	
		);
	 function __construct() 
    {
        parent::__construct();
        
       $this->load->model('payment_model');
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));
    }
    function index()
    {
    	 $this->data['info'] = $this->payment_model->get_pay_info("payment_info",array("id"=>"1"));
    	 $this->layout->view("payment/add");
  		//echo json_encode($response);
    }
    function add()
    {

    	if($_POST)
     	{
     		$this->form_validation->set_rules($this->_pay_validation_rules);
     		if($this->form_validation->run())
	        {
				$edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
				$form = $this->input->post();
				$ins_data['paypal_email'] = $form['paypal_email_id'];
				$ins_data['paypal_mode'] = $form['paypal_mode'];
				$ins_data['auth_login_id'] = $form['auth_login_id'];
				$ins_data['auth_trans_key'] = $form['auth_trans_key'];
				$ins_data['live_auth_login_id'] = $form['live_auth_login_id'];
				$ins_data['live_auth_trans_key'] = $form['live_auth_trans_key'];
				$ins_data['auth_mode'] = $form['auth_mode'];
				$ins_data['date_updated'] = date("Y-m-d H:i:s");
				if(empty($edit_id))
				{
					$ins_data['date_created'] = date("Y-m-d H:i:s");
					$this->payment_model->insert("payment_info",$ins_data);
				}	
				else
				{
					$this->payment_model->update("payment_info",$ins_data,array("id" => $edit_id));
					$this->session->set_flashdata('up_pay','Payment Info has been updated successfully',TRUE);
				}
				redirect('payment');
	        }
	        else
	        {
	        	$this->data['info']=$this->payment_model->get_pay_info("payment_info",array("id"=>"1"));
	        	$this->layout->view('payment/add');
	        }
     	}
    }
    function do_payment()
    {
        $ins = $this->input->post();
        $ins['description'] = $this->input->post('desc');
        $ins['amount'] = $this->input->post('amount');
        $a = $this->create_auth_cust_profile( $ins );
        $res['customer_id'] = $a['cus_id'];
        $res['profileid'] = $a['profileid'];
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
            $ins_data['startDate'] = date("Y-m-d");
            $ins_data['amount'] = $ins['amount'];
            $ins_data['invoice_no'] = $b['invoice_no'];
            $ins_data['description'] = $ins['description'];
            $ins_data['sub_status'] = 0;
            $ins_data['created_date'] = date('Y-m-d H:i:s');
            $ins_data['last_updated'] = date('Y-m-d H:i:s');
            $this->payment_model->insert("authorize_subscription",$ins_data);
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
