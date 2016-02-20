<?php
//safe_include(COREPATH."models/app_model.php");

require_once(COREPATH."models/App_model.php");

class User_Model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'users';
    }

    
     function listing()
    {  
        $this->_fields = "*,id as id, IF(is_active='1','Active','Inactive') as is_active";
        
			$id =  $this->session->userdata('admin_data')['id'];
            $role =  $this->session->userdata('admin_data')['role'];
		if($role == 1){ 
			$this->db->where('role',2);
         } else { 
			$this->db->where(array('role'=>2 ,'id' => $id));
			 }
        
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'name':
                    $this->db->like($key, $value);
                break;
                 
               
            }
        }
        
        
        return parent::listing();
    }
    
    
    
    
    public function get_by_email($email)
    {
        $this->db->select();
        $this->db->from($this->_table);
        $this->db->where('email', $email);
        $result = $this->db->get();
        return $result->row_array();
    }
    public function get_by_loginid($login_id)
    {
        $this->db->select();
        $this->db->from($this->_table);
        $this->db->where('user_name', $login_id);
        $result = $this->db->get();
        return $result->row_array();
    }
    public function get_users($id = 0)
    {
        $this->db->select();
        $this->db->from($this->_table);
        if($id != 0) {
            $this->db->where('id', $id);
        }
        $result = $this->db->get();
        return $result;
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
	
	
	
	function get_menu($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
    
    
      function get_lession_data($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
    
    
    
    function insert($table_name,$data)
    {
        return $this->db->insert($table_name,$data);
    }
    
    
    function update($table_name,$data,$where)
    { 
        $this->db->where($where);
        return $this->db->update($table_name,$data);
    }
    
    function get_info($table_name)
    {
		
		$this->db->select("*");
        $this->db->from($table_name);
        return $result = $this->db->get()->result_array();
		
	}
	
	function delete($table_name,$where,$orcondition='')
    {
        $this->db->where($where);
        if(!empty($orcondition)) {
            $this->db->or_where($orcondition);
        }
       return  $this->db->delete($table_name);
    }
    
    
    function get_lession_detail($table_name,$where)
    {
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
		
	}
	
	
	function get_lession_attachment($table_name,$where)
	{
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
    
    
	
	
    
}
?>
