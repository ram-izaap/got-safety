

   <?php if(isset($this->session->userdata['billing_info']['name']) && $this->session->userdata['billing_info']['name']!=''){ ?>

      <div class="billing-details" id="billing_list">
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 billing" data-form="checkout">
            <!--SHIPPING METHOD-->
            <div class="panel panel-info">
              <div class="panel-heading">Billing Address
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Name:</strong><span class="name"><?php echo $this->session->userdata['billing_info']['name']; ?></span></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Company Name:</strong><span class="company"><?php echo $this->session->userdata['billing_info']['company_name']; ?></span></label>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Email:</strong><span class="email"><?php echo $this->session->userdata['billing_info']['email']; ?></span></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Phone:</strong><span class="phone"><?php echo $this->session->userdata['billing_info']['phone']; ?></span></label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Address:</strong><span class="address"><?php echo $this->session->userdata['billing_info']['address']; ?></span></label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>City:</strong><span class="city"><?php echo $this->session->userdata['billing_info']['city']; ?></span></label>
                  </div>
                </div> 
                
                

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Country:</strong><span class="country"><?php echo $this->session->userdata['billing_info']['country']; ?></span></label>
                  </div>
                </div> 

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>State:</strong><span class="state"><?php echo $this->session->userdata['billing_info']['state']; ?></span></label>
                  </div>
                </div> 

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Zip Code:</strong><span class="zip_code"><?php echo $this->session->userdata['billing_info']['zip_code']; ?></span></label>
                  </div>
                </div> 

              </div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <button class="btn btn-success btn-submit-fix btn-green edit_billing_addr" type="submit">
                    Edit
                  </button>
                </div>
              </div>
            </div>
            <input type="hidden" name="success1" value="billing_success">
            <!--SHIPPING METHOD END-->
          </div>
        </div>

   <?php } else { ?> 

    <!-- Right Bar -->
      <form action="#" name="billing_information" id="billing_information" method="post" class="form-horizontal">
        <input type="hidden" name="success1">
        <div class="billing-details">
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 billing" data-form="checkout">
            <!--SHIPPING METHOD-->
            <div class="panel panel-info">
              <div class="panel-heading">Billing Address
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" placeholder="Name" class="form-control input-lg" id="name" name="name">
                  </div>
                  <span class="vstar err_name"></span>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" placeholder="Company Name" class="form-control input-lg" id="company_name" name="company_name">
                  </div>
                  <span class="vstar"></span>
                </div>
                
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" <?php echo (isset($this->session->userdata['email1']) && $this->session->userdata['email1']!='')?("readonly=readonly"):'';?> placeholder="E - Mail" class="form-control input-lg" id="email" name="email">
                  </div>
                  <span class="vstar err_email"></span>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text"  placeholder="Phone Number" class="form-control input-lg" id="phone" name="phone">
                  </div>
                  <span class="vstar err_phone"></span>
                </div>
                
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text"  placeholder="Address" class="form-control input-lg" id="address" name="address">
                  </div>
                  <span class="vstar err_add"></span>
                </div>
                 
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text"  placeholder="City" class="form-control input-lg" id="city" name="city">
                  </div>
                  <span class="vstar err_city"></span>
                </div>
                
                <div class="form-group">
                  <div class="col-md-12">
                    <select class="form-control input-lg country" name="country" id="country">
                      <option value="">Select Country
                      </option>
                      <?php foreach($countries as $key=>$value): ?>
                      <option value="<?php echo $value['code']; ?>">
                        <?php echo $value['name']; ?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <span class="vstar err_country"></span> 
                </div>

                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text"  placeholder="State" class="form-control input-lg" id="state" name="state">
                  </div>
                  <span class="vstar err_state"></span> 
                </div>
                 
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text"  placeholder="Zip Code" class="form-control input-lg" id="zip_code" name="zip_code">
                  </div>
                  <span class="vstar err_zip"></span>
                </div>
                                           
              </div>
            </div>
            <!--SHIPPING METHOD END-->
          </div>
        </div>
      </form>
      <?php } ?>
          
      
