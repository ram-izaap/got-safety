
	<h3 class="page-title">
			<?php echo "Profile Details"?>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url("home"); ?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					
					<li>
						
						Profile
					</li>
					
					<li>
						
						
					</li>
					
				</ul>

			</div>
			


<div class="form-body">
	<form role="form" name="social" id="social" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id = (isset($form_data['id']))?$form_data['id']:""; ?>" /> 
			
				<div class="form-group">
					<label class="col-md-2 control-label">Name: <span class="required">
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="name" readonly class="form-control" value="<?php echo set_value('name',$form_data['name']); ?>">
						<span class="vstar" <?php echo form_error('name', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Email: <span class="required">
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="email" readonly class="form-control" value="<?php echo set_value('email',$form_data['email']); ?>">
						<span class="vstar" <?php echo form_error('email', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Password: <span class="required">
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="password" class="form-control" value="">
						<span class="vstar" <?php echo form_error('password', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Phone No: <span class="required">*
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="phone" class="form-control" value="<?php echo set_value('phone',$form_data['phone']); ?>">
						<span class="vstar" <?php echo form_error('phone', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				
			
				
				<div class="form-group">
					<label class="col-md-2 control-label">Profile Image:<span class="required"> *</span>
					</label>
					<div class="col-md-10">
						<input id="image" name="profile_img" type="file" class="file" />
					<input id="slide_image" name="slide_image" type="hidden" value="<?php echo set_value('slide_image',$form_data['slide_image']); ?>" />
					
					<span class="vstar"<?php echo form_error('profile_img', '<span class="help-block">', '</span>'); ?> </span>
					
						<?php 	if($edit_id != "") { ?>
								<img  alt="<?php echo $form_data['profile_img'];?>" src="<?php echo $img_url; ?>assets/images/frontend/users/<?php echo $form_data['profile_img'];?>" height="180px" width="150px"> 
							
						<?php } ?>
						
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
