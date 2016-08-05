<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Safety_forms extends App_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('forms1_model'));
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $role = $this->session->userdata('role');
        
        if($role == 2)
        {
            $user_id = $this->session->userdata('user_id');
        }
        else{
            $user_id = $this->session->userdata('created_user');
        }

        $this->data['safety_content'] = $this->forms1_model->get_form_content("display_content",array("id" => 5));

         $this->data['img_url']=$this->layout->get_img_dir();
         
        $this->data['safety_attachment'] = $this->forms1_model->get_form_attachment("safety_forms",$user_id);
        
        $this->layout->view('safety_forms/safety_forms','frontend');
        
    }
   
	
}
?>
