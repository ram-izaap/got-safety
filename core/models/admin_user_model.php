<?php
require_once("libraries/models/App_model.php");
class Admin_user_Model extends App_model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'admin_users';
    }

    
    public function login_check($email,$pass)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('email', $email);
        $this->db->where('password', $pass);

        return $this->db->get()->row_array();
         
    }
}
?>
