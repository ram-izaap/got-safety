<h1><u>Got Safety - Order<?= (isset($data['so_id'])?('- #'.$data['so_id']):('')); ?></u></h1>

<?php echo ($status == 'FAILED')?(''):('Thank you for your order! '); ?>

         
<?php echo ($status == 'HOLD')?('The Shipping charges will be calculated based on best shipping method per region; You will receive a quote by us, and a Paypal money request, after your order has been placed to approve these additional shipping charges.   If the shipping quote is not approved by you within 10 days, your PayPal account will be credited and the order will be cancelled. Please contact our Support Desk for any queries.<br/>'):(''); ?>
<?php echo ($status == 'CONFIRM')?('The Cost for the International Shipping of your order '.(isset($payment['so_id'])?('- #'.$payment['so_id']):('')).' has been calculated. Please find the order details below.<br/>'):(''); ?> 
<?php echo ($status == 'FAILED')?('Your order with following products has been failed.<br/>'):(''); ?>    
    
     <h2>Shipping Address:</h2>
     <div style="margin-left:20px;">       
       <address>
        <strong><?php echo $shipping['name']; ?></strong> <br><?php echo $shipping['company_name']; ?><br><?php echo $shipping['address']; ?> <br><?php echo $shipping['city']; ?> <br><?php echo $shipping['state']; ?> <br><?php echo $shipping['zip_code']; ?> <br><abbr title="Phone">Phone:</abbr> <?php echo $shipping['phone']; ?>
      </address>
      <br />
     <?php if( strcmp($status,'FAILED') !== 0 ) { ?>  
     If you need to make changes to your shipping address please call: Tel: 123-890 (retail)
     <?php }?>
     
     </div>
    
    <h2>Products</h2>
    <div style="">
    <table cellspacing="10" width="100%">
      <tr>
        <th>SKU</th>
        <th>Product Name</th>
        <th>Unit Price</th>
        <th>Quantity</th>
      </tr>
      <tr><td colspan=4><hr/></td></tr>
      <?php foreach ($product_details as $product_detail):?>
        <tr>
          <td align="center"><?php echo $product_detail['sku'];?></td>
          <td align="center"><?php echo $product_detail['name'];?></td>
          <td align="center"><?php echo displayData($product_detail['sell_price'], 'money');?></td>
          <td align="center"><?php echo $product_detail['quantity'];?></td>
        </tr>
        <tr><td colspan=4><hr/></td></tr>     
      <?php endforeach;?>
      
        
      <?php     
      if(count($so_details)):
        $so_details['cart_total']    =   isset($so_details['cart_total'])?($so_details['cart_total']):('');
        $so_details['shipping_cost']   =   isset($so_details['shipping'])?($so_details['shipping']):('');
        $so_details['discount']    = isset($so_details['discount'])?($so_details['discount']):('');
        $so_details['total']     = isset($so_details['total_amount'])?($so_details['total_amount']):('');
        $so_details['total_tax']   = isset($so_details['tax'])?($so_details['tax']):('');
        
      ?>
        <tr>
          <td colspan=3 align="right">Sub-total:</td>
          <td align="center">$<?php echo $so_details['cart_total']; ?></td>
        </tr>
        <tr>
          <td colspan=3 align="right">Shipping:</td>
          <td align="center">$<?php echo $so_details['shipping']; ?></td>
        </tr>
        <tr>
          <td colspan=3 align="right">Discount:</td>
          <td align="center">-<?php echo $so_details['discount']; ?></td>
        </tr>
        <?php if($so_details['tax']>0):?>
        <tr>
          <td colspan=3 align="right">Total Tax:</td>
          <td align="center">$<?php echo $so_details['tax']; ?></td>
        </tr>
        <?php endif;?>
        <tr>
          <td colspan=3 align="right">Total:</td>
          <td align="center">$<?php echo $so_details['total_amount']; ?></td>
        </tr>
    <?php endif; ?>
     </table>
     </div>
     
     
     
     