


  <body>

   

    <!-- // Content area -->
         <section class="container content-area" data-view="create-account">
          
          <!-- rwo default --> 
          <div class="row" data-row="default">


               <aside class="col-sm-12 bg-white inner-full">
                 <div class="inner-content form-wrap">
                      
                    
                        
                        <div class="" data-form="register">
                                        <!-- Begin # DIV Form -->
                        <div id="div-forms">
                            
                           <!-- Begin | Register Form -->
                            <form id="register-form" method="post" >
                              <div class="switch">
                                 <a href="<?php echo base_url('index.php/login'); ?>" title="Login" id="register_login_btn">login</a>
                                 or
                                 <a href="<?php echo base_url('index.php/login/signup'); ?>"  id="login_register_btn" title="Register" class="active">Register</a>
                             </div>
                                <div class="">
                                    <div id="div-register-msg">
                                        <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                        <span class="form-title" id="text-register-msg">Create An  Account</span>
                                    </div>
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control input-lg" value="<?php echo set_value('name',$form_data['name']); ?>" placeholder="Name" onfocus="(this.value == 'Name') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Name')">
                                            <span class="vstar" <?php echo form_error('name', '<span class="help-block">', '</span>'); ?></span>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="text" name="email" id="email" class="form-control input-lg" value="<?php echo set_value('email',$form_data['email']); ?>" placeholder="Email" onfocus="(this.value == 'Email') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Email')">
                                            <span class="vstar" <?php echo form_error('email', '<span class="help-block">', '</span>'); ?></span>
                                          </div>
                                        </div>
                                      </div>
        
                                     
                                      <div class="row">
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control input-lg" value="<?php echo set_value('password',$form_data['password']); ?>" placeholder="Password" onfocus="(this.value == 'Password') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Password')">
                                            <span class="vstar" <?php echo form_error('password', '<span class="help-block">', '</span>'); ?></span>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input type="password" name="con_password" id="con_password" class="form-control input-lg" value="<?php echo set_value('con_password',$form_data['con_password']); ?>" placeholder="Conform Password" onfocus="(this.value == 'Conform password') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Conform password')">
                                            <span class="vstar" <?php echo form_error('con_password', '<span class="help-block">', '</span>'); ?></span>
                                          </div>
                                        </div>
                                      </div>
                                    
                                      
                                </div>
                                <div class="">
                                    <div>
                                        <input type="submit" value="REGISTER" class="btn btn-danger btn-block client-login">
                                    </div>
                                </div>
                            </form>
                            <!-- End | Register Form -->
                            
                            <!-- Begin | Lost Password Form -->
                            <form id="lost-form" style="display:none;">
                            	<div class="switch">
                                 <a href="#" title="Login" id="lost_login_btn">login</a>
                                 or
                                 <a href="#"  id="lost_register_btn" title="Register" class="active">Register</a>
                             </div>
                                <div class="">
                                    <div id="div-lost-msg">
                                        <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                                        <span class="form-title" id="text-lost-msg">Forgot Password</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                          <div class="form-group">
                                            <input type="text" name="gs-company" id="gs-company" class="form-control input-lg"  value="Email id" onfocus="(this.value == 'Company') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Company')">
                                          </div>
                                        </div>
                                      </div>
                                    
                                </div>
                                <div class="">
                                    <div>
                                        <input type="submit" value="SEND" class="btn btn-danger btn-block client-login">
                                    </div>
                                   <!-- <div>
                                        <button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
                                        <button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
                                    </div> -->
                                </div>
                            </form>
                            <!-- End | Lost Password Form -->
                            
                           
                        </div>
                        <!-- End # DIV Form -->
                        </div>
                     
                  </div>
          </aside>

            <!-- rwo default --> 
          </div>
          

         </section>
    <!-- Content area // -->


  
  </body>

