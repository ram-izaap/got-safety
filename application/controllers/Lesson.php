<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Lesson extends App_Controller {
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker'));
        $this->load->model(array('lession_model'));
        //echo $this->layout->get_img_dir();
    }

    public function index()
    {
		
		
		$this->data['list_data'] = $this->lession_model->get_lession_detail("lession",array("is_active" => 1));
		$this->data['lesson_content'] = $this->lession_model->get_info("lesson_content");
		$this->data['img_url']=$this->layout->get_img_dir();
     	$this->layout->view('lesson/lesson','frontend');
        
    }
    
    
    public function get_lesson_data()
    {
		$this->data['img_url']=$this->layout->get_img_dir();
		$lession_id = $this->input->post('view_param');
		
		$this->data['view_link'] = $this->lession_model->get_lession_attachment("lession_attachment",array("lession_id" => $lession_id,"is_active" => 1));
		
		$this->data['view_content'] = $this->lession_model->get_lession_attachment("lession",array("id" => $lession_id,"is_active" => 1));

		$response['html_view'] = $this->load->view('lesson/lesson_attachment',$this->data,TRUE);
  
		echo json_encode($response);
		
		
	} 
	
	
	


   
   
	
}
?>
