<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(COREPATH."controllers/Admin_controller.php");

class Transaction extends Admin_controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaction_model');
	}
	public function index()
	{
		if($_POST)
		{
			$sub_id = $this->input->post('sub_id');
 		 	$this->layout->add_javascripts(array('listing', 'rwd-table'));  
      $this->load->library('listing');
			$this->data['grid'] = $this->transaction_model->gettransactionbyid("authorize_subscription_transaction a",array('sub_id'=>$sub_id));
			$this->layout->view('transaction');
		}
		else
		{
			$this->data['grid']="";
			$this->layout->view('transaction');
		}
	}
}

?>