<?php
//require_once("libraries/models/App_model.php");
require_once(COREPATH."models/App_model.php");
class Employee_model extends App_Model {
    
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'employee';

    }
    
    
    
    function listing()
    {  
		$user_id =  $this->session->userdata('admin_data')['id']; 
		$role =  $this->session->userdata('admin_data')['role']; 
		
		if($role == '2'){
			$user_id = $this->session->userdata('admin_data')['id'];
		}else 
		{
			$user_id = '8';
		}
		
		$id  = $this->session->userdata('id');
		
       // $this->_fields = "*,id as id, IF(is_active='1','Active','Inactive') as is_active";
			
	   $this->_fields = "ld.*,l.name,ld.id as id,IF(ld.is_active='1','Active','Inactive') as is_active";
       $this->db->from('employee ld');
       $this->db->join('users l','l.id=ld.created_user');
       $this->db->group_by('ld.id'); 
        
       if($role == '2'){
        $this->db->where('ld.created_user',$user_id);
        }else {
			$this->db->where('ld.updated_user',$user_id);
		}
        
		
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'employee_name':
                    $this->db->like('ld.employee_name', $value);
                break;
                
                case 'employee_email':
                    $this->db->like('ld.employee_email', $value);
                break;
                
                case 'emp_id':
                    $this->db->like('ld.emp_id', $value);
                break;
                 
                case 'name':
                    $this->db->like('l.name', $value);
                break;
               
            }
        }
        
        
        return parent::listing();
    }
    
     function get_slideimage_detail($table_name,$where)
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
    
    
	 function get_menu_client($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
	
	
	
    function delete($table_name,$where,$orcondition='')
    {
        $this->db->where($where);
        if(!empty($orcondition)) {
            $this->db->or_where($orcondition);
        }
       return  $this->db->delete($table_name);
    }
    
    
     function limit_check_exists($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where)->result_array();
		 $max_limit = $result[0]['employee_limit'];
		 $user_id = $result[0]['id'];
		 
			$this->db->select();
			$this->db->from('employee');
			$this->db->where('created_user', $user_id);
			$result_check = $this->db->get()->result_array();
			//echo $max_limit."--".count($result_check);exit;
			
			if($max_limit > count($result_check)) {
				return 1;
				
			}
			
			
       
	}
	
	
	function employee_id_check_exists($table_name,$where)
    {
		
		 $result = $this->db->get_where($table_name,$where);
        return $result->result_array();
	}
	
	
	function get_client_name($client_id = "")
	{
		$this->db->select('*');
		$this->db->from('users');
        $this->db->where("id" ,$client_id);
		$result = $this->db->get()->row();
		return $result;
	}
	
	
	
	function upload_csv()
	{
		
		$user_id =  $this->session->userdata('admin_data')['id']; 
		$role =  $this->session->userdata('admin_data')['role']; 
		
		
		
		$fp = fopen($_FILES['employee']['tmp_name'],'r') or die("can't open file");
			  while($csv_line = fgetcsv($fp,1024)) 
			  {
				for ($i = 1, $j = count($csv_line); $i < $j; $i++) 
				  {
					  
						$this->db->select('id');
						$this->db->from('users');
						$this->db->where("name" ,$csv_line[0]);
						$result = $this->db->get()->result_array();
						$client_id = $result[0]['id'];
						
						$this->db->select('*');
						$this->db->from('employee');
						$this->db->where("emp_id" ,$csv_line[3]);
						$this->db->where("created_user" ,$client_id);
						$result_employee = $this->db->get()->result_array();
						//print_r(count($result_employee));exit;
						
						if(count($result_employee) == 0) {
						$insert_csv = array();
						$insert_csv['client'] = $client_id;
						$insert_csv['name'] = $csv_line[1];
						$insert_csv['email'] = $csv_line[2];
						$insert_csv['employee_id'] = $csv_line[3];
					}else {
						
						$insert_csv = array();
						$insert_csv['client'] = "";
						$insert_csv['name'] = "";
						$insert_csv['email'] = "";
						$insert_csv['employee_id'] = "";
					}
						
						
				  }
				 
					  if($role == 1) {
						   $data = array(
					   'id'    => '',
					   'employee_name' => $insert_csv['name'] ,
					   'employee_email' => $insert_csv['email'],
					   'emp_id' => $insert_csv['employee_id'],
					   'created_user' => $insert_csv['client'],
					   'updated_user' => $user_id,
					   'created_date' => date("Y-m-d H:i:s"),
					   
					   );
						  
					  }else {
						   $data = array(
					   'id'    => '',
					   'employee_name' => $insert_csv['name'] ,
					   'employee_email' => $insert_csv['email'],
					   'emp_id' => $insert_csv['employee_id'],
					   'created_user' => $insert_csv['client'],
					   'created_date' => date("Y-m-d H:i:s"),
					   );
						  
					  }
			 
					 
				$data['add_employee']=$this->db->insert('employee', $data);
				$this->db->query("delete from employee where employee_name =' ' OR employee_name = 'Name'");
				
			}
                   fclose($fp) or die("can't close file");
	       $data['success']="success";
	       return $data;
		
	}
	
	
    
    
    
}
?>
