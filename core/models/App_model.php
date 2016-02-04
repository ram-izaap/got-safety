<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_model extends CI_Model
{ 
	protected $db;
	protected $_CI;
	protected $_table;
	protected $_debug = FALSE;
	protected $escape = TRUE; //Set this as TRUE if tilt symbol needs to be added with table fields.
	protected $_fields = '';

	public function __construct()
	{ 
		parent::__construct();
		$this->_CI = get_instance();
		if (!$this->_table) {
			$this->_table = $this->getTableName();
		}

		$this->db = $this->_CI->db;

	}

	function listing()
	{
	   
		$this->_fields = 'SQL_CALC_FOUND_ROWS '.$this->_fields;
		$this->escape = FALSE;
		$this->db->select($this->_fields, $this->escape);
		 
		$this->db->limit($this->listing->_get_per_page(), $this->listing->_get_offset());
		$this->db->order_by($this->listing->_get_order() , $this->listing->_get_direction());
		 
		$list = $this->db->get($this->_table)->result_array();
	 
		$count = $this->db->query("select FOUND_ROWS() as count")->row()->count;
		 
		return array(
    	            'list'  => $list,
    	            'count' => $count
		);
		 
	}

	public function get_where($where = array(), $fields = '*',$table = NULL, $order_by = NULL)
	{
		if(!is_array($where)) return FALSE;
		 
		$this->db->select($fields);
		 
		foreach ($where as $f => $v)
		{
			if(is_array($v))
			$this->db->where_in($f, $v);
			else
			$this->db->where($f, $v);
		}
		 
		if( !is_null($order_by) )
		$this->db->order_by($order_by);

		$table = ($table)?$table:$this->_table;
		 
		return $this->db->get($table);
	}


	



	function getTableName()
	{
		$class = strtolower(get_class($this));
		return substr($class, 0, strlen($class) - 6);
	}

	public function get_last_id()
    {
        return $this->db->insert_id();
    }
 

	protected function _before_save($data) {
	}

	protected function _after_save($last_id) {
	}

}

?>
