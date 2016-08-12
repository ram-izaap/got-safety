<div id="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
              <div class="col-lg-12" style="margin-left: -10px;">
                <h1 class="pull-left"><b>Training Records</b></h1>
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
						<li class="active"><span>Training Records</span>
						</li>
					</ol>
				 
                
					<div class="clearfix">
						
						 <div class="pull-right top-page-ui">
								
					 <?php if($this->uri->segment(1) == 'signoff'){ ?>
						
						<a class="pull-right search-export" href="<?php echo base_url('signoff/bulk_export'); ?>" ><i class="fa fa-cloud-download" aria-hidden="true"></i>
						Export Pdf</a>
						<a class="pull-right search-export" href="<?php echo base_url('signoff/bulk_export_excel'); ?>" ><i class="fa fa-cloud-download" aria-hidden="true"></i>
						Export Excel</a>
						
					<?php } ?>
	                        <a onclick="return DeleteCheckedRow(this,'delete-signoff','signoff/signoff_delete');" class="btn btn-success">
	                            <i class="fa fa-minus-circle fa-lg"></i> Delete
	                        </a>
                           
	                    </div>
					</div>
                    
				</div>
			</div>
			<input type="hidden" name="page_name" class="page_name" value="signoff" />
			<?php echo $grid;?>
			<?php //echo '<pre>';print_r($this->session->all_userdata());die;?>
		</div>
	</div>

