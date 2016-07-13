<h3 class="page-title">
  <?php echo $title;?>
</h3>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <i class="fa fa-home">
      </i>
      <a href="<?php echo base_url("index.php/home"); ?>">Home
      </a>
      <i class="fa fa-angle-right">
      </i>
    </li>
    <li>
      <a href="<?php echo base_url("index.php/order"); ?>">Order
      </a>
      <i class="fa fa-angle-right">
      </i>
    </li>
    <li>
      <?php echo $crumb;?>
    </li>
  </ul>
</div>
<section class="container content-area" data-view="about">
  <!-- rwo default --> 
  <div class="row" data-row="default">
    <aside class="col-sm-12 bg-white inner-full">
      <div class="inner-content">
        
        <!-- // Order Invoice  -->
        <div class="order-invoice-wrapper">
          
          <div class="row">
            <div class="col-xs-12">
              <div class="row">
                <div class="col-md-2">
                  <h3><strong>Order No</strong>
                  <div class="clearfix"></div> 
                  <?php echo isset($so_details['id'])?("{$so_details['id']}"):('');?>
                  </h3>
                </div>
                <div class="col-md-2">
                  <h3><strong>Order Total</strong>
                  <div class="clearfix"></div>
                  <?php echo $so_details['total_amount']; ?>
                  </h3>
                </div>
                <div class="col-md-2">
                  <h3><strong>Order Status</strong>
                  <div class="clearfix"></div>
                  <?php echo $so_details['order_status']; ?>
                  </h3>
                </div>
                <div class="col-md-3">
                  <h3><strong>Order Date</strong>
                  <div class="clearfix"></div>
                  <?php echo $so_details['created_date']; ?>
                  </h3>
                </div>
                </div>
                <div class="row">
                  <div class="col-xs-12">
                   <h3><strong>Paid Status</strong>
                  <div class="clearfix"></div>
                  <?php echo ($so_details['paid_status']=='Y')?'Yes':'No'; ?>
                  </h3>
                  </div>
                </div>
                <?php if(count($order_log) > 0): ?>
                <div class="row">
                  <div class="col-xs-12">
                   <h3><strong>Order Logs</strong>
                  <div class="clearfix"></div>
                  <?php echo $order_log['action']; ?>
                  </h3>
                  </div>
                </div>
              <?php endif; ?>
                <div class="row">
                <div class="col-xs-6">
                  <address>
                    <strong>Billed To:</strong><strong><?php echo $billing['name']; ?></strong> <br><?php echo $billing['company_name']; ?><br><?php echo $billing['address']; ?> <br><?php echo $billing['city']; ?> <br><?php echo $billing['state']; ?> <br><?php echo $billing['zip_code']; ?> <br><abbr title="Phone">P:</abbr> <?php echo $billing['phone']; ?>
                  </address>
                </div>
                <div class="col-xs-6">
                  <address>
                    <strong>Shipped To:</strong><strong><?php echo $shipping['name']; ?></strong> <br><?php echo $shipping['company_name']; ?><br><?php echo $shipping['address']; ?> <br><?php echo $shipping['city']; ?> <br><?php echo $shipping['state']; ?> <br><?php echo $shipping['zip_code']; ?> <br><abbr title="Phone">P:</abbr> <?php echo $shipping['phone']; ?>
                  </address>
                </div>
              </div>
              
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default" style="width:75%;">
                <div class="panel-heading">
                  <h3 class="panel-title">
                    <strong>Order summary
                    </strong>
                  </h3>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-condensed table-stripped table-hover table-hg" >
                      <thead>
                        <tr>
                          <td>
                            <strong>Sr
                            </strong>
                          </td>
                          <td class="text-center">
                            <strong>Product ID
                            </strong>
                          </td>
                          <td class="text-center">
                            <strong>Product Name
                            </strong>
                          </td>
                          <td class="text-right">
                            <strong>Unit Price
                            </strong>
                          </td>
                          <td class="text-right">
                            <strong>Quantity
                            </strong>
                          </td>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                        <?php $sno=1; foreach($product_details as $product_detail):?>         
                        <tr>
                          <td><?php echo $sno++;?></td>
                          <td class="text-center"><?php echo $product_detail['sku'];?></td>
                          <td class="text-center"><?php echo $product_detail['product_name'];?></td>
                          <td class="text-right"><?php echo displayData($product_detail['unit_price'], 'money');?></td>
                          <td class="text-right"><?php echo $product_detail['quantity'];?></td>
                        </tr>             
                        <?php endforeach;?>
                        <?php if(count($so_details)):?>
                          <?php 
                            $sub_total = (float)$so_details['cart_total'];
                            $flag = 1;
                          ?>
                        <tr>
                          <td class="thick-line">
                          </td>
                          <td class="thick-line">
                          </td>
                          <td class="thick-line text-center">
                            <strong>Total Items
                            </strong>
                          </td>
                          <td class="thick-line text-right">(<?php echo ($so_details['total_items']>1)?($so_details['total_items'].' items'):($so_details['total_items'].'item');?> )
                          </td>
                        </tr>
                        <tr>
                          <td class="thick-line">
                          </td>
                          <td class="thick-line">
                          </td>
                          <td class="thick-line text-center">
                            <strong>Subtotal
                            </strong>
                          </td>
                          <td class="thick-line text-right"><?php echo '$'.number_format($sub_total,2);?>
                          </td>
                        </tr>
                        <tr>
                          <td class="no-line">
                          </td>
                          <td class="no-line">
                          </td>
                          <td class="no-line text-center">
                            <strong>Shipping
                            </strong>
                          </td>
                          <td class="no-line text-right"><?php echo '$'.number_format((float)$so_details['shipping'],2);?>
                          </td>
                        </tr>
                        <?php if(isset($so_details['tax']) && ceil($so_details['tax'])):?>
                        <tr>
                          <td class="no-line">
                          </td>
                          <td class="no-line">
                          </td>
                          <td class="no-line text-center">
                            <strong>Tax
                            </strong>
                          </td>
                          <td class="no-line text-right"><?php echo '$'.number_format((float)$so_details['tax'],2);?>
                          </td>
                        </tr>
                        <?php endif;?>
                        <tr>
                          <td class="no-line">
                          </td>
                          <td class="no-line">
                          </td>
                          <td class="no-line text-center">
                            <strong>Total
                            </strong>
                          </td>
                          <td class="no-line text-right"><?php echo '$'.number_format((float)$so_details['total_amount'],2);?>
                          </td>
                        </tr>
                       <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Order Invoice  // -->
      </div>
    </aside>
    <!-- rwo default --> 
  </div>
</section>
