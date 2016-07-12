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
			$attachments = $this->api_model->get_lesson_attachments( $lesson_id );

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
			$insert_data['emp_id'] 			= $this->post('emp_id');
			$insert_data['client_id'] 		= $this->post('client_id');
			$insert_data['created_date']   	= date("Y-m-d H:i:s");
			
			$data = $this->post('sign');
			$file_name = "sign".$insert_data['employee_id']."-".$insert_data['lesson_id'].".png";
			list($type, $data) = explode(';', $data);
			list(, $data)      = explode(',', $data);
			$data = base64_decode($data);

			file_put_contents("./signature/".$file_name, $data);

			$insert_data['sign'] 		= $file_name;

			foreach ($insert_data as $key => $val) 
			{
				if( $val == '' )
				{
					throw new Exception("Invalid Input");
					break;
				}	
			}
			$where=array('employee_id'=>$insert_data['employee_id'],'lesson_id'=>$insert_data['lesson_id']);
			
			$chk = $this->api_model->get_where($where,"lesson_id","sign_off")->num_rows();
			
			if($chk > 0){
				$this->api_model->update("sign_off",$insert_data,$where);	
			}
			else
			{	
			$this->api_model->insert("sign_off",$insert_data);
			}
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
