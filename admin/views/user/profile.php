
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
					<label class="col-md-2 control-label">Client Admin Username: <span class="required">
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="name" readonly class="form-control" value="<?php echo set_value('name',$form_data['name']); ?>">
						<span class="vstar" <?php echo form_error('name', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Client Admin Password: <span class="required">
					 </span>
					</label>
					<div class="col-md-10">
						<input type="password" name="password" class="form-control" value="">
						<span class="vstar" <?php echo form_error('password', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Client Admin Email: <span class="required">
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="email" readonly class="form-control" value="<?php echo set_value('email',$form_data['email']); ?>">
						<span class="vstar" <?php echo form_error('email', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>


				<div class="form-group">
					<label class="col-md-2 control-label">Client/App Username: <span class="required">* 
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="user_name" value="<?php echo set_value('user_name',$form_data['user_name']); ?>" class="form-control">
						<span class="vstar" <?php echo form_error('user_name', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Client/App Password: 
					</label>
					<div class="col-md-10">
						<input type="password" name="user_pwd" value="" class="form-control">
						<span class="vstar" <?php echo form_error('user_pwd', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Company Name: <span class="required">* 
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="company_name" value="<?php echo set_value('company_name',$form_data['company_name']); ?>" class="form-control">
						<span class="vstar" <?php echo form_error('company_name', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Company Address: <span class="required"> *
					 </span>
					</label>
					<div class="col-md-10">
						<textarea type="text" name="company_address" class="form-control"><?php echo set_value('company_address',$form_data['company_address']); ?></textarea>
						<span class="vstar" <?php echo form_error('company_address', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Company Phone No: <span class="required"> *
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="company_phone_no" value="<?php echo set_value('company_phone_no',$form_data['company_phone_no']); ?>" class="form-control">
						<span class="vstar" <?php echo form_error('company_phone_no', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Company URL: 
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="company_url" value="<?php echo set_value('company_url',$form_data['company_url']); ?>" class="form-control">
						<span class="vstar" <?php echo form_error('company_url', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Main Contact: 
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="main_contact" value="<?php echo set_value('main_contact',$form_data['main_contact']); ?>" class="form-control">
						<span class="vstar" <?php echo form_error('main_contact', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Main Contact No:  
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="main_contact_no" value="<?php echo set_value('main_contact_no',$form_data['main_contact_no']); ?>" class="form-control">
						<span class="vstar" <?php echo form_error('main_contact_no', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Main Contact Address:  
					 </span>
					</label>
					<div class="col-md-10">
						<textarea name="main_contact_address" class="form-control"><?php echo set_value('main_contact_address',$form_data['main_contact_address']); ?></textarea>
						<span class="vstar" <?php echo form_error('main_contact_address', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

               <div class="form-group">
					<label class="col-md-2 control-label">Main Email Address:  
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="main_email_addr" value="<?php echo set_value('main_email_addr',$form_data['main_email_addr']); ?>" class="form-control">
						<span class="vstar" <?php echo form_error('main_email_addr', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">No of Employees:  
					 </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="no_of_employees" value="<?php echo set_value('no_of_employees',$form_data['no_of_employees']); ?>" class="form-control">
						<span class="vstar" <?php echo form_error('no_of_employees', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Plan Type : <span class="required">
					* </span>
					</label>
					<div class="col-md-10">
						<?php 
						if($get_plans)
							{?>
							<select class="form-control" name="plan_name">
							<?php foreach ($get_plans as $key => $value) 
							{?>
								<option value="<?php echo $value['id'];?>" <?php echo (isset($form_data['plan_type']) && $form_data['plan_type']==$value['id'])?"selected":''; ?>>
									<?php echo $value['plan_type']." ($".$value['plan_amount'].")";?></option>
							<?php 
							}?>
							</select>
						<?php 
							}
							else
							{
								?>
								<span class="vstar">Please Add Plans to Add User.
								<a href="<?=base_url('plan/add_plan');?>">Click Here</a></span>
								<input type="hidden" name="plan_name" value="">
								<?php
							}?>
					</div>
				</div>

				
				<div class="form-group">
					<label class="col-md-2 control-label">Profile Image:<span class="required"> *</span>
					</label>
					<div class="col-md-10">
						<input id="image" name="profile_img" type="file" class="file" />
					<input id="slide_image" name="slide_image" type="hidden" value="<?php echo set_value('slide_image',$form_data['slide_image']); ?>" />
					
					<span class="vstar"<?php echo form_error('profile_img', '<span class="help-block">', '</span>'); ?> </span><br>
					
						<?php 	if($edit_id != "") { ?>
								<img  alt="<?php echo $form_data['profile_img'];?>" src="<?php echo $img_url; ?>assets/images/frontend/users/<?php echo $form_data['profile_img'];?>" class="media-object" width="72"> 
							
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
					<label class="col-md-2 control-label"> <span class="required">
					 </span>
					</label>
					<div class="col-md-2">
						<input type="submit" class="form-control btn btn-primary" style="font-weight: bold; font-size:17px;" name="submit" id="submit" value="SAVE" />
					</div>
				</div>
				
			</form>	
			</div>
