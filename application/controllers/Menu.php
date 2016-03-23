<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Menu extends App_Controller {
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker'));
        $this->load->model(array('menu_model'));
     
      $this->data['img_url']=$this->layout->get_img_dir();   
      //echo $this->layout->get_img_dir();
    }

    public function index()
    {
		
        
    }
    
    
    public function inspection()
    {
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}
		
		$this->data['all_data'] = $this->menu_model->get_all("inspection_reports",array('created_user'=> $user_id,"is_display" => 1));
		$this->data['content'] = $this->menu_model->get_content("display_content",array('id'=> 1));
		
     	$this->layout->view('menu/inspection','frontend');
		
	}
	
	
	 public function osha()
    {
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}
		
		$this->data['all_data'] = $this->menu_model->get_all("cal_osha",array('created_user'=> $user_id,"is_display" => 1));
		$this->data['content'] = $this->menu_model->get_content("display_content",array('id'=> 2));
		
     	$this->layout->view('menu/osha','frontend');
		
	}
	
	
	public function logs()
    {
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}
		
		$this->data['all_data'] = $this->menu_model->get_all("logs",array('created_user'=> $user_id,"is_display" => 1));
		$this->data['content'] = $this->menu_model->get_content("display_content",array('id'=> 3));
		
     	$this->layout->view('menu/logs','frontend');
		
	}
	
	
	public function records()
    {
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}
		
		$this->data['all_data'] = $this->menu_model->get_all("records",array('created_user'=> $user_id,"is_display" => 1));
		$this->data['content'] = $this->menu_model->get_content("display_content",array('id'=> 4));
		
     	$this->layout->view('menu/records','frontend');
		
	}
	
	
	public function forms()
    {
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}
		
		$this->data['all_data'] = $this->menu_model->get_all("safety_forms",array('created_user'=> $user_id,"is_display" => 1));
		$this->data['content'] = $this->menu_model->get_content("display_content",array('id'=> 5));
		
     	$this->layout->view('menu/forms','frontend');
		
	}
	
	
	


   
   
	
}
?>
