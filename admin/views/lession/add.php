<?php if (isset($message)) { if($message = $this->service_message->render()) :?>
		<?php echo $message;?>
<?php endif; }?>
<div id="content-wrapper">
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
              <div class="col-lg-9" style="left: -20px;">
                <h1 class="pull-left" ><b><?php echo $title; ?></b></h1>
              </div>
              <div class="col-lg-3">
                 <button class="btn btn-default" style="float:right;" onclick="goBack('admin/jqslider')" type="button" title="Go Back">Back</button>
              </div>
            </div>
            <div class="col-lg-12" style="bottom: 10px; left:-8px;">
                <ol class="breadcrumb"><li><a href="#">home </a></li><li class="active"><span><?php echo $crumb;?></span></li></ol>
            </div>
        </div>
<div class="row">
 <div class="col-lg-12">
   <div class="main-box">
    <header class="main-box-header clearfix"><h2></h2></header>
    
    <div class="main-box-body clearfix">
        <form role="form" name="social" id="social" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id = (isset($form_data['SlideshowId']))?$form_data['SlideshowId']:""; ?>" /> 
             
           <?php /*  <div class="form-group">
				<label for="ParentMenu">Select Menu<span class="vstar">*</span></label>
				<br />
				 <select name="Menu[]" id="product_id" multiple="multiple">
				   <option value="">Select Menu</option>
				   <?php if(isset($get_menu)) { 
							foreach($get_menu as $fkey => $fvalue){ 
								$a= explode(',',$form_data['Menu']);
								print_r($a);
							  $selected = (in_array($fvalue['id'],$a))?"selected='selected'":"";   
						?>
					<option value="<?php echo $fvalue['id']; ?>" <?php echo $selected; ?>><?php echo $fvalue['name'];?></option>
				   <?php } } ?>
				 </select>
				  <span class="vstar" <?php echo form_error('Menu', '<span class="help-block">', '</span>'); ?></span>
			</div> */ ?>
            
 
            <div class="form-group">
                <label for="name">Slide show Name<span class="vstar">*</span></label>
                <input type="text" class="form-control" name="SlideshowName" id="name" value="<?php echo set_value('SlideshowName',$form_data['SlideshowName']); ?>"/>
               <span class="vstar" <?php echo form_error('SlideshowName', '<span class="help-block">', '</span>'); ?></span>
            </div>
             
             
             
             
             <div class="row show_links_fields_slide jq-slide-wrapper">
                    <div class="col-md-12 btn-add-more">
							<div class="col-md-2" style="text-align: right !important;">
						<input type="button" class="btn btn-success form-control show_link_add_more_slide" name="add_more_link" style="font-weight: bold;color: #fff;"   value="ADD MORE" />
						</div> 
					</div>
				   
				   <?php if($form_data['OrphanUrls'] !=""){ $a = explode('~',$form_data['OrphanUrls']);
				   
				   $s= sizeof($a);
				   //print_r($a['0']);exit;
				   for($i=0;$i<$s;$i++){ 
				   
				   
				   ?>
				  
				  
					<div class="col-md-12 delrow-show sorted_table">
						<div class="col-md-6">
							<?php if($i<=0) {?>
							<label for="Name">Orphan url<span class="vstar">*</span></label>
							<?php } ?>
							<input type="text" class="form-control" name="OrphanUrls[]" value="<?php echo set_value('OrphanUrls[]',$a[$i]); ?>" />
							<span class="vstar" <?php echo form_error('OrphanUrls', '<span class="help-block">', '</span>'); ?></span>
						</div>
						
					  <?php if($i!=0) {?>
						<input type="button" class="btn btn-success form-control bottom_remove_field22 show_remove_field_slide col-md-2 btn-delete" name="bottom_remove-field_slide" value="DELETE" />
						<?php } ?>
					</div>  
					<?php } } else { ?>
						
						<div class="col-md-12 delrow-show sorted_table">
						<div class="col-md-6">
							<label for="Name">Orphan url<span class="vstar">*</span></label>
							<input type="text" class="form-control" name="OrphanUrls[]" value="" />
							<span class="vstar" <?php echo form_error('OrphanUrls[]', '<span class="help-block">', '</span>'); ?></span>
						</div>
						
					  
						
					</div> 
						
						<?php } ?>
				 
             </div>
                       
			
			<div class="form-group radio-effect">
				<label for="slide">Transition Effect </label>
				<div class="checkbox-nice checkbox-inline">
					<span>
				<input type="radio" class="form-control" name="TransitionType" id="TransitionType"  value="sliding"<?php echo set_radio('TransitionType','sliding',$form_data['TransitionType'] == 'sliding');?>/> 
				<label for="Sliding">Sliding</label>
				
				</span>
				<span>
				<input type="radio" class="form-control" name="TransitionType" id="TransitionType"  value="fading"<?php echo set_radio('TransitionType','fading',$form_data['TransitionType'] == 'fading');?>/> 
				<label for="Fading">Fading</label>
				</span>
				<span class="vstar" <?php echo form_error('TransitionType', '<span class="help-block">', '</span>'); ?></span>
				</div>
			</div>
			
			
			
			<div class="form-group">
				<label for="slide">Transition Speed </label>
				<input type="text" class="form-control" name="TransitionSpeed" id="TransitionSpeed" value="<?php echo set_value('TransitionSpeed',$form_data['TransitionSpeed']); ?>"/> 
				<p style="color:#929292">( Transition speed in Milliseconds.Ex:100 ) </p>
				<span class="vstar" <?php echo form_error('TransitionSpeed', '<span class="help-block">', '</span>'); ?></span>
			</div>
			
			
			<div class="form-group">
				<label for="slide">Interval Duration </label>
				
				<input type="text" class="form-control" name="AutoplaySpeed" id="AutoplaySpeed" value="<?php echo set_value('AutoplaySpeed',$form_data['AutoplaySpeed']); ?>"/> 
				<p style="color:#929292">( Interval Duration in Milliseconds.Ex:4000 ) </p>
				<span class="vstar" <?php echo form_error('AutoplaySpeed', '<span class="help-block">', '</span>'); ?></span>
				
			</div>
			
			
			<div class="form-group">
				<label for="slide">Max Height</label>
				
				<input type="text" class="form-control" name="maxHeight" id="maxHeight" value="<?php echo set_value('maxHeight',$form_data['maxHeight']); ?>"/> 
				<span class="vstar" <?php echo form_error('maxHeight', '<span class="help-block">', '</span>'); ?></span>
				
			</div>
			
			 
			 <div class="form-group">
				<label>IsActive</label>
				<br/>
				<div class="checkbox-nice checkbox-inline">
					<input type="checkbox" class="form-control" name="is_active" id="is_active" value="1" 
					 <?php echo set_checkbox('is_active',1,((isset($form_data['is_active']) && $form_data['is_active'] == 1)?true:false));?>/>
					<label for="is_active">
						Yes
					</label>
				</div>
			</div>
			 

            <div class="col-md-1">
                <input type="submit" class="form-control btn btn-primary" style="font-weight: bold; font-size:17px;" name="submit" id="submit" value="SAVE" />
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<style>

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>		

<script>



</script>
