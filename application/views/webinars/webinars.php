 <!-- // Content area -->
         <section class="container content-area" data-view="list">
         <!-- rwo default --> 
          <div class="row" data-row="default">

               <aside class="col-sm-12 bg-white inner-full">
                 <div class="inner-content text-center">                     
                   
                     <div class="btn btn-danger"> Previous Webinars</div>

                     <div class="row form-group">                     

                      <select class="form-control" onchange="change_webinars(this.value)" id="webinarslist" name="webinarslist">
                        <option  value="">Please select webinar</option>
                        <?php foreach($all_data as $data) { ?>
                           <option value="<?php echo $data['id'];?>"><?php echo $data['created_date'];?> - <?php echo $data['title'];?></option>
                        <?php } ?>
                       </select>
                     </div>  

                     <div id="content-load">
                     <div class="content-bar">
                       <?php  if(count($all_data)>0): ?>
                         <iframe width="560" height="315" src="<?php echo strip_tags($most_data[0]['link']);?>" frameborder="0" allowfullscreen></iframe>
                      <?php endif; ?>
                     </div>
                     <div class="clearfix"></div>
         
                     <?php if(isset($most_data[0]['web_desc']) && $most_data[0]['web_desc']!=''): ?>
                      
                      <div class="col-sm-12 col-md-12 content-bar">
                        
                        <?php echo $most_data[0]['web_desc']; ?>
                      
                      </div>
                     
                     <?php endif; ?>

                    <!--  Right menu  -->
                     
                 </div>

           </aside>

            <!-- rwo default --> 
          </div>
          
         </section>
    <!-- Content area // -->
    
    
    <script>
    
    function change_webinars(id) 
    {
		$.ajax({

             url: '<?php echo base_url() ?>index.php/webinars/get_webinars_data/', 
             type: 'POST',
             dataType:'json',
             data: {'view_param': id},
             success: function(response)
             {

                $('#content-load').html(response.html_view);

             }
		});
	}
    
    
    </script>
    
<style>
#webinarslist{width:50%; margin:auto; margin-top:10px;}
</style>
