<?php

function is_logged_in()
{
    if(isset($_SESSION['admin_data']['id'])) 
        return true;
    else
        return false;
    exit;

}


function get_current_user_id()
{
    $CI = & get_instance();
    
    $current_user = get_user_data();
    
    if(!empty($current_user)) {
        return $current_user['user_id'];
    }
}
function get_user_data()
{ 
  $CI = get_instance();
    
        
    if($CI->session->userdata('user_detail')){
        return $CI->session->userdata('user_detail');
    }
    else
    {
        return FALSE;
    }
}

function get_user_role( $user_id = 0 )
{  
    return '1';

    $CI= & get_instance();
    
    if(!$user_id) 
    {
        $user_data = get_user_data();
        return $user_data['role'];
    }   
    
    $CI->load->model('user_model');
    $row = $CI->user_model->get_where(array('id' => $user_id))->row_array;

    if( !$row )
        return FALSE;

    return $row['role'];
}

function get_roles()
{
    $CI = & get_instance();
    $CI->load->model('role_model');
    $records = $CI->role_model->get_roles();

    $roles = array();
    foreach ($records as $id => $val) 
    {
        $roles[$id] = $val;
    }

    return $roles;
}


function displayData($data = null, $type = 'string', $row = array(), $wrap_tag_open = '', $wrap_tag_close = '')
{
     $CI = & get_instance();
     
    if(is_null($data) || is_array($data) || (strcmp($data, '') === 0 && !count($row)) )
        return $data;
    
    switch ($type)
    {
        case 'string':
            break;
        case 'humanize':
        $CI->load->helper("inflector");
            $data = humanize($data);
            break;
        case 'date':
                str2USDate($data);
            break;
        case 'datetime':
            $data = str2USDate($data);
            break;
        case 'money':
            $data = '$'.number_format((float)$data, 2);
            break; 
            
            
        case 'attach_link':
			$data ='<a href="'.base_url().'index.php/attachment?id='.$row['id'].'"><i class="fa fa-plus cen-align"></i></a>';
            break; 
        
        
         case 'attach_link2':
			$data ='<a href="'.base_url().'index.php/attach?id='.$row['id'].'"><i class="fa fa-plus cen-align"></i></a>';
            break; 
            
        case 'user_role':
				if($data== '2'){
					$data ="Client";
				}else {
					$data = "User";
				}
			$data = $data;
            break; 
            
        case 'admin_client_list':
			$data ='<a href="'.base_url().'index.php/client?id='.$row['id'].'"><i class="fa fa-plus cen-align2"></i></a>';
            break;           
        case 'find_employee':
			
			$CI = & get_instance();    
            $CI->load->model('signoff_model');
            $name = $CI->signoff_model->get_employee_name($data);
            $data = $name->employee_name;
            break; 
            
            
            case 'find_client':
			
			$CI = & get_instance();    
            $CI->load->model('employee_model');
            $name = $CI->employee_model->get_client_name($data);
            $data = $name->name;
            break; 
            case 'find_plan':
                $data = ucfirst($data);
            break;
            case 'find_topic':
                $data = $data;
            break;            
            case 'shot_desc':
            if(strlen($data)>35) {
				$result = substr(ucfirst(strip_tags($data)), 0, 50) . "....";
			}else {
				$result = $data;
			}
            $data = $result;
            break;
            
            case 'symbol_amt':
            
            $data = '$'.$data;
            break; 
               
    }
    
    return $wrap_tag_open.$data.$wrap_tag_close;
}

function str2USDate($str)
{
    $intTime = strtotime($str);
    if ($intTime === false)
         return NULL;
    return date("m/d/Y H:i:s", $intTime);
}

function str2USDT($str)
{
    $intTime = strtotime($str);
    if ($intTime === false)
         return NULL;
    return date("m/d/Y", $intTime);
}

    // no logic for server time to local time.
function str2DBDT($str=null)
{
    $intTime = (!empty($str))?strtotime($str):time();
    if ($intTime === false)
         return NULL;
    return date("Y-m-d H:i:s", $intTime);
}

function str2DBDate($str)
{
    $intTime = strtotime($str);
    if ($intTime === false)
        return NULL;
    return date("Y-m-d",$intTime);
}

function addDayswithdate($date,$days){

    $date = strtotime("+".$days." days", strtotime($date));
    return  date("m/d/Y", $date);

}

function day_to_text($date) {
    
    $day_no = date("N",strtotime($date));
    
    $day_array = array(1 => "Monday" , 2 => "Tuesday" , 3 => "Wednesday" , 4 => "Thursday" , 5 => "Friday" , 6 => "Saturday" , 7 => "Sunday" );
    
    return $day_array[$day_no];
}


function date_ranges($case = '')
{
    $dt = date('Y-m-d');
    if(empty($case)){
        return false;
    }

    switch($case)
    {
        case 'today':
            $highdateval = $dt;
            $lowdateval = $dt;
        break;
        case 'thisweek':
            $highdateval = date('Y-m-d', strtotime('saturday this week'));
            $lowdateval  = date('Y-m-d', strtotime('sunday last week'));
        break;
        case 'thisweektodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('sunday last week'));
        break;
        case 'thismonth':
            $highdateval = date('Y-m-d', strtotime('last day of this month'));
            $lowdateval  = date('Y-m-d', strtotime('first day of this month'));
        break;
        case 'thismonthtodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('first day of this month'));
        break;
        case 'thisyear':
            $highdateval = date('Y-m-d', strtotime('1/1 next year -1 day'));
            $lowdateval  = date('Y-m-d ', strtotime('1/1 this year'));
        break;
        case 'thisyeartodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('1/1 this year'));
        break;
        case 'thisquarter':
        $quarters = array();
        $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
        $quarters[01] = $quarters[02] = $quarters[03] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
        $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
        $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('10/1 this year - 1 day')));
        $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('10/1 this year')),'end_date' =>  date('Y-m-d', strtotime('1/1 next year -1 day')));
        $cur_month = (int) date("m",strtotime($dt));
       
        
        $date_range = $quarters[$cur_month];
        $highdateval = $date_range['end_date'];
        $lowdateval  = $date_range['start_date'];
        break;
        case 'yesterday':
            $highdateval = date('Y-m-d', strtotime('yesterday'));
            $lowdateval  = date('Y-m-d', strtotime('yesterday'));
        break;
        case 'recent':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-4,date("Y")));
        break;
        case 'lastweek':
            $highdateval = date('Y-m-d', strtotime('saturday last week'));
            $lowdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
        break;
        case 'lastweektodate':
            if(date('l')=="Sunday")
            {
                $highdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
            }
            else
            {
                //$lastweek = date('l').' last week';
                $highdateval = date('Y-m-d');
            }
            
            $lowdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
        break;
        case 'lastmonth':
            $lowdateval  = date('Y-m-d', strtotime('first day of last month'));
            $highdateval = date('Y-m-d', strtotime('last day of last month'));
        break;
        case 'lastmonthtodate';
            $lowdateval  = date('Y-m-d', strtotime('first day of last month'));
            $highdateval = date('Y-m-d', strtotime('last month'));
        break;
        case 'lastquater':
            $quarters = array();
            $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
            $quarters[01] = $quarters[02] = $quarters[03] =  array('start_date' => date('Y-m-d', strtotime('10/1 last year')),'end_date' =>  date('Y-m-d', strtotime('1/1 this year -1 day')));
            $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
            $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
            
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
            break;
        case 'lastquatertodate':
            $quarters = array();
            $todaydate = date('d',strtotime($dt));
            $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
            $quarters[01] = $quarters[02] = $quarters[03] =  array('start_date' => date('Y-m-d', strtotime('10/1 last year')),'end_date' =>  date('Y-m-d', strtotime('10/'.$todaydate.' last year')));
            $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('1/'.$todaydate.' this year')));
            $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('4/'.$todaydate.' this year')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('7/'.$todaydate.' this year')));
            
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
        break;
        case 'lastyear':
            $lowdateval  = date('Y-m-d', strtotime('1/1 last year'));
            $highdateval = date('Y-m-d', strtotime('1/1 this year -1 day'));
        break;
        case 'lastyeartodate':
            $lowdateval  = date('Y-m-d', strtotime('1/1 last year'));
            $highdateval = date('Y-m-d');
        break;
        case 'since30days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-31,date("Y")));
        break;
        case 'since60days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-61,date("Y")));
        break;
        case 'since90days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-91,date("Y")));
        break;
        case 'since350days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-351,date("Y")));
        break;
        case 'nextweek':
            $lowdateval  = date('Y-m-d', strtotime('this sunday'));
            $highdateval = date('Y-m-d', strtotime('next week saturday'));
        break;
        case 'nextfourweeks':
            $lowdateval  = date('Y-m-d', strtotime('this sunday'));
            $highdateval = date('Y-m-d', strtotime('+4 weeks Saturday'));
        break;
        case 'nextmonth':
            $lowdateval  = date('Y-m-d', strtotime('first day of next month'));
            $highdateval = date('Y-m-d', strtotime('last day of next month'));
        break;
        case 'nextquater':
            $quarters = array();
            $first_day_year = date('Y-m-d', strtotime('1/1 next year'));
            //$quarters[01] = $quarters[02] = $quarters[03] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
             $quarters[01] = $quarters[02] = $quarters[03]= array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
             $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('10/1 this year - 1 day')));
            $quarters[07] = $quarters[08] = $quarters[09]  = array('start_date' => date('Y-m-d', strtotime('10/1 this year')),'end_date' =>  date('Y-m-d', strtotime('1/1 next year -1 day')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 next year - 1 day')));
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
        break;
        case 'nextyear':
            $lowdateval  = date('Y-m-d', strtotime('1/1 next year'));
            $highdateval = date('Y-m-d', strtotime('12/31 next year'));
        break;
        }

        return array('highdateval' => $highdateval, 'lowdateval' => $lowdateval);
   }
   
   
function update_usermeta($key = '',$value = '',$user_id = '') {
    
    if(!$key || !$user_id)
        return false;
        
    $CI = & get_instance();    
    $CI->load->model('user_model');
    
    $meta_row = $CI->user_model->get_where(array('meta_key' => $key, 'user_id' => $user_id),"*",'usermeta');
    
    $data = $return_data = array();
    $data['meta_value'] = $value;
    $data['updated_id'] = getAdminUserId();
    $data['updated_time'] = date('Y-m-d', local_to_gmt());
    
    if($meta_row->num_rows() > 0){
        $meta_row_data = $meta_row->row_array();
        $return_data['prev_value'] = $meta_row_data['meta_value'];
        $CI->user_model->update(array('umeta_id' => $meta_row_data['umeta_id']),$data,'usermeta');
        $return_data['id'] = $meta_row_data['umeta_id'];
        $return_data['status'] =  "update";
        
    }
    else
    {
        $data['meta_key'] = $key;
        $data['user_id'] = $user_id;
        $data['created_id'] = getAdminUserId();
        $data['created_time'] = date('Y-m-d', local_to_gmt());
        $umeta_id = $CI->user_model->insert($data,'usermeta');
        $return_data['id'] = $umeta_id;
        $return_data['status'] =  "add";
    }
    
    return $return_data;
    
}


function get_usermeta($key = '',$user_id = '') {
    
    if(!$key || !$user_id)
        return false;
        
    $CI = & get_instance();    
    $CI->load->model('user_model');
    $meta_row = $CI->user_model->get_where(array('meta_key' => $key, 'user_id' => $user_id),"*",'usermeta');
      
    if($meta_row->num_rows() > 0){
        $meta_row_data = $meta_row->row_array();
    
        return $meta_row_data['meta_value'];
    }
    else
    {
        return false;
    }
}



function xml_obj_to_array($xml_obj) {
        
            $json = json_encode($xml_obj,TRUE);
            $arr = json_decode($json,TRUE);
        
        return $arr;                     
}



function site_traffic()
{
    $CI = & get_instance();
    
    
}


function actionLogAdd($type,$id = NULL, $action)
{
    $CI = & get_instance();
    $CI->load->model('log_model');
    $CI->log_model->add($type,$id,$action);
}

function is_valid_product($product_id = 0)
{
    $CI->db->load->model('product_model');

    $result = $CI->db->product_model->get_where(array('id' => $product_id));

    return $result->num_rows()?TRUE:FALSE;
}

function is_valid_user($user_id = 0)
{
	
    $CI->db->load->model('user_model');

    $result = $CI->db->user_model->get_where(array('id' => $user_id));

    return $result->num_rows()?TRUE:FALSE;
}

function get_img_dir(){
	$CI = & get_instance();
	return $CI->layout->get_img_dir(); 
}

function api_credentials($payment_mode,$type)
{
    $CI = & get_instance();
    
    $api_credentials = $CI->db->query("select * from payment_api_credentials where payment_mode='".$payment_mode."' and payment_method='".$type."' ")->row_array();
    
   if($payment_mode == 'sandbox') 
   { 
    $api = array(
			'Sandbox' => (isset($api_credentials['payment_mode']) && ($api_credentials['payment_mode']=='sandbox'))?true:false, 			
			'APIUsername' => $api_credentials['api_username'], 	
			'APIPassword' => $api_credentials['api_password'], 	
			'APISignature' => $api_credentials['api_signature'], 	
			'APISubject' => '', 									
			'APIVersion' => $api_credentials['api_version']	
		);
   }
   elseif($payment_mode=="TEST")
   {
     $api = array(
        'api_login_id'=>$api_credentials['api_username'],
        'api_transaction_key'=>$api_credentials['api_password'],
        'mode'=>$api_credentials['payment_mode'],
        );
   }
   
   return $api;     
}

function get_plan_details($plan_id)
{
    $CI = & get_instance();
    return $plan = $CI->db->query("select * from plan where id='".$plan_id."'")->row_array();
}
function get_applied_coupon($user_id,$cp_id)
{
   $CI = & get_instance();
   $CI->db->where("user_id",$user_id);
   $CI->db->where("id",$cp_id);
   return $plan = $CI->db->get("coupon_applied")->row_array();
}

function coupon_apply($code,$plan)
{
  $CI = & get_instance();
  $CI->load->model('login_model');
  $chk = $CI->login_model->code_apply($code,$plan);
  $user_id = session_id();
  $ch_applied = $CI->login_model->check_coupon_applied("coupon_applied",
      array("user_id"=>$user_id));
  if(!$CI->session->userdata('coupon_details') || $CI->session->userdata['signup_data']['promo_code']!='')
  {
    if(!$ch_applied)
    {
      if($chk)
      {
        $amt = $chk['plan_amount'];
        $coupon_id = $chk['id'];
        if($chk['discount_type'] =="1")
        {
          $value = $chk['value'];
          $ans = $amt - $value;
          $st="1";
        }
        else if($chk['discount_type'] =="2")
        {
          $value = $chk['value'];
          $value = (($amt) / 100) * $value;
          $ans = $amt - ((($amt) / 100) * $value);
          $st="2";
        }
        $ins_data['user_id'] = session_id();
        $ins_data['code'] = $code;
        $ins_data['coupon_id'] = $coupon_id;
        $ins_data['plan_id'] = $plan;
        $ins_data['org_amount'] = $amt;
        $ins_data['discount_amount'] = number_format($value,2);
        $ins_data['total'] = number_format($ans,2);
        $CI->session->set_userdata("coupon_details",$ins_data);
        //$this->data['coupon'] = array("code"=>$code,"cid"=>$cid,"ans"=>$ans);
        echo "<span class='coupon_succ'><strong>$code - $$value
          <a href='javascript:void(0);' class='del_coupon'>x</a>
          </strong></span>";
      }
      else
      {
        echo "<span class='vstar'>Coupon is Invalid</span>";
        $CI->session->userdata['signup_data']['promo_code'] ="";
      }
    }
    else
    {
      echo "<span class='vstar'>You Already Availed this offer</span>";
    }
  }
  else
  {
    echo "<span class='vstar'>Only one time will be allowed to apply coupon</span>";
  }
}

?>

