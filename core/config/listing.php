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
						'title'=>array('name'=>'Title', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
						//'content'=>array('name'=>'Content', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
						 'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
						 'id'=>array('name'=>'Add Attachment', 'data_type' => 'attach_link', 'sortable' => TRUE, 'default_view'=>1)                             
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
							'lang'=>array('name'=>'Language', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
							//'type'=>array('name'=>'Type', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
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
							'lang'=>array('name'=>'Language', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
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
							'title'=>array('name'=>'Title', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
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
							'name'=>array('name'=>'Name', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
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
							'page_title'=>array('name'=>'Page Title', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['user_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'user/filter',
	"base_url"	=> 	'user/index/',
	"per_page"	=>	"4",
	"fields"	=> array(   
							'name'=>array('name'=>'Name', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
							'role'=>array('name'=>'Role', 'data_type' => 'user_role', 'sortable' => TRUE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),                             
                             'id'=>array('name'=>'Add User', 'data_type' => 'admin_client_list', 'sortable' => TRUE, 'default_view'=>1)                    
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['client_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'client/filter',
	"base_url"	=> 	'/client/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'name'=>array('name'=>'Name', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
							'role'=>array('name'=>'Role', 'data_type' => 'user_role', 'sortable' => TRUE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['inspection_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'inspection/filter',
	"base_url"	=> 	'/inspection/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'title'=>array('name'=>'Title', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
                             'is_display'=>array('name'=>'Is Dispaly', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['osha_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'osha/filter',
	"base_url"	=> 	'/osha/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'title'=>array('name'=>'Title', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
                             'is_display'=>array('name'=>'Is Dispaly', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['documents_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'documents/filter',
	"base_url"	=> 	'/documents/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'title'=>array('name'=>'Title', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
                             'is_display'=>array('name'=>'Is Dispaly', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['records_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'records/filter',
	"base_url"	=> 	'/records/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'title'=>array('name'=>'Title', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
                             'is_display'=>array('name'=>'Is Dispaly', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['forms_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'forms/filter',
	"base_url"	=> 	'/forms/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'title'=>array('name'=>'Title', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
                             'is_display'=>array('name'=>'Is Dispaly', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['posters_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'posters/filter',
	"base_url"	=> 	'/posters/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'title'=>array('name'=>'Title', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
						//'content'=>array('name'=>'Content', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
						 'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
						 'id'=>array('name'=>'Add Attachment', 'data_type' => 'attach_link2', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['attach_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'attach/filter',
	"base_url"	=> 	'/attach/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'language'=>array('name'=>'Language', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
							//'type'=>array('name'=>'Type', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['employee_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'employee/filter',
	"base_url"	=> 	'/employee/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'employee_name'=>array('name'=>'Name', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
							'employee_email'=>array('name'=>'Email', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
							'emp_id'=>array('name'=>'Employee ID', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
							'created_user'=>array('name'=>'Client', 'data_type' => 'find_client', 'sortable' => TRUE, 'default_view'=>1),
                             'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['signoff_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'signoff/filter',
	"base_url"	=> 	'/signoff/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							 'employee_id'=>array('name'=>'Employee Name', 'data_type' => 'find_employee', 'sortable' => TRUE, 'default_view'=>1),
							 'emp_id'=>array('name'=>'Employee ID', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
                             'title'=>array('name'=>'Topic', 'data_type' => 'find_topic', 'sortable' => TRUE, 'default_view'=>1),                             
                             'client_id'=>array('name'=>'Client', 'data_type' => 'find_client', 'sortable' => TRUE, 'default_view'=>1),                             
                             'created_date'=>array('name'=>'Date', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);



/*$config['submittedforms_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'submittedforms/filter',
	"base_url"	=> 	'/submittedforms/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							 'title'=>array('name'=>'Title', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
							 'client_id'=>array('name'=>'Client Name', 'data_type' => 'find_client', 'sortable' => TRUE, 'default_view'=>1), 'created_date'=>array('name'=>'Date', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);
*/

$config['submittedforms_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'submittedforms/filter',
	"base_url"	=> 	'/submittedforms/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							 'employee_id'=>array('name'=>'Employee Name', 'data_type' => 'find_employee', 'sortable' => TRUE, 'default_view'=>1),
							 'emp_id'=>array('name'=>'Employee ID', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
                             
                             'client_id'=>array('name'=>'Client', 'data_type' => 'find_client', 'sortable' => TRUE, 'default_view'=>1),                             
                             'created_date'=>array('name'=>'Date', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                             
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
							'attr_name'=>array('name'=>'Attribute', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
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
							'attr_val'=>array('name'=>'Attribute Value', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
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
							'desc'=>array('name'=>'Description', 'data_type' => 'shot_desc', 'sortable' => FALSE, 'default_view'=>1),
							'cat_name'=>array('name'=>'Category', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'sku'=>array('name'=>'SKU', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                            'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['order_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'order/filter',
	"base_url"	=> 	'/order/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'id'=>array('name'=>'Order No', 'data_type' => 'integer', 'sortable' => FALSE, 'default_view'=>1),
							'order_status'=>array('name'=>'Order Status', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'created_date'=>array('name'=>'Order Date', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
							'name'=>array('name'=>'name', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                            'total_amount'=>array('name'=>'Total Amount', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
                            'total_items'=>array('name'=>'Total Items', 'data_type' => 'integer', 'sortable' => FALSE, 'default_view'=>1),
                            'payment_type'=>array('name'=>'Payment Mode', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)                              
                          ),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['transaction_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'transaction/filter',
	"base_url"	=> 	'/transaction/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
							'name'=>array('name'=>'Name', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
							'email'=>array('name'=>'Email', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
							'profile_id'=>array('name'=>'Subscription ID', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
                            'trans_id'=>array('name'=>'Tranasction No', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1),
                            'status'=>array('name'=>'Status', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1),
                            'last_payment_amt'=>array('name'=>'Amount', 'data_type' => 'symbol_amt', 'sortable' => TRUE, 'default_view'=>1),                             
                            'created_date'=>array('name'=>'Date', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)                              
                          ),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);
$config['subscribers_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'subscribers/filter',
	"base_url"	=> 	'/subscribers/index/',
	"per_page"	=>	"10",
	"fields"	=> array(   
			'name'=>array('name'=>'Name', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
			 'email'=>array('name'=>'Email', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
			 'profile_id'=>array('name'=>'Profile ID', 'data_type' => 'find_plan', 'sortable' => TRUE, 'default_view'=>1),
			 'plan_name'=>array('name'=>'Plan', 'data_type' => 'find_plan', 'sortable' => TRUE, 'default_view'=>1),
			 'amount'=>array('name'=>'Amount', 'data_type' => 'money', 'sortable' => TRUE, 'default_view'=>1),
			 'is_active'=>array('name'=>'Is Active', 'data_type' => 'status', 'sortable' => TRUE, 'default_view'=>1)
						),
	"default_order"	=> "u.id",
	"default_direction" => "DESC"
);
