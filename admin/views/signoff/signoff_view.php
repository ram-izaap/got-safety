<ul class="view-details-signup">
	<li class="title-head">View Details</li>
<li><span>Topic:</span><span> <?php echo $result['title']; ?></span></li>
<li><span>Employee Name:</span><span><?php echo $result['employee_name']; ?></span></li>
<li><span>Employee ID:</span> <span><?php echo $result['emp_id']; ?></span></li>
<li><span>Email:</span> <span><?php echo $result['employee_email']; ?></span></li>
<li><span>Client:</span> <span><?php echo $result['name']; ?></span></li>
<li><span>Date:</span> <span><?php echo $result['created_date']; ?></span></li>
<li><span>Signature:</span> <span><img src="<?php echo $img_url.'/signature/'.$result['sign'];?>" alt="<?php echo $result['employee_name']; ?>" height="120" width="250"></span></li>
</ul>
<div class="col-md-12">
<a href="<?php echo site_url('signoff'); ?>" class="btn-back">Back</a>
</div>
  		 	 	 
