<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//require_once(COREPATH."controllers/App_controller.php");
require_once(COREPATH."libraries/REST_Controller.php");

class Api extends REST_Controller {
	
				protected $_signup_validation_rules = array(
													array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|max_length[255]'),
													array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
                                                    array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|max_length[255]'),
                                                    array('field' => 'con_password', 'label' => 'Confirm Password', 'rules' => 'trim|required|matches[password]')
                                                   
												);
												
	
    function __construct()
    {
    	/*$postdata = file_get_contents("php://input");
	    if (isset($postdata)) 
		{
			$request = json_decode($postdata, true);
			if( is_array($request) )
				$_POST = $request;
		}*/

        parent::__construct();

        

        $this->load->model(array('api_model'));
        $key  = $this->get('X-APP-KEY');
        
    }

    public function index()
    {
		
    }
    
    
    
    /**  get all users list  **/
    
	public function get_user_list_get()
	{
		$data = $this->api_model->get_user_list("users",array("role"=> 3,"is_active" => 1));
		$user = array();$i=0;
		if(count($data) > 0){
			foreach($data as $list){
				$user[$i]['user_id'] = $list['id'];
				$user[$i]['user_name'] = $list['name'];
				$user[$i]['created_id'] = $list['created_id'];
				$user[$i]['role'] = $list['role'];
				$i=$i+1;
			}
			return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);
			}
	} 
	
	
	
	/**  get all Client list  **/
    
	public function get_client_list_get()
	{
		$data = $this->api_model->get_user_list("users",array("role"=> 2,"is_active" => 1));
		$user = array();$i=0;
		if(count($data) > 0){
			foreach($data as $list){
				$user[$i]['user_id'] = $list['id'];
				$user[$i]['user_name'] = $list['name'];
				$user[$i]['created_id'] = $list['created_id'];
				$user[$i]['role'] = $list['role'];
				$i=$i+1;
			}
			return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);
			}
			
	} 
	
	
	
	/**  get particular user details  **/
    
	public function get_user_detail_get()
	{
		
			if((!$this->get('user_id')) && (!$this->get('role') )) 
    		{
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 404);
    		}
    		
			$user_id = $this->get("user_id");
			$role = $this->get("role");
			
			$data = $this->api_model->get_user_detail("users",array("role"=> $role,"id" => $user_id));
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					$user[$i]['user_id'] = $list['id'];
					$user[$i]['user_name'] = $list['name'];
					$user[$i]['created_id'] = $list['created_id'];
					$user[$i]['is_active'] = $list['is_active'];
					$user[$i]['role'] = $list['role'];
					$i=$i+1;
					
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "error","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);
			}
		
		
	} 


	/**  Login  **/
    
	public function login_post()
	{

		$output = array();
		try
		{
			$name 		= $this->post('name');
			$password 	= $this->post('password');

			if( strcmp('', trim($name) ) === 0 || strcmp('', trim($password) ) === 0 )
				throw new Exception("Required fields missing in your request");
				

			$data = $this->api_model->login( $name, $password );

			switch ( $data ) 
			{
				case 0:
					throw new Exception("User not in active");					
					break;

				case -1:
					throw new Exception("Username or password mismatch");					
					break;
				
				default:
					
					break;
			}

			$udata  = $data[0];

			$output['message'] = "Login Successfully";
			$output['user_id'] = $udata['id'];
			$output['user_name'] = $udata['name'];
			$output['created_id'] = $udata['created_id'];
			$output['role'] = $udata['role'];

			$output['status'] = 'success';
		}
		catch( Exception $e)
		{
			$output['message'] = $e->getMessage();
			$output['status'] = 'error';
		}

		$this->response( $output, 200);

	} 



  /**  get all lesson list  **/
    
	public function get_all_lesson_list_get()
	{
		$data = $this->api_model->get_all_lesson_list("lession",array("is_active" => 1));
		$user = array();$i=0;
		if(count($data) > 0){
			foreach($data as $list){
				
				$user[$i]['id']= $list['id'];
				$user[$i]['title'] = $list['title'];
				$user[$i]['content']  = $list['content'];
				$user[$i]['created_user'] = $list['created_user'];
				
				$i=$i+1;
				
			}
			return $this->response(array( "status" => "success","user"=> $user),200);
		}else{
			return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);
		}
	} 
	
	
	/**  get particular lesson details  **/
    
	public function get_lesson_details_get()
	{
		
			if((!$this->get('id')) ) 
    		{
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 404);
    		}
    		
			$id = $this->get("id");
			
			$data = $this->api_model->get_detail("lession",array("id" => $id));
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					$user[$i]['id']= $list['id'];
				$user[$i]['title'] = $list['title'];
				$user[$i]['content']  = $list['content'];
				$user[$i]['created_user'] = $list['created_user'];
				
				$i=$i+1;
				
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);
			}
		
		
		
	} 
	
	
	
	/**  Search lesson based on title  **/
    
	public function search_lesson_get()
	{
			if((!$this->get('title')) ) 
    		{
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 404);
    		}
			
			$title = $this->get("title");
			
			$data = $this->api_model->search_result("lession",$title);
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					$user[$i]['id'] = $list['id'];
				$user[$i]['title'] = $list['title'];
				$user[$i]['content'] = $list['content'];
				$user[$i]['created_user'] = $list['created_user'];
				
				$i=$i+1;
				
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);
			}
		
		
		
	} 
	
	
	/**  Get lesson attachment list **/
	
	public function get_lesson_attachment_get()
	{
		
			if((!$this->get('lesson_id')) ) 
    		{
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 404);
    		}
    		
			$id = $this->get("lesson_id");
			
			$data = $this->api_model->get_detail("lession_attachment",array("lession_id" => $id,"is_active" => 1));
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					$user[$i]['id'] = $list['id'];
					$user[$i]['lession_id'] = $list['lession_id'];
					$user[$i]['language'] = $list['language'];
					$user[$i]['f_name'] = get_img_dir().'assets/images/admin/lession_attachment/'.$list['f_name'];
					$user[$i]['f_name_quiz'] = get_img_dir().'assets/images/admin/lession_attachment/'.$list['f_name_quiz'];
				$i=$i+1;
				
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);

			}
		
		
		
	} 
	
	
	
	/**  Get particular user lesson details after login  **/
    
	public function get_user_lesson_list_get()
	{
		
			if((!$this->get('user_id')) && (!$this->get('created_id') )) 
    		{
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 404);
    		}
			
			$user_id = $this->get("user_id");
			$created_id = $this->get("created_id");
			
			if($created_id == '8'){
				$created_id = $user_id;
				
			}else {
				$created_id = $created_id;
			}
			
			$date = date('Y-m-d');
			
			//$data = $this->api_model->get_lession_detail("lession",array("created_user" => $created_id));
			$data = $this->api_model->get_lession_detail("lession",$created_id);
			
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					$user[$i]['id'] =$list['id']; 
					//$id = $list['id'];
				$user[$i]['title'] = $list['title'];
				$user[$i]['content'] = $list['content'];
				$user[$i]['created_user'] = $list['created_user'];
				$i=$i+1;
				}
				
				return $this->response(array( "status" => "success","lessons"=> $user),200);
				
			}else{
				
				return $this->response(array( "status" => "errror","msg" => "No lessons listed"),200);
				
			}
		
		
		
	} 
	

	/**  Lesson content frontend display **/
	
	public function get_lesson_content_get()
	{
		
			$data = $this->api_model->get_lession_content("lesson_content");
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					
					$user[$i]['id']= $list['id'];
					$user[$i]['content'] = $list['content'];
				
				$i=$i+1;
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);
			}
		
	} 
	
	
	
	/**  Get particular user Webinars details after login  **/
    
	public function get_user_webinars_list_get()
	{
		
		if((!$this->get('user_id')) && (!$this->get('created_id') )) 
    		{
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 404);
    		}
			
			$user_id = $this->get("user_id");
			$created_id = $this->get("created_id");
			
			if($created_id == '8'){
				$created_id = $user_id;
				
			}else {
				$created_id = $created_id;
			}
			
			
			$data = $this->api_model->get_webinars_detail("webinars",array("created_user" => $created_id));
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					$user[$i]['id'] = $list['id'];
				$user[$i]['title'] = $list['title'];
				$user[$i]['link'] = strip_tags($list['link']);
				$user[$i]['created_user'] = $list['created_user'];
				$user[$i]['created_date'] = $list['created_date'];
				
				$i=$i+1;
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);
			}
		
		
		
	} 
	
	
	public function registration()
	{
		
		if($_POST) {
			
			 $this->load->library('email');
			
			$name = $this->input->post("name");
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$con_password = $this->input->post("con_password");
			
			$this->form_validation->set_rules($this->_signup_validation_rules);
			
			if($this->form_validation->run()) {   
               
                $form = $this->input->post();
               
                $ins_data                 = array();
                $ins_data['name']        = $form['name'];
                $ins_data['email']  = $form['email'];
                $ins_data['role']  = 2;
                $ins_data['password']  = md5($form['password']);
                $ins_data['created_date']  =  date("Y-m-d H:i:s");
                $ins_data['is_active']  = 1;
                
                $add_user    = $this->api_model->insert("users",$ins_data);
                
                $url = "http://izaapinnovations.com/got_safety/admin/";
                $msg = "Your Backend Login link as client ".$url."
						Client username: ".$form['name']."
						Password: ".$form['password']."


						Thanks you..";
                
                $this->email->from('admin@gotsafety.com', 'Gotsafety');
				$this->email->to($form['email']);
				$this->email->subject('Signup Successfully');
				$this->email->message($msg);
				$this->email->send();
				
				$response = array("response" => array("httpCode" => 200 , "Message" => "Register successfully" ));
				echo json_encode($response);
				exit;
                
            } else {
				
				$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid entry check again" ));
				echo json_encode($response);
				exit;
			}
            
			
			
		}
		
		
		
		
	}


 /**  Get user poster list after login **/

	public function get_user_posters_list_get()
	{
		
			if((!$this->get('user_id')) && (!$this->get('created_id') )) 
    		{
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 404);
    		}
			
			$user_id = $this->get("user_id");
			$created_id = $this->get("created_id");
			
			if($created_id == '8'){
				$created_id = $user_id;
				
			}else {
				$created_id = $created_id;
			}
			
			
			$data = $this->api_model->get_poster_detail("posters",array("created_user" => $created_id));
			
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					$user[$i]['id'] =$list['id']; 
					//$id = $list['id'];
				$user[$i]['title'] = $list['title'];
				$user[$i]['content'] = $list['content'];
				$user[$i]['created_user'] = $list['created_user'];
				$i=$i+1;
				}
				
				return $this->response(array( "status" => "success","user"=> $user),200);
				
			}else{
				
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);
				
			}
		
	} 
	
	
	/**  Get posters attachment list **/
	
	public function get_posters_attachment_get()
	{
		
			if((!$this->get('poster_id')) ) 
    		{
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 404);
    		}
    		
			$id = $this->get("poster_id");
			
			$data = $this->api_model->get_detail("posters_attachment",array("poster_id" => $id,"is_active" => 1));
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					$user[$i]['id'] = $list['id'];
					$user[$i]['poster_id'] = $list['poster_id'];
					$user[$i]['language'] = $list['language'];
					$user[$i]['poster1'] = get_img_dir().'assets/images/frontend/posters_attachment/'.$list['f_name'];
					$user[$i]['poster2'] = get_img_dir().'assets/images/admin/posters_attachment/'.$list['f_name_quiz'];
				$i=$i+1;
				
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),404);

			}
		
	} 



	/**  posters content frontend display **/
	
	public function get_content_get()
	{
		
		if((!$this->get('type')) ) 
		{
			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 200);
		}
				
			$id = $this->get("type");
			$data = $this->api_model->get_content("display_content",array("id" => $id));
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					
					$user[$i]['id']= $list['id'];
					$user[$i]['content'] = strip_tags($list['content']);
				
				$i=$i+1;
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),200);
			}
		
	} 


	
	/**  Get particular user other pages details after login  **/
    
	public function get_user_menu_list_get()
	{
		
		if((!$this->get('user_id')) && (!$this->get('created_id')) && (!$this->get('type')) ) 
    		{
    			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 200);
    		}
			
			$user_id = $this->get("user_id");
			$created_id = $this->get("created_id");
			$type = $this->get("type");
			
			if($type == "report") {
				$table = "inspection_reports";
				$folder = "inspection_reports";
			}
			else if($type == "document"){
				
				$table = "cal_osha";
				$folder = "call_osha";
			}
			else if($type == "log"){
				
				$table = "logs";
				$folder = "logs";
			}
			else if($type == "record"){
				
				$table = "records";
				$folder = "records";
			}
			else if($type == "forms"){
				
				$table = "safety_forms";
				$folder = "safety_forms";
			}
			else {
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),200);
			}
			
			
			if($created_id == '8'){
				$created_id = $user_id;
				
			}else {
				$created_id = $created_id;
			}
			
			
			$data = $this->api_model->get_menu_detail($table,array("created_user" => $created_id,"is_display" => 1));
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					$user[$i]['id'] = $list['id'];
				$user[$i]['title'] = $list['title'];
				$user[$i]['created_user'] = $list['created_user'];
				$user[$i]['created_date'] = $list['created_date'];
				$user[$i]['url'] = get_img_dir().'assets/images/frontend/'.$folder.'/'.$list['pdf_file'];
				
				$i=$i+1;
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),200);
			}
		
	} 
 
	/* Get employee list based on client id   */

	public function get_employee_get()
	{
		
		if((!$this->get('client_id')) ) 
		{
			return $this->response(array('status' => 'error','msg' => 'Required fields missing in your request','error_code' => 1), 200);
		}
				
			$id = $this->get("client_id");
			$data = $this->api_model->get_content("employee",array("created_user" => $id));
			$user = array();$i=0;
			if(count($data) > 0){
				foreach($data as $list){
					
					$user[$i]['id']= $list['id'];
					$user[$i]['employee_name']= $list['employee_name'];
					$user[$i]['employee_email']= $list['employee_email'];
					
				$i=$i+1;
				}
				return $this->response(array( "status" => "success","user"=> $user),200);
			}else{
				return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),200);
			}
		
	} 
	
	
	
	
	public function training_post()
	{

		$output = array();
		$ins_data = array();
		try
		{
			$ins_data['topic'] 		    = $this->post('topic');
			$ins_data['employee_id'] 	= $this->post('employee_id');
			$ins_data['client_id']   	= $this->post('client_id');
			$ins_data['created_date']   = date("Y-m-d H:i:s");

			if( strcmp('', trim($this->post('topic')) ) === 0 || strcmp('', trim($this->post('employee_id')) ) === 0 || strcmp('', trim($this->post('client_id')) ) === 0 ) {
				throw new Exception("Required fields missing in your request");
			}
				

			$data = $this->api_model->insert("sign_off",$ins_data);
			
		
			//$udata  = $data[0];

			$output['message'] = "Training completed successfully";
			$output['topic'] = $this->post('topic');
			$output['employee_id'] = $this->post('employee_id');
			$output['client_id'] = $this->post('client_id');
			$output['status'] = 'success';
			
		}
		catch( Exception $e)
		{
			$output['message'] = $e->getMessage();
			$output['status'] = 'error';
		}

		$this->response( $output, 200);

	} 
	
	
	/*public function repository_get()
	{
		$dir = site_url('admin/views/repository/files');
		$files1 = scandir($dir);
		print_r($files1);exit;
	} */
	
	
	
	function dir_to_array($dir)
	{	
        if (!is_dir($dir)) { 
                // If the user supplies a wrong path we inform him.
                return null;
        }

        // Our PHP representation of the filesystem
        // for the supplied directory and its descendant.
        $data = [];

        foreach (new DirectoryIterator($dir) as $f) {
                if ($f->isDot()) {
                        // Dot files like '.' and '..' must be skipped.
                        continue;
                }

                $path = $f->getPathname();
                $name = $f->getFilename();
                $ext = $f->getExtension();

                if ($f->isFile()) {
                        $data[] = [ 'name' => $name ,'ext' => $ext,'url' => $path];
                } else {
                        // Process the content of the directory.
                        $files = $this->dir_to_array($path);

                       /* $data[] = [ 'dir'  => $files,
                                    'name' => $name ]; */
                                    
                         $data[] = [ 'name'  => $name,
                                    'children' => $files ];        
                             
                                    
                        // A directory has a 'name' attribute
                        // to be able to retrieve its name.
                        // In case it is not needed, just delete it.
                }
        }

        // Sorts files and directories if they are not on your system.
        \usort($data, function($a, $b) {
                $aa = isset($a['file']) ? $a['file'] : $a['name'];
                $bb = isset($b['file']) ? $b['file'] : $b['name'];

                return \strcmp($aa, $bb);
        });

        return $data;
}

	/*
	 * Converts a filesystem tree to a JSON representation.
	 */
	function dir_to_json($dir)
	{  
			
			//$dir = site_url('admin/views/repository/files/client');
			$data = $this->dir_to_array($dir);
			$data = json_encode($data);

			return $data;
	}

	function repository_get()
	{
		$folder_name = $this->get('client_name');
		
		$dir = 'admin/views/repository/files/'.$folder_name.'/';
		//print $dir;exit;
		
		$a = $this->dir_to_json($dir);
		if($a == 'null' ){
			return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),200);
		}
		echo $a;exit;
		
	}
		
	
	



   
   
	
}
?>
