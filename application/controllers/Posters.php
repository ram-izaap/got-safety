<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Posters extends App_Controller {
	
	
	
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker'));
        $this->load->model(array('posters_model'));
        
        //echo $this->layout->get_img_dir();
    }

    public function index()
    {
		$user_id = $this->session->userdata('user_id');
		$role = $this->session->userdata('role');
		
		if($role == 2){
			$user_id = $this->session->userdata('user_id');
		}else{
			$user_id = $this->session->userdata('created_user');
		}
		
		
		$this->data['list_data'] = $this->posters_model->get_lession_detail("posters",array("created_user"=> $user_id,"is_active" => 1));
		$this->data['posters_content'] = $this->posters_model->get_info_content("display_content",array("id" => 6));
		$this->data['img_url']=$this->layout->get_img_dir();
     	$this->layout->view('posters/posters','frontend');
        
    }
    
    
    public function get_posters_data()
    {
		$this->data['img_url']=$this->layout->get_img_dir();
		$poster_id = $this->input->post('view_param');
		
		$this->data['view_link'] = $this->posters_model->get_lession_attachment("posters_attachment",array("poster_id" => $poster_id,"is_active" => 1));
		
		$this->data['view_content'] = $this->posters_model->get_lession_attachment("posters",array("id" => $poster_id,"is_active" => 1));

		$response['html_view'] = $this->load->view('posters/posters_attachment',$this->data,TRUE);
  
		echo json_encode($response);
		
		
	} 
	
	
	


   
   
	
}
?>
