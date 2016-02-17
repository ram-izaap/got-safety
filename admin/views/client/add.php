
	<h3 class="page-title">
			<?php echo $title;?>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#"><?php echo $crumb;?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					
				</ul>

			</div>
			


<div class="form-body">
	<form role="form" name="social" id="social" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id = (isset($form_data['id']))?$form_data['id']:""; ?>" /> 
				<div class="form-group">
					<label class="col-md-2 control-label">Name : <span class="required">
					* </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="name" class="form-control" value="<?php echo set_value('name',$form_data['name']); ?>">
						<span class="vstar" <?php echo form_error('name', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">email: <span class="required">
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="email" class="form-control" value="<?php echo set_value('email',$form_data['email']); ?>">
						<span class="vstar" <?php echo form_error('email', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Password: <span class="required"> *
					 </span>
					</label>
					<div class="col-md-10">
						<input type="password" name="password" class="form-control" value="<?php echo set_value('password',$form_data['ori_password']); ?>">
						<span class="vstar" <?php echo form_error('password', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-md-2 control-label">Is Active:
					</label>
					<div class="col-md-10">
						<input type="checkbox" class="form-control" name="is_active" id="is_active" value="1" 
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
