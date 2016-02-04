  <!-- // Header -->
        <header>
        <section class="container">
            <aside class="col-sm-4">
              <div class="row">
                <a href="index.html" class="logo device-center">
                  <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="images/logo.png" width="123" height="114" class="" alt="Got Safety">
                </a>
              </div>
            </aside>

            <aside class="col-sm-8 header-right">
              <div class="row">
                <h3>Got Safety? <i class="fa fa-phone"></i>(800) 734-3577 <a href="javascript:void(0);" class="pull-right client-login radius-5"><strong><i class="fa fa-lock"></i>Client Login</strong></a></h3>
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
                  <li class="active"><a href="index.html"><i class="fa fa-home"> </i> Home <span class="sr-only">(current)</span></a></li>
              <li><a href="<?php echo base_url("index.php/about");?>"><i class="fa fa-lightbulb-o"></i> About Us </a></li>
              <li><a href="<?php echo base_url("index.php/product");?>"> <i class="fa fa-shopping-cart"></i> Products </a></li>
              <li><a href="javascript:void(0);"> <i class="fa fa-video-camera"></i> Webinars </a></li>
              <li><a href="<?php echo base_url("index.php/contact");?>"> <i class="fa fa-envelope"></i> Contact </a></li>
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
