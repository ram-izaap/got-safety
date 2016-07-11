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
          <div class="form-group">
            <!--<div class="col-md-12">
              <select class="form-control input-lg payment_type" name="pay_type" id="pay_type" onchange="javascript:hide_card_details();">
                <option value="">Payment Type</option>
                <option value="authorize">Authorize Net</option>
                <option value="paypal">Paypal</option>
              </select>
            </div>-->
            <div class="col-md-12">
                <input type="radio" name="pay_type" id="pay_type" value="authorize" checked onchange="javascript:hide_card_details();">&nbsp;Authorize &nbsp;&nbsp; <input type="radio" name="pay_type" id="pay_type" value="paypal" onchange="javascript:hide_card_details();">&nbsp;Paypal
            </div>
          </div>
          <span class="vstar err_pay_type"></span>
          <div class="panel panel-info hide_cards" data-form="checkout">
            <div class="panel-body">
              <div class="form-group">
                <!--<div class="col-md-12">
                  <select class="form-control input-lg card_type" name="card_type" id="card_type">
                    <option value="">Card Type</option>
                    <option value="6">Visa</option>
                    <option value="7">MasterCard</option>
                    <option value="8">American Express</option>
                    <option value="9">Discover</option>
                  </select>
                </div>-->
                <div class="col-md-12">
                  <input type="radio" name="card_type" id="card_type" value="4" checked>&nbsp;Visa &nbsp;&nbsp; <input type="radio" name="card_type" id="card_type" value="3">&nbsp;MasterCard <br>
                  <input type="radio" name="card_type" id="card_type" value="0" >&nbsp;American Express &nbsp;&nbsp; <input type="radio" name="card_type" id="card_type" value="2">&nbsp;Discover 

                </div>
              </div>
              <span class="vstar err_card_type"></span>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="text" onblur="(this.value == '') &amp;&amp; (this.value = 'Name')" onfocus="(this.value == 'Name') &amp;&amp; (this.value = '')" placeholder="Name on Card" class="form-control input-lg" id="cc_name" name="cc_name">
                </div>
              </div>
              <span class="vstar err_cc_name"></span>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="text" onblur="(this.value == '') &amp;&amp; (this.value = 'Card Number')" onfocus="(this.value == 'Card Number') &amp;&amp; (this.value = '')" placeholder="Card Number" class="form-control input-lg" id="cc_number" name="cc_number">
                </div>
              </div>
              <span class="vstar err_cc_number"></span>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="text" onblur="(this.value == '') &amp;&amp; (this.value = 'Card CVV')" onfocus="(this.value == 'Card CVV') &amp;&amp; (this.value = '')" placeholder="Card CVV" class="form-control input-lg" id="cc_ccd" name="cc_ccd">
                </div>
              </div>
              <span class="vstar err_cc_ccd"></span>
              <div class="form-group">
                <div class="col-md-12">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 card-month">
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
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <select name="exp_year" id="exp_year" class="form-control input-lg exp_year">
                    <option value="">Expiry Year</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                  </select>
                </div>
              </div>
              <span class="vstar err_exp_date"></span>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <button class="btn btn-success btn-submit-fix btn-green" type="submit" id="check_before_order">
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
