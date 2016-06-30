
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
						<input name="pay_method" type="radio" value="1" />&nbsp;&nbsp;&nbsp;Paypal
						 
                            <img src="https://www.alternativeairlines.com/images/stories/Website/Homepage/booking_banner/image_paypal.png" style="width:50px;" />
                         
						</p>
						<div class="paypal_div">
                          <a href="<?php echo base_url();?>payment/paypal"> 
							<input type="image" src="https://www.paypalobjects.com/webstatic/mktg/merchant/images/express-checkout-hero.png" style="width:200px;" />
                           </a> 
						</div>
						<p>
							<input <?php echo set_radio('pay_method','2',TRUE);?> name="pay_method" type="radio" value="2">&nbsp;&nbsp;&nbsp;Authorize.net
							<img src="http://ignitiondeck.com/id/wp-content/uploads/2013/08/authorize-net.png" style="width:200px;">
						</p>	
				</div>
			</aside>
		</div>
	</section>
