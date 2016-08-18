<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

//safe_include("controllers/app_controller.php");
require_once(COREPATH."controllers/App_controller.php");
class Repository extends App_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('forms1_model'));
        if($this->session->userdata('user_id') == "")
        {
            redirect("");
        }
    }

    function dir_to_array($dir)
    {   
        if (!is_dir($dir)) { 
                // If the user supplies a wrong path we inform him.
                return null;
        }

        // Our PHP representation of the filesystem
        // for the supplied directory and its descendant.
        $data = [];

        foreach (new DirectoryIterator($dir) as $f) {
                if ($f->isDot()) {
                        // Dot files like '.' and '..' must be skipped.
                        continue;
                }

                $path = $f->getPathname();
                $name = $f->getFilename();
                $ext = $f->getExtension();
                
                $url_path = base_url().$f->getPathname();

                if ($f->isFile()) {
                        $data[] = [ 'name' => $name ,'ext' => $ext,'url' => $url_path];
                } else {
                        // Process the content of the directory.
                        $files = $this->dir_to_array($path);

                       /* $data[] = [ 'dir'  => $files,
                                    'name' => $name ]; */
                                    
                         $data[] = [ 'name'  => $name,
                                    'children' => $files ];        
                             
                                    
                        // A directory has a 'name' attribute
                        // to be able to retrieve its name.
                        // In case it is not needed, just delete it.
                }
        }

        // Sorts files and directories if they are not on your system.
        \usort($data, function($a, $b) {
                $aa = isset($a['file']) ? $a['file'] : $a['name'];
                $bb = isset($b['file']) ? $b['file'] : $b['name'];

                return \strcmp($aa, $bb);
        });

        return $data;
}

    /*
     * Converts a filesystem tree to a JSON representation.
     */
    function dir_to_json($dir)
    {  
            
            //$dir = site_url('admin/views/repository/files/client');
            $data = $this->dir_to_array($dir);
            $data = json_encode($data);

            return $data;
    }

    function index()
    {

        $role = $this->session->userdata('user_detail')['role'];

        if($role==2)
        {
          $folder_name = $this->session->userdata('user_detail')['name'];
        }
        else
        {
            $id = $this->session->userdata['created_user'];
            $name = $this->db->query("select name from users where id=".$id."")->row();
            $folder_name = $name->name;
        }
        
        $dir = 'admin/views/repository/files/'.$folder_name.'/';
        //print $dir;exit;
        
        $this->data['result'] = $this->dir_to_json($dir);
        if($this->data['result'] == 'null' ){
            return $this->response(array( "status" => "errror","msg" => "Sorry no repositary found!! Try Again...","error_code" => 2 ),200);
        }
        
        $this->layout->view("repository/repository","frontend");
    }

}
