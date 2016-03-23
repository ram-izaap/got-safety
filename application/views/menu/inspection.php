

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
                        <h3>Inspection Reports </h3>
                        <hr />
						<?php echo $content[0]['content']; ?>
						
                        <div class="report-details">
                        	<div class="reports-section clearfix">
                                <h3>2016 Inspections</h3>
									<?php $i=1; foreach($all_data as $data) {  ?>
										<a target="_blank" href="<?php echo $img_url; ?>assets/images/frontend/inspection_reports/<?php echo $data['pdf_file'];?>"  <?php if($i % 2 == 0) {  ?>class="i-reports R-mar0" <?php } else { ?> class="i-reports" <?php } ?>><span><?php echo $data['title']?> <br><small><?php echo $data['created_date']?></small></span></a>
									<?php  $i++;} ?>
                            </div>
                           <?php /*<div class="reports-section clearfix">
                                <h3>2015 Inspections</h3>
                                <a href="#" class="i-reports"><span>Office <br><small>01-01-15</small></span></a>
                                <a href="#" class="i-reports R-mar0"><span>Hotel <br><small>07-01-15</small></span></a>
                                <a href="#" class="i-reports"><span>Animal Rendering<br><small>10-01-15</small></span></a>
                                <a href="#" class="i-reports R-mar0"><span>Food Processing <br><small>12-01-15</small></span></a>
                            </div>
                            <div class="reports-section clearfix">
                                <h3>2014 Inspections</h3>
                                <a href="#" class="i-reports"><span>Manufacturing <br><small>01-01-14</small></span></a>
                                <a href="#" class="i-reports R-mar0"><span>Warehouse<br><small>07-01-14</small></span></a>
                                <a href="#" class="i-reports"><span>Farming <br><small>10-01-14</small></span></a>
                                <a href="#" class="i-reports R-mar0"><span>Construction<br><small>12-01-14</small></span></a>
                            </div> 
                        </div> */ ?>
                        
                        </div>
                 </div>
           </aside>

            <!-- rwo default --> 
          </div>
          

         </section>
    <!-- Content area // -->

