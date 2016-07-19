<?php 
if(isset($_SESSION['renew_succ']))
{?>
<div class="alert alert-success alert-dismisable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<?php echo $_SESSION['renew_succ'];
		unset($_SESSION['renew_succ']);?>
</div>
<?php 
}?>

<ul class="view-details-signup">
	<li class="title-head">View Details</li>
<li><span>Plan type:</span><span> <?php echo Ucfirst($plan_detail[0]['plan_name']); ?></span></li>
<li><span>Amount:</span><span><?php echo "$".number_format($plan_detail[0]['plan_amount'],2); ?></span></li>
<li><span>Plan description:</span> <span><?php echo strip_tags($plan_detail[0]['plan_desc']); ?></span></li>
<li style="padding:10px;"><span>Plan Status:</span> 
	<?php 
	if($plan_detail[0]['profile_status']=="Inactive"){?>
		<span class="btn btn-danger"><?php echo $plan_detail[0]['profile_status']; ?></span>
	<?php }else{ ?>
	<span class="btn btn-info"><?php echo $plan_detail[0]['profile_status']; ?></span>
	<?php }?>
</li>
<li>
	<span style="padding:10px;">
	<?php 
	if($plan_detail[0]['profile_status']=="Inactive"){?>
		<a href="javascript:void();" class="btn btn-success" onclick="show_payment();">
		<i class="fa fa-plus" ></i>Renew Subscription</a>
	<?php }else{?>
		<a href="javascript:void();"
		data-href="<?php echo base_url();?>user/cancel_subscription/<?php echo $_SESSION['admin_data']['id'];?>" onclick="cancel_sub(this);" class="btn btn-success">
		<i class="fa fa-remove"></i>Cancel Subscription</a>
		<?php }?>
	</span>
</li>
</ul>
<br>
<div class="row col-md-12">
<?php 
$id= $_SESSION['admin_data']['id'];
if( (form_error('c_number')!="" || form_error('cvv')!="") )
	$disp= "display:block;";
else
	$disp= "display:none;";
?>
	<div class="payment-info col-md-7" style="<?php echo $disp;?>margin-left:23%;">
		<form action="<?php echo base_url();?>user/renew_subscription/<?php echo $id;?>"
			method="post">
			<input type="hidden" name="pay_method" value="<?php echo $plan_detail[0]['payment_method']; ?>"  >
				<div class="form-group">
					<label class="col-md-4 control-label">Current Plan: 
					</label>
					<div class="col-md-8">
						<?php 
							echo Ucfirst($plan_detail[0]['plan_name']);
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Chooe Other Plan: 
					</label>
					<div class="col-md-8">
						<?php 
						 $cp = $plan_detail[0]['plan_id'];
							foreach ($plans as $key => $value) 
							{
								$np =  $value['id'];
								$price =  $value['plan_amount'];
								$type =  $value['plan_type'];
								?>
									<label class="pull-left">
										<input type="radio" name="plan_name" value="<?php echo $np;?>"
										data-price="<?php echo $price;?>" data-type="<?php echo $type;?>"
										<?php if($cp==$np){ ?> checked <?php }?> >
										<?php echo $value['plan_type']."( $".$value['plan_amount'].")";?>
									</label>
								<?php
							}
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Amount: 
					</label>
					<div class="col-md-8">
						<span class="plan-amt"> 
						<?php 
							echo "$".number_format($plan_detail[0]['plan_amount'],2);
						?>
						</span>
						<input type="hidden" name="amount" class="ip_amt"
							value="<?php echo $plan_detail[0]['plan_amount'];?>">
							<input type="hidden" name="desc" class="ip_type"
							value="<?php echo $plan_detail[0]['plan_name'];?>">
					</div>
				</div>
				<?php 
				if($plan_detail[0]['payment_method']=="Authorize")
				{?>
				<div class="form-group">
					<label class="col-md-4 control-label">Card Number: 
						<span class="required">	* </span>
					</label>
					<div class="col-md-8">
					 <input type="text" class="form-control input-md" name="c_number" maxlength="16"
					 value="<?php echo set_value('c_number',$form_data['c_number']); ?>">
					 <span class="vstar"<?php echo form_error('c_number', '<span class="help-block">', '</span>'); ?> </span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">CVV: <span class="required">	* </span>
					</label>
					<div class="col-md-8">
						<input type="text" class="form-control input-md" name="cvv" maxlength="3"
						value="<?php echo set_value('cvv',$form_data['cvv']); ?>">
						<span class="vstar"<?php echo form_error('cvv', '<span class="help-block">', '</span>'); ?> </span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Expire Month: <span class="required">	* </span>
					</label>
					<div class="col-md-8">
						<select class="form-control" name="exp_month">
							<option value="01">01</option><option value="02">02</option>
							<option value="03">03</option><option value="04">04</option>
							<option value="05">05</option><option value="06">06</option>
							<option value="07">07</option><option value="08">08</option>
							<option value="09">09</option><option value="10">10</option>
							<option value="11">11</option><option value="12">12</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Expire Year: <span class="required">	* </span>
					</label>
					<div class="col-md-8">
						<select class="form-control"  name="exp_year">
							<?php 
								$year = date("Y");
								$year1 = date("Y",strtotime("+20 years"));
								for($i=$year; $i < $year1; $i++) 
								{ ?>
									<option value="<?php echo $i;?>"><?php echo $i;?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
				<?php }?>
				<div class="form-group">
					<label class="col-md-2 control-label"> <span class="required"></span></label>
					<div class="col-md-3">
						<input type="submit" class="form-control btn btn-primary" style="font-weight: bold; font-size:17px;" name="submit" id="submit" value="SUBMIT" />
					</div>
				</div>
		</form>
	</div>
</div>
<div class="col-md-12">
<a href="<?php echo site_url('home'); ?>" class="btn-back">Back</a>
</div>
<div class="clear"></div>
<?php 
if($grid)
{
?>
<div class="row">
	<h3 class="page-title" style="padding-left:20px;">My Subscription Transaction</h3>
	<table class="table table-hover">
		<thead>
			<th>SNO</th>
			<th>Subscription ID</th>
			<th>Amount</th>
			<th>Transaction ID</th>
			<th>Status</th>
			<th>Date</th>
		</thead>
		<tbody>
		<?php
			$i=1;
			foreach ($grid as $key => $value) 
			{
				?>
				<tr>
					<td><?php echo $i++;?></td>
					<td><?php echo $value['profile_id'];?></td>
					<td><?php echo "$".number_format($value['last_payment_amt'],2);?></td>
					<td><?php echo $value['trans_id'];?></td>
					<td><?php echo $value['status'];?></td>
					<td><?php echo $value['created_date'];?></td>
				</tr>
			  <?php 
			}?>
		</tbody>
	</table>
</div>
<?php 
}?>