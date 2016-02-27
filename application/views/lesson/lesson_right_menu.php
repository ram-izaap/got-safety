<!-- Right Bar -->
                     <div class="col-sm-6 col-md-3 right-bar">
                       
                    <?php /*   <h3>Attendance </h3>
                       
                       <div class="" data-nav="gs-attendance">
                          <ul>
                              <li><a href="javascript:void(0);"> Attendance Sheet 2016</a></li>
                              <li><a href="javascript:void(0);"> Attendance Sheet 2015</a></li>
                          </ul>
                      </div> */ ?>

                      <h3>Recommended Lesson</h3>

                      <div class="" data-nav="gs-recommended-lesson">
                          <ul>
							  <?php  foreach($this->data['list_data'] as $list){ ?>
								  
								  <li><a style="cursor:pointer" onclick="get_lesson_list(<?php echo $list['id'];?>);"> <?php echo $list['title'];?></a></li>
								 
								  
							<?php } ?>
                          </ul>
                      </div>
                      
                      
						
                      

                    <?php /*  <h3>Other Lesson</h3>

                      <div class="" data-nav="gs-other-lesson">
                          <ul>
                              <li><a href="javascript:void(0);"> ATV Safety</a></li>
                              <li><a href="javascript:void(0);"> Abuse and Domestic Violence Reporting</a></li>
                              <li><a href="javascript:void(0);"> Acetylene Safety</a></li>
                              <li><a href="javascript:void(0);"> Aerial Climbing Safety</a></li>
                              <li><a href="javascript:void(0);"> Aerosol Transmissible Diseases</a></li>
                              <li><a href="javascript:void(0);"> Air Compressors</a></li>
                              <li><a href="javascript:void(0);"> Air Hose Safety</a></li>
                          </ul>
                      </div>
				*/ ?>


                     </div>

<script>
	
	function get_lesson_list(id)
	{
	   $.ajax({

             url: '<?php echo base_url() ?>index.php/lesson/get_lesson_data/', 
             type: 'POST',
             dataType:'json',
             data: {'view_param': id},
             success: function(response)
             {

                $('#content-load').html(response.html_view);

             }
		});
	}

</script>      
