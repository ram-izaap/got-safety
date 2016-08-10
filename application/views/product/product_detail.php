<section class="container content-area" data-view="product-details">
  <!-- rwo default --> 
  <div class="row" data-row="default">
    <aside class="col-sm-12 bg-white inner-full">
      <div class="inner-content sidebar-fixed">
        <!-- Left Bar -->
        <?php 
           $this->load->view("product/left_sidebar",$this->data['cat_data']);
        ?>
        <!-- -->
        <div class="col-sm-12 col-md-6 content-bar">
        
          <div class="pro-details ">
          
          <a href="<?php echo site_url('cart'); ?>">
           <div class="product-bag radius-5 clearfix visible-xs visible-sm add-cart cart_item">
            <div class="row">
              <div class="col-xs-6 subtotal">$0.00
              </div>
              <div class="col-xs-6 items">0 item 
                <i class="fa fa-shopping-cart">
                </i>
              </div>
            </div>
           </div>
          </a>
          

            <div class="row visible-xs visible-sm aside-pannel">
              
              <div class="sidebar">
                <div class="mini-submenu tab-view">
                  <span class="icon-bar">
                  </span>
                  <span class="icon-bar">
                  </span>
                  <span class="icon-bar">
                  </span>
                </div>
                <div class="list-group col-xs-12 tab-menu">
                  
                  <div class="list-group-item active aside_bar">
                    Submenu
                    <span class="pull-right" id="slide-submenu">
                      <i class="fa fa-times">
                      </i>
                    </span>
                  </div>
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
            <?php if(count($attr_dtl) >0): ?>
            <?php
            $cur_val = current($attr_dtl);
            $cur_val = key($attr_dtl);
            $end_val = end($attr_dtl);
            $end_val = key($attr_dtl);
            ?>
            <div class="col-xs-12">
              <h3>
                <?php echo $product_dtl['name']; ?>
              </h3>
              <hr />
            </div>
            <div class="col-sm-5 col-md-5">
              <div class="product-poster">
                <img src="<?php echo $img_url; ?>assets/product_images/<?php echo $product_dtl['img']; ?>" data-src="<?php echo $img_url; ?>assets/product_images/<?php echo $product_dtl['img']; ?>" alt="<?php echo $product_dtl['name']; ?>" class="">                         
                <?php if(count($attr_dtl)==1 || $attr_dtl[$cur_val]['price']==$attr_dtl[$end_val]['price']){ ?>
                <div class="block-price mprice-bar">
                  <strong>
                    <?php echo $attr_dtl[$cur_val]['price']; ?>
                  </strong>
                </div>
                <?php } else if(count($attr_dtl) > 1){ ?>
                <div class="block-price multi_price mprice-bar">
                  <strong> &nbsp;<?php echo ($attr_dtl[$cur_val]['price'] < $attr_dtl[$end_val]['price'])? $attr_dtl[$cur_val]['price'] . ' - '. $attr_dtl[$end_val]['price']: $attr_dtl[$end_val]['price'] . ' - ' .$attr_dtl[$cur_val]['price']; ?>&nbsp;</strong>
                </div>
                <?php }?>
                <!--<div data-cover="gs-english">
                </div>-->
              </div>
            </div>
            <div class="col-sm-7 col-md-7">
              <div class="pro-description">
                <h5><b>Product Description </b>
                </h5>
                <div class="pro_desc">
                <p>
                  <?php echo $product_dtl['desc']; ?>
                </p>
                </div>
                <p>SKU:<?php echo $product_dtl['sku']; ?>
                </p>

                <form name="product_attribute" id="product_attribute" method="post" action="#" onsubmit="javascript:return false;">
                    <input type="hidden" name="p_id" value="<?php echo $product_dtl['id']; ?>">
                    <?php if(count($attr_dtl) >0) : ?>
                    <!--<label>
                      <?php echo $attrname = (isset($attr_dtl[0]['attr_name']))?$attr_dtl[0]['attr_name']:"-"; ?>
                    </label>-->

                    <div data-role="sorting"  class="product-size">
                    <select name="label_size" class="sel_label_size" id="label_size">
                      <option value="" variationid=''>Choose Your <?php echo $attrname; ?> 
                      </option>
                      <?php foreach($attr_dtl as $key=>$value): ?>
                      <option value="<?php echo $value['id']; ?>" variationid="<?php echo $value['id1']; ?>">
                        <?php echo $value['attr_val']; ?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                    </div>
                    <?php endif; ?>
                    <div id="attr_price">
                    </div>
                </form>

              </div>
            </div>
                      <?php endif; ?>

          </div>

          <?php if(!count($attr_dtl)): ?>
             <h2>No Product Found</h2><hr>
          <?php endif; ?>
          <div class="col-sm-12 marginT-20 padding-xs">
            <div class="review-section">
              <h3>Client Reviews
              </h3>
              <hr />
              <div class="user-reviews">
                
                <div class="clear"></div>

                <!--  -->
                <div class="star-rating">
                   <div id="" class="reviewer-name"><b>Syed</b></div>
                   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry </p>
                   <div class="profile-img">
                      <img src="<?php echo site_url(); ?>assets/images/frontend/profile-img.jpg" alt="" class="img-responsive">
                   </div>
                   <hr />
                </div>

                <div class="star-rating">
                   <div class="reviewer-name"><b>Syed</b></div>
                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus explicabo asperiores sed ipsa odio iure consequuntur ipsum numquam doloribus fugiat molestias dolor praesentium totam repellendus placeat, voluptatem debitis iusto, suscipit dolores eveniet similique magni aliquam veniam repudiandae? Dolor reiciendis maiores corporis non soluta quidem corrupti doloremque, ea ab, earum velit placeat inventore veritatis eius incidunt repellat magni odit itaque veniam. Doloremque repudiandae ex quaerat id aperiam quis rem illo quas voluptate ratione consequatur dicta dolorem deleniti, culpa dolor voluptatem illum nobis aspernatur libero corporis incidunt labore adipisci vitae repellendus. Dignissimos autem fugiat ut quisquam repellat aut incidunt hic veniam ratione!</p>
                   <div class="profile-img">
                      <img src="<?php echo site_url(); ?>assets/images/frontend/profile-img.jpg" alt="" class="img-responsive">
                   </div>
                   <hr />
                </div>
                <!--  -->
                <div class="review-form" data-form="suggestion">
                  <h3>Reviews
                  </h3>
                  <div id="stars" class="starrr star-vote">
                    <span>Your Rating
                    </span>
                  </div>
                  <form role="form">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" name="first_name" id="first_name" class="form-control input-lg" value="First Name" onfocus="(this.value == 'First Name') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'First Name')">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" name="last_name" id="last_name" class="form-control input-lg" value="Last Name" onfocus="(this.value == 'Last Name') &amp;&amp; (this.value = '')" onblur="(this.value == '') &amp;&amp; (this.value = 'Last Name')">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control input-lg" placeholder="Lesson Suggestion">Lesson Suggestion
                      </textarea>
                    </div>
                    <input type="submit" value="submit your review" class="btn btn-danger btn-block client-login">
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          
          <!-- -->
        </div>
        <!-- Right Bar -->
        <div class="col-sm-12 col-md-3 right-bar hidden-xs hidden-sm">
          <div class="product-bag radius-5 clearfix cart_item">
            <div class="row">
              <div class="col-xs-6 subtotal">$0.00
              </div>
              <div class="col-xs-6 items">0 item 
                <i class="fa fa-shopping-cart">
                </i>
              </div>
            </div>
          </div>
          <div id="add_to_cart">
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
    <!-- rwo default --> 
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
		  <a class="btn btn-sm btn-danger" href="<?php echo site_url('shop');?>">
        <i class="fa fa-hand-o-right">
        </i>
        Continue Shopping
      </a>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Ok
        </button>
      </div>
    </div>
  </div>
</div>

