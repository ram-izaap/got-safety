 <!-- // Content area -->
         <section class="container content-area" data-view="list">
          
          <!-- rwo default --> 
          <div class="row" data-row="default">


               <aside class="col-sm-12 bg-white inner-full">
                 <div class="inner-content">
                     
                     <!-- Left Bar -->
                     <div class="col-md-3 left-bar">

                        <div class="list-categories bg-red row">
                            <h3>Menu Categories</h3>
                          <ul>
                            <li class="active"><a href="javascript:void(0);">Safety Lessons </a></li>
                            <li><a href="javascript:void(0);">Inspection Reports </a></li>
                            <li><a href="javascript:void(0);">Cal / OSHA Documentation </a></li>
                            <li><a href="javascript:void(0);">300 Logs </a></li>
                            <li><a href="javascript:void(0);">Training Records </a></li>
                            <li><a href="javascript:void(0);">Accident Reporting </a></li>
                            <li><a href="javascript:void(0);">Safety Forms </a></li>
                            <li><a href="javascript:void(0);">Safety Posters </a></li>
                          </ul>
                        </div>

                     </div>

                     <!-- -->
                     <div class="col-sm-6 content-bar" id="content-load">
                        <h3>Safety Lessons</h3>
                        <hr />

                        <?php  echo $lesson_content[0]['content'];?>
                       
                       <?php $this->load->view("contact/enquiry");?>
                        
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
                    
                   <?php $this->load->view('lesson/lesson_right_menu','frontend'); ?> 
                     
                     
                     
                     
                 </div>





           </aside>

            <!-- rwo default --> 
          </div>
          

         </section>
    <!-- Content area // -->
