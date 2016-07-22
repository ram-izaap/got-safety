<body>
  <!-- // Content area -->
  <section class="container content-area" data-view="create-account">
    <!-- rwo default --> 
    <div class="row" data-row="default">
      <aside class="col-sm-12 bg-white inner-full">
        <?php if(isset($_SESSION['signup_succ'])) {?>
        <div class="alert alert-success alert-dismissable col-md-6 col-md-offset-3">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          <?php echo $_SESSION['signup_succ'];unset($_SESSION['signup_succ']);?>
        </div>
        <?php }?>
        <?php if(isset($_SESSION['signup_fail'])) {?>
        <div class="alert alert-danger alert-dismissable col-md-6 col-md-offset-3">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          <?php echo $_SESSION['signup_fail'];unset($_SESSION['signup_fail'])?>
        </div>
        <?php }?>
        <div class="inner-content form-wrap">
          <div class="" data-form="register">
            <!-- Begin # DIV Form -->
            <div id="div-forms">
              <!-- Begin | Register Form -->
              <form id="register-form" method="post" >
                <div class="switch">
                  <a href="<?php echo base_url('login'); ?>" title="Login" id="register_login_btn">login
                  </a>
                  or
                  <a href="<?php echo base_url('login/signup'); ?>"  id="login_register_btn" title="Register" class="active">Register
                  </a>
                </div>
                <div class="">
                  <div id="div-register-msg">
                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right">
                    </div>
                    <span class="form-title" id="text-register-msg">Create An  Account
                    </span>
                  </div>

                  <div class="row">
                   <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="admin_name" id="admin_name" class="form-control input-lg" value="<?php echo set_value('admin_name',$form_data['admin_name']); ?>" placeholder="Client Admin Username" onfocus="(this.value == 'Client Admin Username') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Client Admin Username')">
                      <span class="vstar" 
                            <?php echo form_error('admin_name', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                    </div>
                   </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                    <input type="password" name="admin_pwd" id="admin_pwd" class="form-control input-lg" value="" placeholder="Client Admin Password" onfocus="(this.value == 'Client Admin Password') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Client Admin Password')">
                    <span class="vstar" 
                          <?php echo form_error('admin_pwd', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                  </div>
                 </div>
                </div>

                  <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                      <input type="password" name="admin_con_pwd" id="admin_con_pwd" class="form-control input-lg" value="" placeholder="Client Admin Confirm Password" onfocus="(this.value == 'Client Admin Confirm Password') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Client Admin Confirm Password')">
                      <span class="vstar" 
                            <?php echo form_error('admin_con_pwd', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                    </div>
                   </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="email" id="email" class="form-control input-lg" value="<?php echo set_value('email',$form_data['email']); ?>" placeholder="Client Admin Email" onfocus="(this.value == 'Client Admin Email') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Client Admin Email')">
                      <span class="vstar" 
                            <?php echo form_error('email', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
                </div>
                


                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="company_name" id="company_name" class="form-control input-lg" value="<?php echo set_value('company_name',$form_data['company_name']); ?>" placeholder="Company Name" onfocus="(this.value == 'Company Name') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Company Name')">
                      <span class="vstar" 
                            <?php echo form_error('company_name', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" name="phone_no" id="phone_no" class="form-control input-lg" value="<?php echo set_value('phone_no',$form_data['phone_no']); ?>" placeholder="Company Phone Number" onfocus="(this.value == 'Company Phone Number') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Company Phone Number')">
                    <span class="vstar" 
                          <?php echo form_error('phone_no', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                  </div>
                </div>
                
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <textarea name="company_address" id="company_address" class="form-control input-lg" placeholder="Company Address" onfocus="(this.value == 'Company Address') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Company Address')"><?php echo set_value('company_address',$form_data['company_address']); ?></textarea>
                      <span class="vstar" 
                            <?php echo form_error('company_address', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
                </div>

                <div class="row">
                
                

                  <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" name="company_url" id="company_url" class="form-control input-lg" value="<?php echo set_value('company_url',$form_data['company_url']); ?>" placeholder="Company URL" onfocus="(this.value == 'Company URL') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Company URL')">
                    <span class="vstar" 
                          <?php echo form_error('company_url', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                  </div>
                 </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="main_contact" id="main_contact" class="form-control input-lg" value="<?php echo set_value('main_contact',$form_data['main_contact']); ?>" placeholder="Main Contact" onfocus="(this.value == 'Main Contact') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Main Contact')">
                      <span class="vstar" 
                            <?php echo form_error('main_contact', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" name="main_contact_no" id="main_contact_no" class="form-control input-lg" value="<?php echo set_value('main_contact_no',$form_data['main_contact_no']); ?>" placeholder="Contact Number" onfocus="(this.value == 'Contact Number') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Contact Number')">
                    <span class="vstar" 
                          <?php echo form_error('main_contact_no', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                  </div>
                 </div>
                 <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="email_addr" id="email_addr" class="form-control input-lg" value="<?php echo set_value('email_addr',$form_data['email_addr']); ?>" placeholder="Email Address" onfocus="(this.value == 'Email Address') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Email Address')">
                      <span class="vstar" 
                            <?php echo form_error('email_addr', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
              </div>

              <div class="row">
                
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="no_of_employees" id="no_of_employees" value="<?php echo set_value('no_of_employees',$form_data['no_of_employees']); ?>" class="form-control input-lg" placeholder="No of Employees" onfocus="(this.value == 'No of Employees') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'No of Employees')">
                      <span class="vstar" 
                            <?php echo form_error('no_of_employees', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <textarea name="main_contact_address" id="main_contact_address" class="form-control input-lg" placeholder="Main Contact Address if different then company's" onfocus="(this.value == 'Main Contact Address if different then company's') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Main Contact Address if different then company's')"><?php echo set_value('main_contact_address',$form_data['main_contact_address']); ?></textarea>
                      <span class="vstar" 
                            <?php echo form_error('main_contact_address', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
                
                </div>

              <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control input-lg" value="<?php echo set_value('name',$form_data['name']); ?>" placeholder="Client/App Username" onfocus="(this.value == 'Client/App Username') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Client/App Username')">
                    <span class="vstar" 
                          <?php echo form_error('name', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" value="<?php echo set_value('password',$form_data['password']); ?>" placeholder="Client/App Password" onfocus="(this.value == 'Client/App Password') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Client/App Password')">
                    <span class="vstar" 
                          <?php echo form_error('password', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                  </div>
                 </div>
                  
                </div>     
             </div>
        <!-- Stativ verse -->
        <h3>Choose Plan
        </h3>
        <hr />
        <div class="plan-wrapper">
          <!-- // plan section -->
        <?php foreach ($plan_data as $key=>$value): ?>
          <input type="radio" name="plan_type" id="plan_type<?php echo $key; ?>" value="<?php echo $value['id']; ?>" <?php echo set_radio('plan_type', $value['id'])?>>
          <label for="plan_type<?php echo $key; ?>">
            <span class="title"><?php echo ucwords($value['plan_type']); ?>
            </span>
            <span class="price"><?php echo "$".$value['plan_amount']; ?>
            </span>
            <span class="description"><?php echo $value['plan_desc']; ?>
            </span>
            <span class="description">Employee Limit:&nbsp;<?php echo $value['emp_limit']; ?>
            </span>
          </label>
          <?php endforeach; ?>
          <!-- plan section // -->
          <span class="vstar" <?php echo form_error('plan_type', '<span class="help-block">', '</span>'); ?></span>
        </div>
        <!-- Stativ verse -->
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
        <a href="#" title="Login" id="lost_login_btn">login
        </a>
        or
        <a href="#"  id="lost_register_btn" title="Register" class="active">Register
        </a>
      </div>
      <div class="">
        <div id="div-lost-msg">
          <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right">
          </div>
          <span class="form-title" id="text-lost-msg">Forgot Password
          </span>
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
