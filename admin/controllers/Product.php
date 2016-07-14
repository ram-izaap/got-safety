<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once(COREPATH."controllers/Admin_controller.php");

class Product extends Admin_controller {
	
	protected $_product_validation_rules = array(
		                                         array('field' => 'name', 'label' => 'Product Name', 'rules' => 'trim|required'),
											     array('field' => 'cat', 'label' => 'Category', 'rules' => 'trim|required'),
                                                 array('field' => 'desc', 'label' => 'Product Description', 'rules' => 'trim|required'),
                                                 array('field' => 'sku', 'label' => 'Product SKU', 'rules' => 'required'),
                                                 array('field' => 'attrid', 'label' => 'Product Attribute', 'rules' => 'required'),
                                                 array('field' => 'price[]', 'label' => 'Amount', 'rules'=>'callback_check_attr_amt|numeric')
                                        );
	
												
   function __construct() 
    {
        parent::__construct();
        
        $this->load->model('product_model');
		$this->load->library('form_validation');
    }


    function index()
    { 
                 
		 $this->layout->add_javascripts(array('listing', 'rwd-table'));  

		 $this->load->library('listing');        
        
         $this->simple_search_fields = array('cat_name' => 'Category','name' => 'Name','sku'=> 'SKU');
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('product/view_product_details/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-eye"></i>
                    </span>
                </a>'.
                '<a href="'.site_url('product/add_product/{id}').'" class="table-link">
                    <span class="fa-stack">
                       
                        <i class="fa fa-pencil"></i>
                    </span>
                </a>';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('product_model', 'listing');

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
        
        
        
        $this->layout->view("product/product_list");
        
    }


    
    public function add_product($edit_id = "")
    { 
		//print_r($_FILES['img']['name']);exit;
       if(is_logged_in()) {

        $edit_id = (isset($_POST['edit_id']))?$_POST['edit_id']:$edit_id;

        if (empty($_FILES['img']['name']) && empty($_POST['prod_img']))
        { 
            $this->form_validation->set_rules('img', 'Image', 'required');
        } 
		
		$this->form_validation->set_rules($this->_product_validation_rules);
	

		if($this->form_validation->run())
        { 
            $form = $this->input->post();

            if(!empty($_FILES['img']['tmp_name']) )
            { 
              $upload_data = $this->do_upload();
              //$pathMain = '../assets/product_images/';
              //$this->resize_image($pathMain . '/' . $upload_data['img']['file_name']);
              $filename = (isset($upload_data['img']['file_name']))?$upload_data['img']['file_name']:"";
            }
            
            else
            {
            	$filename = (isset($_POST['prod_img']))?$_POST['prod_img']:"";
            }             	

            if(isset($form['is_active'])) 
            { 
				$form['is_active'] = $form['is_active'];	
			}
			else 
			{ 
				$form['is_active'] = "0";
			}
			
			$ins_data = array();
            $ins_data1 = array();
            $ins_data2=array();			
			
            $ins_data['name']       	= $form['name'];
            $ins_data['desc']       	= $form['desc'];
            $ins_data['cat']         = $form['cat'];
            $ins_data['img']       	= (!empty($filename))?$filename:"";
            $ins_data['add_info']  = $form['add_info'];
            $ins_data['sku']  = $form['sku'];
            $ins_data['attr_id']  = $form['attrid'];
            $ins_data['is_active']  = $form['is_active'];
            $ins_data['updated_date']  = date("Y-m-d H:i:s");
            
            if(empty($edit_id))
            {
            	$update_data = $this->product_model->insert("products",$ins_data);
                $last_insert_id = $this->db->insert_id();
                $ins_data1['p_id'] = $last_insert_id;
                
                if($last_insert_id!='')
                {
                    $i=0;
                    foreach($form['attr_id'] as $key=>$value)
                    {
                        if($form['price'][$i]!='')
                        {
                          $ins_data1['attr_val_id'] = $value;
                          $ins_data1['updated_date']  = date("Y-m-d H:i:s"); 
                          $update_data = $this->product_model->insert("product_variation",$ins_data1);
                          $last_insert_id1 = $this->db->insert_id();
                          $ins_data2['variation_id']=$last_insert_id1;
                          if($last_insert_id!='')
                          {
                            $ins_data2['price'] = $form['price'][$i];
                            $ins_data2['updated_date']  = date("Y-m-d H:i:s");
                            $update_data = $this->product_model->insert("product_price",$ins_data2);
                          }
                        }
                        ++$i;
                    }
                }
            }
            else 
            {
            	$update_data = $this->product_model->update("products",$ins_data,array("id" => $edit_id));
                
                $i=0;
                    foreach($form['attr_id'] as $key=>$value)
                    {
                        if($form['price'][$i]!='')
                        {
                          $ins_data1['p_id'] = $edit_id;
                          $ins_data1['attr_val_id'] = $value;
                          $ins_data1['updated_date']  = date("Y-m-d H:i:s");

                          $check_attr_val = $this->product_model->get_attr_id($value,$edit_id);
                          
                          if($value!=$check_attr_val->attr_val_id)
                          {
                              $update_data = $this->product_model->insert("product_variation",$ins_data1);
                              $last_insert_id1 = $this->db->insert_id();
                              if($last_insert_id1!='')
                              {
                                $ins_data2['variation_id']=$last_insert_id1;
                                $ins_data2['price'] = $form['price'][$i];
                                $ins_data2['updated_date']  = date("Y-m-d H:i:s");
                                $update_data = $this->product_model->insert("product_price",$ins_data2);
                              }
                          }
                          else
                          {
                              //$ins_data2['variation_id']=$value;
                              $ins_data2['price'] = $form['price'][$i];
                              $ins_data2['updated_date']  = date("Y-m-d H:i:s");
                              $update_data = $this->product_model->update("product_price",$ins_data2,array("variation_id" => $form['variation_id'][$i]));
                          }
                        }
                        ++$i;
                    }
            }
		     redirect("product");
		}	
			
			 if($edit_id) {
                $edit_data = $this->product_model->get_product_data("products",array("id" => $edit_id));


                if(!isset($edit_data[0])) {
                    redirect("product");   
                }
                $this->data['title']          = "EDIT PRODUCT";
                $this->data['crumb']        = "Edit";
                $this->data['form_data']      = (array)$edit_data[0];                
            }

            else if($this->input->post()) { 
                $this->data['form_data'] = $_POST;
                $this->data['title']     = "ADD PRODUCT";
                $this->data['crumb']   = "Add";
                $this->data['form_data']['id'] = $edit_id != ''?$edit_id:'';
                
            }
            else
            {
                $this->data['title']     = "ADD PRODUCT";
                $this->data['crumb']   = "Add";
                $this->data['form_data'] = array("name" => "","desc" =>"","add_info" => "","sku" => "","cat"=>"","img"=>"","attr_id"=>"","is_active" => ""); 
            }
		
            $this->load->model('category_model');
            $cat_data = $this->category_model->get_cat_data("category",NULL);
            $this->data['cat_data'] = $cat_data;


            $this->load->model('attribute_model');
            $attr_data = $this->attribute_model->get_attr_data1("attribute",NULL);
            $this->data['attr_data'] = $attr_data;

            $this->data['content'] = '';

            
            if((isset($_POST) && !empty($_POST['attrid'])) ||  !empty($edit_id)){

                if(!empty($edit_id))
                    $attr_id = $edit_data[0]['attr_id'];
                else
                    $attr_id = $_POST['attrid'];

                $attrdata['values'] = $this->product_model->get_product_data("attribute_value",array("attr_id" =>$attr_id));
                $attr_price = array(); 
                if(!empty($edit_id))
                {
                    $attr_price1 = $this->product_model->get_attr_price($edit_id);
                      foreach($attr_price1 as $key=>$value)
                      {
                         $attr_price[$value['attr_val_id']] = array('price'=>$value['price'],'variation_id'=>$value['variation_id']);
                      }
                      $attrdata['attr_price'] = $attr_price;
                }

                $this->data['content'] = $this->load->view("attribute/attribute_values",$attrdata,TRUE);
            }
            $this->data['img_url']=$this->layout->get_img_dir();
            $this->layout->view('product/add');
		
		}
        else
        {
            redirect("home");
        }  
    
	}

    function get_attributes($attr_id,$edit_id = '')
    {
        $attr_price=array();
        $this->data['values'] = $this->product_model->get_product_data("attribute_value",array("attr_id" => $attr_id));

        if(!empty($edit_id))
        {
            $attr_price1 = $this->product_model->get_attr_price($edit_id);
              foreach($attr_price1 as $key=>$value)
              {
                 $attr_price[$value['attr_val_id']] = array('price'=>$value['price'],'variation_id'=>$value['variation_id']);
              }
              $this->data['attr_price'] = $attr_price;
        }

        $content = $this->load->view("attribute/attribute_values",$this->data,TRUE);
        $status = 'success';
        echo json_encode(array('status'=>$status,'content'=>$content));
    }
	
	
	function product_delete()
    {
      
        $id = ($_POST['id'])?$_POST['id']:"";
        if(!empty($id)) {
            
            $this->db->query('delete from products where id in ('.$id.')');
            return true;  
        }
    }

    function check_attr_amt()
    {
        $amt = $this->input->post('price');
        $count=0;
        if (isset($amt) && !empty($amt))
        {
            foreach($_POST['price'] as $key => $value)
              if($value!='')
                $count++;
        }

        if($count==0)
        {  
           $this->form_validation->set_message('check_attr_amt', 'Please Select Any One Attribute Field');
           return false;
        }
        else
        {
            return true;
        }

    } 

    function do_upload()
    {
       $this->load->library('image_lib');


        $config['upload_path'] = '../assets/product_images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|PNG|JPEG';
        $config['max_size'] = '2048';
    
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("img"))
        {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
        else
        {
            $data = array("img" => $this->upload->data());
            return $data;
        }
    }

    function resize_image($sourcePath)
    {
        $this->image_lib->clear();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $sourcePath;
        $config['quality'] = '100%';
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = false;
        $config['width'] = 210;
        $config['height'] = 300;
        $this->image_lib->initialize($config);
 
        if ($this->image_lib->resize())
            return true;
        return false;
    }

    function view_product_details($pid)
    {
        $get_product_dtl = $this->product_model->get_product_by_id($pid);

        $get_attr_dtl = $this->product_model->get_attr_by_id($pid);

        $this->data['product_dtl'] = $get_product_dtl;

        $this->data['attr_dtl'] = $get_attr_dtl;

        $this->data['title'] = "PRODUCT INFORMATION";

        $this->data['crumb'] = "Product Information";

        $this->data['img_url']=$this->layout->get_img_dir();

        $this->layout->view("product/product_info");
    } 
 }

