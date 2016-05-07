<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."libraries/REST_Controller.php");

class User extends REST_Controller {
	
	
    function __construct()
    {

    	parent::__construct();

        $this->load->model(array('api_model'));
        $key  = $this->get('X-APP-KEY');
        
    }

    public function login_post()
	{

		$user_data = array();
		try
		{
			$name 		= $this->post('name');
			$password 	= $this->post('password');

			if( strcmp('', trim($name) ) === 0 || strcmp('', trim($password) ) === 0 )
				throw new Exception("Required fields are missing in your request");
				

			$user_data = $this->api_model->login( $name, $password );

			if( !is_array($user_data) || !count($user_data) ) throw new Exception("The user account does not exist.");
			
			if( $user_data['is_active'] != 1 ) throw new Exception("The user account is inactive.");

			$user_data['message'] = "Login Successfully";
			$user_data['status'] = 'SUCCESS';
		}
		catch( Exception $e)
		{
			$user_data['message'] = $e->getMessage();
			$user_data['status'] = 'ERROR';
		}

		$this->response( $user_data, 200);

	}


	public function employees_get()
	{
		
		try
		{
			$output = array();

			$client_id = $this->get('client_id');
			$employees = $this->api_model->get_employees( $client_id );

			$output['status'] 	= 'SUCCESS';
			$output['employees'] 	= $employees;

			$this->response( $output, 200);
		}
		catch( Exception $e)
		{

			$output['message'] = $e->getMessage();
			$output['status'] = 'ERROR';

			$this->response($output,200);
		}
		
		
	} 
   
	
}
?>
