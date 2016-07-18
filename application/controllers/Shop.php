<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."controllers/App_controller.php");

class Shop extends App_Controller {
    
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker','cart'));
        $this->load->model(array('product1_model'));
    }

    public function index($catname='')
    {
        $uri_segment = $this->uri->segment(2);

        if($uri_segment=='page')
        {
            $catid='';
        }
        else
        {
            if($catname!='')
            {
                $get_cat_id  = $this->product1_model->get_product("category",array("cat_name"=>str_replace("-"," ",$catname)));
                $catid = $get_cat_id[0]['id'];
            } 
            else
            {
                $catid='';
            }
        }


        $product_detail=$productvariationdtl=array();

        $this->data['cat_data'] = $this->product1_model->get_product("category",NULL);

        foreach($this->data['cat_data'] as $key=>$value)
        {
            $this->data['p_count'] = $this->product1_model->get_product_count("products",array("cat" =>$value['id'],"is_active"=>1));
            $this->data['cat_data'][$key]['p_count'] = $this->data['p_count']->cnt;
            if($catid!='')
                $this->data['cat_data'][$key]['catid'] = $catid;
        }

        if($catid=='')
        {
            $product_data = $this->product1_model->get_all_products($catid,$config='',$offset='');
            
            $offset = ($this->uri->segment(3) != '' ? $this->uri->segment(3): 0);

            $config['total_rows'] = count($product_data);
            $config['per_page']= 1;
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['uri_segment'] = 3;
            $config['base_url']= base_url().'/shop/page';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next &gt;';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>'; 
            $this->pagination->initialize($config);
            $this->data['paginglinks'] = $this->pagination->create_links();
            
            if($this->data['paginglinks']!= '') 
            {
              $this->data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.count($product_data).' results.';
            }  
            
            $product_data1 = $this->product1_model->get_all_products($catid,$config["per_page"], $offset); 
            $this->data['product_detail'] = $product_data1;
        }

        else
        {
          $product_data = $this->product1_model->get_all_products($catid,$config='',$offset='');


            $offset = ($this->uri->segment(4) != '' ? $this->uri->segment(4): 0);

            $config['total_rows'] = count($product_data);
            $config['per_page']= 1;
            //$config['first_link'] = 'First';
            //$config['last_link'] = 'Last';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['uri_segment'] = 4;
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>'; 
            $config['base_url']= base_url().'/shop/'.$catname.'/page'; 
            $this->pagination->initialize($config);
            $this->data['paginglinks'] = $this->pagination->create_links();

            if($this->data['paginglinks']!= '') 
            {
               $this->data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.count($product_data);
            }  

            $product_data1 = $this->product1_model->get_all_products($catid,$config["per_page"], $offset); 
            $this->data['product_detail'] = $product_data1;
        }

        $this->data['img_url']=$this->layout->get_img_dir();
        $this->layout->view('product/product','frontend');
        
    }

}
?>
