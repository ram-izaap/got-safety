<div class="col-xs-12 checkout-review">
  <!--REVIEW ORDER-->
  <?php if(count($this->cart->contents()) > 0): ?>
  <div class="panel panel-info">
    <div class="panel-heading">
      Review Order 
      <div class="pull-right">
        <small>
          <a href="<?php echo site_url('cart'); ?>" class="afix-1">Edit Cart
          </a>
        </small>
      </div>
    </div>
    <div class="panel-body">
      <?php $i=1; foreach($this->cart->contents() as $items): ?>
      <div class="form-group">
        <div class="col-sm-2 col-xs-3">
          <a href="<?php echo site_url(); ?>product/product_detail/<?php echo $items['options']['product_id']; ?>">
            <img width="90" src="<?php echo $img_url; ?>assets/product_images/<?php echo $items['img']; ?>" alt="product image" class="img-responsive">
          </a>
        </div>
        <div class="col-sm-7 col-xs-6 product-name">
          <h5>
            <a href="<?php echo site_url(); ?>product/product_detail/<?php echo $items['options']['product_id']; ?>">
              <?php echo $items['name']; ?>
            </a>
          </h5>
          <p>
            <small>
              <?php echo $items['attr_name']; ?> :
              <span>
                <?php echo $items['attr_val']; ?>
              </span>
            </small>
          </p>
          <p>
            <small>
              Qty :
              <span>
                <?php echo $items['qty']; ?>
              </span>
            </small>
          </p>
        </div>
        <div class="col-sm-3 col-xs-3 text-right product-price">
          <div class="block-price">
            <strong>
              $<?php echo $this->cart->format_number($items['price']); ?>
            </strong>
          </div>
        </div>
      </div>
      <div class="form-group">
        <hr>
      </div>
      <?php endforeach; ?>
      <div class="form-group">
        <div class="col-xs-12 total-order">
          <strong>Subtotal
          </strong>
          <div class="pull-right">
            <span>$
              <?php echo $this->cart->format_number($this->cart->total()); ?>
            </span>
          </div>
        </div>
        <div class="col-xs-12 total-order">
          <strong>Shipping
          </strong>
          <div class="pull-right">
            <span>$
              <?php echo $ship_amt = (isset($this->session->userdata['ship_amt']['shipping_amt']) && $this->session->userdata['ship_amt']['shipping_amt']!='')? number_format($this->session->userdata['ship_amt']['shipping_amt'],2):0; ?>
            </span>
          </div>
        </div>
        <div class="col-xs-12 total-order">
          <strong>Tax
          </strong>
          <div class="pull-right">
            <span>$
              <?php echo $tax_amt = (isset($this->session->userdata['tax_amt']['tax_amt']) && $this->session->userdata['tax_amt']['tax_amt']!='')? number_format((float)$this->session->userdata['tax_amt']['tax_amt'],2):0; ?>
            </span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <hr>
      </div>
      <div class="form-group">
        <div class="col-xs-12 total-order">
          <strong>Order Total
          </strong>
          <div class="pull-right">$
            <?php echo number_format($this->cart->format_number($this->cart->total()) + number_format((float)$this->session->userdata['ship_amt']['shipping_amt'],2)+number_format((float)$this->session->userdata['tax_amt']['tax_amt'],2),2); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <!--REVIEW ORDER END-->
 </div>

