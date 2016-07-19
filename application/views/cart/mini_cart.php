
<!-- // Mini Cart -->
<div class="mini-cart-wrapper">
  <!-- // Mc Scroll -->
  <div class="mc-scroll">
    <!-- Single loop -->
    <?php if(count($this->cart->contents()) > 0): 
      foreach($this->cart->contents() as $items): ?>
    <div class="mc-loop clearfix">
      <div class="form-group clearfix">
        <div class="col-sm-12">
          <p class="mc-title">
            <b>
              <a href="<?php echo site_url(); ?>product/<?php echo str_replace(" ","-",$items['name']); ?>">
                <?php echo $items['name']; ?>
              </a>
            </b> 
          </p>
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
              <b class="mc-count">
                <?php echo ($items['qty']) .'*'.($this->cart->format_number($items['price'])); ?>
              </b> 
              <span>
                <strong>$ <?php echo $this->cart->format_number($items['subtotal']); ?>
                </strong>
              </span>
            </small>
          </p>
          <p class="text-right mc-remove-cart">
            <a href="#" class="btn-delete" rowid="<?php echo $items['rowid']; ?>" remove="" from="">Remove
              <i class="fa fa-trash-o prd-delete">
              </i>
            </a>
          </p>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <!-- Mc Scroll // -->
  <div class="clear">
  </div>
  <div class="mc-main-total">
    <p>
      <small>SubTotal 
        <span>
          <strong class="pull-right">$ 
            <?php echo $this->cart->format_number($this->cart->total()); ?>
          </strong>
        </span>
      </small>
    </p>
    <p>
      <a href="<?php echo site_url('cart');?>"  class="btn btn-lg btn-danger">
        <i class="fa fa-hand-o-right">
        </i>
        View Cart
      </a>
      <a href="<?php echo site_url('checkout');?>"  class="btn btn-lg btn-warning">
        <i class="fa fa-hand-o-right">
        </i>
        Checkout
      </a>
    </p>
    <?php endif; ?>
  </div>
</div>
<div class="clear">
</div>
<!-- Mini Cart // -->
