<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."libraries/REST_Controller.php");

class Lesson extends REST_Controller {
	
	
    function __construct()
    {

    	parent::__construct();

        $this->load->model(array('api_model'));
        $key  = $this->get('X-APP-KEY');
        
    }

    public function list_get()
	{
		
		try
		{
			$output = array();

			$client_id = $this->get('client_id');
			$lessons = $this->api_model->get_lessons( $client_id );

			$output['status'] 	= 'SUCCESS';
			$output['lessons'] 	= $lessons;

			$this->response( $output, 200);
		}
		catch( Exception $e)
		{

			$output['message'] = $e->getMessage();
			$output['status'] = 'ERROR';

			$this->response($output,200);
		}
		
		
	} 

	public function attachment_get()
	{
		
		try
		{
			$output = array();

			$lesson_id = $this->get('lesson_id');
			$attachments = $this->api_model->get_attachments( $lesson_id );

			$output['status'] 	= 'SUCCESS';
			$output['attachments'] 	= $attachments;

			$this->response( $output, 200);
		}
		catch( Exception $e)
		{

			$output['message'] = $e->getMessage();
			$output['status'] = 'ERROR';

			$this->response($output,200);
		}
		
		
	} 

	public function training_post()
	{
		
		try
		{
			$output = array();

			$insert_data = array();
			$insert_data['lesson_id'] 		= $this->post('lesson_id');
			$insert_data['employee_id'] 	= $this->post('employee_id');
			$insert_data['created_date']   	= date("Y-m-d H:i:s");

			foreach ($insert_data as $key => $val) 
			{
				if( $val == '' )
				{
					throw new Exception("Invalid Input");
					break;
				}	
			}

			$this->api_model->insert("sign_off",$insert_data);

			$output['status'] 	= 'SUCCESS';
			$output['message'] 	= "Training completed successfully";

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
