<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_Controller extends CI_Controller
{
    public $logged_in                  = FALSE;
    public $error_message              =    '';
    public $data                       =    array();
    public $role                       =    0;
    public $init_scripts               = array();
    public $criteria                   = array(); 
    
   
    public $settings   = array();
    public $interests  = array();
    public $options    = array();
    
    public function __construct()
    {
        parent::__construct(); 
        
    //print_r($this->session->userdata('user_data'));die;
       // $this->role = get_user_role();
        
        $this->init();
			

        //if($this->uri->segment(1,'')
        $this->load->library("form_validation");

        $this->load->library("layout");
        
        $this->load->model("user_model");
        $this->load->model("role_model");
        $this->load->model("home_model");
        $this->load->model("admin/header_model");
        $this->load->model("admin/footer_model");
        
        $this->data['social_link'] = $this->home_model->get_social_links();
        
        $this->data['contact_info_header'] = $this->header_model->get_contact_info('cub_contact_info_logo');
        
        $this->data['header_menu'] = $this->header_model->menu_listings('cub_menu',array("parent_id" => 0));
        
        $this->data['sub_menu'] = $this->header_model->menu_listings('cub_menu',array("parent_id !=" => 0));
        
        $footer = $this->footer_model->get_footer_data('cub_footer');
        
        $this->data['footer'] = $footer;
        
        $footer = (array) $footer[0];
        
        $this->data['show_room'] = $this->footer_model->get_footer_links("cub_footer_links",array("footer_id" => $footer['id'], "link_type" => "show_room"));
        
        $this->data['bottom_link'] = $this->footer_model->get_footer_links("cub_footer_links",array("footer_id" => $footer['id'], "link_type" => "bottom_link"));
        
        $this->data['other_link'] = $this->footer_model->get_footer_links("cub_footer_links",array("footer_id" => $footer['id'], "link_type" => "other_link"));
        
        $this->data['cms_data'] = $this->home_model->get_all_cms_data('cub_new_page');
        //print_r(count($this->data['cms_data']));exit;
        
		$this->data['installaiton_content'] = $this->home_model->get_installaiton_content('cub_service');

        /* Meta Tags Display */

        $page_uri = (trim(str_replace("/","",$_SERVER['REQUEST_URI'])) == "")?$_SERVER['PHP_SELF']:$_SERVER['REQUEST_URI'];

        $path_pos = strrpos($page_uri, '.');

        if(!empty($path_pos))
        {

          $pagePath = substr($page_uri,0,$path_pos );//echo $pagePath;  
        }

        else
        {
            $pagePath =  $page_uri;
        }

        $page_uri = mysql_real_escape_string($page_uri);
        
        $page_uri = substr(strrchr($page_uri, "/"), 1);

        $this->data['meta_datas'] = $this->header_model->get_meta_data('cub_metas',$page_uri);

        if(count($this->data['meta_datas']) > 0) 
        {
             
             $this->layout->set_title($this->data['meta_datas']['0']['Title']);
             $this->layout->set_meta('keywords',$this->data['meta_datas']['0']['Keywords']);
             $this->layout->set_meta('description',$this->data['meta_datas']['0']['Description']);
        }

   }


    public function init()
    {
        $seg1 = $this->uri->segment(1,'');

        $this->load->config('layout');
        

        switch ($seg1) 
        {
            case 'admin':

                $layout = $this->config->item('admin', 'layout');
                
                echo "inininin";exit;

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
                    else
                    {
                        $seg2 = $this->uri->segment(2,'');
                        if(empty($seg2)){
                            redirect('admin/contact_form');
                        }
                    }
                    
                    
                   
                }


                break;
            
            default:
                $layout = $this->config->item('frontend', 'layout');
				
                if( !$layout )
                            die('Layout not found.');
                        
                $this->layout->initialize($layout);

                $this->load_settings_data();

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
    
    public function load_settings_data()
    {
        $this->load->model('settings_model');
        
        $result = $this->settings_model->get_settings();

        $this->settings = array();
        foreach ($result as $row) 
        {
            $this->settings[$row['type']][$row['name']] = $row['value'];
        }

        $result = $this->settings_model->get_interest_list(array('i.status' => 1));
        $this->interests = array();
        $this->options  = array();
        foreach ($result as $row) 
        {
            $this->interests[$row['int_id']] = $row;
            if($row['option_id'])
            {
                $this->options[$row['int_id']][$row['option_id']] = $row['option_name'];
            }
            
        }

        return $this->settings;


    }
  
}

?>
