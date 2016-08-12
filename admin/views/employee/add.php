
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
						
						<a href="<?php echo base_url("index.php/employee"); ?>">Employee</a>
						<i class="fa fa-angle-right"></i>
					</li>
					
					<li>
						<?php echo $crumb;?>
						
					</li>
					
				</ul>

			</div>
			


<div class="form-body">
	<form role="form" name="social" id="social" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id = (isset($form_data['id']))?$form_data['id']:""; ?>" /> 
			
				<?php $role =  $this->session->userdata('admin_data')['role'];  
              if($role == "1"){   ?>
				  
             <div class="form-group">
				<label class="col-md-2 control-label">Client: <span class="required">
				* </span>
				</label>
				<div class="col-md-10">
					<select name="user_id" class="table-group-action-input form-control input-medium">
						<option value="">Select...</option>
						<?php if(isset($get_menu)) { 
							foreach($get_menu as $fkey => $fvalue){
							  if($this->session->userdata("clientid")!='')	
							    $selected = ($this->session->userdata("clientid") == $fvalue['id'])?"selected='selected'":"";
							  else
							    $selected = ($form_data['created_user'] == $fvalue['id'])?"selected='selected'":"";      
						?>
						<option value="<?php echo $fvalue['id']; ?>" <?php echo $selected; ?> <?php echo set_select("user_id",$fvalue['id']); ?>><?php echo $fvalue['name'];?></option>
						<?php } } ?>
					</select>
					 <span class="vstar" <?php echo form_error('user_id', '<span class="help-block">', '</span>'); ?></span>
				</div>
			</div>
			
			
			<?php } ?>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Name: <span class="required">
					* </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="employee_name" class="form-control" value="<?php echo set_value('employee_name',$form_data['employee_name']); ?>">
						<span class="vstar" <?php echo form_error('employee_name', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Email: <span class="required">
					* </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="employee_email" class="form-control" value="<?php echo set_value('employee_email',$form_data['employee_email']); ?>">
						<span class="vstar" <?php echo form_error('employee_email', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-md-2 control-label">Employee ID: <span class="required">
					* </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="emp_id" class="form-control" value="<?php echo set_value('emp_id',$form_data['emp_id']); ?>">
						<span class="vstar" <?php echo form_error('emp_id', '<span class="help-block">', '</span>'); ?></span>
						<p style="color:black;">( Ex: EMP4  or  EMP-04 )</p>
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
