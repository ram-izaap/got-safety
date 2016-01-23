<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_Controller extends CI_Controller
{
    public $logged_in                  = FALSE;
    public $error_message              =    '';
    public $data                       =    array();
    public $role                       =    0;
    public $init_scripts               = array();
    public $criteria                   = array(); 
    
   
    
    public function __construct()
    {
        parent::__construct(); 
    
    //print_r($this->session->userdata('user_data'));die;
        $this->role = get_user_role();
        
        $this->init();

        //if($this->uri->segment(1,'')
        $this->load->library("form_validation");
        
        $this->load->model("user_model");
        $this->load->model("role_model");
        $this->load->model("home_model");
        
        $user_id  = $this->uri->segment(3);
		
		if($this->uri->segment(3) == ''){

			$profile_user_id = $this->session->userdata('user_id');

			}else {

			$profile_user_id = $user_id; 
			}

		$this->data['user_data'] = $this->home_model->get_user_details($profile_user_id);
        
    }
    
    public function init()
    {
        $seg1 = $this->uri->segment(1,'');

        $this->load->config('layout');
        

        switch ($seg1) 
        {
            case 'admin':

                $layout = $this->config->item('admin', 'layout');

                if( !$layout )
                            die('Layout not found.');

                $this->layout->initialize($layout);

                if( !is_logged_in() )
                {
                    $seg2 = $this->uri->segment(2,'');
                    if($seg1 === 'admin' && $seg2 !== 'login')
                    {
                        redirect('admin/login');
                    }
                }
                elseif(is_logged_in() && get_user_role())
                {
                    if(get_user_role() != '1')
                    {
                        redirect('home');
                    }
                }

                break;
            
            default:
                $layout = $this->config->item('frontend', 'layout');

                if( !$layout )
                            die('Layout not found.');
                        
                $this->layout->initialize($layout);

                break;
        }

        
        
    }


    public function index()
    {
       
    }
    
    public function _ajax_output($data, $json_format = FALSE)
    {
        if(is_array($data) && $json_format)
            echo json_encode($data);
        else 
            echo $data;
        
        exit();
    }
    
    
  
}

?>
