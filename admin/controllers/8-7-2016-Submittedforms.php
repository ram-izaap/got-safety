<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Submittedforms extends Admin_controller {
	
    function __construct() 
    {
        parent::__construct();
        
       $this->load->model('submittedforms_model');
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));
        $this->data['img_url']=$this->layout->get_img_dir();
    }


    function index()
    {
		//$this->output->enable_profiler(true);
		
        $this->layout->add_javascripts(array('listing', 'rwd-table'));  

        $this->load->library('listing');

        //init fncts
        //$this->load_settings_data();
        
        $this->simple_search_fields = array(	
												'sf.title' => 'Title',
                                                'u.name' => 'Name',
                                                'sf.created_date' => 'Date'
                                                
                                                
                                                
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
       
            $str = '<a href="'.site_url('submittedforms/view_detail/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('submittedforms_model', 'listing');

        if($this->input->is_ajax_request())
            $this->_ajax_output(array('listing' => $listing), TRUE);
        
        $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
        $this->data['simple_search_fields'] = $this->simple_search_fields;
        $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
        $this->data['per_page'] = $this->listing->_get_per_page();
        $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
        
        $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);        
        
        $this->data['listing'] = $listing;
        
        $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
        
        //$this->data['user_data'] = $this->session->userdata('admin_user_data');
        
      
       
        $this->layout->view("submittedforms/submittedforms_list");
        
        
    }
    
    
	
	function submittedforms_delete()
    {
       
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from submitted_forms where id in ('.$id.')');
            //$this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } 
    
    
	
	function view_detail($id = "")
	{
		$search_field = "sf.id";
		$search_value = $id;
		$this->data['result'] = $this->submittedforms_model->view_details($search_field,$search_value);
		$this->data['user_result'] = $this->submittedforms_model->get_user_details($this->data['result']['user_id']);
		//print_r($this->data['user_result']->name);exit;
		
		$this->layout->view("submittedforms/submittedforms_view");
		
	}
    
  
   
    
}

