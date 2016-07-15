<ul class="view-details-signup">
	<li class="title-head">View Details</li>
<li><span>Plan type:</span><span> <?php echo Ucfirst($plan_detail[0]['plan_name']); ?></span></li>
<li><span>Amount:</span><span><?php echo $plan_detail[0]['plan_amount']; ?></span></li>
<li><span>Plan description:</span> <span><?php echo $plan_detail[0]['plan_desc']; ?></span></li>

</ul>
<div class="col-md-12">
<a href="<?php echo site_url('home'); ?>" class="btn-back">Back</a>
</div>
  		 	 	 
