  <!-- // Header -->
        <header>
        <section class="container">
            <aside class="col-sm-4">
              <div class="row">
                <a href="<?php echo base_url();?>" class="logo device-center">
                  <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo get_img_dir();?>/logo.png" width="123" height="114" class="" alt="Got Safety">
                </a>
              </div>
            </aside>

            <aside class="col-sm-8 header-right">
              <div class="row">
				  
                <h3>Got Safety? <i class="fa fa-phone"></i>(800) 734-3577 
                <?php if($this->session->userdata('user_id') == "") { ?>
                <a href="<?php echo base_url('login/signup');?>" class="pull-right client-login radius-5"><strong><i class="fa fa-lock"></i>Client Login</strong></a>
                
                <?php } else { ?>
					<a href="<?php echo base_url('login/logout');?>" class="pull-right client-login radius-5"><strong><i class="fa fa-lock"></i>Logout</strong></a>
				 <?php } ?>
                </h3>
                 
              </div>
            </aside>

        </section>
      </header>
      <!-- Header // -->

   <!-- // Navigation -->
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="row">
            
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gs-nav-collapse" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand visible-xs" href="javascript:void(0);">Menu 
                  <i class="fa fa-hand-o-right"></i>
                </a>
              </div>


              <div class="collapse navbar-collapse" id="gs-nav-collapse">
                <ul class="nav navbar-nav">
					
						<li <?php  if($this->uri->segment(1) == '') { ?> class="active"; <?php }?> ><a href="<?php echo base_url("");?>"><i class="fa fa-home"> </i> Home <span class="sr-only">(current)</span></a></li>
					
					<?php if($this->session->userdata('user_id') == "") { ?>
						<li <?php  if($this->uri->segment(1) == 'about') { ?> class="active" <?php }?> ><a href="<?php echo base_url("about");?>"><i class="fa fa-lightbulb-o"></i> About Us </a></li>
				  <?php } ?>
				  <?php if($this->session->userdata('user_id') == "") { ?>
					  
					<?php /*	<li <?php  if($this->uri->segment(1) == 'product') { ?> class="active"; <?php }?>><a href="<?php echo base_url("index.php/product");?>"> <i class="fa fa-shopping-cart"></i> Products </a></li>*/ ?>
				   <?php } ?> 
				  <?php if($this->session->userdata('user_id') != "") { ?>
				  
					  <li <?php  if($this->uri->segment(1) == 'webinars') { ?> class="active"; <?php }?>><a href="<?php echo base_url("webinars");?>"> <i class="fa fa-video-camera"></i> Webinars </a></li>
					  
					  <li <?php  if($this->uri->segment(1) == 'lesson') { ?> class="active"; <?php }?>><a href="<?php echo base_url("lesson");?>">Lesson </a></li>
				  
				  <?php } ?>
				  <?php if($this->session->userdata('user_id') == "") { ?>
				   <li <?php  if($this->uri->segment(1) == 'contact') { ?> class="active"; <?php }?>><a href="<?php echo base_url("contact");?>"> <i class="fa fa-envelope"></i> Contact </a></li>
				  <?php } ?>
				  
                </ul>
                <form class="navbar-form navbar-right" data-form="search">
                  <div class="form-group">
                    <input type="text" class="form-control" value="Search..." onfocus="(this.value == 'Search...') && (this.value = '')" onblur="(this.value == '') && (this.value = 'Search...')" />
                  </div>
                  <button type="submit" class="btn-search" data-icon="search"><i class="fa fa-search"></i></button>
                </form>

              </div>
            
          </div>
        </div>
      </nav>
      <!--  Navigation // -->
