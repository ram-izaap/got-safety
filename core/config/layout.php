<?php

//
// Layout config for the site admin 
//
                                        

$config['layout']['default']['template'] = 'layouts/frontend';
$config['layout']['default']['title']    = 'GotSafty - Admin';
$config['layout']['default']['js_dir']    = "assets/js/admin";
$config['layout']['default']['css_dir']   = "assets/css/admin";
$config['layout']['default']['img_dir']   = "assets/images/admin";

$config['layout']['default']['javascripts'] = array(
  'jquery.min',"jquery-migrate.min", 'bootstrap.min', 'jquery.blockui.min', 'jquery.cokie.min', 'jquery.uniform.min', 'jquery.validate.min', 'metronic', 'layout', 'demo', 'login'  
);
 
$config['layout']['default']['stylesheets'] = array('bootstrap.min', 'font-awesome.min.css', 'uniform.default','components','plugins','layout','darkblue','custom','login');

$config['layout']['default']['description'] = '';
$config['layout']['default']['keywords']    = '';

$config['layout']['default']['http_metas'] = array(
	'X-UA-Compatible' => 'IE=edge',
    'Content-Type' => 'text/html; charset=utf-8',
	'viewport'     => 'width=device-width, initial-scale=1.0',
    'author' => 'Order Processing - Admin',
);

?>
