<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(COREPATH."controllers/Admin_controller.php");

class Transaction extends Admin_controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaction_model');
	}
	/*public function index()
	{
		if($_POST)
		{
			$sub_id = $this->input->post('sub_id');
 		 	$this->layout->add_javascripts(array('listing', 'rwd-table'));  
      $this->load->library('listing');
			$this->data['grid'] = $this->transaction_model->gettransactionbyid("payment_transaction_history a",array('profile_id'=>$sub_id));
			$this->layout->view('transaction');
		}
		else
		{
			$this->data['grid']="";
			$this->layout->view('transaction');
		}
	}*/
	
	
	
	
	
	public function index()
    { 
        $this->layout->add_javascripts(array('listing', 'rwd-table'));  


        $this->load->library('listing');
         

        //init fncts
       //$this->load_settings_data();
        
        $this->simple_search_fields = array(
                                                
                                                'profile_id' => 'Subscription ID'
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('user/add_edit_user/{id}').'" class="table-link">
                    <span class="fa-stack">
                        
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('transaction_model', 'listing');

        if($this->input->is_ajax_request())
            $this->_ajax_output(array('listing' => $listing), TRUE);
        
        $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
        $this->data['simple_search_fields'] = $this->simple_search_fields;
        $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
        $this->data['per_page'] = $this->listing->_get_per_page();
        $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
        
        $role =  $this->session->userdata('admin_data')['role'];
       
        if($role == 1 ) { 
        $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);        
	}else {
		$this->data['search_bar'] = "";
	}
        $this->data['listing'] = $listing;
        
        $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
        
        $this->layout->view("transaction/transaction_list");
        
    }
    
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

?>
