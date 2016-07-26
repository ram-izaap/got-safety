<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."controllers/App_controller.php");

class Product extends App_Controller {
    
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('bootstrap.min','bootstrap-datepicker','cart'));
        $this->load->model(array('product1_model'));
    }

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
            $this->data['cat_data'][$key]['p_count'] = count($this->data['p_count']);
            
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
