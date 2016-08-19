
<body class="login" style="background-color: #F6F6F6 !important;">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
	<img src="<?php echo get_img_dir();?>/logo.png" alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content" style="background-color: #c0c0c0;">
	<!-- BEGIN LOGIN FORM -->
	
	<form class="login-form" action="<?php site_url('login')?>" method="post">
		<h3 class="form-title" style="color: #222;">Client Sign In</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<input class="form-control form-control-solid placeholder-no-fix" style="background-color: #fff;" type="text" autocomplete="off" placeholder="Username" name="name"/>
			<span class="vstar" <?php echo form_error('name', '<span class="help-block">', '</span>'); ?></span>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control form-control-solid placeholder-no-fix" style="background-color: #fff;" type="password" autocomplete="off" placeholder="Password" name="password"/>
			<span class="vstar" <?php echo form_error('password', '<span class="help-block">', '</span>'); ?></span>
		</div>
		<div class="form-actions" style="border-width: 0;">
			<button type="submit" class="btn btn-success uppercase" style="background-color: #ed1c24;">Login</button>
			<label class="rememberme check">
			<?php /*<input type="checkbox" name="remember" value="1"/>Remember </label>
			<a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a> */ ?>
		</div>
		</form>
	<!-- END LOGIN FORM -->
	
	
</div>
<div class="copyright">
	 <?php echo date("Y");?> &copy; Got Safety. Admin Dashboard.
</div>

</body>
