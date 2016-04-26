<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Signoff extends Admin_controller {
	
    function __construct() 
    {
        parent::__construct();
        
       $this->load->model('signoff_model');
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));
    }


    function index()
    {
		//$this->output->enable_profiler(true);
		
        $this->layout->add_javascripts(array('listing', 'rwd-table'));  

        $this->load->library('listing');

        //init fncts
        //$this->load_settings_data();
        
        $this->simple_search_fields = array(
                                                'l.employee_name' => 'Employee Name',
                                                'ld.emp_id' => 'Employee ID',
                                                'ld.created_date' => 'Date',
                                                'ld.topic' => 'Topic',
                                                'u.name' => 'Client'
                                                
                                                
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        /*$str = '<a href="'.site_url('signoff/view_detail/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>'; */
            $str = '<a href="#" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('signoff_model', 'listing');

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
        
      
       
        $this->layout->view("signoff/signoff_list");
        
        
    }
    
    
	
	function signoff_delete()
    {
       
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from sign_off where id in ('.$id.')');
            //$this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } 
    
    
   
    
    function bulk_export()
    {
		
		$this->load->library('pdf');
		
		$search_field  = $this->session->userdata('search_field');
		$search_value  = $this->session->userdata('search_value');
		
		 $stylesheet = file_get_contents(base_url()."views/pdf.css");
		// print $stylesheet;exit;
		
		if($search_field != "" && $search_value !="" ) {
		
		$this->data['result'] = $this->signoff_model->get_serach_data($search_field,$search_value);
		
		$html ='<table class="table-bor">
  <tr>
    <th>Topic</th>
    <th>Employee Name</th>		
    <th>Employee ID</th>
    <th>Client </th>
    <th>Date </th>
  </tr>';
 foreach($this->data['result'] as $data ) {  
  $html .= '<tr>
    <td>'.$data['topic'].'</td>'.
    '<td>'.$data['employee_name'].'</td>'.		
    '<td>'.$data['emp_id'].'</td>'.
    '<td>'.$data['name'].'</td>'.
    '<td>'.$data['created_date'].'</td>'.
  '</tr>';
    }  
    
    
  
$html .= '</table>';
		
		$pdf = $this->pdf->load(); 
		$pdf->WriteHTML($stylesheet,1);	
        $pdf->WriteHTML($html,2);
        
        $micro = microtime();
        
        $filename = "Export-".date("Y-m-d H:i:s").".pdf";
       
        $pdf->Output($filename,"D");
        
       
	}else {
		redirect("signoff");
		
	}	
		
	}
    
  
   
    
}

