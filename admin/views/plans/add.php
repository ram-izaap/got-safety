  <h3 class="page-title">
	<?php echo $title;?>
  </h3>
  <div class="page-bar">
    <ul class="page-breadcrumb">
	  <li>
		 <i class="fa fa-home"></i>
		 <a href="<?php echo base_url("index.php/home"); ?>">Home</a>
		 <i class="fa fa-angle-right"></i>
	  </li>
	  <li>
		 <a href="<?php echo base_url("index.php/plan"); ?>">Plan</a>
		 <i class="fa fa-angle-right"></i>
	  </li>
	  <li>
	    <?php echo $crumb;?>
	  </li>
	</ul>
  </div>
  
  <div class="form-body">
	<form role="form" name="plans" id="plans" method="POST">
      <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id = (isset($form_data['id']))?$form_data['id']:""; ?>" /> 
      
      <div class="form-group">
		<label class="col-md-2 control-label">Name: <span class="required">* </span>
		</label>
		<div class="col-md-10">
			<input type="text" name="plan_type" class="form-control" value="<?php echo set_value('plan_type',$form_data['plan_type']); ?>">  
			<span class="vstar" <?php echo form_error('plan_type', '<span class="help-block">', '</span>'); ?></span>
		
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-md-2 control-label">Price:<span class="required">*</span>
		</label>
		<div class="col-md-10">
			<input type="text" name="plan_amount" class="form-control" value="<?php echo set_value('plan_amount',$form_data['plan_amount']); ?>">  
			<span class="vstar" <?php echo form_error('plan_amount', '<span class="help-block">', '</span>'); ?></span>
		</div>
	  </div>
	   <div class="form-group">
		<label class="col-md-2 control-label">Emplolyee Limit:<span class="required">*</span>
		</label>
		<div class="col-md-10">
			<input type="text" name="emp_limit" class="form-control" value="<?php echo set_value('emp_limit',$form_data['emp_limit']); ?>">  
			<span class="vstar" <?php echo form_error('emp_limit', '<span class="help-block">', '</span>'); ?></span>
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-md-2 control-label">Description: 
		</label>
		<div class="col-md-10">
			<textarea name="plan_desc" class="form-control"> <?php echo set_value('plan_desc',$form_data['plan_desc']); ?></textarea>
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-md-2 control-label">Directory: 
		</label>
		<div class="col-md-10">
			<input type="radio" class="" name="plan_directory" id="plan_directory" value="Y" 
			<?php echo set_radio('plan_directory','Y',((isset($form_data['plan_directory']) && $form_data['plan_directory'] == 'Y' || $form_data['plan_directory'] == '')?true:false));?>/>&nbsp;Yes&nbsp;&nbsp;

			<input type="radio" class="" name="plan_directory" id="plan_directory" value="N" 
			<?php echo set_radio('plan_directory','N',((isset($form_data['plan_directory']) && $form_data['plan_directory'] == 'N')?true:false));?>/>&nbsp;No
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-md-2 control-label">Is Active:
		</label>
		<div class="col-md-10">
			<input type="checkbox" class="" name="is_active" id="is_active" value="1" 
			<?php echo set_checkbox('is_active',1,((isset($form_data['is_active']) && $form_data['is_active'] == 1)?true:false));?>/>
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-md-2 control-label"> <span class="required">
		 </span>
		</label>
		<div class="col-md-2">
			<input type="submit" class="form-control btn btn-primary" style="font-weight: bold; font-size:17px;" name="submit" id="submit" value="SAVE" />
		</div>
	  </div>
	</form>	
  </div>


