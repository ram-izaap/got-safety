<div class="col-md-9 content-bar cart-section">
  <h3>Cart</h3>
  <hr>
  <div class="desktop-cart">
    <div id="page-wrap">
      <?php if(count($this->cart->contents()) > 0) { ?>
      <table width="100%" class="c-table">
        <thead>
          <tr>
            <th width="70%">Product
            </th>
            <th width="8%">Price
            </th>
            <th width="8%">Sub Total
            </th>
            <th width="4%">
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($this->cart->contents() as $items): ?>
          <tr>
            <td class="cart-del" id="cart-del">
              <button class="btn btn-danger btn-sm btn-delete" remove="" from="" rowid="<?php echo $items['rowid']; ?>">
                <i class="fa fa-trash-o prd-delete">
                </i>
              </button>
            </td>
            <td class="prod-name">
              <div class="media">
                <a class="thumbnail pull-left" href="<?php echo site_url(); ?>product/product_detail/<?php echo $items['options']['product_id']; ?>"> 
                  <img class="media-object" width="72" src="<?php echo $img_url; ?>assets/product_images/<?php echo $items['img']; ?>" alt="<?php echo $items['name']; ?>" title="<?php echo $items['name']; ?>"> 
                </a>
                <div class="media-body">
                  <h4 class="media-heading">
                    <a href="<?php echo site_url(); ?>product/product_detail/<?php echo $items['options']['product_id']; ?>">
                      <?php echo $items['name']; ?>
                    </a>
                  </h4>
                  <h5>
                    <span>
                      <?php echo $items['attr_name']; ?> :
                    </span>
                    <span class="text-success">
                      <strong>
                        <?php echo $items['attr_val']; ?>
                      </strong>
                    </span>
                  </h5>
                </div>
              </div>
            </td>
            <td class="prod-price">
              <strong>
                <?php echo $this->cart->format_number($items['price']); ?>
              </strong>
            </td>
            <td class="prod-total">
              <strong>$
                <?php echo $this->cart->format_number($items['subtotal']); ?>
              </strong>
            </td>
          </tr>
          <?php endforeach; ?>
          <tr>
          </tr>
        </tbody>
      </table>
      <table width="100%" class="table">
        <tbody>
          <tr>
            <td class="td-empty"> 
            </td>
            <td class="td-empty"> 
            </td>
            <td class="td-empty"> 
            </td>
            <td class="Subtotal">
              <h5>Subtotal
              </h5>
            </td>
            <td class="text-right">
              <h5>
                <strong>$
                  <?php echo $this->cart->format_number($this->cart->total()); ?>
                </strong>
              </h5>
            </td>
          </tr>
          <tr>
            <td class="td-empty"> 
            </td>
            <td class="td-empty"> 
            </td>
            <td class="td-empty"> 
            </td>
            <td class="Subtotal">
              <h3>Total
              </h3>
            </td>
            <td class="text-right">
              <h3>
                <strong>$
                  <?php echo $this->cart->format_number($this->cart->total()); ?>
                </strong>
              </h3>
            </td>
          </tr>
          <tr>
            <td class="td-empty"> 
            </td>
            <td class="td-empty"> 
            </td>
            <td class="td-empty"> 
            </td>
            <td class="cart-cntshop">
              <a href="<?php echo site_url('cart');?>" class="btn btn-success btn-green" type="button"> 
                <i class="fa fa-hand-o-right">
                </i>View Cart 
                </a>
            </td>
            <td class="cart-chkout">
              <a href="<?php echo site_url('checkout');?>" class="btn btn-success btn-green" type="button"> 
                <i class="fa fa-hand-o-right">
                </i>Checkout 
                </span>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
      <?php } else { ?>
      <table width="100%" class="c-table">
        <thead>
          <tr>
            <th width="70%">No Items Found
            </th>
          </tr>
        </thead>
      </table>
      <?php } ?>
    </div>
  </div>
</div>
