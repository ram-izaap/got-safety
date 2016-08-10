

    <!-- // Static banner // -->
    <!--<section class="static-banner">
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo get_img_dir();?>/home-banner-min.jpg" alt="Safety" class="img-responsive" />
      <div data-text="static">
        <div>
          <h3>Simplest way to keep track of your documentation and safety lessons online and on your phone!</h3>
          <a href="<?php echo site_url("login/signup"); ?>"><i class="fa fa-hand-o-right"></i> Click Here to Join Now <i class="fa fa-hand-o-left"></i></a>
        </div>
      </div>
    </section>-->

    <div id="banner_full " class="main-slider">
      <div id="slider"> 
        <a href="#"><img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo get_img_dir();?>/banner1.png" alt="" class="" /></a> <a href="#"> <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo get_img_dir();?>/banner2.jpg" alt="" class="" /></a> 
        <a href="#"> <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo get_img_dir();?>/banner3.png" alt="" class="" /></a> 
        <a href="#"><img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo get_img_dir();?>/banner4.png" alt="" class="" /></a> 
        <a href="#" ><img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo get_img_dir();?>/banner5.png" alt="" class="" /></a> </div>
    </div>

    <!-- // Content area -->
        <section class="container content-area" data-view="home">

        
  <!-- rwo default -->
  <div class="row" data-row="default">
    <aside class="col-sm-6 home-left"> 
      <!-- // Plans -->
      <div class="plans">
        <div class="bg-white" data-plan="gs-monthly">
          <h4>BASIC SAFETY PLAN
          </h4>
          <strong class="sub-title">
            <p>Includes:
            </p>
          </strong>
          <ul class="list-area">         
            <li> - Access To Personalized Online Client Center
            </li>
            <li> - Complete Set of Customized OSHA
              Compliant Documentation
            </li>
            <li>- Live Documentation Interview over the phone
            </li>
            <li>- Free Updates to your Documentation
              (As long a you’re on a service plan)
            </li>
            <li>- Over 500 Lesson Topics
            </li>
            <li>- Online Access to Safety Training Records:
            </li>
            <li>- Access to GotSafety Mobile Safety App:
            </li>
            <li>- Searchable by: Employee Name, ID Number, Lesson Topic or Date
            </li>
            <li>- Documentation on the Go
            </li>
            <li>- Mobile Tailgate Lessons & Signoff Sheets
            </li>
            <li>- Access to our Cloud Service called The Repository Tree
            </li>
          </ul>
          <a href="javascript:void(0);"> 
            <strong>$79.99
            </strong> month
          </a> 
        </div>
        <div class="bg-white" data-plan="gs-yearly">
          <h4>CUSTOMIZED OSHA DOCUMENTATION
          </h4>
          <strong class="sub-title">
            <p>A One Time fee of $1,250 will get you:
            </p>
          </strong>
          <ul class="list-area">         
            <li>- Complete Set of Customized OSHA Compliant Documentation
            </li>
            <li>- Live Documentation Interview over the phone
            </li>
            <li>- Free Updates to your Documentation
              (As long a you’re on a service plan)
            </li>
          </ul>
          <!--<a href="javascript:void(0);"> 
            <strong>$350
            </strong> Only
          </a>--> 
        </div>
      </div>
      <!-- // button section -->
       <?php if($this->session->userdata('user_id') == ""): ?>
      <div class="start-button"> 
        <a href="<?php echo site_url("login/signup"); ?>" class=" radius-5">
          <strong>Click Here to 
            <br>
            Start Today!
          </strong>
        </a> 
      </div>
      <?php endif; ?>
      <!--  button section // --> 
    </aside>
    <aside class="col-sm-6 home-right">
      <div class="welcome-content">
        <h1>Welcome to Gotsafety.com
        </h1>
        <p>Here you will have access to over 500 Safety Lessons and Documentation specific to your state in a mobile training app which will store or archive all employee signatures into their company client center.
        </p>
        <p>OSHA requires that every company in the state provide their employees with regular safety lessons. As an ongoing support services client, you will eceive these mandatory lesson materials and expert support to maintain your safety training program. We will provide you with all lesson materials in both English and Spanish.
        </p>
        <p>You will be able to download your lessons and documentation online in PDF format and access your lessons from your phone!
        </p>
      </div>
      <div class="video_modal">
         <a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg">
            <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo get_img_dir();?>/video-cover.jpg" class="img-responsive" alt="" />
          <p class="sales_video">SALES VIDEO HERE</p>
          </a>

        <!-- // modal box content -->
          <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="container">
                    <H2>10 Extreme Safety Fails <button class="btn btn-default pull-right close" data-dismiss="modal"><i class="fa fa-close"></i></button></H2>
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe width="560" height="315" src="//www.youtube.com/embed/3pGQk9VSfVs" allowfullscreen></iframe>
                    </div>
                    
                  </div>                           
                </div>
              </div>
            </div>
          </div>
        <!-- modal box content // --> 
      </div>
    </aside>
    <!-- rwo default --> 
  </div>
</section>

    <!-- Content area // -->


   

 

   
