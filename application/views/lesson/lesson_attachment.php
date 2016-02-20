<div id="sample-con">
	<div class="language-list">
			<div aria-label="Large button group" role="group" class="btn-group btn-group-lg">
	<?php foreach($view_link as $data){ ?>
		
		
	<a href="<?php echo get_img_dir().'assets/images/admin/lession_attachment/'.$data['f_name'];?>" target="_blank"><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['language']; ?> Lesson</button></a>
	
	<a href="<?php echo get_img_dir().'assets/images/admin/lession_attachment/'.$data['f_name_quiz'];?>" target="_blank">	<button class="btn btn-default quiz-btn" type="button"> <?php echo $data['language']; ?> Quiz</button></a>
		
		<?php } ?>
			
			</div>
		</div>
		
		<?php echo $view_content[0]['content'];?>
	
	 </div>


<style>

.language-list { text-align:center;}


</style>
