<div id="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
              <div class="col-lg-12" style="margin-left: -10px;">
                <h1 class="pull-left"><b>Plans</b></h1>
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
						<li class="active"><span>Plans</span>
						</li>
						
					</ol>
					<div class="clearfix">
						
						 <div class="pull-right top-page-ui">
							  
	                        <a href="<?php echo site_url('plan/add_plan');?>" class="btn btn-success">
	                            <i class="fa fa-plus-circle fa-lg"></i> New
	                        </a>
	                        <a onclick="return DeleteCheckedRow(this,'delete-plan','plan/plan_delete');" class="btn btn-success">
	                            <i class="fa fa-minus-circle fa-lg"></i> Delete
	                        </a>
                           
	                    </div>
					</div>
                    
				</div>
			</div>
			<input type="hidden" name="page_name" class="page_name" value="plans" />
			<?php echo $grid;?>
			<?php //echo '<pre>';print_r($this->session->all_userdata());die;?>
		</div>
	</div>
