

    <!-- // Content area -->
         <section class="container content-area" data-view="list">
          
          <!-- rwo default --> 
          <div class="row" data-row="default">

           <aside class="col-sm-12 bg-white inner-full">
                 <div class="inner-content">
                     
                     <!-- Left Bar -->
                     <div class="col-md-3 left-bar">

                        <?php $this->load->view('_partials/left_menu','frontend'); ?> 

                     </div>

                     <!-- -->
                     <div class="col-md-9 content-bar inspection-reports">
                        <h3>300 Logs</h3>
                        <hr />

                        <?php echo $content[0]['content']; ?> 

                        <div class="report-details">
                        	<div class="reports-section clearfix">
                                <?php $i=1; foreach($all_data as $data) {  ?>
										<a target="_blank" href="<?php echo $img_url; ?>assets/images/frontend/logs/<?php echo $data['pdf_file'];?>"  <?php if($i % 2 == 0) {  ?>class="i-reports R-mar0" <?php } else { ?> class="i-reports" <?php } ?>><span><?php echo $data['title']?> <br><small><?php echo $data['created_date']?></small></span></a>
									<?php  $i++;} ?>

                            </div>
                        </div>
                        
                        </div>
                 </div>
           </aside>

            <!-- rwo default --> 
          </div>
          

         </section>
    <!-- Content area // -->

