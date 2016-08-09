<!-- // Content area -->
<section class="container content-area" data-view="list">
  <div class="row" data-row="default">
    <aside class="col-sm-12 bg-white inner-full">
      <div class="inner-content">
      <h1>Safety Forms
            </h1>
            <hr>
          <?php  if(count($safety_content)>0): ?>
          <div class="col-sm-12 col-md-12 content-bar">
          <?php echo ucfirst($safety_content->content); ?>
        </div>
          <?php endif; ?>
        
        <div class="safety_forms">

        <?php if(count($safety_attachment) >0): foreach($safety_attachment as $key=>$value): ?>
          <div class="col-sm-12 col-md-12 content-bar">
          <a href="<?php echo $img_url; ?>assets/images/frontend/safety_forms/<?php echo $value['pdf_file'];?>" target="_blank"><strong><?php echo $value['title']; ?> </strong></a>
        </div>
        <?php endforeach; endif; ?>  
        </div>
        </aside>
      </div>
 </section>
