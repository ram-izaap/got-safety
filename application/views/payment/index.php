<!-- // Content area -->
	<section class="container content-area" data-view="create-account">
		<!-- rwo default --> 
		<div class="row" data-row="default">
			<aside class="col-sm-12 bg-white inner-full">
			<?php 
			if(isset($_SESSION['signup_fail']))
				{?>
				<div class="alert alert-danger alert-dismissable col-md-6 col-md-offset-3">
				 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				 	<?php  
				 		echo $_SESSION['signup_fail'];
				 		unset($_SESSION['signup_fail']);
				 	}
				 	?>
				</div>
				<div class="inner-content form-wrap" style="width:90%;">
						<div class="form-group">
							<label class="col-md-12 control-label">Coupon Code</label>
							<div class="col-md-4">
								<input type="text" class="coupon_text form-control form-input">
								<div class="coupon_div">
									<?php
									//print_r($_SESSION['coupon_details']['code']);
									if( (isset($_SESSION['signup_data']['promo_code'])) && ($_SESSION['signup_data']['promo_code']!='') || 
										(isset($_SESSION['coupon_details']['code'])) && ($_SESSION['coupon_details']['code']) )
									{
									if(isset($_SESSION['coupon_details']))
									  $code=$this->session->userdata('coupon_details')['code'];
									else
									 	$code=$this->session->userdata['signup_data']['promo_code'];
									$plan_id=$this->session->userdata['signup_data']['plan_type'];
									
									if($this->session->userdata('coupon_details'))
										$coupon = $this->session->userdata('coupon_details');
									?>
									 <span class="coupon_succ">
                    <span style="width:85px;">
                      <strong><?=$coupon['code'];?></strong>
                    </span>
                    <span></strong>- $<?=$coupon['discount_amount'];?></strong>
                    </span>
                    <a href="javascript:void(0)" class="del_coupon">x</a>
                  </span>
									<?php
									}
									?>
								</div>
							</div>
								<br>
							<input class="btn btn-danger btn-red apply_coupon" value="Apply" 
							type="button">
						</div><br>
						<h4>Choose Payment Gateway</h4>
						<p>
						<?php
						if($this->session->userdata){
							$email = $this->session->userdata['signup_data']['email'];
						}
						else
						{
							$email=set_value('email');
						}

						?>
						<input name="pay_method" type="radio" value="1" />&nbsp;&nbsp;&nbsp;Paypal<img src="https://www.alternativeairlines.com/images/stories/Website/Homepage/booking_banner/image_paypal.png" style="width:50px;" />
                         
						</p>
						<div class="paypal_div">
                          	<form name="paypal_form" method="post" action="<?php echo base_url('payment/paypal'); ?>"	
									autocomplete="on">
									<?php 
									if($this->session->userdata('coupon_details'))
									{
										$p_amt = $_SESSION['coupon_details']['total'];
									}
									else
									{
										$p_amt = $_SESSION['plan_details'][0]['plan_amount'];
									}
									?>
									<input type="hidden" name="plan_name" value="<?php echo (isset($_SESSION['plan_details']))?$_SESSION['plan_details'][0]['plan_type'] : "";?>">
									<input type="hidden" name="plan_cost" value="<?php echo $p_amt;?>">
									<input type="hidden" name="plan_id" value="<?php echo (isset($_SESSION['plan_details'][0]['id']))?$_SESSION['plan_details'][0]['id']:"";?>">
								     <h5>Personal Info</h5>
									 <div class="row">
					                    <div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="firstname" id="firstname" class="form-control input-lg" 
					                        value="<?php echo set_value('firstname');?>" placeholder="First Name" >
					                         <span class="vstar"> <?php echo form_error('firstname');?></span>
					                      </div>
					                    </div>
					                    <div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="lastname" id="lastname" class="form-control input-lg" value="<?php echo set_value('lastname');?>" placeholder="Last Name">
					                         <span class="vstar"> <?php echo form_error('lastname');?></span>
					                      </div>
					                    </div>
					                   </div>
				                    <div class="row">
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="pay_email" id="pay_email" class="form-control input-lg" 
					                        value="<?php echo (!empty($email))?$email:set_value('pay_email');?>" readonly placeholder="Email-ID">
					                         <span class="vstar"> <?php echo form_error('pay_email');?></span>
					                      </div>
				                    	</div>
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="pay_address" id="pay_address" class="form-control input-lg" value="<?php echo set_value('pay_address');?>" placeholder="Address">
					                         <span class="vstar"> <?php echo form_error('pay_address');?></span>
					                      </div>
				                    	</div>
				                    </div>
				                    <div class="row">
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="pay_city" id="pay_city" class="form-control input-lg" 
					                        value="<?php echo set_value('pay_city');?>" placeholder="City">
					                         <span class="vstar"> <?php echo form_error('pay_city');?></span>
					                      </div>
				                    	</div>
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="pay_state" id="pay_state" class="form-control input-lg"
					                         value="<?php echo set_value('pay_state');?>" placeholder="State">
					                         <span class="vstar"> <?php echo form_error('pay_state');?></span>
					                      </div>
				                    	</div>
				                    </div>
				                    <div class="row">
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="pay_zipcode" id="pay_zipcode" class="form-control input-lg" value="<?php echo set_value('pay_zipcode');?>" placeholder="Zipcode">
					                         <span class="vstar"> <?php echo form_error('pay_zipcode');?></span>
					                      </div>
				                    	</div>
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="pay_country" id="pay_country" class="form-control input-lg" value="<?php echo set_value('pay_country');?>" placeholder="Country">
					                         <span class="vstar"> <?php echo form_error('pay_country');?></span>
					                      </div>
				                    	</div>
				                    </div>
				                    <div class="row">
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="pay_phone" id="pay_phone" class="form-control input-lg" value="<?php echo set_value('pay_phone');?>" placeholder="Mobile">
					                         <span class="vstar"> <?php echo form_error('pay_phone');?></span>
					                      </div>
				                    	</div>
				                    	<!--<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="pay_fax" id="pay_fax" class="form-control input-lg" value="<?php echo set_value('pay_fax');?>" placeholder="Fax">
					                         <span class="vstar"> <?php echo form_error('pay_fax');?></span>
					                      </div>
				                    	</div>-->
				                    </div>
				                 	
					                    <div class="row">
					                   		<div class="col-sm-12">
					                   			<input type="submit" class="btn btn-block client-login btn-danger" name="submit" value="Pay & Register" />
					                   		</div>
					                    </div>
								</form>     
						</div>
						<p>
							<input <?php echo set_radio('pay_method','2',TRUE);?> name="pay_method" type="radio" value="2">&nbsp;&nbsp;&nbsp;Authorize.net
							<img src="http://ignitiondeck.com/id/wp-content/uploads/2013/08/authorize-net.png" style="width:200px;">
						</p>
						<?php 
						if(isset($_SESSION['coupon_details']))
						{
							$p_amt = number_format($coupon['total'],2);
						}
						else
						{
							$p_amt = $_SESSION['plan_details'][0]['plan_amount'];
						}
						?>
						<div class="auth_div" style="display:none;">
								<form name="auth-form" method="post" action="<?php echo base_url('payment/authorize_form'); ?>"	
									autocomplete="on">
									<input type="hidden" name="plan_name" value="<?php echo (isset($_SESSION['plan_details']))?$_SESSION['plan_details'][0]['plan_type']:"";?>">
									<input type="hidden" name="plan_cost" value="<?php echo $p_amt;?>">
									<input type="hidden" name="plan_id" value="<?php echo (isset($_SESSION['plan_details'][0]['id']))?$_SESSION['plan_details'][0]['id']:"";?>">
								<h5>Personal Info</h5>
									 <div class="row">
					                    <div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="fname" id="fname" class="form-control input-lg" 
					                        value="<?php echo set_value('fname');?>" placeholder="First Name" >
					                         <span class="vstar"> <?php echo form_error('fname');?></span>
					                      </div>
					                    </div>
					                    <div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="lname" id="lname" class="form-control input-lg" value="<?php echo set_value('lname');?>" placeholder="Last Name">
					                         <span class="vstar"> <?php echo form_error('lname');?></span>
					                      </div>
					                    </div>
					                   </div>
				                    <div class="row">
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="email" id="email" class="form-control input-lg" 
					                        value="<?php echo $email;?>" readonly placeholder="Email-ID">
					                         <span class="vstar"> <?php echo form_error('email');?></span>
					                      </div>
				                    	</div>
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="address" id="address" class="form-control input-lg" value="<?php echo set_value('address');?>" placeholder="Address">
					                         <span class="vstar"> <?php echo form_error('address');?></span>
					                      </div>
				                    	</div>
				                    </div>
				                    <div class="row">
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="city" id="city" class="form-control input-lg" 
					                        value="<?php echo set_value('city');?>" placeholder="City">
					                         <span class="vstar"> <?php echo form_error('city');?></span>
					                      </div>
				                    	</div>
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="state" id="state" class="form-control input-lg"
					                         value="<?php echo set_value('state');?>" placeholder="State">
					                         <span class="vstar"> <?php echo form_error('state');?></span>
					                      </div>
				                    	</div>
				                    </div>
				                    <div class="row">
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="zipcode" id="zipcode" class="form-control input-lg" value="<?php echo set_value('zipcode');?>" placeholder="Zipcode">
					                         <span class="vstar"> <?php echo form_error('zipcode');?></span>
					                      </div>
				                    	</div>
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="country" id="country" class="form-control input-lg" value="<?php echo set_value('country');?>" placeholder="Country">
					                         <span class="vstar"> <?php echo form_error('country');?></span>
					                      </div>
				                    	</div>
				                    </div>
				                    <div class="row">
				                    	<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="phone" id="phone" class="form-control input-lg" value="<?php echo set_value('phone');?>" placeholder="Mobile">
					                         <span class="vstar"> <?php echo form_error('phone');?></span>
					                      </div>
				                    	</div>
				                    	
				                    	<!--<div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="fax" id="fax" class="form-control input-lg" value="<?php echo set_value('fax');?>" placeholder="Fax">
					                         <span class="vstar"> <?php echo form_error('fax');?></span>
					                      </div>
				                    	</div>-->
				                    </div>
				                 	<h5>Card Details</h5>
				                 	 <div class="row">
					                    <div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="c_number" id="c_number" class="form-control input-lg" value="<?php echo set_value('c_number');?>" placeholder="XXXXXXXXXXXXXXXX" maxlength="16">
					                         <span class="vstar"> <?php echo form_error('c_number');?></span>
					                      </div>
					                    </div>
					                    <div class="col-sm-6">
					                      <div class="form-group">
					                        <input type="text" name="cvv" maxlength="3" id="cvv" class="form-control input-lg" value="<?php echo set_value('cvv');?>" placeholder="XXX">
					                         <span class="vstar"> <?php echo form_error('cvv');?></span>
					                      </div>
					                    </div>
					                   </div>
					                   <div class="row">
					                    <div class="col-sm-6">
					                      <div class="form-group">
					                        	<select name="exp_month" class="form-control input-lg">
					                        		<option value="">--Select Expire Month--</option>
					                        		<option value="01">01</option>
					                        		<option value="02">02</option>
					                        		<option value="03">03</option>
					                        		<option value="04">04</option>
					                        		<option value="05">05</option>
					                        		<option value="06">06</option>
					                        		<option value="07">07</option>
					                        		<option value="08">08</option>
					                        		<option value="09">09</option>
					                        		<option value="10">10</option>
					                        		<option value="11">11</option>
					                        		<option value="12">12</option>
					                        	</select>
					                        	<span class="vstar"> <?php echo form_error('exp_month');?></span>
					                      </div>
					                    </div>
					                    <div class="col-sm-6">
					                      <div class="form-group">
					                        <select name="exp_year" class="form-control input-lg">
					                        	<option value="">--Select Expire Year--</option>
					                        	<?php 
					                        	$year = date('Y');
					                        	$year1 = date('Y',strtotime("+20 years"));
					                        	for ($i=$year; $i < $year1 ; $i++)
					                        	{ 
					                        	?>
					                        	<option value="<?php echo $i;?>"><?php echo $i;?></option>
					                        	<?php 
					                        		}
					                        	?>
					                        </select>
					                        <span class="vstar"> <?php echo form_error('exp_year');?></span>
					                      </div>
					                    </div>
					                   </div>
					                    <div class="row">
					                   		<div class="col-sm-12">
					                   			<input type="submit" class="btn btn-block client-login btn-danger" name="submit" value="Pay & Register">
					                   		</div>
					                    </div>
								</form>
				</div>
			</aside>
		</div>
	</section>
