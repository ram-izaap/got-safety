<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Signoff extends Admin_controller {
	
    function __construct() 
    {
        parent::__construct();
        
       $this->load->model('signoff_model');
       $this->load->library('form_validation');
       $this->layout->add_javascripts(array('common'));
       $this->data['img_url']=$this->layout->get_img_dir();

        if(!is_logged_in()) 
        {
          redirect("login");
        }
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
                                                'le.title' => 'Topic',
                                                'u.name' => 'Client'
                                                
                                                
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
       
            $str = '<a href="'.site_url('signoff/view_detail/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-eye"></i>
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
		
		
		$search_field  = $this->session->userdata('search_field');
		$search_value  = $this->session->userdata('search_value');

		// print $stylesheet;exit;
		//http://localhost/got_safety/admin/views/pdf_test.css
		if($search_field != "" && $search_value !="" ) 
		  $this->data['result'] = $this->signoff_model->get_serach_data($search_field,$search_value);
		else
		  $this->data['result'] = $this->signoff_model->get_serach_data($search_field='',$search_value='');
		
		$html = $this->load->view('signoff/sign_export',$this->data,true);


		$stylesheet = file_get_contents(base_url()."views/pdf.css");

		$this->load->library('pdf');
		$pdf = $this->pdf->load(); 
		//$pdf->debug=true;
		$pdf->WriteHTML($stylesheet,1);
        $pdf->WriteHTML($html);
        $pdf->Output('Training-signoff-records.pdf','D');
        exit;
		
	}
	
	
	function view_detail($id = "")
	{
		$search_field = "ld.id";
		$search_value = $id;
		$this->data['result'] = $this->signoff_model->view_details($search_field,$search_value);
		//print_r($this->data['result']);exit;
		
		$this->layout->view("signoff/signoff_view");
		
	}
	
	
	function bulk_export_excel()
    {
        
        $this->load->library('export');
        
        $search_field  = $this->session->userdata('search_field');
        $search_value  = $this->session->userdata('search_value');
        
        if($search_field != "" && $search_value !="" ) 
            $this->data['result'] = $this->signoff_model->get_serach_data($search_field,$search_value);
        else
            $this->data['result'] = $this->signoff_model->get_serach_data($search_field='',$search_value='');
        
        $this->export->to_excel($this->data['result'], 'Signoff'); 
        
    }
	
	
	
   
    
}

