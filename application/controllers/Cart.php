<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Cart extends App_Controller {
    
    function __construct()
    {
        parent::__construct();
        
        $this->layout->add_javascripts(array('cart'));
        $this->load->library('cart');
        $this->load->model(array('cart_model'));
    }

    function index()
    {
        $this->load->model("product1_model");
        $this->data['cat_data'] = $this->product1_model->get_product("category",NULL);

        $tax = $this->cart_model->get_other_cost("tax_amt"); 
        
        $ship_cost = $this->cart_model->get_other_cost("ship_amt");

        if(!$this->session->userdata('tax_amt')) 
            $tax_amt = $this->session->set_userdata("tax_amt",$tax);

        if(!$this->session->userdata('ship_amt')) 
            $ship_amt = $this->session->set_userdata("ship_amt",$ship_cost);

        foreach($this->data['cat_data'] as $key=>$value)
        {
            $this->data['p_count'] = $this->product1_model->get_product_count("products",array("cat" =>$value['id'],"is_active"=>1));
            $this->data['cat_data'][$key]['p_count'] = $this->data['p_count']->cnt;
        }

        $this->data['img_url'] = get_img_dir();
        $this->layout->view("cart/cart_list","frontend");
    }

    function add($product_id,$attr_id,$qty)
    {
        //check if product id is integer
        if(!(int)$product_id)
        {
            $this->_error_msg = "Invalid product.";
            return FALSE;
        }
        //check if product id is integer
        if(!(int)$attr_id)
        {
            $this->_error_msg = "Invalid attribute.";
            return FALSE;
        }
        //check if qty is valid integer
        if (!preg_match('/^[0-9]*$/', $qty)) {
            $this->_error_msg = "Invalid quantity.";
            return FALSE;
        }
        
        if(!(int)$qty)
        {
            $this->_error_msg = "Invalid quantity.";
            return FALSE;
        }

        $product = $this->cart_model->get_product($product_id,$attr_id);

        if(!count($product))
        {
            $this->_error_msg = "Invalid product.";
            return FALSE;
        }

        $product->id    = $product->sku;
        $product->name = $product->name;
        $product->price  = $product->price;
        $product->qty    = ((int)$qty)?((int)$qty):(1);
        $product->options = array('product_id'=>$product->id1,'Description' => $product->desc, 'Additional Information' => $product->add_info,'Product Image' =>$product->img,'Attribute Name'=>$product->attr_name,'Attribute Value'=>$product->attr_val,'Price'=>$product->price);
        $found = false;

        foreach ($this->cart->contents() as $id => $item)  
        {
            if ($product->id == $item['id'] && $product->attr_val == $item['attr_val']) 
            {

                $found = TRUE;
                $product->rowid = $id;
                $product->qty  += $item['qty'];
                break;
            }
        }

        if ($found === TRUE) 
        {

           $this->cart->update(get_object_vars($product));
           $this->data['img_url'] = get_img_dir();
           $content = $this->load->view("cart/mini_cart",$this->data,TRUE);
           $status = 'success';
           echo json_encode(array('status'=>$status,'subtotal'=>$this->cart->total(),'total_items'=>$this->cart->total_items(),'content'=>$content));
        } 
        else 
        {
            $this->cart->insert(get_object_vars($product));
            $this->data['img_url'] = get_img_dir();
            $content = $this->load->view("cart/mini_cart",$this->data,TRUE);
            $status = 'success';
            echo json_encode(array('status'=>$status,'subtotal'=>$this->cart->total(),'total_items'=>$this->cart->total_items(),'content'=>$content));
        }
    }

    function get_cart_dtl()
    {
        $this->data['img_url'] = get_img_dir();
        $content = $this->load->view("cart/mini_cart",$this->data,TRUE);
        $status = 'success';
        echo json_encode(array('status'=>$status,'subtotal'=>$this->cart->total(),'total_items'=>$this->cart->total_items(),'content'=>$content));
    }

    function update_cart()
    {

        $cart_info = $_POST['cart'] ;
        foreach( $cart_info as $id => $cart)
        {
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];

            $data = array('rowid' => $rowid,'price' => $price,'amount' => $amount,'qty' => $qty);
            $this->cart->update($data);
        }
        
        redirect('cart');
    }

    function remove_cart($rowid,$remove='')
    {

        if($remove=="all")
        {
            $this->cart->destroy();
        }
        
        else
        {  
           $data = array('rowid' => $rowid,'qty' => 0);
           $this->cart->update($data);
        }

            
        $this->data['img_url'] = get_img_dir();
        $content = $this->load->view("cart/mini_cart",$this->data,TRUE);
        $status = 'success';
        echo json_encode(array('status'=>$status,'subtotal'=>$this->cart->total(),'total_items'=>$this->cart->total_items(),'content'=>$content));
    }
}
?>
