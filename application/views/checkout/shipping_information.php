

   <?php if(isset($this->session->userdata['shipping_info']['name']) && $this->session->userdata['shipping_info']['name']!=''){ ?>

      <div class="billing-details">
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 shipping" data-form="checkout">
            <!--SHIPPING METHOD-->
            <div class="panel panel-info">
              <div class="panel-heading">Shipping Address
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Name:</strong><?php echo $this->session->userdata['shipping_info']['name']; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Company Name:</strong><?php echo $this->session->userdata['shipping_info']['company_name']; ?></label>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Email:</strong><?php echo $this->session->userdata['shipping_info']['email']; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Phone:</strong><?php echo $this->session->userdata['shipping_info']['phone']; ?></label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Address:</strong><?php echo $this->session->userdata['shipping_info']['address']; ?></label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>City:</strong><?php echo $this->session->userdata['shipping_info']['city']; ?></label>
                  </div>
                </div> 
                
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>State:</strong><?php echo $this->session->userdata['shipping_info']['state']; ?></label>
                  </div>
                </div> 

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Country:</strong><?php echo $this->session->userdata['shipping_info']['country']; ?></label>
                  </div>
                </div> 
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Zip Code:</strong><?php echo $this->session->userdata['shipping_info']['zip_code']; ?></label>
                  </div>
                </div>
                <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <button class="btn btn-success btn-submit-fix btn-green edit_shipping_addr" type="submit">
                    Edit
                  </button>
                </div>
                
              </div> 

              </div>
            </div>
            <!--SHIPPING METHOD END-->
          </div>
                <input type="hidden" name="success" value="shipping_success">

        </div>

   <?php } else { ?> 

    <!-- Right Bar -->
      <form action="#" name="shipping_information" id="shipping_information" method="post" class="form-horizontal">
      <input type="hidden" name="success" value="shipping_success">
        <div class="billing-details">
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 billing" data-form="checkout">
            <!--SHIPPING METHOD-->
            <div class="panel panel-info">
              <div class="panel-heading">Shipping Address
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" placeholder="Name" class="form-control input-lg" id="name" name="sa_name">
                  </div>
                </div>
                <span class="vstar err_sa_name"></span>
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" placeholder="Company Name" class="form-control input-lg" id="company_name" name="sa_company_name">
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text"  placeholder="E - Mail" class="form-control input-lg" id="email" name="sa_email">
                  </div>
                </div>
                <span class="vstar err_sa_email"></span>
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" placeholder="Phone Number" class="form-control input-lg" id="phone" name="sa_phone">
                  </div>
                </div>
                <span class="vstar err_sa_phone"></span>
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" placeholder="Address" class="form-control input-lg" id="address" name="sa_address">
                  </div>
                </div>
                 <span class="vstar err_sa_add"></span>
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" placeholder="City" class="form-control input-lg" id="city" name="sa_city">
                  </div>
                </div>
                <span class="vstar err_sa_city"></span> 
                <div class="form-group">
                  <div class="col-md-12">
                    <select class="form-control input-lg sa_state" name="sa_state" id="state">
                      <option value="">Select State
                      </option>
                      <?php foreach($states as $key=>$value): ?>
                      <option value="<?php echo $value['state_code']; ?>">
                        <?php echo $value['state_name']; ?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <span class="vstar err_sa_state"></span> 
                <div class="form-group">
                  <div class="col-md-12">
                    <select class="form-control input-lg sa_country" name="sa_country" id="country">
                      <option value="">Select Country
                      </option>
                      <?php foreach($countries as $key=>$value): ?>
                      <option value="<?php echo $value['code']; ?>">
                        <?php echo $value['name']; ?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <span class="vstar err_sa_country"></span>  
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" placeholder="Zip Code" class="form-control input-lg" id="zip_code" name="sa_zip_code">
                  </div>
                </div>
                <span class="vstar err_sa_zip"></span>

              </div>
            </div>
            <!--SHIPPING METHOD END-->
          </div>
        </div>
      </form>
      <?php } ?>
          
      
