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
                     <div class="col-sm-6 content-bar" id="content-load">
                        <h3>Safety Posters</h3>
                        <hr />

                        <?php  echo $posters_content[0]['content'];?>
                       
                        <!--// Product item 
                          <div class="product-loop" data-item="single">
                            <div class="block clearfix">
                              <div class="col-sm-6">
                                 <div class="block-image">
                                  <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="images/product/cover/cover-1.jpg" alt="Product name" width="" height="" class=""/>
                                </div> 
                              </div>
                              <div class="col-sm-6">
                                <h4>“I Could Have Saved A Life That Day”</h4>
                                <a href="javascript:void(0);"><i class="fa fa-hand-o-right"></i> Select Options</a>
                              </div>
                            </div>
                          </div>
                         Product item //-->

                     </div>

                    <!--  Right menu  -->
                    
                   <?php $this->load->view('posters/posters_right_menu','frontend'); ?> 
                    
                 </div>

           </aside>

            <!-- rwo default --> 
          </div>
          

         </section>
    <!-- Content area // -->
