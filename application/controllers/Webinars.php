<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Webinars extends App_Controller {
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker'));
        $this->load->model(array('webinars_model'));
        //echo $this->layout->get_img_dir();
    }

    public function index()
    {
		
		
		$this->data['most_data'] = $this->webinars_model->get_webinars_most("webinars",array("is_active" => 1));
		$this->data['all_data'] = $this->webinars_model->get_webinars_all("webinars",array("is_active" => 1));
		
     	$this->layout->view('webinars/webinars','frontend');
        
    }
    
    
    public function get_webinars_data()
    {
		
		$id = $this->input->post('view_param');
		
		$this->data['view_link'] = $this->webinars_model->get_webinars_attachment("webinars",array("id" => $id,"is_active" => 1));
		
		//$this->data['view_content'] = $this->webinars_model->get_lession_attachment("lession",array("id" => $lession_id,"is_active" => 1));

		$response['html_view'] = $this->load->view('webinars/webinars_attachment',$this->data,TRUE);
  
		echo json_encode($response);
		
		
	} 
	
	
	


   
   
	
}
?>
