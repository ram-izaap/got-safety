<!-- // Content area -->
<section class="container content-area" data-view="list">
	<!-- rwo default --> 
	<div class="row" data-row="default" >
		<aside class="col-sm-12 col-md-6 rbg-white inner-full safety-lesn">
			<div class="inner-content">
				<select name="language" id="lang" class="table-group-action-input form-control 	    input-medium" onChange="get_lesson_list(this);">
					<?php 
					if(isset($get_language)) 
					{ 
						foreach($get_language as $fkey => $fvalue)
						{
							?>
							<option value="<?php echo $fvalue['id']; ?>" ><?php echo $fvalue['lang'];?></option>
							<?php 
						} 
					} 
					?>
				</select><br>
				<input type="text" class="form-control" placeholder="Search Lesson By Title..."
				 name="search_title" onkeyup="get_title_list(this);">
				<div class="safety-contentload" data-nav="gs-recommended-lesson" id="content-load">
					<ul>
						<?php  
						foreach($get_attachment as $list)
						{ 
							?>
							<li>
								<a style="cursor:pointer" href="<?php echo site_url();?>lesson/get_lesson_data?lesson_id=<?php echo $list['id'];?>&attachment_id=<?php echo $list['att_id']; ?>&language_id=<?php echo $list['language'];?>"> <?php echo $list['att_title'];?></a>
							</li>
							<?php 
						}
						?>
					</ul>
				</div>
				<!--  Right menu  -->
			</div>
		</aside>
		<!-- rwo default --> 
	</div>
</section>
<!-- Content area // -->
<script>
function get_lesson_list(lang)
{ 
	var language_id = lang.value;
	title = $("input[name='search_title']").val();

	$.ajax({
		url: '<?php echo base_url() ?>index.php/lesson/ajax_lesson_display/', 
		type: 'POST',
		dataType:'json',
		data: {'language_id': language_id,'title':title},
		success: function(response)
		{ 	
			$('#content-load').html(response.html_view);
		}
		});
}
function get_title_list(title)
{
	title = title.value;
	language_id = $("#lang").val();
	//alert(title);
	$.ajax({
		url: '<?php echo base_url() ?>index.php/lesson/ajax_lesson_display/', 
		type: 'POST',
		dataType:'json',
		data: {'language_id': language_id,'title':title},
		success: function(response)
		{ 	
			$('#content-load').html(response.html_view);
		}
		});
}

</script>  
