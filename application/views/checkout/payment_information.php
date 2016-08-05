<!-- Right Bar -->
<form action="#" method="post" name="paymethod" id="paymethod" class="form-horizontal">
<input type="hidden" name="card_success">
  <div class="billing-details">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 card-payment">
      <!--CREDIT CART PAYMENT-->
      <div class="panel panel-info" data-form="checkout">
        <div class="panel-heading">
          <span>
            <i class="glyphicon glyphicon-lock">
            </i>
          </span>Secure Payment
        </div>
        <div class="panel-body">
        
          <div class="panel panel-info hide_cards" data-form="checkout">

            <div class="panel-body">
              <div class="form-group">
              <!--  -->
              <div class="plan-wrapper plan-checkout">

              <input type="radio" name="pay_type" id="pay_type-1" value="authorize" checked onchange="javascript:hide_card_details();"> 
              <label for="pay_type-1">
                Authorize
              </label>

              <input type="radio" name="pay_type" id="plan_type-2" value="paypal" onchange="javascript:hide_card_details();"> 
              <label for="plan_type-2">
                Paypal
              </label>

              </div>
              <!--  -->
                

                <!--<div class="col-md-12 cc-pay-type">
                  

              <div class="plan-wrapper plan-checkout">

                <input type="radio" name="card_type" id="pay_type-3" value="4" checked>
                <label for="pay_type-3">
                  Visa
                </label>

                <input type="radio" name="card_type" id="pay_type-4" value="3"> 
                <label for="pay_type-4">
                  MasterCard
                </label>

                <input type="radio" name="card_type" id="pay_type-5" value="0"> 
                <label for="pay_type-5">
                  American Express
                </label>

                <input type="radio" name="card_type" id="pay_type-6" value="2"> 
                <label for="pay_type-6">
                  Discover
                </label>

              </div>
        
              <hr />

                  <input type="radio" name="card_type" id="card_type" value="4" checked>&nbsp;Visa &nbsp;&nbsp; 
                  <input type="radio" name="card_type" id="card_type" value="3">&nbsp;MasterCard <br>
                  <input type="radio" name="card_type" id="card_type" value="0" >&nbsp;American Express &nbsp;&nbsp; 
                  <input type="radio" name="card_type" id="card_type" value="2">&nbsp;Discover 
                 </div>-->
              </div>
              <div class="form-group">
                <div class="col-md-12 cc-pay-type">
                  <input type="text" placeholder="Name on Card" class="form-control input-lg" id="cc_name" name="cc_name">
                </div>
                <span class="vstar err_cc_name"></span>
              </div>
              <div class="form-group">
                <div class="col-md-12 cc-pay-type">
                  <input type="text" placeholder="Card Number" class="form-control input-lg" id="cc_number" name="cc_number">
                </div>
                <span class="vstar err_cc_number"></span>
              </div>
              <div class="form-group">
                <div class="col-md-12 cc-pay-type">
                  <input type="text" placeholder="Card CVV" class="form-control input-lg" id="cc_ccd" name="cc_ccd">
                </div>
                <span class="vstar err_cc_ccd"></span>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 card-month cc-pay-type">
                  <select name="exp_month" id="exp_month" class="form-control input-lg exp_month">
                    <option value="">Expiry Month</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 card-month">
                  <select name="exp_year" id="exp_year" class="form-control input-lg exp_year">
                  <option value="">Expiry Year</option>
                    <?php 
                        for($i=date('Y');$i<=date('Y')+20;$i++){
                          $sel = ($i == @$cards['exp_year'])?('selected'):('');
                          echo "<option value='$i' $sel>$i</option>";
                        }
                    ?>
                  </select>
                </div>
                <span class="vstar err_exp_date"></span>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <button class="btn btn-success btn-submit-fix btn-green" type="button" onsubmit="javascript:return false();" id="check_before_order">
                    <i class="fa fa-hand-o-right">
                    </i>Place Order
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!--CREDIT CART PAYMENT END-->
        </div>
      </div>
    </div>
  </div>
</form>
