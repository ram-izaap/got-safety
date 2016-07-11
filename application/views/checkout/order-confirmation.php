<h1><u>HealioHealth.com - Order<?= (isset($data['so_id'])?('- #'.$data['so_id']):('')); ?></u></h1>

<?php echo ($status == 'FAILED')?(''):('Thank you for your order! '); ?>

<?php echo $fraud_type == 'yes'?'<p>Your IP Address has been added in fraudulent list.Please contact administrator for further details.</p>':''; ?>         
         
<?php echo ($status == 'HOLD')?('The Shipping charges will be calculated based on best shipping method per region; You will receive a quote by us, and a Paypal money request, after your order has been placed to approve these additional shipping charges.   If the shipping quote is not approved by you within 10 days, your PayPal account will be credited and the order will be cancelled. Please contact our Support Desk for any queries.<br/>'):(''); ?>
<?php echo ($status == 'CONFIRM')?('The Cost for the International Shipping of your order '.(isset($payment['so_id'])?('- #'.$payment['so_id']):('')).' has been calculated. Please find the order details below.<br/>'):(''); ?> 
<?php echo ($status == 'FAILED')?('Your order with following products has been failed.<br/>'):(''); ?>    
    
     <h2>Shipping Address:</h2>
     <div style="margin-left:20px;">       
      <?php echo $formatted_address;?>
      <br />
     <?php if( strcmp($status,'FAILED') !== 0 ) { ?>  
     If you need to make changes to your shipping address please call: Tel: 800-573-0052 (retail)
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
      <tr><td colspan=5><hr/></td></tr>
      <?php foreach ($product_details as $product_detail):?>
        <tr>
          <td><?php echo $product_detail['sku'];?></td>
          <td><?php echo $product_detail['name'];?></td>
          <td><?php echo displayData($product_detail['sell_price'], 'money');?></td>
          <td><?php echo $product_detail['quantity'];?></td>
        </tr>
        <tr><td colspan=5><hr/></td></tr>     
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
          <td align="right">$<?php echo $so_details['cart_total']; ?></td>
        </tr>
        <tr>
          <td colspan=3 align="right">Shipping:</td>
          <td align="right">$<?php echo $so_details['shipping']; ?></td>
        </tr>
        <tr>
          <td colspan=3 align="right">Discount:</td>
          <td align="right">-<?php echo $so_details['discount']; ?></td>
        </tr>
        <?php if($payment['tax']>0):?>
        <tr>
          <td colspan=3 align="right">Total Tax:</td>
          <td align="right">$<?php echo $so_details['tax']; ?></td>
        </tr>
        <?php endif;?>
        <tr>
          <td colspan=3 align="right">Total:</td>
          <td align="right">$<?php echo $so_details['total_amount']; ?></td>
        </tr>
    <?php endif; ?>
     </table>
     </div>
     
     
     
     