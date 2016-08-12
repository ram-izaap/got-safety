<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Signoff extends App_Controller {
	
	
    function __construct()
    {
        parent::__construct();
        
       $this->data['img_url']=$this->layout->get_img_dir();
    }

  
     public function index($lesson_id=0)
    {
        //$this->load->model(array('webinars_model'));

        $user = $this->session->userdata('user_detail');

        if(!is_array($user) || empty($user))
            redirect('login');

        if(!$lesson_id)
            redirect('login');

        $client_id = $user['created_id'];

		$this->data['employees'] = $this->db->get_where('employee', array("created_user" => $client_id,"is_active" => 1))->result_array();
		
        $this->data['client_id'] = $client_id;
        $this->data['lesson_id'] = $lesson_id;

     	$this->layout->view('signoff/signoff','frontend');
        
    }
    
    function training_record()
    {
        try
        {
            $output = array();
            
            $insert_data = array();
            $insert_data['lesson_id']       = $this->input->post('lesson_id');
            $insert_data['employee_id']     = $this->input->post('employee_id');
            
            //getting emp_id
            $emp_id = $this->db->get_where('employee', array("id" => $insert_data['employee_id']))->row_array();
            
            $insert_data['emp_id']          = $emp_id['emp_id'];
            $insert_data['client_id']       = $this->input->post('client_id');
            $insert_data['created_date']    = date("Y-m-d H:i:s");
            
            $data = $this->input->post('sign');
            $file_name = "sign".$insert_data['employee_id']."-".$insert_data['lesson_id'].".png";
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            file_put_contents("./signature/".$file_name, $data);

            $insert_data['sign']        = $file_name;

            foreach ($insert_data as $key => $val) 
            {
                if( $val == '' )
                {
                    throw new Exception("Invalid Input");
                    break;
                }   
            }
            $where=array('employee_id'=>$insert_data['employee_id'],'lesson_id'=>$insert_data['lesson_id']);
            
            $chk = $this->db->get_where("sign_off",$where,"lesson_id")->num_rows();
            
            if($chk > 0){
                $this->db->update("sign_off",$insert_data,$where);   
            }
            else
            {   
                $this->db->insert("sign_off",$insert_data);
            }

            $output['status']   = 'success';
            $output['message']  = "Training completed successfully";

            echo json_encode($output);
            exit;
        }
        catch( Exception $e)
        {

            $output['message'] = $e->getMessage();
            $output['status'] = 'error';

            echo json_encode($output);
            exit;
        }
    }
	
}
?>
