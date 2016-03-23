
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
						<?php echo $crumb;?>
						
					</li>
					
				</ul>

			</div>
			


<div class="form-body">
	<form role="form" name="social" id="social" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id = (isset($form_data['id']))?$form_data['id']:""; ?>" /> 
			<?php  $role =  $this->session->userdata('admin_data')['role'];  
              if($role == "1"){   ?>
			
			<div class="form-group">
				<label class="col-md-2 control-label">Language: <span class="required">
				* </span>
				</label>
				<div class="col-md-10">
					<select name="language" class="table-group-action-input form-control input-medium">
						<option value="">Select...</option>
						<?php if(isset($get_menu)) { 
							foreach($get_menu as $fkey => $fvalue){
							  $selected = ($form_data['language'] == $fvalue['lang'])?"selected='selected'":"";   
						?>
						<option value="<?php echo $fvalue['lang']; ?>" <?php echo $selected; ?>><?php echo $fvalue['lang'];?></option>
						<?php } } ?>
					</select>
					 <span class="vstar" <?php echo form_error('language', '<span class="help-block">', '</span>'); ?></span>
				</div>
			</div>
			
			<?php } ?>
			
			<?php  $role =  $this->session->userdata('admin_data')['role'];  
              if($role == "2"){   ?>
			<div class="form-group">
				<label class="col-md-2 control-label">Language: <span class="required">
				* </span>
				</label>
				<div class="col-md-10">
					<select name="language" class="table-group-action-input form-control input-medium">
						<option value="">Select...</option>
						<?php if(isset($get_menu)) { 
							foreach($get_menu as $fkey => $fvalue){ 
							  $selected = ($form_data['language'] == $fvalue['lang'])?"selected='selected'":"";   
						?>
						<?php
						$a= explode(',',$lang_list);
						if(in_array($fvalue['id'],$a)) { ?>
						<option value="<?php echo $fvalue['lang']; ?>" <?php echo $selected; ?>><?php echo $fvalue['lang'];?></option>
						<?php } ?>
						<?php  } } ?>
					</select>
					 <span class="vstar" <?php echo form_error('language', '<span class="help-block">', '</span>'); ?></span>
				</div>
			</div>
			<?php } ?>
			
		<?php /*	<div class="form-group">
				<label class="col-md-2 control-label">Type: <span class="required">
				* </span>
				</label>
				<div class="col-md-10">
					<select name="type" class="table-group-action-input form-control input-medium">
						<option value="">Select...</option>
						<?php 
							if($form_data['type'] == 'Lesson') {
								$selected = "selected='selected'";
							}else if($form_data['type'] == 'Quiz') {
								$selected = "selected='selected'";
							}else {
								$selected = "";
							}
							  //$selected = ($form_data['type'] == '')?"selected='selected'":"";   
						?>
						<option value="<?php echo "Lesson"; ?>" <?php if($form_data['type'] == 'Lesson') { ?>selected="selected";<?php } ?> ?>   <?php echo "Lesson";?></option>
						<option value="<?php echo "Quiz"; ?>" <?php if($form_data['type'] == 'Quiz') { ?>selected="selected";<?php } ?> ?>   <?php echo "Quiz";?></option>
						
					</select>
					 <span class="vstar" <?php echo form_error('type', '<span class="help-block">', '</span>'); ?></span>
				</div>
			</div>
			
			*/ ?>

				
				<div class="form-group">
					<label class="col-md-2 control-label">5 X 9:<span class="required">* </span>
					</label>
					<div class="col-md-10">
						<input id="image" name="f_name" type="file" class="file" />
					<input id="team_image" name="slide_image" type="hidden" value="<?php echo set_value('slide_image',$form_data['slide_image']); ?>" />
					
					<span class="vstar"<?php echo form_error('f_name', '<span class="help-block">', '</span>'); ?> </span>
					
						<?php if($edit_id != "") { ?>
								<a  target="_blank" href="<?php echo $img_url; ?>assets/images/frontend/posters_attachment/<?php echo $form_data['f_name'];?>" height="70px;" width="100px;"> <?php echo $form_data['f_name'];?> </a>
							
						<?php } ?>
						
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-md-2 control-label">5 X 11:<span class="required">* </span>
					</label>
					<div class="col-md-10">
						<input id="image" name="f_name_quiz" type="file" class="file" />
					<input id="team_image2" name="slide_image2" type="hidden" value="<?php echo set_value('slide_image2',$form_data['slide_image2']); ?>" />
					
					<span class="vstar"<?php echo form_error('f_name_quiz', '<span class="help-block">', '</span>'); ?> </span>
					
						<?php if($edit_id != "") { ?>
								<a  target="_blank" href="<?php echo $img_url; ?>assets/images/frontend/posters_attachment/<?php echo $form_data['f_name'];?>" height="70px;" width="100px;"> <?php echo $form_data['f_name_quiz'];?> </a>
							
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
