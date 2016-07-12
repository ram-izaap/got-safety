<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(COREPATH."libraries/REST_Controller.php");

class Repository extends REST_Controller {
	
	
    function __construct()
    {

    	parent::__construct();

        $this->load->model(array('api_model'));
        $key  = $this->get('X-APP-KEY');
        
    }

    public function employees_get()
	{
		
		try
		{
			$output = array();

			$client_id = $this->get('client_id');
			$employees = $this->api_model->get_employees( $client_id );

			$output['status'] 	= 'SUCCESS';
			$output['employees'] 	= $employees;

			$this->response( $output, 200);
		}
		catch( Exception $e)
		{

			$output['message'] = $e->getMessage();
			$output['status'] = 'ERROR';

			$this->response($output,200);
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

	function repository_get()
	{
		$folder_name = $this->get('client_name');
		
		$dir = 'admin/views/repository/files/'.$folder_name.'/';
		//print $dir;exit;
		
		$a = $this->dir_to_json($dir);
		if($a == 'null' ){
			return $this->response(array( "status" => "errror","msg" => "Unknown Error Occurred!! Try Again...","error_code" => 2 ),200);
		}
		echo $a;exit;
		
	}
		
   

   	
	
}
?>
