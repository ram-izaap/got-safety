<section class="container" data-view="list">
          
	<div class="row" data-row="default" >
	
		 
		 <div class="col-sm-12 col-md-6 content-bar"> 
               
			<iframe width="560" height="315" src="<?php echo strip_tags($view_link[0]['link']);?>" frameborder="0" allowfullscreen></iframe>
           
         </div>

         <div class="clearfix"></div>
         
         <?php if(isset($view_link[0]['web_desc']) && $view_link[0]['web_desc']!=''): ?>
          
          <div class="col-sm-12 col-md-12 content-bar">
            
            <?php echo $view_link[0]['web_desc']; ?>
          
          </div>
         
         <?php endif; ?>
		
	 </div>	
	
	
 </section>


