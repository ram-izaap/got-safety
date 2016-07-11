<section class="container content-area" data-view="list">
  <div class="row" data-row="default">
    <aside class="col-sm-12 bg-white inner-full">
      <div class="inner-content">
        <?php 
           $this->load->view("product/left_sidebar",$this->data['cat_data']);
        ?>
        <div class="col-sm-6 content-bar">
          <h3>Products 
          </h3>
          <hr/>
          <div class="product-containet">
            <div class="product-loop" data-item="single">
              <div class="block clearfix">
                <div class="col-sm-6">
                  <div class="block-image">
                    <img data-src="<?php echo $img_url; ?>assets/product_images/<?php echo $product_dtl['img']; ?>" alt="<?php echo $product_dtl['name']; ?>" width="" height="" class=""/>
                    <?php
                      $cur_val = current($attr_dtl);
                      $cur_val = key($attr_dtl);
                      $end_val = end($attr_dtl);
                      $end_val = key($attr_dtl);
                    ?>
                    
                    <?php if(count($attr_dtl)==1){ ?>
                    <div class="block-price">
                      <strong>
                        <?php echo $attr_dtl[$cur_val]['price']; ?>
                      </strong>
                    </div>
                    <?php } else if(count($attr_dtl) > 1){ ?>
                    <div class="block-price">
                      <strong>
                        <?php echo $attr_dtl[$cur_val]['price'] .'-'.$attr_dtl[$end_val]['price']; ?>
                      </strong>
                    </div>
                    <?php }?>
                  </div> 
                </div>
                <div class="col-sm-6">
                  <h4>Name: 
                    <?php echo $product_dtl['name']; ?>
                  </h4>
                  <h4>Description: 
                    <?php echo $product_dtl['desc']; ?>
                  </h4>
                  <h4>SKU: 
                    <?php echo $product_dtl['sku']; ?>
                  </h4>
                  <h4>Category: 
                    <?php echo $product_dtl['cat_name']; ?>
                  </h4>
                  <h4>Additional Information: 
                    <?php echo $product_dtl['add_info']; ?>
                  </h4>
                  <form name="product_attribute" id="product_attribute" method="post">
                    <input type="hidden" name="p_id" value="<?php echo $product_dtl['id']; ?>">
                    <?php if(count($attr_dtl) >0) : ?>
                    <label>
                      <?php echo $attrname = (isset($attr_dtl[0]['attr_name']))?$attr_dtl[0]['attr_name']:"-"; ?>
                    </label>
                    <select name="label_size" class="sel_label_size" id="label_size">
                      <option value="">Choose an option
                      </option>
                      <?php foreach($attr_dtl as $key=>$value): ?>
                      <option value="<?php echo $value['id']; ?>" variationid="<?php echo $value['id1']; ?>">
                        <?php echo $value['attr_val']; ?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                    <?php endif; ?>
                    <div id="attr_price">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Right Bar -->
        <div class="col-sm-6 col-md-3 right-bar cart_item">
          <div class="product-bag radius-5 clearfix">
            <div class="row">
              <div class="col-xs-6 subtotal">$0.00
              </div>
              <div class="col-xs-6 items">0 items 
                <i class="fa fa-shopping-cart">
                </i>
              </div>
            </div>
          </div>
          <div id="add_to_cart" style="display:none;">
          </div>
          <div class="" data-nav="gs-attendance">
            <ul>
              <li>
                <a href="javascript:void(0);">Broucher Downloads 
                </a>
              </li>
              <li>
                <a href="javascript:void(0);">Free Safety Evaluation 
                </a>
              </li>
              <li>
                <a href="javascript:void(0);">Free OSHA Citation Review 
                </a>
              </li>
              <li>
                <a href="javascript:void(0);">Forkit Certifications 
                </a>
              </li>
              <li>
                <a href="javascript:void(0);">FAQ’S 
                </a>
              </li>
              <li>
                <a href="javascript:void(0);">Industries Serviced 
                </a>
              </li>
              <li>
                <a href="javascript:void(0);">Safety Blog 
                </a>
              </li>
              <li>
                <a href="javascript:void(0);"> Accident Reporting
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </aside>
  </div>
</section>

<!-- Add to Cart Success Modal Popup -->
<div class="modal fade" id="add_cart_modal" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" >
  <div class="modal-dialog1">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
        </button>
        <h4 class="modal-title">Success
        </h4>
      </div>
      <div class="modal-body">
        <p>Product Successfully Added to Cart
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok
        </button>
      </div>
    </div>
  </div>
</div>
