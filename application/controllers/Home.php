<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Home extends App_Controller {
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker'));
       
        $this->load->model(array('home_model'));
        //echo $this->layout->get_img_dir();
    }

    public function index()
    {
		
		//$this->data['info'] = $this->home_model->get_info("add_pages",array("page_id" => "6"));
     	$this->layout->view('home/home','frontend');
        
    }


   
   
	
}
?>
