<div id="sample-con" class="lesson-contnt">
	
	 <select name="language" class="table-group-action-input form-control input-medium select-bg lang1">
						
						<?php if(isset($get_language)) { 
							foreach($get_language as $fkey => $fvalue){
							 
						?>
						<option value="<?php echo $fvalue['id']; ?>" <?php echo (isset($selected_language) && $fvalue['id']==$selected_language)?"selected":""; ?>><?php echo $fvalue['lang'];?></option>
						<?php } } ?>
					</select>
	
	<div class="language-list">
			<div aria-label="Large button group" role="group" class="btn-group btn-group-lg">
	<?php foreach($atachment_detail as $data){
		
			if($data['f_name'] || $data['l_url']):

			if($data['type'] =='1'){ ?>
			
				<a href="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name'];?>" target="_blank"><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				
					
			<?php }else if($data['type'] =='2' && $data['f_name'] == "" ) {?>
				<!--audio url -->
				<a href="<?php echo $data['l_url']; ?>" target=_blank> <button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				
			<?php }else if($data['type'] =='2' && $data['l_url'] == "") {?>
			<!--Audio File -->
			
			<div id="newTab">
				
				   <audio style="width:1000px; position:absolute; top:0; bottom:0; margin:auto; left:0; right:0;" controls>
				  
							  <source src="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name'];?>" type="audio/mpeg">
							  Your browser does not support the video tag.
					</audio> 
			</div>		
		
			<a href="javascript:;" id="link" ><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				
				
			<?php }else if($data['type'] =='3' && $data['f_name'] == "") {?>
		<!--Video url -->
				<a href="<?php echo $data['l_url']; ?>" target=_blank> <button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				
			<?php }else if($data['type'] =='3' && $data['l_url'] == "") {?>
		<!--Video File -->
			<div id="newTab3">
				
				   <video width="100%" height="100%" controls>
				  
							  <source src="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name'];?>" type="video/ogg">
							  Your browser does not support the video tag.
					</video> 
			</div>			
		
			<a href="javascript:;" id="link3" ><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
				
			<?php }else { ?>	
				
				<a href="<?php echo $img_url.'assets/images/admin/lession_attachment/'.$data['f_name'];?>" target="_blank"><button class="btn btn-default lesson-btn" type="button"> <?php echo $data['lang']; ?> Lesson</button></a>
								
			<?php } 

			endif; ?>

		
		<?php } ?>

			
			</div>
		</div>
		
		<div id="content-load">
			<h2><?php echo $language_content['title'];?></h2>
			
			<?php echo $language_content['content'];?>

			<div class="text-center"><a href="<?php echo site_url('signoff/index/'.$lesson_id);?>" class="btn btn-danger btn-lg">SIGN OFF</a></div>
		</div>
		
	 </div>


<style>

.language-list { text-align:center;}

#newTab,#newTab2,#newTab3,#newTab4 {
    display: none;
}

</style>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
 <script>
	   

	   
	
	$( document ).ready(function() {
	
function newTabFunction() { 
    var w = window.open();
    var html = $("#newTab").html();

    $(w.document.body).html(html);
}


$(function() { 
    $("a#link").click(newTabFunction);
});


function newTabFunction2() { 
    var w = window.open();
    var html = $("#newTab2").html();

    $(w.document.body).html(html);
}


$(function() { 
    $("a#link2").click(newTabFunction2);
});

function newTabFunction3() { 
    var w = window.open();
    var html = $("#newTab3").html();

    $(w.document.body).html(html);
}


$(function() { 
    $("a#link3").click(newTabFunction3);
});

function newTabFunction4() { 
    var w = window.open();
    var html = $("#newTab4").html();

    $(w.document.body).html(html);
}


$(function() { 
    $("a#link4").click(newTabFunction4);
});
	
	

 });


</script>  

