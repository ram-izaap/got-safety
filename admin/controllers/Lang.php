<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Lang extends Admin_controller {
	
	protected $_lang_validation_rules = array(
													array('field' => 'lang', 'label' => 'Language', 'rules' => 'trim|required|max_length[255]'),
                                                    array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
													
												);
												
												
											
	

    function __construct() 
    {
        parent::__construct();
         
        $this->load->model('lang_model');
		$this->load->library('form_validation');
        $this->layout->add_javascripts(array('common'));

        if(!is_logged_in()) 
        {
          redirect("login");
        }
    }


    function index()
    { 
        
        
	 $this->layout->add_javascripts(array('listing', 'rwd-table'));  

        $this->load->library('listing');
         

        //init fncts
       //$this->load_settings_data();
        
        $this->simple_search_fields = array(
                                                
                                                'lang' => 'Language'
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('lang/add_lang/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('lang_model', 'listing');

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
        	$this->layout->view("lang/lang_list");
        else
        	redirect("login");
        
        
    }
    
    
    
  
	
	public function add_lang($edit_id = "")
    { 
		
		if(is_logged_in()) {
			 $edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			$this->form_validation->set_rules($this->_lang_validation_rules);
			
			
       
        if($this->form_validation->run())
        { 
            $form = $this->input->post();
           // print_r($form);exit;
            
           // print_r($form);exit;
			if(isset($form['is_active'])) { 
				$form['is_active'] = $form['is_active'];	
			}
			else { 
				$form['is_active'] = "0";
			}
			
			
			$ins_data = array();
			
			//print $filename;exit;
			
			
            $ins_data['lang']       	= Ucfirst($form['lang']);
            $ins_data['is_active']  = $form['is_active'];
           
            
           
			if(empty($edit_id)){
			
			$update_data = $this->lang_model->insert("language",$ins_data);
           // $this->service_message->set_flash_message('record_insert_success');
		}else {
			
			$update_data = $this->lang_model->update("language",$ins_data,array("id" => $edit_id));
           // $this->service_message->set_flash_message('record_update_success');
		}
		redirect("lang");    

		}	
			
			 if($edit_id) {
                $edit_data = $this->lang_model->get_lang_data("language",array("id" => $edit_id));
                
                if(!isset($edit_data[0])) {
                    //$this->service_message->set_flash_message('record_not_found_error');
                    redirect("lang");   
                }
                $this->data['title']          = "EDIT LANGUAGE";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                
            }
            else if($this->input->post()) { 
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD LANGUAGE";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
                
            }
            else
            {
                $this->data['title']     = "ADD LANGUAGE";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("lang" => "","is_active" => ""); 
            }
		
		 
		$this->layout->view('lang/add');
		
		}
        else
        {
            redirect("login");
        }  
    
	}
	
	
	
	/*  
	
	
	function do_upload()
	{
		$config['upload_path'] = './assets/frontend/images/white_paper';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('back_image'))
		{
			$error = array('error' => $this->upload->display_errors());

			return $error;
			
		}
		else
		{
			$data = array('back_image' => $this->upload->data());
			return $data;
			
		}
	}
	
	*/

	
	function lang_delete()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from language where id in ('.$id.')');
           
            
           // $this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } 
    
    
   
    
}

