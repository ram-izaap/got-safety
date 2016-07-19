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
                        <input type="text" name="name" id="name" class="form-control input-lg" value="<?php echo set_value('name',$form_data['name']); ?>" placeholder="Username" onfocus="(this.value == 'Username') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Username')">
                        <span class="vstar" 
                              <?php echo form_error('name', '
                        <span class="help-block">', '
                        </span>'); ?>
                        </span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="email" id="email" class="form-control input-lg" value="<?php echo set_value('email',$form_data['email']); ?>" placeholder="Email" onfocus="(this.value == 'Email') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Email')">
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
                    <input type="password" name="password" id="password" class="form-control input-lg" value="<?php echo set_value('password',$form_data['password']); ?>" placeholder="Password" onfocus="(this.value == 'Password') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Password')">
                    <span class="vstar" 
                          <?php echo form_error('password', '
                    <span class="help-block">', '
                    </span>'); ?>
                    </span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="password" name="con_password" id="con_password" class="form-control input-lg" value="<?php echo set_value('con_password',$form_data['con_password']); ?>" placeholder="Conform Password" onfocus="(this.value == 'Conform password') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Conform password')">
                  <span class="vstar" 
                        <?php echo form_error('con_password', '
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
