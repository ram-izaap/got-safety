<?php
class Checkout_model extends CI_Model {
			
		function __construct()
		{
				parent::__construct();
				$this->_table = '';
		}

		function get_data($table_name)
		{
		$result = $this->db->get($table_name);
				return $result->result_array();
	}

		function create_sales_order($table_name,$data)
		{
				$this->db->insert($table_name,$data);
				return $this->db->insert_id();
		}

		function addaction_loginfo($type,$action_content,$action_id)
		{
				
				$loginfo_details = array('action' => $action_content,
																 'action_id' => $action_id,
																 'line' => $type,
																 'created_time' => date("Y-m-d H:i:s")
														);
											 
				$this->db->insert('log', $loginfo_details);
		}

		function get_order_log($where)
		{
				$result = $this->db->get_where("log",$where)->row_array();
				return $result;
		}

		 function get_product_details_by_sales_order($so_id, $order_details_only = FALSE)
		{
				$so_ids = is_array($so_id)?$so_id:array($so_id);
				
				$fields = ' so.id as sales_order_id,
										soi.id as so_item_id,
										soi.product_id,
										soi.item_status,
										soi.unit_price,
										products.sku,
										products.name as product_name,
										';
				if($order_details_only)
				{
						$fields .= 'sum(soi.quantity) as quantity';
				}
				else 
				{
						$fields .= 'soi.quantity';
				}
				
				
				$this->db->select($fields, FALSE);
				$this->db->from('sales_order so');
				$this->db->join('sales_order_item soi', 'soi.sales_order_id=so.id');
				$this->db->join('products', 'products.id=soi.product_id');
				
				
				$this->db->where_in('so.id', $so_ids);
				
				return $this->db->get()->result_array();
		}

		function get_address($where)
		{
				$result = $this->db->get_where("address",$where);
				$address = $result->row_array();
				return $address;
		}

		function get_address1($where)
		{
				$this->db->order_by("created_date","DESC");
				$this->db->limit(1);
				$result = $this->db->get_where("address",$where)->row_array();
				return $result;
		}
		public function get_coupon_data($code)
		{
			$this->db->select("a.*,c.value as offer,b.id as c_id");
			$this->db->from("coupon_details a");
			$this->db->join("coupon_codes b","a.id=b.coupon_id");
			$this->db->join("coupon_offers_value c","a.id=c.coupon_id");
			$this->db->where("b.code",$code);
			$this->db->where("a.order_type","1");
			$result = $this->db->get();
			return $result->row_array();
		}
		public function check_coupon_applied($userid,$cid)
		{
			$this->db->where("coupon_id",$cid);
			$this->db->where("user_id",$userid);
			$result = $this->db->get("coupon_applied");
			return $result->row_array();
		}
		public function insert($table_name,$data)
		{
			$this->db->insert($table_name,$data);
			return $this->db->insert_id();
		}
 }
?>
