<?php
require_once(COREPATH."models/App_model.php");

class Admin_user_Model extends App_model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'users';
    }

    
    public function login_check($name,$pass)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('name', $name);
        $this->db->where('password', $pass);

        return $this->db->get()->row_array();
         
    }
}
?>
