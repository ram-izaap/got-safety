
<div class="container_12">
	<div class="grid_12 mb40">
		<div id="shop-cart">
		<h1 class="mbt40 border-bot mb40"><?php echo $this->session->flashdata('message');?></h1>
		<div class="clear"></div>
		        <div class="cart-details">
		            <div class="order-num"><?php echo isset($so_details['id'])?("Order No.: <strong>{$so_details['id']}</strong>"):('');?></strong></div>
		            <div>Order placed on: 
		            	<span class="red">
		            		<?php  
		            		if(isset($so_details['created_date']))
		            		{
		            			$dateTime = date_create( $so_details['created_date'] );
		            			echo $dateTime->format("d F Y h:i:s A").' EST';
		            		}
		            		?>
		            	</span>
		            </div><br>
		            
		        </div>
		        <div class="billingshippingaddres" id="billing_address" >
		            <div class="billingshippingaddres-head">Billing Address</div>
		            <div style="text-transform:uppercase; padding:5px;"> 
		            	<address><strong><?php echo $billing['name']; ?></strong> <br><?php echo $billing['company_name']; ?><br><?php echo $billing['address']; ?> <br><?php echo $billing['city']; ?> <br><?php echo $billing['state']; ?> <br><?php echo $billing['zip_code']; ?> <br><abbr title="Phone">P:</abbr> <?php echo $billing['phone']; ?></address>		                
		            </div>
		        </div>
		        <div class="billingshippingaddres" id="shipping_address">
		            <div class="billingshippingaddres-head">Shipping Address</div>
		            <div style="text-transform:uppercase; padding:5px;"> 
		               <address><strong><?php echo $shipping['name']; ?></strong> <br><?php echo $shipping['company_name']; ?><br><?php echo $shipping['address']; ?> <br><?php echo $shipping['city']; ?> <br><?php echo $shipping['state']; ?> <br><?php echo $shipping['zip_code']; ?> <br><abbr title="Phone">P:</abbr> <?php echo $shipping['phone']; ?></address>		                
		            </div>
		        </div>
		        <div class="clear"></div>
		        <?php if(count($product_details)):?>         
		       <div class="grid_12">
		        <h2>Order Details</h2>

		        	<table summary="Employee Pay Sheet" id="box-table-a" width="100%">
		                <thead>
			                <tr>
				                <th width="5%" scope="col">Sr</th>
				                <th width="15%" scope="col">Product ID</th>
				                <th width="59%" scope="col">Product Name</th>
				                <th width="12%" scope="col">Unit Price</th>
				                <th width="9%" scope="col">Quantity</th>
			                </tr>
		                </thead>
		                <tbody>
		                	<?php $sno=1; foreach($product_details as $product_detail):?>					
							<tr>
				                <td><?php echo $sno++;?></td>
				                <td><?php echo $product_detail['sku'];?></td>
				                <td><?php echo $product_detail['name'];?></td>
				                <td><?php echo displayData($product_detail['sell_price'], 'money');?></td>
				                <td align="center"><?php echo $product_detail['quantity'];?></td>
			                </tr>							
							<?php endforeach;?>
		                
		                </tbody>
		            </table>
					<?php if(count($so_details)):?>
						<?php 
							$sub_total = (float)$so_details['cart_total'];
							$flag = 1;
						?>
		                <div class="floatR">
		                	<table cellspacing="0" cellpadding="0" class="basket-summary-table">
		                        <tbody>
		                          <tr>
		                            <td class="left-side">Sub Total (<?php echo ($so_details['total_items']>1)?($so_details['total_items'].' items'):($so_details['total_items'].'item');?> ) :</td>
		                            <td class="right-side"><?php echo '$'.number_format($sub_total,2);?></td>
		                          </tr>
		                          <tr>
		                            <td class="left-side">Shipping :</td>
		                            <td class="right-side"><?php echo '$'.number_format((float)$so_details['shipping'],2);?></td>
		                          </tr>
		                          <?php if(isset($so_details['tax']) && ceil($so_details['tax'])):?>
		                          <tr>
		                        	<td class="left-side">Tax :</td>
		                        	<td class="right-side green"><?php echo '$'.number_format((float)$so_details['tax'],2);?></td>
		                          </tr>
		                          <?php endif;?>
			                      <tr>
			                        <td class="left-side total-you-pay">Total Amount :</td>
			                        <td id="basket_total_price" class="right-side final-price"><?php echo '$'.number_format((float)$so_details['total_amount'],2);?></td>
			                      </tr>
		                    	</tbody>
		               		</table>
                		</div>
                	<?php endif;?>
                </div>
              <?php endif;?>
		    </div>
		    <div class="clear"></div>
		</div>
	</div>
</div>

