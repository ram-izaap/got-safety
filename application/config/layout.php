<?php

//
// Layout config for the site admin 
//
                                        

$config['layout']['default']['template'] = 'layouts/frontend';
$config['layout']['default']['title']    = 'GotSafty';

$config['layout']['default']['javascripts'] = array(
  'jquery',"jquery-ui", 'bootstrap.min', 'bootbox.min', 'function', 'jquery.fixedheadertable.min', 'listing', 'resizable-tables', 'bootstrap-datepicker', 'bootstrap-select', 'ckeditor/ckeditor'  
);
 
$config['layout']['default']['stylesheets'] = array('bootstrap', 'bootstrap-responsive', 'zoom');

$config['layout']['default']['description'] = '';
$config['layout']['default']['keywords']    = '';

$config['layout']['default']['http_metas'] = array(
    'Content-Type' => 'text/html; charset=utf-8',
	'viewport'     => 'width=device-width, initial-scale=1.0',
    'author' => 'Order Processing',
);

?>
