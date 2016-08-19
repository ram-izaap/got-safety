<h3 class="page-title">Add Promo Code</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li><i class="fa fa-home"></i><a href="<?php echo base_url("index.php/home"); ?>">Home</a>
				<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url("index.php/promo"); ?>">Promo Code</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>Add</li>
	</ul>
</div>
<div class="form-body">
	<?php if($this->session->flashdata('up_pay')==TRUE){?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?php echo $this->session->flashdata('up_pay');?>
		</div>
		<?php }?>
		<form action="<?=base_url();?>promo/add_edit_promo" method="post">
			<input type="hidden" name="promo_id" value="<?=$promo_id;?>">
			<div class="form-group">
				<label class="col-md-2 control-label">Code: <span class="required">*</span></label>
				<div class="col-md-10">
					<input type="text" name="code" class="form-control" value="<?=set_value('code',$promo['code']);?>">
					<span class="vstar"><?=form_error('code');?></span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Title: <span class="required">*</span></label>
				<div class="col-md-10">
					<input type="text" name="title" class="form-control" value="<?=set_value('title',$promo['title']);?>">
					<span class="vstar"><?=form_error('title');?></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-4 control-label">From Date: <span class="required">*</span></label>
						<div class="col-md-8">
							<input type="text" name="from_date" id="from" readonly="" class="form-control" value="<?=set_value('from_date',$promo['from_date']);?>">
							<span class="vstar"><?=form_error('from_date');?></span>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-4 control-label">To Date: <span class="required">*</span></label>
						<div class="col-md-8">
							<input type="text" name="to_date" id="to" readonly="" class="form-control" value="<?=set_value('to_date',$promo['to_date']);?>">
							<span class="vstar"><?=form_error('to_date');?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-4 control-label">Limit Per User: <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" name="limit_user" class="form-control" value="<?=set_value('limit_user',$promo['limit_per_user']);?>">
							<span class="vstar"><?=form_error('limit_user');?></span>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-6 control-label">Total Apply Limit: <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" name="total_limit" class="form-control" value="<?=set_value('total_limit',$promo['total_limit']);?>">
							<span class="vstar"><?=form_error('total_limit');?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-4 control-label">Type: <span class="required">*</span></label>
						<div class="col-md-6">
							<select name="discount_type" class="form-control">
								<option <?php echo set_select('discount_type','1',$promo['discount_type']=="1");?> value="1">Flat</option>
								<option <?php echo set_select('discount_type','2',$promo['discount_type']=="2");?> value="2">Percentage</option>					
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-6 control-label">
							<span class="dis_label">Amount</span>: <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" name="value" class="form-control" value="<?=set_value('value',$promo['value']);?>">
							<span class="vstar"><?=form_error('value');?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 control-label">Order Type: <span class="required">*</span></label>
				<div class="col-md-10">
					<select name="order_type" class="form-control">
						<option <?php echo set_select('order_type','1',$promo['order_type']=="1");?> value="1">Shopping</option>
						<option <?php echo set_select('order_type','2',$promo['order_type']=="2");?> value="2">Plans</option>
					</select>
				</div>
			</div>
			<div class="form-group spec_plan hide">
				<label class="col-md-2 control-label">
					<span>Plans</span>: <span class="required">*</span></label>
				<div class="col-md-10">
					<select aria-hidden="true" tabindex="-1" id="multiple" class="form-control select2-multiple select2-hidden-accessible" data-placeholder="Select Plans" multiple="" name="specific_plan[]">
           <?php
           if($plans)
           {
           	$p_id = explode(",",$promo['plans']);
           	foreach ($plans as $key => $value) 
           	{
           		?>
           			<option <?=set_select('specific_plan[]',$value['id'],in_array($value['id'], $p_id));?>
           			value="<?=$value['id'];?>"><?=$value['plan_type'];?></option>
           		<?php
           	}
           }
           ?>
	      </select>
	      <span class="vstar"><?=form_error('specific_plan[]');?></span>
				</div>
			</div>
			<div class="form-group shop-only">
				<label class="col-md-2 control-label">Offer Type: <span class="required">*</span></label>
				<div class="col-md-10">
					<select name="offer_type" class="form-control">
						<option <?php echo set_select('offer_type','1',$promo['offer_type']=="1");?> value="1">All Orders</option>
						<option <?php echo set_select('offer_type','2',$promo['offer_type']=="2");?> value="2">Shipping</option>
						<option <?php echo set_select('offer_type','3',$promo['offer_type']=="3");?> value="3">Specific Products</option>
					</select>
				</div>
			</div>
			<div class="form-group amount_over hide shop-only">
				<label class="col-md-2 control-label">Amount Over: <span class="required">*</span></label>
				<div class="col-md-10">
					<input type="text" class="form-control" name="amount_over" 
						value="<?=set_value('amount_over',$promo['offer']);?>">
					<span class="vstar"><?=form_error('amount_over');?></span>
				</div>
			</div>
			<div class="form-group spec_prod hide shop-only">
				<label class="col-md-2 control-label">
					<span>Products SKU</span>: <span class="required">*</span></label>
				<div class="col-md-10">
					<select aria-hidden="true" tabindex="-1" id="multiple" class="form-control select2-multiple select2-hidden-accessible" data-placeholder="Select Products" multiple="" name="specific_product[]">
           <?php
           if($products)
           {
           	$sku = explode(",",$promo['offer']);
           	foreach ($products as $key => $value) 
           	{
           		?>
           			<option <?=set_select('specific_product[]',$value['sku'],in_array($value['sku'], $sku));?>
           			value="<?=$value['sku'];?>"><?=$value['sku'];?></option>
           		<?php
           	}
           }
           ?>
	      </select>
	      <span class="vstar"><?=form_error('specific_product');?></span>
				</div>
			</div>
				<div class="form-group col-md-offset-2">
					<div class="col-md-2">
						<input type="submit" class="btn btn-primary" name="submit" value="Save">
					</div>
			</div>
		</form>
</div>