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
          <?php

           $i=1; foreach($this->cart->contents() as $items): 
            $sku[] = $items['sku'];
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
                    <a href="<?php echo site_url(); ?>product/<?php echo str_replace(" ","-",$items['name']); ?>">
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
      <input type="hidden" name="sku" value="<?=implode(",",$sku);?>">
      <table width="100%" class="table">
        <tbody>
          <tr>
            <td colspan="3">
              <div class="form-group">
                <label class="control-label col-md-2">Coupon Code:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control form-input coupon_text">
                  <span class="coupon_error hide vstar"></span>
                  <div class="coupon_success">
                    <?php
                      //print_r($this->session->userdata('coupon_details'));
                      $coupon = $this->session->userdata('coupon_details');
                      $cp_amt=0;$sh_amt=0;
                      if(!empty($coupon))
                      {
                        if($coupon['offer_type']=="2")
                        {
                          $sh_amt = $coupon['discount_amount'];;
                          $cp_amt = 0;
                        }
                        else
                        {
                          $sh_amt = 0;
                          $cp_amt = $coupon['discount_amount']; ?><span class="coupon_succ">
                    <span style="width:85px;">
                      <strong><?=$coupon['code'];?></strong>
                    </span>
                    <span></strong>- $<?=$coupon['discount_amount'];?></strong>
                    </span>
                    <a href="javascript:void(0)" class="del_coupon">x</a>
                  </span>
                       <?php }
                        ?>
                        <span class="coupon_succ">
                          <span style="width:85px;">
                            <strong><?=$coupon['code'];?></strong>
                          </span>
                          <span></strong>- $<?=number_format($coupon['discount_amount'],2);?></strong>
                          </span>
                          <a href="javascript:void(0)" class="del_coupon">x</a>
                        </span>
                        <?php
                      }
                      ?>
                  </div>
                </div>             
                 <div class="col-md-3">
                  <input class="btn btn-danger btn-red shop-coupon-apply" 
                    value="Apply" type="button">
               </div>
              </div>
            </td>
            <td class="Subtotal">
              <h5>Subtotal
              </h5>
            </td>
            <td class="text-center">
              <h5>
                <strong>$
                  <?=$sub_amt = $this->cart->format_number($this->cart->total()-$cp_amt);?>
                  <input type="hidden" class="sub_amt" value="<?=$sub_amt;?>">
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
                  <?php echo $ship_amt = (isset($this->session->userdata['ship_amt']['shipping_amt']) && $this->session->userdata['ship_amt']['shipping_amt']!='')? number_format($this->session->userdata['ship_amt']['shipping_amt'] - $sh_amt,2):0; ?>
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
                  <?php 
                    echo number_format(((
                        $this->cart->total() + 
                        number_format((float)$this->session->userdata['ship_amt']['shipping_amt'],2)+
                        number_format((float)$this->session->userdata['tax_amt']['tax_amt'],2)) - number_format($cp_amt,2)) - 
                          number_format($sh_amt,2),2); 
                  ?>
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
