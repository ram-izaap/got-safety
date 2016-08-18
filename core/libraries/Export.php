<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Excel library for Code Igniter applications
* Based on: Derek Allard, Dark Horse Consulting, www.darkhorse.to, April 2006
* Tweaked by: Moving.Paper June 2013
*/
class Export{
    
    function to_excel($array, $filename) { 
         

         //Filter all keys, they'll be table headers
        $h = array();

       $url = str_replace('/admin','',base_url());
     
        $str='';

        foreach($array as $row){
            foreach($row as $key=>$val){
                if(!in_array($key, $h)){
                 $h[] = $key;   
                }
                }
                }
                //echo the entire table headers
                $str .= '<table><tr>';
                foreach($h as $key) {
                    $key = ucwords($key);
                    $str .= '<th>'.$key.'</th>';
                }
                $str .= '</tr>';
                
                foreach($array as $row){
                     $str .= '<tr>';
                    foreach($row as $val)
                    {
                        if(substr(strrchr($val,'.'),1))
                            //echo '<td><img src="../signature/'.$val.'"></td>';
                           $str .= "<td><img src='".$url."/signature/".$val."' width='150' height='40'></td>";
                        else
                            $str .= $this->writeRow($val); 
                    }  
                }
                $str .= '</tr>';
                $str .= '</table>';



               echo $str;

               header('Content-type: application/vnd.ms-excel');
               header('Content-Disposition: attachment; filename='.$filename.'.xls');
            
        }
    function writeRow($val) {
                return '<td>'.utf8_decode($val).'</td>'; 
                //echo              
    }

}

