
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
						
					</li>
					
				</ul>

			</div>
			


<div class="form-body">
	<form role="form" name="social" id="social" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id = (isset($form_data[0]['id']))?$form_data[0]['id']:""; ?>" /> 
				
				<div class="form-group">
					<label class="col-md-2 control-label">Content: <span class="required">
					* </span>
					</label>
					<div class="col-md-10">
						<textarea name="content" class="form-control"> <?php echo set_value('content',$form_data[0]['content']); ?></textarea>
					<span class="vstar" <?php echo form_error('content', '<span class="help-block">', '</span>'); ?></span>
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
