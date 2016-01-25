<?php
require_once(COREPATH."controllers/Admin_controller.php");
class User_Model extends Admin_model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'users';
    }

    function listing()
    {
        $this->_fields = " *,IF(is_blocked='1','Inactive','Active') as status";
        
        //from
        $this->db->from($this->_table);
        
        //joins
        
        
        //where
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'user_name':
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
}
?>
