<?php
/*
 * view - the path to the listing view that you want to display the data in
 * 
 * base_url - the url on which that pagination occurs. This may have to be modified in the 
 * 			controller if the url is like /product/edit/12
 * 
 * per_page - results per page
 * 
 * order_fields - These are the fields by which you want to allow sorting on. They must match
 * 				the field names in the table exactly. Can prefix with table name if needed
 * 				(EX: products.id)
 * 
 * OPTIONAL
 * 
 * default_order - One of the order fields above
 * 
 * uri_segment - this will have to be increased if you are paginating on a page like 
 * 				/product/edit/12
 * 				otherwise the pagingation will start on page 12 in this case 
 * 
 * 
 */
 






$config['lession_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'lession/filter',
	"base_url"	=> 	'/lession/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'title'=>array('name'=>'Title', 'data_type' => 'attach_link', 'sortable' => FALSE, 'default_view'=>1),
							'content'=>array('name'=>'Content', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['attachment_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'attachment/filter',
	"base_url"	=> 	'/attachment/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'language'=>array('name'=>'Language', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['lang_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'lang/filter',
	"base_url"	=> 	'/lang/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'lang'=>array('name'=>'Language', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['webinars_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'webinars/filter',
	"base_url"	=> 	'/webinars/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'title'=>array('name'=>'Title', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['page_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'page/filter',
	"base_url"	=> 	'/page/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'name'=>array('name'=>'Name', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['addpages_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'addpages/filter',
	"base_url"	=> 	'/addpages/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'page_title'=>array('name'=>'Page Title', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);
