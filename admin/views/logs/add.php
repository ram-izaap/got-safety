
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
						
						<a href="<?php echo base_url("index.php/logs"); ?>">300 Logs</a>
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
							  $selected = ($form_data['created_user'] == $fvalue['id'])?"selected='selected'":"";   
						?>
						<option value="<?php echo $fvalue['id']; ?>" <?php echo $selected; ?>><?php echo $fvalue['name'];?></option>
						<?php } } ?>
					</select>
					 <span class="vstar" <?php echo form_error('user_id', '<span class="help-block">', '</span>'); ?></span>
				</div>
			</div>
			
			<div class="form-group">
					<label class="col-md-2 control-label">All:
					</label>
					<div class="col-md-10">
						<input type="checkbox" class="" name="all" id="all" value="1" 
						<?php echo set_checkbox('all',1,((isset($form_data['all']) && $form_data['all'] == 1)?true:false));?>/>
					</div>
				</div>
				
			
			<?php } ?>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Title: <span class="required">
					* </span>
					</label>
					<div class="col-md-10">
						<input type="text" name="title" class="form-control" value="<?php echo set_value('title',$form_data['title']); ?>">
						<span class="vstar" <?php echo form_error('title', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				
			
				
				<div class="form-group">
					<label class="col-md-2 control-label">File:<span class="required"> *</span>
					</label>
					<div class="col-md-10">
						<input id="image" name="pdf_file" type="file" class="file" />
					<input id="slide_image" name="slide_image" type="hidden" value="<?php echo set_value('slide_image',$form_data['slide_image']); ?>" />
					
					<span class="vstar"<?php echo form_error('pdf_file', '<span class="help-block">', '</span>'); ?> </span>
					
						<?php 	if($edit_id != "") { ?>
								<a  target="_blank" href="<?php echo $img_url; ?>assets/images/frontend/logs/<?php echo $form_data['pdf_file'];?>" > <?php echo $form_data['pdf_file'];?> </a>
							
						<?php } ?>
						
					</div>
				</div> 
				
				
				
				
				<div class="form-group">
					<label class="col-md-2 control-label">Is Display:
					</label>
					<div class="col-md-10">
						<input type="checkbox" class="" name="is_display" id="is_display" value="1" 
						<?php echo set_checkbox('is_display',1,((isset($form_data['is_display']) && $form_data['is_display'] == 1)?true:false));?>/>
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
