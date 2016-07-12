

   <?php if(isset($this->session->userdata['billing_info']['name']) && $this->session->userdata['billing_info']['name']!=''){ ?>

      <div class="billing-details" id="billinig_list">
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 billing" data-form="checkout">
            <!--SHIPPING METHOD-->
            <div class="panel panel-info">
              <div class="panel-heading">Billing Address
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Name:</strong><?php echo $this->session->userdata['billing_info']['name']; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Company Name:</strong><?php echo $this->session->userdata['billing_info']['company_name']; ?></label>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Email:</strong><?php echo $this->session->userdata['billing_info']['email']; ?></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Phone:</strong><?php echo $this->session->userdata['billing_info']['phone']; ?></label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Address:</strong><?php echo $this->session->userdata['billing_info']['address']; ?></label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>City:</strong><?php echo $this->session->userdata['billing_info']['city']; ?></label>
                  </div>
                </div> 
                
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>State:</strong><?php echo $this->session->userdata['billing_info']['state']; ?></label>
                  </div>
                </div> 

                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Country:</strong><?php echo $this->session->userdata['billing_info']['country']; ?></label>
                  </div>
                </div> 
                <div class="form-group">
                  <div class="col-xs-12">
                  <label><strong>Zip Code:</strong><?php echo $this->session->userdata['billing_info']['zip_code']; ?></label>
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
        <input type="hidden" name="success1" value="billing_success">
        <div class="billing-details">
          
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 billing" data-form="checkout">
            <!--SHIPPING METHOD-->
            <div class="panel panel-info">
              <div class="panel-heading">Billing Address
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" onblur="(this.value == '') &amp;&amp; (this.value = 'Name')" onfocus="(this.value == 'Name') &amp;&amp; (this.value = '')" placeholder="Name" class="form-control input-lg" id="name" name="name">
                  </div>
                </div>
                <span class="vstar err_name"></span>
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" onblur="(this.value == '') &amp;&amp; (this.value = 'Company Name')" onfocus="(this.value == 'Company Name') &amp;&amp; (this.value = '')" placeholder="Company Name" class="form-control input-lg" id="company_name" name="company_name">
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" onblur="(this.value == '') &amp;&amp; (this.value = 'E - Mail')" onfocus="(this.value == 'E - Mail') &amp;&amp; (this.value = '')" placeholder="E - Mail" class="form-control input-lg" id="email" name="email">
                  </div>
                </div>
                <span class="vstar err_email"></span>
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" onblur="(this.value == '') &amp;&amp; (this.value = 'Phone Number')" onfocus="(this.value == 'Phone Number') &amp;&amp; (this.value = '')" placeholder="Phone Number" class="form-control input-lg" id="phone" name="phone">
                  </div>
                </div>
                <span class="vstar err_phone"></span>
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" onblur="(this.value == '') &amp;&amp; (this.value = 'Address')" onfocus="(this.value == 'Address') &amp;&amp; (this.value = '')" placeholder="Address" class="form-control input-lg" id="address" name="address">
                  </div>
                </div>
                 <span class="vstar err_add"></span>
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" onblur="(this.value == '') &amp;&amp; (this.value = 'City')" onfocus="(this.value == 'City') &amp;&amp; (this.value = '')" placeholder="City" class="form-control input-lg" id="city" name="city">
                  </div>
                </div>
                <span class="vstar err_city"></span> 
                <div class="form-group">
                  <div class="col-md-12">
                    <select class="form-control input-lg state" name="state" id="state">
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
                <span class="vstar err_state"></span> 
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
                </div>
                <span class="vstar err_country"></span>  
                <div class="form-group">
                  <div class="col-xs-12">
                    <input type="text" onblur="(this.value == '') &amp;&amp; (this.value = 'Zip Code')" onfocus="(this.value == 'Zip Code') &amp;&amp; (this.value = '')" placeholder="Zip Code" class="form-control input-lg" id="zip_code" name="zip_code">
                  </div>
                </div>
                <span class="vstar err_zip"></span>                           
              </div>
            </div>
            <!--SHIPPING METHOD END-->
          </div>
        </div>
      </form>
      <?php } ?>
          
      
