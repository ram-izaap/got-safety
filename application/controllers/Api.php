<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."controllers/App_controller.php");
class Api extends App_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('api_model'));
        
    }

    public function index()
    {
		
    }
    
    
    
    /**  get all users list  **/
    
	public function get_user_list()
	{
		$data = $this->api_model->get_user_list("users",array("role"=> 3,"is_active" => 1));
		
		if(count($data) > 0){
			foreach($data as $list){
				$user_id = $list['id'];
				$user_name = $list['name'];
				$created_id = $list['created_id'];
				
				$response[] = array("user_list" => array("httpCode" => 200 , "Message" => "User available","user_id" => $user_id, "user_name" => $user_name, "created_id" => $created_id));
			}
			$user_response["userlist"] = $response;
			echo json_encode($user_response);
			exit;
		}else{
			$response[] = array("user_list" => array("httpCode" => 401 , "Message" => "No user available" ));
			$user_response["userlist"] = $response;
			echo json_encode($user_response);
			exit;
		}
	} 
	
	
	
	/**  get all Client list  **/
    
	public function get_client_list()
	{
		$data = $this->api_model->get_user_list("users",array("role"=> 2,"is_active" => 1));
		
		if(count($data) > 0){
			foreach($data as $list){
				$user_id = $list['id'];
				$user_name = $list['name'];
				$created_id = $list['created_id'];
				
				$response[] = array("client_list" => array("httpCode" => 200 , "Message" => "Client available","user_id" => $user_id, "user_name" => $user_name, "created_id" => $created_id));
			}
			$client_response["clientlist"] = $response;
			echo json_encode($client_response);
			exit;
			
		}else{
			$response[] = array("client_list" => array("httpCode" => 401 , "Message" => "No client available" ));
			$client_response["clientlist"] = $response;
			echo json_encode($client_response);
			exit;
		}
	} 
	
	
	
	/**  get particular user details  **/
    
	public function get_user_detail()
	{
		if($_POST){ 
			
			$user_id = $this->input->post("user_id");
			$role = $this->input->post("role");
			
			$data = $this->api_model->get_user_detail("users",array("role"=> $role,"id" => $user_id));
			
			if(count($data) > 0){
				foreach($data as $list){
					$user_id = $list['id'];
					$user_name = $list['name'];
					$created_id = $list['created_id'];
					$is_active = $list['is_active'];
					
					$response[] = array("user_list" => array("httpCode" => 200 , "Message" => "User details available","user_id" => $user_id, "user_name" => $user_name, "created_id" => $created_id ,"is_active" => $is_active));
				}
				$user_response["userlist"] = $response;
				echo json_encode($user_response);
				exit;
			}else{
				$response[] = array("user_list" => array("httpCode" => 401 , "Message" => "No User available" ));
				$user_response["userlist"] = $response;
				echo json_encode($user_response);
				exit;
			}
		
		}
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
	} 


	/**  Login  **/
    
	public function login()
	{
		if($_POST){ 
			
			$name = $this->input->post("name");
			$password = $this->input->post("password");
			
			$data = $this->api_model->login($name,$password);
			if($data == 0){
				
				$response = array("response" => array("httpCode" => 400 , "Message" => "User not in active" ));
				echo json_encode($response);
				exit;
				
			}else if($data == -1){
				
				$response = array("response" => array("httpCode" => 401 , "Message" => "Username or password mismatch" ));
				echo json_encode($response);
				exit;
				
			}else {
				$user_id = $data[0]['id'];
				$user_name 	= $data[0]['name'];
				$role 	= $data[0]['role'];
				$created_id 	= $data[0]['created_id'];
				
				$response[] = array("user_list" => array("httpCode" => 200 , "Message" => "Login Successfully","user_id" => $user_id, "user_name" => $user_name, "created_id" => $created_id ));
				echo json_encode($response);
				exit;
			}
			
		}
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
	} 



  /**  get all lesson list  **/
    
	public function get_all_lesson_list()
	{
		$data = $this->api_model->get_all_lesson_list("lession",array("is_active" => 1));
		
		if(count($data) > 0){
			foreach($data as $list){
				$id = $list['id'];
				$title = $list['title'];
				$content = $list['content'];
				$created_user = $list['created_user'];
				
				$response[] = array("lesson_list" => array("httpCode" => 200 , "Message" => "Lesson available","id" => $id, "title" => $title, "content" => $content, "created_user" => $created_user));
			}
			$user_response["lessonlist"] = $response;
			echo json_encode($user_response);
			exit;
		}else{
			$response[] = array("lesson_list" => array("httpCode" => 401 , "Message" => "No Lesson available" ));
			$user_response["lessonlist"] = $response;
			echo json_encode($user_response);
			exit;
		}
	} 
	
	
	/**  get particular lesson details  **/
    
	public function get_lesson_details()
	{
		if($_POST){ 
			
			$id = $this->input->post("id");
			
			$data = $this->api_model->get_detail("lession",array("id" => $id));
			
			if(count($data) > 0){
				foreach($data as $list){
					$id = $list['id'];
				$title = $list['title'];
				$content = $list['content'];
				$created_user = $list['created_user'];
				
				$response[] = array("lesson_list" => array("httpCode" => 200 , "Message" => "Lesson available","id" => $id, "title" => $title, "content" => $content, "created_user" => $created_user));
				}
				$user_response["lessonlist"] = $response;
				echo json_encode($user_response);
				exit;
			}else{
				$response[] = array("lesson_list" => array("httpCode" => 401 , "Message" => "No Lesson available" ));
				$user_response["lessonlist"] = $response;
				echo json_encode($user_response);
				exit;
			}
		
		}
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
		
	} 
	
	
	
	/**  Search lesson based on title  **/
    
	public function search_lesson()
	{
		if($_POST){ 
			
			$title = $this->input->post("title");
			
			$data = $this->api_model->search_result("lession",$title);
			
			if(count($data) > 0){
				foreach($data as $list){
					$id = $list['id'];
				$title = $list['title'];
				$content = $list['content'];
				$created_user = $list['created_user'];
				
				$response[] = array("search_list" => array("httpCode" => 200 , "Message" => "Lesson available","id" => $id, "title" => $title, "content" => $content, "created_user" => $created_user));
				}
				$user_response["searchlist"] = $response;
				echo json_encode($user_response);
				exit;
			}else{
				$response[] = array("search_list" => array("httpCode" => 401 , "Message" => "No Lesson available" ));
				$user_response["searchlist"] = $response;
				echo json_encode($user_response);
				exit;
			}
		
		}
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
		
	} 
	
	
	/**  Get lesson attachment list **/
	
	public function get_lesson_attachment()
	{
		if($_POST){ 
			
			$id = $this->input->post("lession_id");
			
			$data = $this->api_model->get_detail("lession_attachment",array("lession_id" => $id,"is_active" => 1));
			
			if(count($data) > 0){
				foreach($data as $list){
					$id = $list['id'];
					$lession_id = $list['lession_id'];
					$language = $list['language'];
					$f_name = get_img_dir().'assets/images/admin/lession_attachment/'.$list['f_name'];
					$f_name_quiz = get_img_dir().'assets/images/admin/lession_attachment/'.$list['f_name_quiz'];
				
				$response[] = array("lesson_list" => array("httpCode" => 200 , "Message" => "Lesson attachment available","id" => $id, "lession_id" => $lession_id, "language" => $language, "f_name" => $f_name, "f_name_quiz" => $f_name_quiz));
				}
				$user_response["lessonlist"] = $response;
				echo json_encode($user_response);
				exit;
			}else{
				$response[] = array("lesson_list" => array("httpCode" => 401 , "Message" => "No Lesson attachment available" ));
				$user_response["lessonlist"] = $response;
				echo json_encode($user_response);
				exit;
			}
		
		}
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
		
	} 
	
	
	
	/**  Get particular user lesson details after login  **/
    
	public function get_user_lesson_list()
	{
		if($_POST){ 
			
			$user_id = $this->input->post("user_id");
			$created_id = $this->input->post("created_id");
			
			if($created_id == '8'){
				$created_id = $user_id;
				
			}else {
				$created_id = $created_id;
			}
			
			
			$data = $this->api_model->get_detail("lession",array("created_user" => $created_id));
			
			if(count($data) > 0){
				foreach($data as $list){
					$id = $list['id'];
				$title = $list['title'];
				$content = $list['content'];
				$created_user = $list['created_user'];
				
				$response[] = array("lesson_list" => array("httpCode" => 200 , "Message" => "Lesson available","id" => $id, "title" => $title, "content" => $content, "created_user" => $created_user));
				}
				$user_response["lessonlist"] = $response;
				echo json_encode($user_response);
				exit;
			}else{
				$response[] = array("lesson_list" => array("httpCode" => 401 , "Message" => "No Lesson available" ));
				$user_response["lessonlist"] = $response;
				echo json_encode($user_response);
				exit;
			}
		
		}
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
		
	} 
	

	/**  Lesson content frontend display **/
	
	public function get_lesson_content()
	{
		
			$data = $this->api_model->get_lession_content("lesson_content");
			
			if(count($data) > 0){
				foreach($data as $list){
					
					$id = $list['id'];
					$content = $list['content'];
				
				$response = array("lesson_list" => array("httpCode" => 200 , "Message" => "Lesson content available","id" => $id,"content" => $content));
				}
				echo json_encode($response);
				exit;
			}else{
				$response = array("lesson_list" => array("httpCode" => 401 , "Message" => "No Lesson content available" ));
				echo json_encode($response);
				exit;
			}
		
	} 
	
	
	
	/**  Get particular user Webinars details after login  **/
    
	public function get_user_webinars_list()
	{
		if($_POST){ 
			
			$user_id = $this->input->post("user_id");
			$created_id = $this->input->post("created_id");
			
			if($created_id == '8'){
				$created_id = $user_id;
				
			}else {
				$created_id = $created_id;
			}
			
			
			$data = $this->api_model->get_webinars_detail("webinars",array("created_user" => $created_id));
			
			if(count($data) > 0){
				foreach($data as $list){
					$id = $list['id'];
				$title = $list['title'];
				$link = $list['link'];
				$created_user = $list['created_user'];
				$created_date = $list['created_date'];
				
				$response[] = array("webinars_list" => array("httpCode" => 200 , "Message" => "Webinars available","id" => $id, "title" => $title, "link" => $link, "created_user" => $created_user, "created_date" => $created_date));
				}
				$user_response["webinarslist"] = $response;
				echo json_encode($user_response);
				exit;
			}else{
				$response[] = array("webinars_list" => array("httpCode" => 401 , "Message" => "No Webinars available" ));
				$user_response["webinarslist"] = $response;
				echo json_encode($user_response);
				exit;
			}
		
		}
		$response = array("response" => array("httpCode" => 400 , "Message" => "Invalid method type" ));
		echo json_encode($response);
		exit;
		
	} 











   
   
	
}
?>
