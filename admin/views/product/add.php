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
		 <a href="<?php echo base_url("index.php/product"); ?>">Product</a>
		 <i class="fa fa-angle-right"></i>
	  </li>
	  <li>
	    <?php echo $crumb;?>
	  </li>
	</ul>
  </div>

  <div class="form-body">
	<form role="form" name="product" id="product" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id = (isset($form_data['id']))?$form_data['id']:""; ?>" /> 
      
      <div class="form-group">
		<label class="col-md-2 control-label">Product Name: <span class="required">* </span>
		</label>
		<div class="col-md-10">
			<input type="text" name="name" class="form-control" value="<?php echo set_value('name',$form_data['name']); ?>">  
			<span class="vstar" <?php echo form_error('name', '<span class="help-block">', '</span>'); ?></span>
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-md-2 control-label">Category: <span class="required">* </span>
		</label>
		<div class="col-md-10">
			<select name="cat" class="form-control">
			  <option value="">Please Select Category</option>
			   <?php foreach ($cat_data as $key=>$value): ?>
                <option <?php if($value['id'] == $form_data['cat']) {?>selected="selected"<?php } ?> value="<?php echo $value['id']; ?>" <?php echo set_select('cat',  $value['id']); ?>><?php echo $value['cat_name']; ?></option>  
			   <?php endforeach; ?> 
			</select> 
			<span class="vstar" <?php echo form_error('cat', '<span class="help-block">', '</span>'); ?></span>
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-md-2 control-label">Product Description: <span class="required">* </span>
		</label>
		<div class="col-md-10">
			<textarea name="desc" class="form-control"> <?php echo set_value('desc',$form_data['desc']); ?></textarea>
			<span class="vstar" <?php echo form_error('desc', '<span class="help-block">', '</span>'); ?></span>
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-md-2 control-label">Additional Information: 
		</label>
		<div class="col-md-10">
			<textarea name="add_info" class="form-control"> <?php echo set_value('add_info',$form_data['add_info']); ?></textarea>
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-md-2 control-label">Product SKU:<span class="required">* </span>
		</label>
		<div class="col-md-10">
			<input type="text" name="sku" class="form-control" value="<?php echo set_value('sku',$form_data['sku']); ?>">  
			<span class="vstar" <?php echo form_error('sku', '<span class="help-block">', '</span>'); ?></span>
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="col-md-2 control-label">Product Image: 
		</label>
		<div class="col-md-10">
			<input type="file" name="img" id="img">
			<span class="vstar" <?php echo form_error('img', '<span class="help-block">', '</span>'); ?></span>
			<input id="prod_img" name="prod_img" type="hidden" value="<?php echo $value = (isset($form_data['img']))?set_value('prod_img',$form_data['img']):''; ?>" />

			<?php if($edit_id!= "") { ?>
			   <a target="_blank" href="<?php echo $img_url; ?>assets/product_images/<?php echo $form_data['img'];?>" > <?php echo $form_data['img'];?> </a>
			<?php } ?>
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
		<label class="col-md-2 control-label">Attribute: <span class="required">* </span>
		</label>
		<div class="col-md-10">
			<select name="attrid" class="form-control sel_attr_type">
			  <option value="">Please Select Attribute</option>
			  <?php foreach ($attr_data as $key=>$value): ?>
                <option <?php $attr_id = (isset($form_data['attr_id']))?$form_data['attr_id']:""; ?> <?php if($value['id'] == $attr_id) {?>selected="selected"<?php } ?> value="<?php echo $value['id']; ?>" <?php echo set_select('attrid',  $value['id']); ?>><?php echo $value['attr_name']; ?></option>  
			   <?php endforeach; ?>
			</select> 
			<span class="vstar" <?php echo form_error('attrid', '<span class="help-block">', '</span>'); ?></span>
		</div>
	  </div>

	  <div id="attr_list">
	  		<?php echo $content;?>
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




