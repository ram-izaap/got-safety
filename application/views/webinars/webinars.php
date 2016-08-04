 <!-- // Content area -->
         <section class="container content-area" data-view="list">
         <!-- rwo default --> 
          <div class="row" data-row="default">

               <aside class="col-sm-12 bg-white inner-full">
                 <div class="inner-content">
                     
                     <!-- Left Bar -->
                     <div class="col-md-3 list-web">

                       <button class="pre-but-color pre-web"> Previous Webinars</button>
                        <div class="letter-size product-categories-webinars"; >
							<ul>
								<?php foreach($all_data as $data) { ?>
									<li>
										<a onclick="change_webinars(<?php echo $data['id'];?>);"><?php echo $data['created_date'];?> - <?php echo $data['title'];?></a>
									</li>
									
								<?php } ?>
							</ul>
						</div>
						
                     </div>

                     <!-- -->
                     <div id="content-load">
                     <div class="col-sm-12 col-md-6 content-bar">
                       <?php  if(count($all_data)>0): ?>
						             <iframe width="560" height="315" src="<?php echo strip_tags($most_data[0]['link']);?>" frameborder="0" allowfullscreen></iframe>
                      <?php endif; ?>
                     </div>
                     <div class="clearfix"></div>
         
                     <?php if(isset($most_data[0]['web_desc']) && $most_data[0]['web_desc']!=''): ?>
                      
                      <div class="col-sm-12 col-md-12 content-bar">
                        
                        <?php echo $most_data[0]['web_desc']; ?>
                      
                      </div>
                     
                     <?php endif; ?>

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

