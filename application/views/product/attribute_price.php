<div class="text-center">
      <span><?php echo "$".$values[0]['price']; ?></span>
    </div>
<div class="qty">
  <div class="col-sm-12 input-group number-spinner">
    <div class="pro-spinner">
      <span class="input-group-btn minus">
        <button class="btn btn-default" data-dir=dwn>
          <i class="fa fa-minus">
          </i>
        </button>
      </span>
      <input type="text" name="quantity" class="form-control text-center" value=1>
      <span class="input-group-btn">
        <button class="btn btn-default plus" data-dir=up>
          <i class="fa fa-plus">
          </i>
        </button>
      </span><br>
    </div>
  </div>
</div>
<div class="add-to-cart">
  <button type="button" class="add_to_cart">ADD TO CART
    <i class="fa fa-shopping-cart">
    </i>
  </button>
</div>
