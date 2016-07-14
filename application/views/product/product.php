<!-- // Content area -->
<section class="container content-area" data-view="list">
  <!-- rwo default --> 
  <div class="row" data-row="default">
    <aside class="col-sm-12 bg-white inner-full">
      <div class="inner-content">
        <!-- Left Bar -->
        <?php 
          $this->load->view("product/left_sidebar",$this->data['cat_data']);
        ?>
        <!-- -->
        <div class="col-sm-6 content-bar">
          <h3>Products 
            <div data-role="sorting">
              Sort By -   
              <select>
                <option>Popularity
                </option>
              </select>
            </div>
          </h3>
          <hr />
          <div class="product-containet">
            <?php foreach($product_detail as $key=>$value): if($value['is_active']==1) : ?>
            <div class="product-loop" data-item="single">
              <div class="block clearfix">
                <div class="col-sm-6">
                  <div class="block-image">
                    <a href="<?php echo site_url(); ?>product/product_detail/<?php echo $value['id']; ?>">
                      <img data-src="<?php echo $img_url; ?>assets/product_images/<?php echo $value['img']; ?>" alt="<?php echo $value['name']; ?>" width="" height="" class=""/>
                    </a>
                      <?php
                        $cur_val = current($product_variation[$value['id']]);
                        $cur_val = key($product_variation[$value['id']]);
                        $end_val = end($product_variation[$value['id']]);
                        $end_val = key($product_variation[$value['id']]);
                      ?>  
                      <?php if(count($product_variation[$value['id']])==1 || $product_variation[$value['id']][$cur_val]==$product_variation[$value['id']][$end_val]){ ?>
                      <div class="block-price">
                        <strong>
                          <?php echo $product_variation[$value['id']][$cur_val]; ?>
                        </strong>
                      </div>
                      <?php } else if(count($product_variation[$value['id']]) > 1){ ?>
                      <div class="block-price">
                        <strong>
                          <?php echo ($product_variation[$value['id']][$cur_val] < $product_variation[$value['id']][$end_val])?$product_variation[$value['id']][$cur_val] .'-'.$product_variation[$value['id']][$end_val]:$product_variation[$value['id']][$end_val] .'-'.$product_variation[$value['id']][$cur_val]; ?>
                        </strong>
                      </div>
                      <?php }?>
                     <?php /* <div data-cover="gs-english">
                      </div> */ ?>
                      </div> 
                  </div>
                  <div class="col-sm-6">
                    <h4>
                      <a href="<?php echo site_url(); ?>product/product_detail/<?php echo $value['id']; ?>">“
                        <?php echo $value['name']; ?>”
                      </a>
                    </h4>
                    <p class="text-right">
                      <a href="<?php echo site_url(); ?>product/product_detail/<?php echo $value['id']; ?>">
                        <i class="fa fa-hand-o-right">
                        </i> Select Options
                      </a>
                    </p>
                  </div>
                </div>
              </div>
              <?php endif; endforeach; ?>
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
      </div>
    </section>
