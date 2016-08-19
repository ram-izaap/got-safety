<h3 class="page-title">
  Manage Promo Code
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
      <a href="<?php echo base_url("index.php/promo"); ?>">Manage Promo Code
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
            <div class="col-md-12">
              <div class="panel panel-default order-summary" style="width:100%;">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-condensed table-stripped table-hover table-hg" >
                      <thead>
                        <tr>
                          <td width="10"><strong>SNO</strong></td>
                          <td class="text-center"><strong>Coupon Name</strong></td>
                          <td class="text-center"><strong>Title</strong></td>
                          <td class="text-right"><strong>Is Active</strong></td>
                          <td class="text-center"><strong>Date</strong></td>
                          <td><strong>Action</strong></td>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                        <?php $sno=1; 
                        if($coupons){
                        foreach($coupons as $detail):?>         
                        <tr>
                          <td><?php echo $sno++;?></td>
                          <td class="text-center"><?php echo $detail['code'];?></td>
                          <td class="text-center"><?php echo $detail['title'];?></td>
                          <td class="text-right">
                            <?php 
                              if($detail['is_active']=="0")
                                echo "Active";
                              else 
                                echo "Inactive";
                            ?>
                          </td>
                          <td class="text-center"><?php echo displayData($detail['created_date'],'datetime');?></td>
                          <td>
                            <a href="<?=base_url();?>promo/add_edit_promo/<?=$detail['coupon_id'];?>"><i class="fa fa-pencil"></i></a>
                              &nbsp;&nbsp;&nbsp;
                            <a href="javascript:void(0);" data-target="#DeleteModal" 
                              data-toggle="modal" data-id="<?=$detail['id'];?>" class="delete-coupon">
                              <i class="fa fa-remove"></i>
                            </a>
                          </td>
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
<div id="DeleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Coupon</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure want to delete this coupon?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Close</button>
        <a href="#" class="btn btn-primary remove-coupon">Delete</a>
      </div>
    </div>
  </div>
</div>