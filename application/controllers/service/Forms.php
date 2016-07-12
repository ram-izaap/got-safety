<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."libraries/REST_Controller.php");

class Forms extends REST_Controller {
	
	
    function __construct()
    {

    	parent::__construct();

        $this->load->model(array('api_model'));
        $key  = $this->get('X-APP-KEY');
        
    }

    public function forms_post()
	{
		
		$param = $this->post('username');

		//file_put_contents("./signature/".$file_name, $data);
		 $file = $_FILES['file']['name'];
		 $file_loc = $_FILES['file']['tmp_name'];
		 $file_type = $_FILES['file']['type'];
		 $folder="./signature/";
		 
		 move_uploaded_file($file_loc,$folder.'dummypdf.pdf');
		
		echo json_encode($_POST);
		exit;
		
	} 
	
	
	
	
	public function user_menu_list_get()
	{ 
		
		if(!$this->get('type') ) 
    		{
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 200);
    		}
			
			
			$type = $this->get("type");
			
			if($type == "forms"){
				
				$table = "safety_forms";
				$folder = "safety_forms";
			}
			else {
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),200);
			}
			
			
			
			
			
			$data = $this->api_model->get_menu_detail($table,array("is_display" => 1));
			
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					$user[$i]['id'] = $list['id'];
				$user[$i]['title'] = $list['title'];
				$user[$i]['url'] = get_img_dir().'assets/images/frontend/'.$folder.'/'.$list['pdf_file'];
				
				$i=$i+1;
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),200);
			}
		
	} 
 
	
}
?>
