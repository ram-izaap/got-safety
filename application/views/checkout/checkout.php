<!-- // Content area -->
<section class="container content-area checkout-area" data-view="list">
  <!-- rwo default --> 
  <div class="row" data-row="default">
    <aside class="col-sm-12 bg-white inner-full">
    
    <div id="preloader" style="display:none; padding-top: 323.5px;"> Processing...
      <div><img src="<?php echo site_url(); ?>assets/images/frontend/preloader-screen.gif" id="preloader_image"></div>
    </div>

      <div class="inner-content clearfix">
        <!-- Left Bar -->
        <?php 
           $this->load->view("product/left_sidebar",$this->data['cat_data']);
        ?>
        <!-- Right Bar -->
        <div class="col-sm-12 col-md-9 content-bar checkout-section">
          <h3>Checkout
          </h3>
          <hr>
          <div class="checkout-details">
            <div id="billing_address" > 
              <?php echo $billing_information; ?>
            </div>
            <div id="billing_list">
            </div>
            <div id="billing_form" style="display:none;">
            </div>
            <div id="shipping_address"> 
              <?php echo $shipping_information; ?>
            </div>
            <div id="shipping_list">
            </div>
            <div id="shipping_form" style="display:none;">
            </div> 
            <div id="order_information"> 
              <?php echo $order_information; ?>
            </div> 
            <div id="payment_information"> 
              <?php echo $payment_information; ?>
            </div>  
          </div>
        </div>
      </div>
      
    </aside>
    <!-- rwo default --> 
  </div>
</section>
