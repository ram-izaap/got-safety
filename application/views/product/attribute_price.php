<!--<div class="quantity">
  <input type="number" step="1" name="quantity" value="1" title="Qty" class="form-control"  min="1">
</div>
<h4>Price: 
  <?php echo $values[0]['price']; ?>
</h4>
<p class="text-right">
  <a href="#" class="add_to_cart">Add to Cart
  </a>
</p>-->


<div class="qty">
  <div class="col-sm-6" data-role="sorting">
    <select>
      <option>Popularity
      </option>
    </select>
  </div>
  <div class="col-sm-6 input-group number-spinner">
    <div class="pro-spinner">
      <span class="input-group-btn minus">
        <button class="btn btn-default" data-dir="dwn">
          <i class="fa fa-minus">
          </i>
        </button>
      </span>
      <input type="text" name="quantity" class="form-control text-center" value="1">
      <span class="input-group-btn">
        <button class="btn btn-default plus" data-dir="up">
          <i class="fa fa-plus">
          </i>
        </button>
      </span><br>
      <span><?php echo $values[0]['price']; ?></span>
    </div>
  </div>
</div>
<div class="add-to-cart">
  <button type="button" class="add_to_cart">ADD TO CART
    <i class="fa fa-shopping-cart">
    </i>
  </button>
</div>
