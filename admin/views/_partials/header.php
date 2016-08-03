<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="<?php echo base_url("index.php/home");?>">
			<img src="<?php echo get_img_dir();?>/logo-footer.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
			<?php /*	<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-bell"></i>
					<span class="badge badge-default">
					7 </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<h3><span class="bold">12 pending</span> notifications</h3>
							<a href="extra_profile.html">view all</a>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
								<li>
									<a href="javascript:;">
									<span class="time">just now</span>
									<span class="details">
									<span class="label label-sm label-icon label-success">
									<i class="fa fa-plus"></i>
									</span>
									New user registered. </span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="time">3 mins</span>
									<span class="details">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									Server #12 overloaded. </span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="time">10 mins</span>
									<span class="details">
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>
									Server #2 not responding. </span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="time">14 hrs</span>
									<span class="details">
									<span class="label label-sm label-icon label-info">
									<i class="fa fa-bullhorn"></i>
									</span>
	<div class="scroll-to-top" style="display: block;">
		<i class="icon-arrow-up"></i>
	</div>								Application error. </span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="time">2 days</span>
									<span class="details">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									Database overloaded 68%. </span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="time">3 days</span>
									<span class="details">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									A user IP blocked. </span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="time">4 days</span>
									<span class="details">
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>
									Storage Server #4 not responding dfdfdfd. </span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="time">5 days</span>
									<span class="details">
									<span class="label label-sm label-icon label-info">
									<i class="fa fa-bullhorn"></i>
									</span>
									System Error. </span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="time">9 days</span>
									<span class="details">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									Storage server failed. </span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li> 
				<!-- END NOTIFICATION DROPDOWN -->
				<!-- BEGIN INBOX DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-envelope-open"></i>
					<span class="badge badge-default">
					4 </span>
					</a>
					<ul class="dropdown-menu">
						<li class="external">
							<h3>You have <span class="bold">7 New</span> Messages</h3>
							<a href="page_inbox.html">view all</a>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
								<li>
									<a href="inbox.html?a=view">
									<span class="photo">
									<img src="images/avatar2.jpg" class="img-circle" alt="">
									</span>
									<span class="subject">
									<span class="from">
									Lisa Wong </span>
									<span class="time">Just Now </span>
									</span>
									<span class="message">
									Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
									<span class="photo">
									<img src="images/avatar3.jpg" class="img-circle" alt="">
									</span>
									<span class="subject">
									<span class="from">
									Richard Doe </span>
									<span class="time">16 mins </span>
									</span>
									<span class="message">
									Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
									<span class="photo">
									<img src="images/avatar1.jpg" class="img-circle" alt="">
									</span>
									<span class="subject">
									<span class="from">
									Bob Nilson </span>
									<span class="time">2 hrs </span>
									</span>
									<span class="message">
									Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
									<span class="photo">
									<img src="images/avatar2.jpg" class="img-circle" alt="">
									</span>
									<span class="subject">
									<span class="from">
									Lisa Wong </span>
									<span class="time">40 mins </span>
									</span>
									<span class="message">
									Vivamus sed auctor 40% nibh congue nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
									<span class="photo">
									<img src="images/avatar3.jpg" class="img-circle" alt="">
									</span>
									<span class="subject">
									<span class="from">
									Richard Doe </span>
									<span class="time">46 mins </span>
									</span>
									<span class="message">
									Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<!-- END INBOX DROPDOWN -->
				<!-- BEGIN TODO DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<i class="icon-calendar"></i>
					<span class="badge badge-default">
					3 </span>
					</a>
					<ul class="dropdown-menu extended tasks">
						<li class="external">
							<h3>You have <span class="bold">12 pending</span> tasks</h3>
							<a href="page_todo.html">view all</a>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
								<li>
									<a href="javascript:;">
									<span class="task">
									<span class="desc">New release v1.2 </span>
									<span class="percent">30%</span>
									</span>
									<span class="progress">
									<span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">40% Complete</span></span>
									</span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="task">
									<span class="desc">Application deployment</span>
									<span class="percent">65%</span>
									</span>
									<span class="progress">
									<span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">65% Complete</span></span>
									</span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="task">
									<span class="desc">Mobile app release</span>
									<span class="percent">98%</span>
									</span>
									<span class="progress">
									<span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">98% Complete</span></span>
									</span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="task">
									<span class="desc">Database migration</span>
									<span class="percent">10%</span>
									</span>
									<span class="progress">
									<span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">10% Complete</span></span>
									</span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="task">
									<span class="desc">Web server upgrade</span>
									<span class="percent">58%</span>
									</span>
									<span class="progress">
									<span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">58% Complete</span></span>
									</span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="task">
									<span class="desc">Mobile development</span>
									<span class="percent">85%</span>
									</span>
									<span class="progress">
									<span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">85% Complete</span></span>
									</span>
									</a>
								</li>
								<li>
									<a href="javascript:;">
									<span class="task">
									<span class="desc">New UI release</span>
									<span class="percent">38%</span>
									</span>
									<span class="progress progress-striped">
									<span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">38% Complete</span></span>
									</span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>*/ ?>
				<!-- END TODO DROPDOWN -->
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="<?php echo $img_url; ?>assets/images/frontend/users/<?php echo $user_image;?>"/>
				<?php 	$name =  $this->session->userdata('admin_data')['name']; 
						$id =  $this->session->userdata('admin_data')['id']; 
				
				?> 
					<span class="username username-hide-on-mobile">
					<?php echo $name;?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="<?php echo site_url('user/profile'); ?>/<?php echo $id?>">
							<i class="icon-user"></i> My Profile </a>
						</li>
						
						<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 2){ ?>
						<li>
							<a href="<?php echo site_url('user/user_plan_detail'); ?>/<?php echo $id?>">
							<i class="icon-tag"></i> Plan Detail </a>
						</li>
						
						<?php } ?>
						
						<?php /*<li>
							<a href="page_calendar.html">
							<i class="icon-calendar"></i> My Calendar </a>
						</li>
						<li>
							<a href="inbox.html">
							<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
							3 </span>
							</a>
						</li>
						<li>
							<a href="page_todo.html">
							<i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
							7 </span>
							</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="extra_lock.html">
							<i class="icon-lock"></i> Lock Screen </a>
						</li> */ ?>
						<li>
							<a href="<?php echo base_url('index.php/login/logout');?>">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-quick-sidebar-toggler">
					<a href="<?php echo base_url('index.php/login/logout');?>" class="dropdown-toggle">
					<i class="icon-logout"></i>
					</a>
				</li>
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->

<div class="clearfix">
</div>


<div class="page-container">
	
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<?php /*<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
					<form class="sidebar-search " action="extra_search.html" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li> */ ?>
                    
				<?php /*	<li>
						<a href="javascript:;">
						<i class="icon-basket"></i>
						<span class="title">eCommerce</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="ecommerce_orders.html">
								<i class="icon-basket"></i>
								Orders</a>
							</li>
							<li>
								<a href="ecommerce_orders_view.html">
								<i class="icon-tag"></i>
								Order View</a>
							</li>
							<li>
								<a href="ecommerce_products.html">
								<i class="icon-handbag"></i>
								Products</a>
							</li>
							<li>
								<a href="ecommerce_products_edit.html">
								<i class="icon-pencil"></i>
								Product Edit</a>
							</li>
						</ul>
					</li>
					
					<li>
						<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">Login Options</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li>
								<a href="login.html">
								Login Form </a>
							</li>﻿﻿
							
						</ul>
					</li> */ ?>
					
					<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>
					<li>
						<a href="javascript:;">
						<i class="icon-settings"></i>
						<span class="title">Settings</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							
							<li> 
								<a href="<?php echo site_url('lang'); ?>">
								Language </a>
								
							</li>
							
							
						<?php /*	<li> 
								<a href="<?php echo site_url('page'); ?>">
								Page </a>
							</li>
						*/ ?>	
						</ul>
					</li>
					
				<?php /*	<li>
						<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">Page Managment</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li> 
								<a href="<?php echo site_url('addpages/add_edit_pages'); ?>">
								 Add Page</a>
							</li>
							<li> 
								<a href="<?php echo site_url('addpages'); ?>">
								 Manage Pages</a>
							</li>
							
						</ul>
					</li> <?php */ ?>
					
					<?php } ?>
					
					<li>
						<a href="javascript:;">
						<i class="icon-notebook"></i>
						<span class="title">Safety lessons</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
					<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>
							<?php /*<li> 
								<a href="<?php echo site_url('lession/lesson_content'); ?>">
								Frontend Content </a>
							</li> */?>
					<?php } ?>
							
							<li> 
								<a href="<?php echo site_url('lesson/add_lesson'); ?>">
								Add lessons </a>
							</li>
							
							<li> 
								<a href="<?php echo site_url('lesson'); ?>">
								Manage lessons </a>
							</li>
							
							
							<li> 
								<a href="<?php echo site_url('signoff'); ?>">
								Manage Training records </a>
							</li>
							
						</ul>
					</li>
					
					
					
					<li>
						<a href="javascript:;">
						<i class="icon-screen-desktop"></i>
						<span class="title">Webinars</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li> 
								<a href="<?php echo site_url('webinars/add_webinars'); ?>">
								Add Webinars </a>
							</li>
							<li> 
								<a href="<?php echo site_url('webinars'); ?>">
								Manage Webinars </a>
							</li>
							
						</ul>
					</li>
					
					
					
					
					
				<?php /*	<li>
						<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">About Us</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li> 
								<a href="<?php echo site_url('aboutus/about'); ?>">
								 Update</a>
							</li>
							
						</ul>
					</li>
					
					
					<li>
						<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">Contact Us</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li> 
								<a href="<?php echo site_url('contactus/contact'); ?>">
								 Update</a>
							</li>
							
						</ul>
					</li> */ ?>
					
				<?php /*	
					
					<li>
						<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">Inspection reports</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>
							<li> 
								<a href="<?php echo site_url('inspection/inspection_content'); ?>">
								Frontend Content </a>
							</li>
					<?php } ?>		
							<li> 
								<a href="<?php echo site_url('inspection/add_edit_inspection'); ?>">
								Add reports </a>
							</li>
							<li> 
								<a href="<?php echo site_url('inspection'); ?>">
								Manage reports </a>
							</li>
							
						</ul>
					</li>
					
					
					<li>
						<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">Cal / OSHA</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
						<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>	
							<li> 
								<a href="<?php echo site_url('osha/osha_content'); ?>">
								Frontend Content </a>
							</li>
					<?php } ?>		
							<li> 
								<a href="<?php echo site_url('osha/add_edit_osha'); ?>">
								Add Documents </a>
							</li>
							<li> 
								<a href="<?php echo site_url('osha'); ?>">
								Manage Documents </a>
							</li>
							
						</ul>
					</li>
					
					
					<li>
						<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">300 logs</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
					<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>
							<li> 
								<a href="<?php echo site_url('documents/logs_content'); ?>">
								Frontend Content </a>
							</li>
						<?php } ?>	
							<li> 
								<a href="<?php echo site_url('documents/add_edit_logs'); ?>">
								Add Documents </a>
							</li>
							<li> 
								<a href="<?php echo site_url('documents'); ?>">
								Manage Documents </a>
							</li>
							
						</ul>
					</li>
					
					
					
					<li>
						<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">Records</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
					<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>		
							<?php /*<li> 
								<a href="<?php echo site_url('records/records_content'); ?>">
								Frontend Content </a>
							</li>
						
							<li> 
								<a href="<?php echo site_url('records/add_edit_records'); ?>">
								Add Documents </a>
							</li>
							<li> 
								<a href="<?php echo site_url('records'); ?>">
								Manage Documents </a>
							</li>
							
						</ul>
					</li>
					*/ ?>
					
					<li>
						<a href="javascript:;">
						<i class="icon-docs"></i>
						<span class="title">Documentation</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
						<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>	
							<li> 
								<a href="<?php echo site_url('osha/osha_content'); ?>">
								Frontend Content </a>
							</li>
					<?php } ?>		
							<li> 
								<a href="<?php echo site_url('osha/add_edit_osha'); ?>">
								Add Documents </a>
							</li>
							<li> 
								<a href="<?php echo site_url('osha'); ?>">
								Manage Documents </a>
							</li>
							
						</ul>
					</li>
					
					<li>
						<a href="javascript:;">
						<i class="icon-list"></i>
						<span class="title">Safety Forms</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
					<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>		
							<?php /*<li> 
								<a href="<?php echo site_url('forms/forms_content'); ?>">
								Frontend Content </a>
							</li>*/?>
						
							<li> 
								<a href="<?php echo site_url('forms/add_edit_forms'); ?>">
								Add Safety Forms </a>
							</li>
							<li> 
								<a href="<?php echo site_url('forms'); ?>">
								Manage Safety Forms </a>
							</li>
							<?php } ?>	
							<li> 
								<a href="<?php echo site_url('submittedforms'); ?>">
								Submitted Safety Forms </a>
							</li>
							
						</ul>
					</li>
					
				<?php /*	
					<li>
						<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">Safety Posters</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
						<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>
							<li> 
								<a href="<?php echo site_url('posters/posters_content'); ?>">
								Frontend Content </a>
							</li>
							
					<?php } ?>		<li> 
								<a href="<?php echo site_url('posters/add_edit_posters'); ?>">
								Add Posters </a>
							</li>
							
							<li> 
								<a href="<?php echo site_url('posters'); ?>">
								Manage Posters </a>
							</li>
							
							
							
						</ul>
					</li>
					*/ ?>
					
					
					
					
				<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>
					
					<li>
						<a href="javascript:;">
						<i class="icon-users"></i>
						<span class="title">Client Management</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li> 
								<a href="<?php echo site_url('user/add_edit_user'); ?>">
								 Add Client</a>
							</li>
							<li> 
								<a href="<?php echo site_url('user'); ?>">
								 Manage Clients</a>
							</li>
							<li> 
								<a href="<?php echo site_url('subscribers'); ?>">
								 Subscribed Users</a>
							</li>
							
						</ul>
					</li>
					<?php } ?>
					<?php /* } else { ?>
						
						<li>
							<a href="javascript:;">
							<i class="icon-user"></i>
							<span class="title">User Management</span>
							<span class="arrow "></span>
							</a>
							<ul class="sub-menu">
								<li> 
									<a href="<?php echo site_url('user'); ?>">
									  Add User</a>
								</li>
								
								
								
							</ul>
						</li>
					<?php } */ ?>
				<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 2){ ?>	
					<li>
						<a href="javascript:;">
						<i class="icon-user-following"></i>
						<span class="title">Employee Management</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li> 
								<a href="<?php echo site_url('employee/add_edit_employee'); ?>">
								 Add Employee</a>
							</li>
							<li> 
								<a href="<?php echo site_url('employee'); ?>">
								 Manage Employee</a>
							</li>
							
							<li> 
								<a href="<?php echo site_url('employee/bulk_upload'); ?>">
								 Bulk Upload </a>
							</li>
							
						</ul>
					</li>
					
					<?php } ?>
					<li>
						<a href="javascript:;">
						<i class="icon-fire"></i>
						<span class="title">Repository Management</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li> 
								<a href="<?php echo site_url('repository'); ?>">
								 Add Files</a>
							</li>
							
							
						</ul>
					</li>
					
			<?php $role =  $this->session->userdata('admin_data')['role'];
					if($role == 1){ ?>		
					<li>
						<a href="javascript:;">
						<i class="icon-tag"></i>
						<span class="title">Plans</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
						   <li> 
								<a href="<?php echo site_url('plan/add_plan'); ?>">
								Add Plans </a>
							</li>
							
							<li> 
								<a href="<?php echo site_url('plan'); ?>">
								Manage Plans </a>
							</li>							
						</ul>
					</li>

					<li>
						<a href="javascript:;">
						<i class="icon-layers"></i>
						<span class="title">Category</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
						   <li> 
								<a href="<?php echo site_url('category/add_category'); ?>">
								Add Category </a>
							</li>
							
							<li> 
								<a href="<?php echo site_url('category'); ?>">
								Manage Category </a>
							</li>							
						</ul>
					</li>

					<li>
						<a href="javascript:;">
						<i class="icon-anchor"></i>
						<span class="title">Attribute</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
						  <li> 
							<a href="<?php echo site_url('attribute/attribute_value'); ?>">
							Manage Attribute </a>
						  </li>
						</ul>
					</li>
					<li>
						<a href="javascript:;">
						<i class="icon-basket-loaded"></i>
						<span class="title">Product</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
						  <li> 
							<a href="<?php echo site_url('product/add_product'); ?>">
							Add Product </a>
						  </li>
						  <li> 
							<a href="<?php echo site_url('product'); ?>">
							Manage Product </a>
						  </li>
						</ul>
					</li>
					<li>
						<a href="javascript:;">
						<i class="icon-credit-card"></i>
						<span class="title">Payment Info</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li> 
								<a href="<?php echo site_url('payment'); ?>">
								 Add Info</a>
							</li>
							
							
						</ul>
					</li>
					
					
					<li>
						<a href="javascript:;">
						<i class="icon-bag"></i>
						<span class="title">Order Details</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li> 
								<a href="<?php echo site_url('order'); ?>">
								 View Order</a>
							</li>
							
							
						</ul>
					</li>
					
					<?php } ?>
					<!--<li>
						<a href="javascript:;">
						<i class="fa fa-dollar"></i>
						<span class="title">Transaction Details</span>
						<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<li> 
								<a href="<?php echo site_url('transaction'); ?>">
								 View Transactions</a>
							</li>
							
							
						</ul>
					</li>-->
					
					
					
					
				</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
