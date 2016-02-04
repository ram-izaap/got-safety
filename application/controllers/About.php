<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class About extends App_Controller {
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker'));
        $this->load->model(array('about_model'));
        //echo $this->layout->get_img_dir();
    }

    public function index()
    {

		$this->data['img_url']=$this->layout->get_img_dir();
     	$this->layout->view('about/about','frontend');
        
    }


   
   
	
}
?>
