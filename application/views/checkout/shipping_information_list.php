   <?php if(isset($this->session->userdata['shipping_info']['name']) && $this->session->userdata['shipping_info']['name']!=''): ?>

      <form action="#" name="shipping_information" id="shipping_information" method="post" class="form-horizontal" onsubmit="javascript:shipping_address_validation(); return false;">
            <div class="billing-details">
              
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 billing" data-form="checkout">
                <!--SHIPPING METHOD-->
                <div class="panel panel-info">
                  <div class="panel-heading">Shipping Address
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" value="<?php echo $this->session->userdata['shipping_info']['name']; ?>" placeholder="Name" class="form-control input-lg" id="name" name="sa_name">
                      </div>
                      <span class="vstar err_sa_name"></span>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" value="<?php echo $this->session->userdata['shipping_info']['company_name']; ?>" placeholder="Company Name" class="form-control input-lg" id="company_name" name="sa_company_name">
                      </div>
                      <span class="vstar"></span>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text"  value="<?php echo $this->session->userdata['shipping_info']['email']; ?>" placeholder="E - Mail" class="form-control input-lg" id="email" name="sa_email">
                      </div>
                      <span class="vstar err_sa_email"></span>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" value="<?php echo $this->session->userdata['shipping_info']['phone']; ?>" placeholder="Phone Number" class="form-control input-lg" id="phone" name="sa_phone">
                      </div>
                      <span class="vstar err_sa_phone"></span>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" value="<?php echo $this->session->userdata['shipping_info']['address']; ?>" placeholder="Address" class="form-control input-lg" id="address" name="sa_address">
                      </div>
                      <span class="vstar err_sa_add"></span>
                    </div>
                     
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" placeholder="City" value="<?php echo $this->session->userdata['shipping_info']['city']; ?>" class="form-control input-lg" id="city" name="sa_city">
                      </div>
                      <span class="vstar err_sa_city"></span>
                    </div>
                     
                    <div class="form-group">
                      <div class="col-md-12">
                        <select class="form-control input-lg sa_state" name="sa_state" id="state">
                          <option value="">Select State
                          </option>
                          <?php foreach($states as $key=>$value): ?>
                          <option value="<?php echo $value['state_code']; ?>" <?php if($value['state_code'] == $this->session->userdata['shipping_info']['state']) { ?> selected <?php } ?>>
                            <?php echo $value['state_name']; ?>
                          </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <span class="vstar err_sa_state"></span>
                    </div>
                     
                    <div class="form-group">
                      <div class="col-md-12">
                        <select class="form-control input-lg sa_country" name="sa_country" id="country">
                          <option value="">Select Country
                          </option>
                          <?php foreach($countries as $key=>$value): ?>
                          <option value="<?php echo $value['code']; ?>" <?php if($value['code'] == $this->session->userdata['shipping_info']['country']) { ?> selected <?php } ?>>
                            <?php echo $value['name']; ?>
                          </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <span class="vstar err_sa_country"></span> 
                    </div>
                     
                    <div class="form-group">
                      <div class="col-xs-12">
                        <input type="text" placeholder="Zip Code" class="form-control input-lg" id="zip_code" value="<?php echo $this->session->userdata['shipping_info']['zip_code']; ?>" name="sa_zip_code">
                      </div>
                    </div>
                    <span class="vstar err_sa_zip"></span>
                    <div class="form-group">
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <button class="btn btn-success btn-submit-fix btn-green" onclick="javascript:shipping_address_validation()" >
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