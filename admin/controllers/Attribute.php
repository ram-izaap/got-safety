<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Attribute extends Admin_controller {
													
   function __construct() 
    {
        parent::__construct();
        
        $this->load->model('attribute_model');
        $this->load->model('attribute_value_model');
        $this->load->library('form_validation');
    }


    function index()
    { 
                 
		 $this->layout->add_javascripts(array('listing', 'rwd-table'));  

		 $this->load->library('listing');        
        
         $this->simple_search_fields = array('attr_name' => 'Attribute');
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="#" onclick="edit_attr_name({id})" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('attribute_model', 'listing');

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
        
        
        
        $this->layout->view("attribute/attribute_list");
        
    }

    function attribute_value()
    { 
                 
         $this->layout->add_javascripts(array('listing', 'rwd-table'));  

         $this->load->library('listing');        
        
         $this->simple_search_fields = array('attr_name' => 'Attribute','attr_val' => 'Attribute Value');
         
         $this->_narrow_search_conditions = array("start_date");
        
         $str = '<a href="#" id1="{id}" attr_id="{attr_id}" attr_val="{attr_val}"  class="table-link add_attr_val">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
         $this->listing->initialize(array('listing_action' => $str));

         $listing = $this->listing->get_listings('attribute_value_model', 'listing');

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
        
         $this->layout->view("attribute/attribute_value_list");
        
    }
    
    public function add_edit_attr($edit_id='')
    { 

       if(is_logged_in()) {

           $edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;

           $form = $this->input->post();

            $ins_data = array();            
            
            if(empty($edit_id) && $form['save_method']=='add' || !empty($edit_id) && $form['save_method']=='update')
            {
                $ins_data['attr_name']  = $form['attr_name'];
                $ins_data['updated_date']  = date("Y-m-d H:i:s");
                
                if($form['save_method']=='add')
                  $update_data = $this->attribute_model->insert("attribute",$ins_data);
                else
                  $update_data = $this->attribute_model->update("attribute",$ins_data,array("id" => $edit_id));
                
                echo json_encode(array("status" => TRUE));
            }

            else
            {
                $edit_data = $this->attribute_model->get_attr_data("attribute",array("id" => $edit_id));
                echo json_encode($edit_data);
            }
        }
        else
        {
            redirect("home");
        } 
    }

    public function add_edit_attr_val($edit_id='')
    { 

       if(is_logged_in()) {

           $edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;

           $form = $this->input->post();


            $ins_data = array();            
            
            if(empty($edit_id) && $form['save_method']=='add' || !empty($edit_id) && $form['save_method']=='update')
            {
                $ins_data['attr_id']  = $form['attr_name'];
                $ins_data['attr_val']  = $form['attr_val'];
                $ins_data['updated_date']  = date("Y-m-d H:i:s");
                
                if($form['save_method']=='add')
                {

                  $update_data = $this->attribute_model->insert("attribute_value",$ins_data);
                }
                else
                {
                  $update_data = $this->attribute_model->update("attribute_value",$ins_data,array("id" => $edit_id));
                }
                
                echo json_encode(array("status" => TRUE));
            }

            else
            {
                $edit_data = $this->attribute_model->get_attr_data("attribute_value",array("id" => $edit_id));
                echo json_encode($edit_data);
            }
        }
        else
        {
            redirect("home");
        } 
    }
    
	
	function get_attribute()
  {
      $attr_id = $this->input->post("attr_id");

      if($attr_id!='')
        $where = array("id" => $attr_id);
      else
        $where = '';
      
      $edit_data = $this->attribute_model->get_attr_data1("attribute",$where);
      echo json_encode($edit_data);
  }

  

	function attr_delete()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from attribute where id in ('.$id.')');
            return true;  
        }
    }
    
    function attr_delete1()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from attribute_value where id in ('.$id.')');
            return true;  
        }
    }  
 }

