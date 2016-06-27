<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Payment extends App_Controller 
{
	protected $_auth_validation_rules =    array (
                    array('field' => 'fname', 'label' => 'First Name', 'rules' => 'trim|required|min_length[4]|alpha'),		
                    array('field' => 'lname', 'label' => 'Last Name', 'rules' => 'trim|required|min_length[2]|alpha'),
                    array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),
                    array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required|alpha'),
                    array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required|alpha'),
                    array('field' => 'zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required|numeric'),
                    array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required|alpha'),
                    array('field' => 'c_number', 'label' => 'Card Number', 'rules' => 'trim|required|numeric|max_length[16]|min_length[16]'),
                    array('field' => 'cvv', 'label' => 'CVV', 'rules' => 'trim|required|numeric|max_length[3]|min_length[3]'),
                    array('field' => 'exp_month', 'label' => 'Expiration Month', 'rules' => 'trim|required'),
                    array('field' => 'exp_year', 'label' => 'Expiration Year', 'rules' => 'trim|required'),
                    array('field' => 'email', 'label' => 'Email-ID', 'rules' => 'trim|required|valid_email'),
                    array('field' => 'phone', 'label' => 'Phone Number', 'rules' => 'trim|required|numeric|max_length[12]|min_length[6]'),
                    array('field' => 'fax', 'label' => 'Fax Number', 'rules' => 'trim|required|numeric|max_length[10]|min_length[6]'),
				);
	 public function index()
     {
     	 $this->layout->view('payment','frontend');
     }
     public function check()
     {
     	if($_POST)
     	{
     		$this->form_validation->set_rules($this->_auth_validation_rules);
     		if($this->form_validation->run())
	        {
	                        
	        }
	        else
	        {
	        	$this->layout->view('payment','frontend');
	        }
     	}
     }
}
?>