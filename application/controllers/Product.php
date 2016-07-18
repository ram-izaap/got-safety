<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."controllers/App_controller.php");

class Product extends App_Controller {
    
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker','cart'));
        $this->load->model(array('product1_model'));
    }

    /*public function index($catid='')
    {

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
        
    }*/

    public function index($pname='')
    {   
        if($pname!='')
        {
         $get_p_id = $this->product1_model->get_product("products",array("name"=>str_replace("-"," ",$pname)));
         $pid = $get_p_id[0]['id'];
        } 
        else
        {
            $pid='';
        }

        $this->data['product_dtl'] = $this->product1_model->get_product_by_id($pid);
        $this->data['attr_dtl'] = $this->product1_model->get_attr_by_id($pid);
        $this->data['cat_data'] = $this->product1_model->get_product("category",NULL);
        foreach($this->data['cat_data'] as $key=>$value)
        {
            $this->data['p_count'] = $this->product1_model->get_product_count("products",array("cat" =>$value['id'],"is_active"=>1));
            $this->data['cat_data'][$key]['p_count'] = $this->data['p_count']->cnt;
            
            if($this->data['product_dtl']['cat']!='')
                $this->data['cat_data'][$key]['catid'] = $this->data['product_dtl']['cat'];
        }
        $this->layout->view('product/product_detail','frontend');
    }

    function get_price($variation_id)
    {
        $this->data['values'] = $this->product1_model->get_product("product_price",array("variation_id" => $variation_id));
        $content = $this->load->view("product/attribute_price",$this->data,TRUE);
        $status = 'success';
        echo json_encode(array('status'=>$status,'content'=>$content));
    }
}
?>
