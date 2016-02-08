 <!-- // Content area -->
         <section class="container content-area" data-page="contact">
          
          <!-- rwo default --> 
          <div class="row" data-row="default">


               <aside class="col-sm-12 bg-white inner-full">
                 <div class="inner-content">
                     <h1>Contact Us</h1>
                     <hr />

                     <div id="map-row">
                      <div class="col-xs-12">
                      
                          <!-- PASTE GOOGLE MAP IFRAME HERE. ENSURE HEIGHT MATCHES IN CSS .map-overlay CLASS. -->
                        <!-- <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.uk/maps?f=q&source=s_q&hl=en&geocode=&q=15+Springfield+Way,+Hythe,+CT21+5SH&aq=t&sll=52.8382,-2.327815&sspn=8.047465,13.666992&ie=UTF8&hq=&hnear=15+Springfield+Way,+Hythe+CT21+5SH,+United+Kingdom&t=m&z=14&ll=51.077429,1.121722&output=embed"></iframe> -->
                        <?php /*  <iframe src="http://mapbuildr.com/frame/8i8sek" frameborder="0" height="400" width="100%"></iframe>
                          <!-- /IFRAME --> */ ?>
                          
                         <iframe src="http://www.yourmapmaker.com/preview.php?a=<?php echo strip_tags($info[0]['content']);?>,Canada&w=100%&h=400&n=Got Safety&z=14&t=Map" height="400" width="100%"  frameborder="0"></iframe>
                          
                            <div id="map-overlay" class="col-xs-5 col-xs-offset-6" style="">
                              <h2>Contact us</h2>
                              <address style="color:#fff;">
                                <?php echo $info[0]['content'];?>
                              </address>
                            </div>
                      </div>
                    </div>

                 </div>





           </aside>

            <!-- rwo default --> 
          </div>
          

         </section>
    <!-- Content area // -->
