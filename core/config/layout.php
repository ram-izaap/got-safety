<?php
//print base_url();
//
// Layout config for the site admin 
//
                                        

$config['layout']['default']['template'] = 'layouts/frontend';
$config['layout']['default']['title']    = 'GotSafety - Admin';
$config['layout']['default']['js_dir']    = "assets/js/admin";
$config['layout']['default']['css_dir']   = "assets/css/admin";
$config['layout']['default']['img_dir']   = "assets/images/admin";

$config['layout']['default']['javascripts'] = array(
  'jquery.min',"jquery-migrate.min", 'bootstrap.min', 'jquery.blockui.min', 'jquery.cokie.min', 'jquery.uniform.min', 'jquery.validate.min', 'metronic', 'layout', 'demo', 'login','tinymce/tinymce.min','tinymce','common','listing'
);
 
$config['layout']['default']['stylesheets'] = array('bootstrap.min', 'font-awesome.min', 'uniform.default','components','plugins','layout','darkblue','custom','login');

$config['layout']['default']['description'] = 'GotSafety';
$config['layout']['default']['keywords']    = 'GotSafety';

$config['layout']['default']['http_metas'] = array(
	'X-UA-Compatible' => 'IE=edge',
    'Content-Type' => 'text/html; charset=utf-8',
	'viewport'     => 'width=device-width, initial-scale=1.0',
    'author' => 'Order Processing - Admin',
);

                                     

$config['layout']['frontend']['template'] = 'layouts/frontend';
$config['layout']['frontend']['title']    = 'GotSafety - frontend';
$config['layout']['frontend']['js_dir']    = "assets/js/frontend";
$config['layout']['frontend']['css_dir']   = "assets/css/frontend";
$config['layout']['frontend']['img_dir']   = "assets/images/frontend";

$config['layout']['frontend']['javascripts'] = array(
  'jquery.min',"jquery-migrate.min", 'bootstrap.min', 'jquery.blockui.min','gs-main'  
);
 
$config['layout']['frontend']['stylesheets'] = array('bootstrap', 'font-awesome/font-awesome.css?4.5.0', 'main');

$config['layout']['frontend']['description'] = 'GotSafety';
$config['layout']['frontend']['keywords']    = 'GotSafety';

$config['layout']['frontend']['http_metas'] = array(
	'X-UA-Compatible' => 'IE=edge',
    'Content-Type' => 'text/html; charset=utf-8',
	'viewport'     => 'width=device-width, initial-scale=1.0',
    'author' => 'Got Safety - Frontend',
);


 
   

?>
