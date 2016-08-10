<body>
  <!-- // Content area -->
  <section class="container content-area" data-view="create-account">
    <!-- rwo default --> 
    <div class="row" data-row="default">
      <aside class="col-sm-12 bg-white inner-full">
        <?php if(isset($_SESSION['signup_succ'])) {?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          <?php echo $_SESSION['signup_succ'];unset($_SESSION['signup_succ']);?>
        </div>
        <?php }?>
        <?php if(isset($_SESSION['signup_fail'])) {?>
        <div class="alert alert-danger alert-dismissable">
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
               
                <div class="">
                  <div id="div-register-msg">
                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right">
                    </div>
                   <span class="form-title" id="text-login-msg">Create an Account</span>
                    </span>
                  </div>

                  <div class="row">
                   <div class="col-sm-12">
                    <div class="form-group">
                      <input type="text" name="company_name" id="company_name" class="form-control input-lg" value="<?php echo set_value('company_name',$form_data['company_name']); ?>" placeholder="Name of Company" >
                      <span class="vstar" 
                            <?php echo form_error('company_name', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                 </div>
                 </div>

                 <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <textarea name="company_address" id="company_address" class="form-control input-lg" placeholder="Address"><?php echo set_value('company_address',$form_data['company_address']); ?></textarea>
                      <span class="vstar" 
                            <?php echo form_error('company_address', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
                </div>

                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group">
                      <input type="text" name="city" id="city" class="form-control input-lg" placeholder="City" value="<?php echo set_value('city',$form_data['city']); ?>">
                      <span class="vstar" <?php echo form_error('city', '<span class="help-block">', '</span>'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <input type="text" name="state" id="state" class="form-control input-lg" placeholder="State" value="<?php echo set_value('state',$form_data['state']); ?>">
                      <span class="vstar" <?php echo form_error('state', '<span class="help-block">', '</span>'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <input type="text" name="zip_code" id="zip_code" class="form-control input-lg" placeholder="Zip Code" value="<?php echo set_value('zip_code',$form_data['zip_code']); ?>">
                      <span class="vstar" <?php echo form_error('zip_code', '<span class="help-block">', '</span>'); ?></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                 <div class="col-sm-5">
                  <div class="form-group">
                    <input type="text" name="phone_no" id="phone_no" class="form-control input-lg" value="<?php echo set_value('phone_no',$form_data['phone_no']); ?>" placeholder="Phone Number" >
                    <p class="eg_content">(e.g.1234566789)</p>
                    <span class="vstar" 
                          <?php echo form_error('phone_no', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                  </div>
                 </div>
                 <div class="col-sm-7">
                  <div class="form-group">
                    <input type="text" name="company_url" id="company_url" class="form-control input-lg" value="<?php echo set_value('company_url',$form_data['company_url']); ?>" placeholder="Company Web Address" >
                    <span class="vstar" 
                          <?php echo form_error('company_url', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                  </div>
                 </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="main_contact" id="main_contact" class="form-control input-lg" value="<?php echo set_value('main_contact',$form_data['main_contact']); ?>" placeholder="Main Contact" >
                      <span class="vstar" 
                            <?php echo form_error('main_contact', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="email" id="email" class="form-control input-lg" value="<?php echo set_value('email',$form_data['email']); ?>" placeholder="Main Contact Email" >
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
                    <input type="text" name="main_contact_no" id="main_contact_no" class="form-control input-lg" value="<?php echo set_value('main_contact_no',$form_data['main_contact_no']); ?>" placeholder="Main Contact Phone #" >
                    <p class="eg_content">(e.g.1234566789)</p>
                    <span class="vstar" 
                          <?php echo form_error('main_contact_no', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                  </div>
                 </div>
                </div>

                <div class="row">
                 <div class="col-sm-12">
                    <div class="form-group">
                      <textarea name="main_contact_address" id="main_contact_address" class="form-control input-lg" placeholder="Main Contact Address if different than company's" ><?php echo set_value('main_contact_address',$form_data['main_contact_address']); ?></textarea>
                      <span class="vstar" 
                            <?php echo form_error('main_contact_address', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
                </div>

                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group">
                      <input type="text" name="city1" id="city1" class="form-control input-lg" placeholder="City" value="<?php echo set_value('city',$form_data['city1']); ?>">
                      <span class="vstar" <?php echo form_error('city1', '<span class="help-block">', '</span>'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <input type="text" name="state1" id="state1" class="form-control input-lg" placeholder="State" value="<?php echo set_value('state',$form_data['state1']); ?>">
                      <span class="vstar" <?php echo form_error('state1', '<span class="help-block">', '</span>'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <input type="text" name="zip_code1" id="zip_code1" class="form-control input-lg" placeholder="Zip Code" value="<?php echo set_value('zip_code',$form_data['zip_code1']); ?>">
                      <span class="vstar" <?php echo form_error('zip_code1', '<span class="help-block">', '</span>'); ?></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                 <div class="col-sm-5">
                    <div class="form-group">
                      <input type="text" name="no_of_employees" id="no_of_employees" value="<?php echo set_value('no_of_employees',$form_data['no_of_employees']); ?>" class="form-control input-lg" placeholder="No of Employees">
                      <span class="vstar" 
                            <?php echo form_error('no_of_employees', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                      <input type="text" name="promo_code" id="promo_code" value="<?php echo set_value('promo_code',$form_data['promo_code']); ?>" class="form-control input-lg" placeholder="Promo Code">
                      <span class="vstar" 
                            <?php echo form_error('promo_code', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                  </div>
                </div>
                </div>



                  <div class="row">
                   <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="admin_name" id="admin_name" class="form-control input-lg" value="<?php echo set_value('admin_name',$form_data['admin_name']); ?>" placeholder="Client Admin Username" >
                      <span class="vstar" 
                            <?php echo form_error('admin_name', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                    </div>
                   </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                    <input type="password" name="admin_pwd" id="admin_pwd" class="form-control input-lg" value="<?php echo set_value('admin_pwd',$form_data['admin_pwd']); ?>" placeholder="Client Admin Password" >
                    <span class="vstar" 
                          <?php echo form_error('admin_pwd', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                  </div>
                 </div>
                </div>

                  <!--<div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                      <input type="password" name="admin_con_pwd" id="admin_con_pwd" class="form-control input-lg" value="<?php echo set_value('admin_con_pwd',$form_data['admin_con_pwd']); ?>" placeholder="Client Admin Confirm Password" >
                      <span class="vstar" 
                            <?php echo form_error('admin_con_pwd', '
                      <span class="help-block">', '
                      </span>'); ?>
                      </span>
                    </div>
                   </div>
                  
                </div>-->
                
                
             

              <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control input-lg" value="<?php echo set_value('name',$form_data['name']); ?>" placeholder="Client/App Username" >
                    <span class="vstar" 
                          <?php echo form_error('name', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" value="<?php echo set_value('password',$form_data['password']); ?>" placeholder="Client/App Password">
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
