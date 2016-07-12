<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."libraries/REST_Controller.php");

class Webinars extends REST_Controller {
	
	
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
			$webinars_data = $this->api_model->get_webinars( $client_id );
	
			$webinars = array();$i=0;
			
				foreach($webinars_data as $list){
					
					$webinars[$i]['id'] = $list['id'];
					$webinars[$i]['title'] = $list['title'];
					$webinars[$i]['link'] = strip_tags($list['link']);
					$webinars[$i]['created_user'] = $list['created_user'];
					$webinars[$i]['created_date'] = $list['created_date'];
				
				$i=$i+1;
				}
			
			$output['status'] 	= 'SUCCESS';
			$output['webinars'] =  $webinars;
			

			$this->response($output, 200);
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
