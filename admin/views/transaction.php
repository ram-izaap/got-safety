<div id="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
              <div class="col-lg-12" style="margin-left: -10px;">
                <h1 class="pull-left"><b>Subscription Transaction Details</b></h1>
                </div>
                
                
                 
                 <?php /*
                    if ($message = $this->service_message->render()) :
        		               echo $message;
                     endif; */
                    ?>
				<div class="col-lg-12" style="margin-left: -10px;">
					<ol class="breadcrumb">
						<li><a href="<?=site_url('home')?>">Home</a>
						</li>
						<li class="active"><span>Subscription Transaction Details</span>
						</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<form action="<?php echo base_url('transaction');?>" method="post">
					<div class="form-group">
						<label class="col-md-2 control-label">Customer Subscription ID:
							<span class="required">* </span></label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="sub_id" 
							placeholder="Customer Subscription ID" 
							value="<?php echo set_value('sub_id');?>" >
							<span class="vstar"><?php echo form_error('sub_id');?></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"> <span class="required"></span></label>
						<div class="col-md-2">
							<input type="submit" class="form-control btn btn-primary" style="font-weight: bold; font-size:17px;" name="submit" id="submit" value="VIEW" />
						</div>
						<div class="col-md-2">
							<a href="<?php echo base_url('transaction');?>" class="form-control btn btn-primary pull-right">CLEAR</a>
						</div>
					</div>
				</form>
			</div>
			<input type="hidden" name="page_name" class="page_name" value="forms" />
			<div class="table-responsive">
				<table class="table user-list table-hover drag_drop" id="data_table">
					<thead class="greenbg_title">
						<tr id="grid-headers">
							<th>Name</th>
							<th>Email</th>
							<th>Subscription ID</th>
							<th>Invoice No</th>
							<th>Tranasction No.</th>
							<th>Status</th>
							<th>Amount</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody class="white_bg">		
					<?php 
						if($grid)
						{
							foreach ($grid as $val)
							{
								?>
								<tr>
									<td><?php echo $val['name'];?></td>
									<td><?php echo $val['email'];?></td>
									<td><?php echo $val['sub_id'];?></td>
									<td><?php echo $val['invoice_no'];?></td>
									<td><?php echo $val['trans_id'];?></td>
									<td><?php echo $val['status'];?></td>
									<td><?php echo "$".number_format($val['amount'],2);?></td>
									<td><?php echo date('d-m-Y H:i:s',strtotime($val['date']));?></td>
								</tr>
								<?php
							}
						}
					?>						                     
					</tbody>
				</table>
			</div>
	</div>
</div>


