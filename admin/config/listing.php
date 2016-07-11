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

$config['plan_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'plan/filter',
	"base_url"	=> 	'/plan/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'plan_type'=>array('name'=>'Name', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'plan_amount'=>array('name'=>'Price', 'data_type' => 'integer', 'sortable' => FALSE, 'default_view'=>1),
							'plan_desc'=>array('name'=>'Description', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'plan_directory'=>array('name'=>'Directory', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['category_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'category/filter',
	"base_url"	=> 	'/category/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'cat_name'=>array('name'=>'Category', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['attribute_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'attribute/filter',
	"base_url"	=> 	'/attribute/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'attr_name'=>array('name'=>'Attribute', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['attribute_attribute_value'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'attribute_value/filter',
	"base_url"	=> 	'/attribute_value/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'attr_name'=>array('name'=>'Attribute', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'attr_val'=>array('name'=>'Attribute Value', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['product_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'product/filter',
	"base_url"	=> 	'/product/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'name'=>array('name'=>'Name', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'desc'=>array('name'=>'Description', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'cat_name'=>array('name'=>'Category', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'sku'=>array('name'=>'SKU', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                            'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);



