<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."libraries/REST_Controller.php");

class Poster extends REST_Controller {
	
	
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
			$posters = $this->api_model->get_posters( $client_id );

			$output['status']   = 'SUCCESS';
			$output['posters'] 	= $posters;

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

			$poster_id = $this->get('poster_id');
			$attachments = $this->api_model->get_poster_attachments( $poster_id );

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
 
	
}
?>
