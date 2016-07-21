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
      <table width="100%" class="c-table">
        <thead>
          <tr>
            <th width="70%">Product</th>
            <th width="7%">Quantity</th>
            <th width="7%">Price</th>
            <th width="13%">Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; foreach($this->cart->contents() as $items): 
            echo form_hidden('cart[' . $i . '][id]', $items['id']);
            echo form_hidden('cart[' . $i . '][rowid]', $items['rowid']);
            echo form_hidden('cart[' . $i . '][name]', $items['name']);
            echo form_hidden('cart[' . $i . '][price]', $items['price']);
          ?>
          <tr>
            <td class="prod-name">
              <div class="media clearfix">
                <a class="thumbnail m-thumbnail pull-left" href="<?php echo site_url(); ?>product/product_detail/<?php echo $items['options']['product_id']; ?>"> 
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
            <td class="prod-quantity">
              <?php echo $this->cart->format_number($items['qty']); ?>
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
          <?php ++$i; endforeach; ?>
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
            <td class="text-center">
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
              <h5>Shipping
              </h5>
            </td>
            <td class="text-center">
              <h5>
                <strong>$
                  <?php echo $ship_amt = (isset($this->session->userdata['ship_amt']['shipping_amt']) && $this->session->userdata['ship_amt']['shipping_amt']!='')? number_format($this->session->userdata['ship_amt']['shipping_amt'],2):0; ?>
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
              <h5>Tax
              </h5>
            </td>
            <td class="text-center">
              <h5>
                <strong>$
                  <?php echo $tax_amt = (isset($this->session->userdata['tax_amt']['tax_amt']) && $this->session->userdata['tax_amt']['tax_amt']!='')? number_format((float)$this->session->userdata['tax_amt']['tax_amt'],2):0; ?>
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
            <td class="text-center">
              <h3>
                <strong>$
                  <?php echo number_format($this->cart->format_number($this->cart->total()) + number_format((float)$this->session->userdata['ship_amt']['shipping_amt'],2)+number_format((float)$this->session->userdata['tax_amt']['tax_amt'],2),2); ?>
                </strong>
              </h3>
            </td>
          </tr>
        </tbody>
      </table>      
    </div>
  </div>
  <?php endif; ?>
  <!--REVIEW ORDER END-->
</div>
