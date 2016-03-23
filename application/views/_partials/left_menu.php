
<div class="list-categories bg-red row">
	<h3>Menu Categories</h3>
	  <ul>
		  <li <?php if($this->uri->segment(1) == 'lesson') { ?> class="active"; <?php }?>><a href="<?php echo base_url("lesson");?>">Safety Lessons</a></li>
		  <li <?php if($this->uri->segment(2) == 'inspection') { ?> class="active"; <?php }?>><a href="<?php echo base_url("menu/inspection");?>">Inspection Reports </a></li>
		  <li <?php if($this->uri->segment(2) == 'osha') { ?> class="active"; <?php }?>><a href="<?php echo base_url("menu/osha");?>">Cal / OSHA Documentation</a></li>
		  <li <?php if($this->uri->segment(2) == 'logs') { ?> class="active"; <?php }?>><a href="<?php echo base_url("menu/logs");?>">300 Logs </a></li>
		  <li <?php if($this->uri->segment(2) == 'records') { ?> class="active"; <?php }?>><a href="<?php echo base_url("menu/records");?>">Training Records </a></li>
		  <li ><a target="_blank" href="<?php echo $img_url; ?>assets/images/frontend/inspection_reports/Spanish_ATV_Safety-Quiz.pdf">Accident Reporting </a></li>
		  <li <?php if($this->uri->segment(2) == 'forms') { ?> class="active"; <?php }?>><a href="<?php echo base_url("menu/forms");?>">Safety Forms </a></li>
		  <li <?php if($this->uri->segment(1) == 'posters') { ?> class="active"; <?php }?>><a href="<?php echo base_url("posters");?>">Safety Posters </a></li> 
	  </ul>
</div>
