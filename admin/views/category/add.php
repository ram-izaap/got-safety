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
		 <a href="<?php echo base_url("index.php/category"); ?>">Category</a>
		 <i class="fa fa-angle-right"></i>
	  </li>
	  <li>
	    <?php echo $crumb;?>
	  </li>
	</ul>
  </div>
  
  <div class="form-body">
	<form role="form" name="category" id="category" method="POST">
      <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id = (isset($form_data['id']))?$form_data['id']:""; ?>" /> 
      
      <div class="form-group">
		<label class="col-md-2 control-label">Category: <span class="required">* </span>
		</label>
		<div class="col-md-10">
			<input type="text" name="cat_name" class="form-control" value="<?php echo set_value('cat_name',$form_data['cat_name']); ?>">  
			<span class="vstar" <?php echo form_error('cat_name', '<span class="help-block">', '</span>'); ?></span>
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


