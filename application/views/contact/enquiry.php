 <div class="" data-form="suggestion">
                          <!-- -->


                            <h3>Send Suggestion</h3>
                            <form role="form" action="<?php //echo base_url("index.php/contact/enquiry"); ?>" method="POST">
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" 
                                    onfocus="(this.value == 'First Name') && (this.value = '')" onblur="(this.value == '') && (this.value = 'First Name')" />
                                    <span class="vstar"><?php echo form_error('first_name', '<span class="">', '</span>'); ?></span>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" 
                                    onfocus="(this.value == 'Last Name') && (this.value = '')" onblur="(this.value == '') && (this.value = 'Last Name')" />
                                    <span class="vstar"><?php echo form_error('last_name', '<span class="">', '</span>'); ?></span>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="text" name="email" id="gs-email" class="form-control input-lg" placeholder="Email" 
                                     />
                                    <span class="vstar"><?php echo form_error('email', '<span class="">', '</span>'); ?></span>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="text" name="company" id="gs-company" class="form-control input-lg" placeholder="Company" 
                                    onfocus="(this.value == 'Company') && (this.value = '')" onblur="(this.value == '') && (this.value = 'Company')" />
                                    <span class="vstar"><?php echo form_error('company', '<span class="">', '</span>'); ?></span>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <select class="form-control input-lg" name="best_time">
                                      <option value="">Best Time to Contact</option>
                                      <option value="Morning">Morning</option>
                                      <option value="Afternoon">Afternoon</option>
                                      <option value="Evening">Evening</option>
                                    </select> 
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <input type="tel" name="number" id="gs-number" class="form-control input-lg" placeholder="Number" 
                                    onfocus="(this.value == 'Number') && (this.value = '')" onblur="(this.value == '') && (this.value = 'Number')" />
                                    <span class="vstar"><?php echo form_error('number', '<span class="">', '</span>'); ?></span>
                                  </div>
                                </div>
                              </div>

                               <div class="form-group">
                                <textarea class="form-control input-lg" placeholder="Lesson Suggestion" name="suggestion"></textarea>
                              </div>
                              <input type="hidden" value="<?php echo $this->uri->segment(1);?>" name="url" class="btn btn-danger btn-block client-login">
                              <input type="submit" value="SUBMIT" class="btn btn-danger btn-block client-login">
                            
                            </form>
                          <!-- -->
                        </div>

