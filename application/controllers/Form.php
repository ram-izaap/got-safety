<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Form extends App_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('safety_forms');
        $this->load->library("pdf");

        if($this->session->userdata('user_id') == "")
        {
            redirect("");
        }
    }

    public function index()
    {
        $this->layout->view("form/form_list","frontend");
    }

    function client_forms($type='')
    {
      if($_POST) 
      {

        $html = $this->safety_forms->create_pdf($this->input->post());

        $pdf = $this->pdf->load(); 
        $pdf->WriteHTML($html);

        $clientDirectory = "client1";
        
        $role = $this->session->userdata("role"); 
        
        if($role==2)
        {
           $created_user = $this->session->userdata('user_detail')['id'];
           $where = "where id=".$created_user."";
        }
        else
        {  	
          $created_user = $this->session->userdata("created_user");
          $where = "where id=".$created_user."";
        }

        $clientDirectory = $this->db->query("select name,email from users $where")->row();

        $folder = "./members/".$clientDirectory->name."/records/".date('Y')."/";
        
        if(!is_dir($folder))
        	mkdir($folder,0755,true);


        if($_POST['form_type']=='Accident Investigation')
          $filename = "./members/". $clientDirectory->name . "/records/" . date("Y")."/" . date('m-d-Y') . " - " . $this->input->post('address') . " - ".$this->input->post('form_rename').".pdf";
        
        else if($_POST['form_type']=='Safety Violation' || $_POST['form_type']=='Safety Inspection Check List')
          $filename = "./members/". $clientDirectory->name . "/records/" . date("Y")."/" . date('m-d-Y') . " - " . $this->input->post('job_site') . " - ".$this->input->post('form_rename').".pdf";

        else if($_POST['form_type']=='Daily Sign in Sheet')
          $filename = "./members/". $clientDirectory->name . "/records/" . date("Y")."/" . date('m-d-Y') . " - " . $this->input->post('project_name') . " - ".$this->input->post('form_rename').".pdf";
        
        
        

        if(file_exists($filename))
        {
            if($_POST['form_type']=='Accident Investigation')
            {
		      $filename = "./members/". $clientDirectory->name . "/records/" . date("Y")."/" . date('m-d-Y') . " - " . $this->input->post('address') . " - ".$this->input->post('form_rename')."_".strtotime('now').".pdf";
              $filename1 = "".date('m-d-Y') . " - " . $this->input->post('address') . " - ".$this->input->post('form_rename')."_".strtotime('now').".pdf";
            }

            else if($_POST['form_type']=='Safety Violation' || $_POST['form_type']=='Safety Inspection Check List')
            {
               $filename = "./members/". $clientDirectory->name . "/records/" . date("Y")."/" . date('m-d-Y') . " - " . $this->input->post('job_site') . " - ".$this->input->post('form_rename')."_".strtotime('now').".pdf";
               $filename1 = "".date('m-d-Y') . " - " . $this->input->post('job_site') . " - ".$this->input->post('form_rename')."_".strtotime('now').".pdf"; 
            }
            else if($_POST['form_type']=='Daily Sign in Sheet')
            {
               $filename = "./members/". $clientDirectory->name . "/records/" . date("Y")."/" . date('m-d-Y') . " - " . $this->input->post('project_name') . " - ".$this->input->post('form_rename')."_".strtotime('now').".pdf";
               $filename1 = "".date('m-d-Y') . " - " . $this->input->post('project_name') . " - ".$this->input->post('form_rename')."_".strtotime('now').".pdf"; 
            }
           
        }
		else
		{
			if($_POST['form_type']=='Accident Investigation')
            {
              $filename = "./members/". $clientDirectory->name . "/records/" . date("Y")."/" . date('m-d-Y') . " - " . $this->input->post('address') . " - ".$this->input->post('form_rename').".pdf";
              $filename1 = date('m-d-Y') . " - " . $this->input->post('address') . " - ".$this->input->post('form_rename').".pdf";
            }
            else if($_POST['form_type']=='Safety Violation' || $_POST['form_type']=='Safety Inspection Check List')
            {
               $filename = "./members/". $clientDirectory->name . "/records/" . date("Y")."/" . date('m-d-Y') . " - " . $this->input->post('job_site') . " - ".$this->input->post('form_rename').".pdf";
               $filename1 = "".date('m-d-Y') . " - " . $this->input->post('job_site') . " - ".$this->input->post('form_rename').".pdf"; 
            }
            else if($_POST['form_type']=='Daily Sign in Sheet')
            {
               $filename = "./members/". $clientDirectory->name . "/records/" . date("Y")."/" . date('m-d-Y') . " - " . $this->input->post('project_name') . " - ".$this->input->post('form_rename').".pdf";
               $filename1 = "".date('m-d-Y') . " - " . $this->input->post('project_name') . " - ".$this->input->post('form_rename').".pdf"; 
            }
		}


		$pdf->Output($filename, 'F');

		//email client to linked PDF report

		$config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = "html";

        $msg .=  '<a href="'.site_url().$filename.'" target="_blank">'.$filename1.'</a>';
      
        $this->email->set_mailtype("html");  
        $this->email->from('admin@gotsafety.com', 'Gotsafety');
        $this->email->to($clientDirectory->email);
        $this->email->subject('Your'.$this->input->post('form_type').' Report is ready for viewing');
        $this->email->message($msg);
        $this->email->attach($filename);
        $this->email->send();
 
        $ins_data = array();

        $ins_data['type'] = $this->input->post('form_type');
        $ins_data['filename'] = $filename1;
        $ins_data['client_id'] =$created_user;
        $ins_data['created_date'] = date("Y-m-d H:i:s");

        $this->db->insert("forms",$ins_data);

        $this->session->set_flashdata("safety_form_succ",$this->input->post('form_type')."  form has been created sucessfully",TRUE);
        $this->layout->view("form/form_list","frontend");
      }

      else
      {
        $this->layout->view("form/".$type,"frontend");
      }
    }
}
?>
