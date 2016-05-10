<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."libraries/REST_Controller.php");

class Repository extends REST_Controller {
	
	
    function __construct()
    {

    	parent::__construct();

        $this->load->model(array('api_model'));
        $key  = $this->get('X-APP-KEY');
        
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
