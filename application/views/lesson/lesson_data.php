<div id="sample-con" class="lesson-contnt">
	
	 <select name="language" id="lang" class="table-group-action-input form-control input-medium select-bg" onChange="get_lesson_list(this);">
						
						<?php if(isset($get_language)) { 
							foreach($get_language as $fkey => $fvalue){
							 
						?>
						<option value="<?php echo $fvalue['id']; ?>" ><?php echo $fvalue['lang'];?></option>
						<?php } } ?>
					</select>
	
	<div class="language-list">
			<div aria-label="Large button group" role="group" class="btn-group btn-group-lg">
	<?php foreach($atachment_detail as $data){
		
			if($data['type'] =='1'){ ?>
			
				<a href="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name'];?>" target="_blank"><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				
				<a href="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name_quiz'];?>" target="_blank">	<button class="btn btn-default quiz-btn" type="button"> <?php echo $data['lang']; ?> Quiz</button></a>
					
			<?php }else if($data['type'] =='2' && $data['f_name'] == "" && $data['f_name_quiz'] == "" ) {?>
		<!--audio url -->
				<a href="<?php echo $data['l_url']; ?>" target=_blank> <button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				<a href="<?php echo $data['q_url']; ?>" target=_blank><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Quiz</button></a>
				
			<?php }else if($data['type'] =='2' && $data['l_url'] == "" && $data['q_url'] == "" ) {?>
		<!--Audio File -->
		
				<a href="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name'];?>" target="_blank"><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				
				<a href="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name_quiz'];?>" target="_blank">	<button class="btn btn-default quiz-btn" type="button"> <?php echo $data['lang']; ?> Quiz</button></a>
				
			<?php }else if($data['type'] =='3' && $data['f_name'] == "" && $data['f_name_quiz'] == "" ) {?>
		<!--Video url -->
				<a href="<?php echo $data['l_url']; ?>" target=_blank> <button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				<a href="<?php echo $data['q_url']; ?>" target=_blank><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Quiz</button></a>
				
			<?php }else if($data['type'] =='3' && $data['l_url'] == "" && $data['q_url'] == "" ) {?>
		<!--Video File -->
		
			
		
				<a href="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name'];?>" target="_blank"><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				
				<a href="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name_quiz'];?>" target="_blank">	<button class="btn btn-default quiz-btn" type="button"> <?php echo $data['lang']; ?> Quiz</button></a>	
				
			
			<?php }else { ?>	
				
				<a href="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name'];?>" target="_blank"><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				
				<a href="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name_quiz'];?>" target="_blank">	<button class="btn btn-default quiz-btn" type="button"> <?php echo $data['lang']; ?> Quiz</button></a>
				
			<?php } ?>
		
		<?php } ?>
			
			</div>
		</div>
		
		<div id="content-load">
			<h2><?php echo $language_content['title'];?></h2>
			
			<?php echo $language_content['content'];?>
		</div>
		
	 </div>


<style>

.language-list { text-align:center;}


</style>


 <script>
	   
	function get_lesson_list(lang)
	{ 
		
		 var language_id = lang.value;
		 
		 
	   $.ajax({

             url: '<?php echo base_url() ?>index.php/lesson/ajax_attachment_display/', 
             type: 'POST',
             dataType:'json',
             data: {'language_id': language_id},
             
             success: function(response)
             { 
				
                $('#content-load').html(response.html_view);

             }
		});
	}

	
</script>  
