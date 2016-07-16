<div class="col-md-3 left-bar">
  <div class="gs-account radius-5">
    <a href="javascript:void(0);">
      <i class="fa fa-user">
      </i> My Account
    </a>
  </div>
  <div class="product-categories row">
    <h3>Product Categories
    </h3>
    <ul>
      <?php foreach($cat_data as $key=>$value): if($value['p_count']!=0): ?>
      <li class="<?php echo (isset($value['catid']) && $value['id']==$value['catid']) ?"active":""; ?>">
        <a href="<?php echo site_url(); ?>shop/<?php echo strtolower(str_replace(" ","-",$value["cat_name"])); ?>">
          <?php echo $value['cat_name']; ?>
          <span class="badge">
            <?php echo $value = ($value['p_count']!='')?$value['p_count']:'0'; ?>
          </span> 
        </a>
      </li>
      <?php endif; endforeach;  ?>
    </ul>
  </div>
</div>
