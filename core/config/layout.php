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
  'jquery.min',"jquery-migrate.min", 'bootstrap.min', 'jquery.blockui.min', 'jquery.cokie.min', 'jquery.uniform.min','bootstrap-switch.min','app.min', 'jquery.validate.min', 'metronic', 'layout', 'demo', 'login','tinymce/tinymce.min','tinymce','common','listing','date','jquery-ui','jquery-ui.min','elfinder.new','select2.min','select2.full.min'
);
 $config['layout']['default']['stylesheets'] = array('bootstrap.min', 'font-awesome.min', 'uniform.default','components','plugins','layout','darkblue','custom','login','jquery-ui','elfinder.full','theme','simple-line-icons.min','select2.min','select2-bootstrap.min');

$config['layout']['default']['description'] = 'GotSafety';
$config['layout']['default']['keywords']    = 'GotSafety';

$config['layout']['default']['http_metas'] = array(
	'X-UA-Compatible' => 'IE=edge',
    'Content-Type' => 'text/html; charset=utf-8',
	'viewport'     => 'width=device-width, initial-scale=1.0',
    'author' => 'Got Safety - Admin',
);

                                     

$config['layout']['frontend']['template'] = 'layouts/frontend';
$config['layout']['frontend']['title']    = 'GotSafety - frontend';
$config['layout']['frontend']['js_dir']    = "assets/js/frontend";
$config['layout']['frontend']['css_dir']   = "assets/css/frontend";
$config['layout']['frontend']['img_dir']   = "assets/images/frontend";

$config['layout']['frontend']['javascripts'] = array(
  'jquery.min',"jquery-migrate.min", 'bootstrap.min', 'jquery.blockui.min','gs-main','jquery.nivo.slider','cart','jquery.creditCardValidator','checkout','chosen.jquery','numeric-1.2.6.min','bezier','jquery.signaturepad','common','signoff','jquery.ztree.core'
);
 
$config['layout']['frontend']['stylesheets'] = array('bootstrap', 'font-awesome/font-awesome.css?4.5.0', 'main','bootstrap-chosen','sign/jquery.signaturepad');

$config['layout']['frontend']['description'] = 'GotSafety';
$config['layout']['frontend']['keywords']    = 'GotSafety';

$config['layout']['frontend']['http_metas'] = array(
	'X-UA-Compatible' => 'IE=edge',
    'Content-Type' => 'text/html; charset=utf-8',
	'viewport'     => 'width=device-width, initial-scale=1.0',
    'author' => 'Got Safety - Frontend',
);


 
   

?>
