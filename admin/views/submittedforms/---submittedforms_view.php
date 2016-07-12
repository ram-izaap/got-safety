<ul class="view-details-signup">
	<li class="title-head">View Details</li>

<li><span>Title:</span><span><?php echo $result['title']; ?></span></li>
<li><span>User Name:</span><span><?php echo $this->data['user_result']->name; ?></span></li>
<li><span>Client Name:</span> <span><?php echo $result['name']; ?></span></li>
<li><span>User Email:</span> <span><?php echo $this->data['user_result']->email; ?></span></li>
<li><span>Submitted Date:</span> <span><?php echo $result['created_date']; ?></span></li>
<li><span>Submitted File:</span> <span><a  target="_blank" href="<?php echo $img_url; ?>assets/images/frontend/submitted_forms/<?php echo $result['file_name'];?>" height="70px;" width="100px;"> <?php echo $result['file_name'];?> </a></span></li>
<li><span>Signature:</span> <span><img src="<?php echo $img_url.'/forms_signature/'.$result['sign'];?>" alt="<?php echo $this->data['user_result']->name; ?>" height="120" width="250"></span></li>

</ul>
<div class="col-md-12">
<a href="<?php echo site_url('submittedforms'); ?>" class="btn-back">Back</a>
</div>
  		 	 	 
