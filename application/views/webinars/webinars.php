 <!-- // Content area -->
         <section class="container content-area" data-view="list">
          
          <!-- rwo default --> 
          <div class="row" data-row="default">


               <aside class="col-sm-12 bg-white inner-full">
                 <div class="inner-content">
                     
                     <!-- Left Bar -->
                     <div class="col-md-3 list-web">

                       <button class="pre-but-color"> Previous Webinars</button>
                        <div class="letter-size"; >
							<?php foreach($all_data as $data) { ?>
								
								<a onclick="change_webinars(<?php echo $data['id'];?>);"><?php echo $data['created_date'];?> - <?php echo $data['title'];?></a><br>
						
							<?php } ?>

						</div>
						
                     </div>

                     <!-- -->
                     <div class="col-sm-6 content-bar" id="content-load">
                        

                        
						
						<video height="400" width="100%" controls>
  
							<source src="<?php echo $most_data[0]['link'];?>" >
				 
						</video>	
			
                       
                      
                     </div>

                    <!--  Right menu  -->
                    
                     
                 </div>





           </aside>

            <!-- rwo default --> 
          </div>
          

         </section>
    <!-- Content area // -->
    
    
    <script>
    
    function change_webinars(id) 
    {
		$.ajax({

             url: '<?php echo base_url() ?>index.php/webinars/get_webinars_data/', 
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
    
 <style>
	 
.list-web:hover .letter-size { display: block; }
	 
.letter-size { font-size:12px; display:none;}

.pre-but-color { background:#E81B23 !important; color:#FFFFFF;}
.pre-but-color:hover { background:#737373 !important;}

</style>
