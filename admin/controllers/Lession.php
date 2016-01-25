<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Lession extends Admin_controller {
	
	/*protected $_jqslider_validation_rules = array(
													array('field' => 'SlideshowName', 'label' => 'Slide show Name', 'rules' => 'trim|required|max_length[255]'),
													array('field' => 'TransitionType', 'label' => 'TransitionType', 'rules' => 'trim|required|max_length[255]'),
													array('field' => 'TransitionSpeed', 'label' => 'Transition Speed', 'rules' => 'trim|required|max_length[255]'),
													array('field' => 'AutoplaySpeed', 'label' => 'Interval Duration', 'rules' => 'trim|required|max_length[255]'),
													array('field' => 'maxHeight', 'label' => 'Max Height', 'rules' => 'trim|required|max_length[255]'),
													//array('field' => 'Menu', 'label' => 'Select Menu', 'rules' => 'required'),
													array('field' => 'OrphanUrls', 'label' => 'OrphanUrls', 'rules' => 'required'),
                                                    array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'trim')
													
												);
												*/
												
											
	

    function __construct() 
    {
        parent::__construct();
        
        $this->load->model('lession_model');
       $this->load->library('form_validation');
    }


    function index()
    { 
        
        

        $this->load->library('listing');
         

        //init fncts
       //$this->load_settings_data();
        
        $this->simple_search_fields = array(
                                                
                                                'title' => 'title'
                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('admin/jqslider/add_edit_jqslider/{id}').'" class="table-link">
                    <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('lession_model', 'listing');

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
        
        $this->data['user_data'] = $this->session->userdata('admin_user_data');  
        
        $this->layout->view("lession/lession_list");
        
        
    }
    
    
    
  /*  
	
	public function add_edit_jqslider($edit_id = "")
    { 
		
		if(is_logged_in()) {
			 $edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;
			
			$this->form_validation->set_rules($this->_jqslider_validation_rules);
			
			//$get_menu = $this->jqslider_model->get_menu("cub_menu",array("SlideshowId" => $edit_id));
			
			$this->data['get_menu'] = $this->jqslider_model->get_menu("cub_menu",array("parent_id" => 7));
       
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
			
			
            $ins_data['SlideshowName']       	= $form['SlideshowName'];
           // $ins_data['Menu']       	= implode(",",$form["Menu"]);
            $ins_data['OrphanUrls']       	= implode("~",$form["OrphanUrls"]);
           
           
            $ins_data['is_active']  = $form['is_active'];
            $ins_data['TransitionType']  = $form['TransitionType'];
            $ins_data['TransitionSpeed']  = $form['TransitionSpeed'];
            $ins_data['AutoplaySpeed']  = $form['AutoplaySpeed'];
            $ins_data['maxHeight']  = $form['maxHeight'];
           
			if(empty($edit_id)){
			
			$social_data = $this->jqslider_model->insert("cub_slideshow",$ins_data);
            $this->service_message->set_flash_message('record_insert_success');
		}else {
			
			$social_data = $this->jqslider_model->update("cub_slideshow",$ins_data,array("SlideshowId" => $edit_id));
            $this->service_message->set_flash_message('record_update_success');
		}
		redirect("admin/jqslider");    
			//print_r($social_data);exit;
		}	
			
			 if($edit_id) {
                $edit_data = $this->jqslider_model->get_menu_data("cub_slideshow",array("SlideshowId" => $edit_id));
                
                if(!isset($edit_data[0])) {
                    $this->service_message->set_flash_message('record_not_found_error');
                    redirect("admin/jqslider");   
                }
                $this->data['title']          = "EDIT JQ Slider";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];
                
            }
            else if($this->input->post()) {
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD JQ Slider";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['SlideshowId'] = $edit_id != ''?$edit_id:'';
                $this->data['form_data']['OrphanUrls'] = '';
                $this->data['form_data']['TransitionType'] = 'sliding';
            }
            else
            {
                $this->data['title']     = "ADD JQ Slider";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("SlideshowName" => "","is_active" => "","Menu" => "","OrphanUrls" => "","TransitionType" => "","TransitionSpeed" => "","AutoplaySpeed" => "","maxHeight" => ""); 
            }
		
		 //$this->layout->view('/admin/header/menu/add',$this->data,TRUE); 
		$this->layout->view('admin/jqslider/add',$this->data);
		
		}
        else
        {
            redirect("admim/login");
        }  
    
	}
	
	
	
	
	
	
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
	
	

	
	function jqslider_delete()
    {
       
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from cub_slideshow where SlideshowId in ('.$id.')');
            $this->service_message->set_flash_message('record_delete_success');
            return true;  
        }
    } */
    
    
   
    
}

