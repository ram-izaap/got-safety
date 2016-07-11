<h3 class="page-title">
  <?php echo $title;?>
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
      <a href="<?php echo base_url("index.php/product"); ?>">Product
      </a>
      <i class="fa fa-angle-right">
      </i>
    </li>
    <li>
      <?php echo $crumb;?>
    </li>
  </ul>
</div>
<div class="form-body">
  <div class="form-group">
    <label class="col-md-2 control-label">
      <strong>Product Name:
      </strong>
    </label>
    <div class="col-md-10">
      <label>
        <?php echo $product_dtl['name']; ?>
      </label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label">
      <strong>Category:
      </strong>
    </label>
    <div class="col-md-10">
      <label>
        <?php echo $product_dtl['cat_name']; ?>
      </label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label">
      <strong>Product Description:
      </strong> 
    </label>
    <div class="col-md-10">
      <label>
        <?php echo $product_dtl['desc']; ?>
      </label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label">
      <strong>Additional Information:
      </strong> 
    </label>
    <div class="col-md-10">
      <label>
        <?php echo $product_dtl['add_info']; ?>
      </label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label">
      <strong>Product SKU:
      </strong>
    </label>
    <div class="col-md-10">
      <label>
        <?php echo $product_dtl['sku']; ?>
      </label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label">
      <strong>Product Image:
      </strong> 
    </label>
    <div class="col-md-10">
      <label>
        <a target="_blank" href="<?php echo $img_url; ?>assets/product_images/<?php echo $product_dtl['img']; ?>" > 
          <?php echo $product_dtl['img']; ?> 
        </a>
      </label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label">
      <strong>Is Active:
      </strong>
    </label>
    <div class="col-md-10">
      <label>
        <?php echo $product_dtl['is_active']; ?>
      </label>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label">
      <strong>Attribute Type:
      </strong>
    </label>
    <div class="col-md-10">
      <label>
        <?php echo $attrname = (isset($attr_dtl[0]['attr_name']))?$attr_dtl[0]['attr_name']:"-"; ?>
      </label>
    </div>
  </div>
  <?php if(count($attr_dtl) > 0): ?>
  <table class="table table-striped table-bordered attr_table" id="example" style="margin-left:16px;width:49.7%">
    <thead>
      <tr>
        <th>S.No
        </th>
        <th>Attribute
        </th>
        <th>Amount
        </th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; foreach($attr_dtl as $key=>$value):  ?>
      <tr>
        <th scope="row">
          <?php echo $i; ?>
        </th>
        <td>
          <label>
            <?php echo $value['attr_val']; ?> 
          </label>
        </td>
        <td>
          <label>
            <?php echo $value['price']; ?> 
          </label>
        </td>
      </tr>
      <?php ++$i; endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>
</div>
