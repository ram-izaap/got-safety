<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Subscribers extends Admin_Controller 
{
	function __construct()
  {
    parent::__construct();
    $this->load->model('subscribers_model');
  }
  function index()
  {
  	$this->layout->add_javascripts(array('listing', 'rwd-table'));  
    $this->load->library('listing');
    $this->simple_search_fields = array('u.name' => 'Name','p.plan_type'=>'Plan Name');
    $this->_narrow_search_conditions = array("start_date");
    $str = '<a href="'.site_url('subscribers/view_subscribed_user/{user_id}').'" class="table-link">
                    <span class="fa-stack">
                        
                        <i class="fa fa-eye"></i>
                    </span>
                </a>';
 		$this->listing->initialize(array('listing_action' => $str));
 		$listing = $this->listing->get_listings('subscribers_model', 'listing');
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
    if(is_logged_in())
   	  $this->layout->view('subscribers/subscribed_users');
    else
      redirect("login");
  }
  function  view_subscribed_user($id)
  {
  		$this->data['info'] = $this->subscribers_model->get_user_info($id);
  		$this->data['trans'] = $this->subscribers_model->get_user_trans($id);
      if(is_logged_in())
  		  $this->layout->view('subscribers/view_subscribed_users');
      else
        redirect("login");
  }
    
}