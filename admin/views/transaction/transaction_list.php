<div id="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
              <div class="col-lg-12" style="margin-left: -10px;">
                <h1 class="pull-left"><b>Transaction Details</b></h1>
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
						<li class="active"><span>Transaction Details</span>
						</li>
					</ol>
					
					<?php /*<?php if($this->session->userdata('admin_data')['role'] == 1) { ?>
						<div class="clearfix">
							
							 <div class="pull-right top-page-ui">
								 
								 
								<a href="<?php echo site_url('user/add_edit_user');?>" class="btn btn-success">
									<i class="fa fa-plus-circle fa-lg"></i> New
								</a>
								<a onclick="return DeleteCheckedRow(this,'delete-user','user/user_delete');" class="btn btn-success">
									<i class="fa fa-minus-circle fa-lg"></i> Delete
								</a>
							   
							</div>
						</div>
                    <?php  }?> */ ?>
				</div>
			</div>
			<input type="hidden" name="page_name" class="page_name" value="user" />
			<?php echo $grid;?>
			<?php //echo '<pre>';print_r($this->session->all_userdata());die;?>
		</div>
	</div>

