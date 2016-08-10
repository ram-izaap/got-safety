<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Documents extends App_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('documents_model'));

         if($this->session->userdata('user_id') == "")
        {
            redirect("");
        }
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

        $this->data['osha_content'] = $this->documents_model->get_osha_content("display_content",array("id" => 2));

         $this->data['img_url']=$this->layout->get_img_dir();
         
        $this->data['osha_attachment'] = $this->documents_model->get_osha_attachment("cal_osha",$user_id);
        
        $this->layout->view('documents/documents','frontend');
        
    }
   
	
}
?>
