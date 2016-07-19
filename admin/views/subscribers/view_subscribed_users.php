<h3 class="page-title">
  Subscribed Users
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
      <a href="<?php echo base_url("index.php/subscribers"); ?>">Subscribed Users
      </a>
      <i class="fa fa-angle-right">
      </i>
    </li>
    <li>
      View
    </li>
  </ul>
</div>
<section class="container content-area content-order-area" data-view="about">
  <!-- rwo default --> 
  <div class="row" data-row="default">
    <aside class="col-sm-12 bg-white inner-full">
      <div class="inner-content clearfix">
        
        <!-- // Order Invoice  -->
        <div class="order-invoice-wrapper">
          
          <div class="row">
            <div class="col-xs-12">
            <!--<div class="row">
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
                <div class="col-md-3">
                   <h3><strong>Paid Status</strong>
                  <div class="clearfix"></div>
                  <?php echo ($so_details['paid_status']=='Y')?'Yes':'No'; ?>
                  </h3>
                  </div>
            </div>-->
                <div class="row">
                <div class="col-xs-6">
                  <address>
                    <strong>User Information:</strong><br>
                    	<strong><?php echo $info[0]['fname']." ".$info[0]['lname']; ?></strong> <br>
                    	<?php echo $info[0]['address']; ?> <br>
                    	<?php echo $info[0]['city']; ?> <br>
                    	<?php echo $info[0]['state']; ?> <br>
                    	<?php echo $info[0]['zipcode']; ?> <br>
                    	<abbr title="Phone">Ph:</abbr> <?php echo $info[0]['phone']; ?>
                  </address>
                </div>
                <div class="col-xs-6">
                  <address>
                    <strong>Plan Details:</strong><br>
                    <strong><?php echo ucwords($info[0]['plan_name']); ?></strong><br>
                    <?php echo "$".number_format($info[0]['plan_amount'],2); ?> <br>
                    <?php echo strip_tags($info[0]['plan_desc']); ?> <br>
                    Profile ID : 
                    <?php 
                    	if( $info[0]['payment_method']=="paypal")
                    		echo  $info[0]['profile_id'];
                    	else
                    		echo  $info[0]['subscription_id'];
                    		 ?> <br>
                    <?php  
                    	$status= $info[0]['profile_status']; 
                    	if($status=="Active")
                    		echo "<span class='btn btn-info'>".$status."</span>";
                    	else
                    		echo "<span class='btn btn-danger'>".$status."</span>";
                    ?> <br>

                  </address>
                </div>
              </div>
              
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default order-summary" style="width:100%;">
                <div class="panel-heading">
                  <h3 class="panel-title">
                    <strong>Transaction summary
                    </strong>
                  </h3>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-condensed table-stripped table-hover table-hg" >
                      <thead>
                        <tr>
                          <td width="10">
                            <strong>SNO
                            </strong>
                          </td>
                          <td class="text-center">
                            <strong>Transaction ID
                            </strong>
                          </td>
                          <td class="text-center">
                            <strong>Amount
                            </strong>
                          </td>
                          <td class="text-right">
                            <strong>Status
                            </strong>
                          </td>
                          <td class="text-right">
                            <strong>Date
                            </strong>
                          </td>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                        <?php $sno=1; 
                        if($trans){
                        foreach($trans as $detail):?>         
                        <tr>
                          <td><?php echo $sno++;?></td>
                          <td class="text-center"><?php echo $detail['trans_id'];?></td>
                          <td class="text-center"><?php echo displayData($detail['last_payment_amt'],'money');?></td>
                          <td class="text-right"><?php echo $detail['status'];?></td>
                          <td class="text-right"><?php echo displayData($detail['created_date'],'datetime');?></td>
                        </tr>             
                        <?php $sno++;endforeach;}?>
                        
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
