   <?php if(isset($this->session->userdata['billing_info']['name']) && $this->session->userdata['billing_info']['name']!=''): ?>

      <form action="#" name="billing_information" id="billing_information" method="post" class="form-horizontal" onsubmit="javascript:billing_address_validation(); return false;">
            <div class="billing-details">
              
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 billing" data-form="checkout">
                <!--SHIPPING METHOD-->
                <div class="panel panel-info">
                  <div class="panel-heading">Billing Address
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" value="<?php echo $this->session->userdata['billing_info']['name']; ?>" placeholder="Name" class="form-control input-lg" id="name" name="name">
                      </div>
                      <span class="vstar err_name"></span>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" value="<?php echo $this->session->userdata['billing_info']['company_name']; ?>" placeholder="Company Name" class="form-control input-lg" id="company_name" name="company_name">
                      </div>
                       <span class="vstar"></span>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text"  <?php echo (isset($this->session->userdata['email1']) && $this->session->userdata['email1']!='')?("readonly=readonly"):'';?> value="<?php echo $this->session->userdata['billing_info']['email']; ?>" placeholder="E - Mail" class="form-control input-lg" id="email" name="email">
                      </div>
                      <span class="vstar err_email"></span>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" value="<?php echo $this->session->userdata['billing_info']['phone']; ?>" placeholder="Phone Number" class="form-control input-lg" id="phone" name="phone">
                      </div>
                      <span class="vstar err_phone"></span>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" value="<?php echo $this->session->userdata['billing_info']['address']; ?>" placeholder="Address" class="form-control input-lg" id="address" name="address">
                      </div>
                       <span class="vstar err_add"></span>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" placeholder="City" value="<?php echo $this->session->userdata['billing_info']['city']; ?>" class="form-control input-lg" id="city" name="city">
                      </div>
                      <span class="vstar err_city"></span> 
                    </div>
                    
                    <div class="form-group">
                      <div class="col-md-12">
                        <select class="form-control input-lg state" name="state" id="state">
                          <option value="">Select State
                          </option>
                          <?php foreach($states as $key=>$value): ?>
                          <option value="<?php echo $value['state_code']; ?>" <?php if($value['state_code'] == $this->session->userdata['billing_info']['state']) { ?> selected <?php } ?>>
                            <?php echo $value['state_name']; ?>
                          </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <span class="vstar err_state"></span>
                    </div>
                     
                    <div class="form-group">
                      <div class="col-md-12">
                        <select class="form-control input-lg country" name="country" id="country">
                          <option value="">Select Country
                          </option>
                          <?php foreach($countries as $key=>$value): ?>
                          <option value="<?php echo $value['code']; ?>" <?php if($value['code'] == $this->session->userdata['billing_info']['country']) { ?> selected <?php } ?>>
                            <?php echo $value['name']; ?>
                          </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                       <span class="vstar err_country"></span>
                    </div>
                     
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" placeholder="Zip Code" class="form-control input-lg" id="zip_code" value="<?php echo $this->session->userdata['billing_info']['zip_code']; ?>" name="zip_code">
                      </div>
                      <span class="vstar err_zip"></span>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <button class="btn btn-success btn-submit-fix btn-green" onclick="javascript:billing_address_validation()">
                         Save
                        </button>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <button class="btn btn-success btn-submit-fix btn-green" type="submit">
                         Cancel
                        </button>
                      </div>
                   </div>                           
                  </div>
                </div>
                <input type="hidden" name="success1" value="billing_success">
                <!--SHIPPING METHOD END-->
              </div>
            </div>
          </form>
          <?php endif; ?>