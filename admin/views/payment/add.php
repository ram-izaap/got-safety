<h3 class="page-title">Add Payment Info</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url("index.php/home"); ?>">Home</a>
				<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url("index.php/employee"); ?>">Payment</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>Add</li>
	</ul>
</div>
<div class="form-body">
	<?php if($this->session->flashdata('up_pay')==TRUE){?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?php echo $this->session->flashdata('up_pay');?>
		</div>
		<?php }?>
	<form role="form" method="POST" enctype="multipart/form-data" action="<?php echo base_url('payment/add');?>">
		<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id = (isset($info[0]['id']))?$info[0]['id']:""; ?>" /> 
		<h2>Paypal Info</h2><br>
		<div class="form-group">
			<label class="col-md-2 control-label">Mail ID: <span class="required">* </span></label>
			<div class="col-md-10">
				<input type="text" class="form-control" name="paypal_email_id" placeholder="Paypal Email-ID" 
				value="<?php echo $info[0]['api_username'];?>" >
				<span class="vstar"><?php echo form_error('paypal_email_id');?></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Password : <span class="required">* </span></label>
			<div class="col-md-10">
				<input type="text" class="form-control" name="paypal_password" placeholder="Paypal Password" 
				value="<?php echo $info[0]['api_password'];?>" >
				<span class="vstar"><?php echo form_error('paypal_password');?></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Signature : <span class="required">* </span></label>
			<div class="col-md-10">
				<input type="text" class="form-control" name="paypal_signature" placeholder="Paypal Signature" 
				value="<?php echo $info[0]['api_signature'];?>" >
				<span class="vstar"><?php echo form_error('paypal_signature');?></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Mode: <span class="required">* </span></label>
			<div class="col-md-10">
				<select name="paypal_mode" class="form-control">
					<option <?php if($info[0]['payment_mode']=="sandbox"){?> selected <?php }?> value="sandbox">Test</option>
					<option <?php if($info[0]['payment_mode']=="production"){?> selected <?php }?> value="production">Production</option>
				</select>
			</div>
		</div>
		<h2>Authorize.net Info</h2><br>
		<div class="form-group">
			<label class="col-md-2 control-label">Mode:</label>
			<div class="col-md-10">
				<select name="auth_mode" class="form-control">
					<option <?php if($info[1]['payment_mode']=="TEST"){?> selected <?php }?> value="TEST">Test</option>
					<option <?php if($info[0]['payment_mode']=="PRODUCTION"){?> selected <?php }?> value="PRODUCTION">Production</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Test Merchant Login ID: <span class="required">* </span></label>
			<div class="col-md-10">
				<input type="text" name="auth_login_id" class="form-control" placeholder="Merchant Login ID" 
				value="<?php echo $info[1]['api_username'];?>" >
				<span class="vstar"><?php echo form_error('auth_login_id');?></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Test Merchant Transaction Key:<span class="required">* </span></label>
			<div class="col-md-10">
			<input type="text" class="form-control" name="auth_trans_key"
			 placeholder="Merchant Transaction Key" value="<?php echo $info[1]['api_password'];?>">
			<span class="vstar"><?php echo form_error('auth_trans_key');?></span>
			</div>
		</div>	
		<div class="form-group">
			<label class="col-md-2 control-label"> <span class="required"></span></label>
			<div class="col-md-2">
				<input type="submit" class="form-control btn btn-primary" style="font-weight: bold; font-size:17px;" name="submit" id="submit" value="SAVE" />
			</div>
		</div>
	</form>	
</div>
