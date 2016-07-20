<div id="sample-con">
	
	 
		
		<div id="load-view">
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
