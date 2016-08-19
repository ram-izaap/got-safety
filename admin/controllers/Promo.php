<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(COREPATH."controllers/Admin_controller.php");

class Promo extends Admin_Controller 
{
  protected $_promo_validation_rules =    array (
    array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|max_length[40]|min_length[4]'),
    array('field' => 'from_date', 'label' => 'From Date', 'rules' => 'trim|required'),
    array('field' => 'to_date', 'label' => 'To Date', 'rules' => 'trim|required'),
    array('field' => 'limit_user', 'label' => 'Limit Per User', 'rules' => 'trim|required|numeric'),
    array('field' => 'total_limit', 'label' => 'Total Limit', 'rules' => 'trim|required|numeric'),
    array('field' => 'value', 'label' => 'Value', 'rules' => 'trim|required|numeric'),
  );
	function __construct()
  {
    parent::__construct();  
    $this->load->model('promo_model');
    if(!is_logged_in()) 
    {
      redirect("login");
    }
  }
  public function index()
  {
    $this->data['coupons'] = $this->promo_model->get_coupons();
    $this->layout->view("promo/home");
  }
  public function add()
  {
    $this->data['promo_id'] = "";
    $this->data['products'] = $this->promo_model->get_products_sku("products",
        array("is_active"=>1));
    $this->layout->view("promo/add");
  }
  public function add_edit_promo($edit_id="")
  {
    $form = $this->input->post();
    $edit_id = isset($_POST['promo_id']) ? $_POST['promo_id'] : $edit_id;
    $this->form_validation->set_rules($this->_promo_validation_rules);
    $form = $this->input->post();
    $this->form_validation->set_rules("code","Code","trim|required|max_length[20]|min_length[4]|callback_check_code['".$edit_id."']'");
    if(isset($form['order_type']) && $form['order_type']=="2")
     $this->form_validation->set_rules("specific_plan[]","Plan","trim|required");
   if(isset($form['order_type']) && $form['order_type']=="1")
   {
    if(isset($form['offer_type']) && $form['offer_type']=="1")
     $this->form_validation->set_rules("amount_over","Amount Over","trim|required|numeric");
    else if(isset($form['offer_type']) && $form['offer_type']=="3")
      $this->form_validation->set_rules("specific_product[]","Product","trim|required");
   }
      if($this->form_validation->run())
      {
        /* Inserr in Coupon Details Table*/
        $ins_data['from_date'] = $form['from_date'];
        $ins_data['to_date'] = $form['to_date'];
        $ins_data['limit_per_user'] = $form['limit_user'];
        $ins_data['total_limit'] = $form['total_limit'];
        $ins_data['discount_type'] = $form['discount_type'];
        if($form['order_type']=="2")
          $ins_data['plans'] = implode(",",$form['specific_plan']);
        else
          $ins_data['plans'] = "";
        $ins_data['value'] = $form['value'];
        $ins_data['order_type'] = $form['order_type'];
        $ins_data['offer_type'] = $form['offer_type'];
        /*Insert in Coupon Code Tables*/
        $ins_data1['code'] = $form['code'];
        $ins_data1['title'] = $form['title'];       
        $ins_data1['created_date'] = date("Y-m-d H:i:s");
        /*Insert in Coupon Offers Table*/
        if($form['offer_type']=="1")
          $ins_data2['value'] = $form['amount_over'];
        else if($form['offer_type']=="2")
          $ins_data2['value'] = "";
        else
          $ins_data2['value'] = implode(",",$form['specific_product']);

        $ins_data2['created_date'] = date("Y-m-d H:i:s");
        if(empty($edit_id))
        {
          $coupon_id = $this->promo_model->insert("coupon_details",$ins_data);
          $ins_data1['coupon_id'] = $coupon_id;
          $ins_data2['coupon_id'] = $coupon_id;
          $codes = $this->promo_model->insert("coupon_codes",$ins_data1);
          $offer = $this->promo_model->insert("coupon_offers_value",$ins_data2);
        }
        else
        {
          $coupon_id = $this->promo_model->update("coupon_details",$ins_data,
              array("id"=>$edit_id));
          $codes = $this->promo_model->update("coupon_codes",$ins_data1,
            array("coupon_id"=>$edit_id));
          $offer = $this->promo_model->update("coupon_offers_value",$ins_data2,
            array("coupon_id"=>$edit_id));
        }        
        $this->session->set_flashdata("coupon_succ",TRUE);
        redirect("promo");
      }
      else
      {
        if(empty($edit_id))
        {
          $edit_data = array("code"=>"","title"=>"","from_date"=>"","to_date"=>"",
            "limit_per_user"=>"","total_limit"=>"","discount_type"=>"","value"=>"",
            "order_type"=>"","offer_type"=>"","offer"=>"");
        }
        else
        {
          $edit_data = $this->promo_model->get_promo_data($edit_id);
        }
        $this->data['promo'] = (array)$edit_data;
        $this->data['promo_id'] = $edit_id;
        $this->data['products'] = $this->promo_model->get_products_sku("products",
            array("is_active"=>1));
        $this->data['plans'] = $this->promo_model->get_plans("plan",
            array("is_active"=>1));
        $this->layout->view("promo/add");
      }
  }
  public function delete($id)
  {
    $this->promo_model->delete("coupon_codes",array("coupon_id"=>$id));
    redirect("promo");
  }
  public function check_code()
  {
    $code = $this->input->post('code');
    $id = $this->input->post('promo_id');
    if($id=="")
      $chk = $this->promo_model->check_code("coupon_codes",array("code"=>$code));
    else
      $chk =$this->promo_model->check_code("coupon_codes",array("code"=>$code,"coupon_id!="=>$id));
    if($chk)
    {
      $this->form_validation->set_message('check_code', 'This Code already exists.');
      return false;
    }
    else
      return true;

  }
}
?>
    
   