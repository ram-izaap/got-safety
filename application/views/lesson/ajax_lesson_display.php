 <!-- // Content area -->
         <section class="container content-area" data-view="list">
          
          <!-- rwo default --> 
          <div class="row" data-row="default" >


               <aside class="col-sm-12 bg-white inner-full">
                 <div class="inner-content">
                   
                     <div class="" data-nav="gs-recommended-lesson" id="content-load">
                          <ul>
							  <?php  foreach($get_attachment as $list){ ?>
								  
								  <li><a style="cursor:pointer" href="<?php echo site_url();?>lesson/get_lesson_data?lesson_id=<?php echo $list['id'];?>&attachment_id=<?php echo $list['att_id']; ?>&language_id=<?php echo $list['language'];?>"> <?php echo $list['att_title'];?></a></li>
								 
								  
							<?php } ?>
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
		 
		 
	   $.ajax({

             url: '<?php echo base_url() ?>index.php/lesson/ajax_lesson_display/', 
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
