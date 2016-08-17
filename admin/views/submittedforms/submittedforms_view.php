

<ul class="view-details-signup">
	<li class="title-head">View Details</li>

<li><span>Client Name :</span><span><?php echo $result['name']; ?></span></li>
<li><span>Form Type :</span> <span><?php echo $result['type']; ?></span></li>
<li><span>File:</span> <span><a href="../../../members/<?php echo $result['name']; ?>/records/<?php echo date("Y"); ?>/<?php echo $result['filename']; ?>"><?php echo $result['filename']; ?></a></span></li>
<li><span>Date:</span> <span><?php echo $result['created_date']; ?></span></li>
</ul>
<div class="col-md-12">
<a href="<?php echo site_url('submittedforms'); ?>" class="btn-back">Back</a>
</div>
  		 	 	 
