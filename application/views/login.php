


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
                            
                            <!-- Begin # Login Form -->
                            <form id="login-form" method="POST">
                            <div class="switch">
                             <a class="active">login</a> or 
                             <a href="<?php echo base_url('login/signup');?>">REGISTER</a>
                            </div> 
                            
                            <div class="">
                                    <div id="div-login-msg">
                                        <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                        <span class="form-title" id="text-login-msg">Login</span> or

                                    </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control input-lg" placeholder="Username" value="<?php echo set_value('name',$form_data['name']); ?>" onfocus="(this.value == 'Username') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Username')">
                                            <span class="vstar" <?php echo form_error('name', '<span class="help-block">', '</span>'); ?></span>
                                            
                                            
							</div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="form-group">
                                            <input type="password" name="password" id="password" value ="<?php echo set_value('password',$form_data['password']); ?>" class="form-control input-lg"  placeholder="Password" onfocus="(this.value == 'Password') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Password')">
                                            <span class="vstar" <?php echo form_error('password', '<span class="help-block">', '</span>'); ?></span>
                                          </div>
                                        </div>
                                      </div>
                                      
                                </div>
                                <div class="">
                                    <div>
                                        <input type="submit" value="LOGIN" class="btn btn-danger btn-block client-login">
                                    </div>
                                    <div class="forgot_pwd">
                                        
                                    </div>
                                </div>
                            </form>
                            <!-- End # Login Form -->
                            
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

