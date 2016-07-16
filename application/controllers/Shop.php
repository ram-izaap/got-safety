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
        if($catname!='')
        {
         $get_cat_id  = $this->product1_model->get_product("category",array("cat_name"=>str_replace("-"," ",$catname)));
         $catid = $get_cat_id[0]['id'];
        } 
        else
        {
            $catid='';
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
            $product_data = $this->product1_model->get_all_products($catid);
            
            foreach ($product_data as $key => $value) 
            {
                $product_detail[$value['id']] = array("id"=>$value['id'],"name"=>$value['name'],"img"=>$value['img'],"is_active"=>$value['is_active'],"attr_id"=>$value['attr_id'],"updated_date"=>$value['updated_date']);
                $productvariationdtl[$value['id']][] = $value['price'];
            }

            $this->data['product_detail'] = $product_detail;
            $this->data['product_variation'] = $productvariationdtl;
        }

        else
        {
          $product_data = $this->product1_model->get_all_products($catid);
            
            foreach ($product_data as $key => $value) 
            {
                $product_detail[$value['id']] = array("id"=>$value['id'],"name"=>$value['name'],"img"=>$value['img'],"is_active"=>$value['is_active'],"attr_id"=>$value['attr_id'],"updated_date"=>$value['updated_date']);
                $productvariationdtl[$value['id']][] = $value['price'];
            }

            $this->data['product_detail'] = $product_detail;
            $this->data['product_variation'] = $productvariationdtl;
        }

        $this->data['img_url']=$this->layout->get_img_dir();
        $this->layout->view('product/product','frontend');
        
    }

}
?>
