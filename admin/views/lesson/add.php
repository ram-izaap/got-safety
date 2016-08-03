
<?php if($this->session->flashdata('lesson_succ')==TRUE){?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?php echo $this->session->flashdata('lesson_succ');?>
		</div>
		<?php }?>
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
						
						<a href="<?php echo base_url("index.php/lesson"); ?>">Lesson</a>
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
						<option value="<?php echo $fvalue['id']; ?>" <?php echo $selected; ?> <?php echo set_select('user_id',  $fvalue['id']); ?>><?php echo $fvalue['name'];?></option>
						<?php } } ?>
					</select>
					 <span class="vstar" <?php echo form_error('user_id', '<span class="help-block">', '</span>'); ?></span>
				</div>
			</div>
			
			
			<div class="form-group">
					<label class="col-md-2 control-label">All:
					</label>
					<div class="col-md-10">
						<input type="checkbox" class="" name="visible_to_all" id="visible_to_all" value="1" 
						<?php echo set_checkbox('visible_to_all',1,((isset($form_data['visible_to_all']) && $form_data['visible_to_all'] == 1)?true:false));?>/>
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
					<label class="col-md-2 control-label">Start Date: <span class="required">
					* </span>
					</label>
					<div class="col-md-10">
						<input type="text" id="from" name="from" class="form-control" value="<?php echo set_value('from',$form_data['from']); ?>" readonly>
						<span class="vstar" <?php echo form_error('from', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label">End Date: <span class="required">
					* </span>
					</label>
					<div class="col-md-10">
						<input type="text" id="to" name="to_date" class="form-control" value="<?php echo set_value('to_date',$form_data['to_date']); ?>" readonly>
						<span class="vstar" <?php echo form_error('to_date', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div>
				
				
				<?php /*<div class="form-group">
					<label class="col-md-2 control-label">Content: <span class="required">
					* </span>
					</label>
					<div class="col-md-10">
						<textarea name="content" class="form-control"> <?php echo set_value('content',$form_data['content']); ?></textarea>
					<span class="vstar" <?php echo form_error('content', '<span class="help-block">', '</span>'); ?></span>
					</div>
				</div> */?>

				<div class="form-group">
					<label class="col-md-2 control-label">Recommended Lesson:
					</label>
					<div class="col-md-10">
						<input type="checkbox" class="" name="rec_lesson" id="rec_lesson" value="1" 
						<?php echo set_checkbox('rec_lesson',1,((isset($form_data['rec_lesson']) && $form_data['rec_lesson'] == 1)?true:false));?>/>
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
			
			
			<?php if($lesson_id != "") { ?>

					<a class="add-att" href="<?php echo site_url();?>attachment/add_attachment?id=<?php echo $lesson_id;?>">Add attachment</a> 

			<?php }else if($edit_id !="") { ?>
				
				<a class="add-att" href="<?php echo site_url();?>attachment/add_attachment?id=<?php echo $edit_id;?>">Add attachment</a> 
				
				<?php } ?>
				
				
				
			<?php if($lesson_id != "") { ?>

					<?php echo $attachment_display;?> 

			<?php }else if($edit_id !="") { ?>
				
				<?php echo $attachment_display;?> 
				
				<?php } ?>
				
<style>

.att-lesson { width:80%; margin:20px auto; }
.att-lesson th { text-align: center; border-top:none !important; font-size: 14px;}
.att-lesson td {  text-align:center; border-top:1px solid #000 !important;}
.att-main{ width:100%; display:inline-block; border:1px solid #ccc; margin-top:20px;}
.att-main h2 {background: #8795A8; margin-bottom: 0; margin-top: 0; padding: 6px 12px; color:#ffffff;}
.add-att { background:#364150; padding: 6px 12px; color:#fff; float:right;   margin-right: 22px; text-decoration:none;}
.att-back {  margin: 0 16px 16px 0 !important;}
.add-att:hover {
    background-color: #3b9c96;
    border-color: #307f7a;
    color: #fff;
    text-decoration: none;
}
.add-att::before {
    content: "+";
    font-size: 15px;
    padding-right: 5px;
   
}

</style>
