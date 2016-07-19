
<!-- // Content area -->
<section class="container content-area" data-view="list">
  <!-- rwo default --> 
  <div class="row" data-row="default">
    <aside class="col-sm-12 bg-white inner-full">
      <div class="inner-content">
        <!-- Left Bar -->
        <?php 
           $this->load->view("product/left_sidebar",$this->data['cat_data']);
        ?>
        <!-- -->
        <div class="col-md-9 content-bar cart-section">
          <h3>Cart
          </h3>
          <hr>
          <div class="desktop-cart">
            <div id="page-wrap">
              <?php if(count($this->cart->contents()) > 0) { ?>
              <form action="<?php echo site_url('cart/update_cart');?>" method="post" name="Cartlist" id="cartlist">
                <table width="100%" class="c-table">
                  <thead>
                    <tr>
                      <th width="70%">Product</th>
                      <th width="7%">Quantity</th>
                      <th width="7%">Price</th>
                      <th width="13%">Sub Total</th>
                      <th width="3%"></th>
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
                          <a class="thumbnail pull-left" href="<?php echo site_url(); ?>product/<?php echo str_replace(" ","-",$items['name']); ?>"> 
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
                        <input type="number" name="cart[<?php echo $i; ?>][qty]" class="form-control" value="<?php echo $items['qty']; ?>" />
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
                      <td class="cart-del" id="cart-del">
                        <button class="btn btn-danger btn-sm btn-delete" from="cart_list" remove="" rowid="<?php echo $items['rowid']; ?>">
                          <i class="fa fa-trash-o prd-delete">
                          </i>
                        </button>
                      </td>
                    </tr>
                    <?php ++$i; endforeach; ?>
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
                        <h5>Shipping
                        </h5>
                      </td>
                      <td class="text-right">
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
                      <td class="text-right">
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
                      <td class="text-right">
                        <h3>
                          <strong>$
                            <?php echo number_format($this->cart->format_number($this->cart->total()) + number_format((float)$this->session->userdata['ship_amt']['shipping_amt'],2)+number_format((float)$this->session->userdata['tax_amt']['tax_amt'],2),2); ?>
                          </strong>
                        </h3>
                      </td>
                    </tr>
                    <tr>
                      <td class="td-empty"> 
                      </td>
                      <td class="cart-chkout">
                        <a href="#" class="btn btn-success btn-sm btn-delete" from="cart_list" remove="all" type="button"> Clear Cart 
                          </span>
                        </a>
                      </td>
                      <td class="cart-cntshop">
                       <input class="btn btn-success btn-sm" value="Update Cart" type="submit">
                      </td>
                      <td class="cart-cntshop">
                        <a href="<?php echo site_url('shop'); ?>" class="btn btn-default btn-sm" type="button">
                          <i class="fa fa-shopping-cart">
                          </i> Continue Shopping 
                        </a>
                      </td>
                      <td class="cart-chkout">
                        <a href="<?php echo site_url('checkout'); ?>" class="btn btn-success btn-sm" type="button"> 
                          <i class="fa fa-hand-o-right">
                          </i>Checkout 
                          </span>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
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
      </div>
    </aside>
  </div>
</section>
  
