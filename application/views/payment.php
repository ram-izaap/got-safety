<body>
	<!-- // Content area -->
	<section class="container content-area" data-view="create-account">
		<!-- rwo default --> 
		<div class="row" data-row="default">
			<aside class="col-sm-12 bg-white inner-full">
				<div class="inner-content form-wrap" style="width:90%;">
						<h4>Choose Payment Gateway</h4>
						<p>
						<?php 
						if($this->session->userdata)
						{
							$email = $this->session->userdata('email');
						}
						else
						{
							$email=set_value('email');
						}

						?>
							<input  name="pay_method" type="radio" value="1">&nbsp;&nbsp;&nbsp;Paypal
							<img src="https://www.alternativeairlines.com/images/stories/Website/Homepage/booking_banner/image_paypal.png" style="width:50px;">
							</p>
							<div class="paypal_div">
								<input type="image" src="https://www.paypalobjects.com/webstatic/mktg/merchant/images/express-checkout-hero.png" style="width:200px;">
							</div>
							<p>
								<input <?php echo set_radio('pay_method','2',TRUE);?> name="pay_method" type="radio" value="2">&nbsp;&nbsp;&nbsp;Authorize.net
								<img src="http://ignitiondeck.com/id/wp-content/uploads/2013/08/authorize-net.png" style="width:200px;">
							</p>

							<div class="auth_div" style="display:none;">
								<form name="auth-form" method="post" action="<?php echo base_url('login/do_payment'); ?>"	
									autocomplete="on">
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
	                        <input type="text" name="email" id="email" class="form-control input-lg" value="<?php echo $email;?>" readonly placeholder="Email-ID">
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
                    	<div class="col-sm-6">
	                      <div class="form-group">
	                        <input type="text" name="fax" id="fax" class="form-control input-lg" value="<?php echo set_value('fax');?>" placeholder="Fax">
	                         <span class="vstar"> <?php echo form_error('fax');?></span>
	                      </div>
                    	</div>
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
				</div>
			</aside>
		</div>
	</section>
</body>
