
<div id="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
              <div class="col-lg-12" style="margin-left: -10px;">
                <h1 class="pull-left"><b>Employee</b></h1>
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
						<li class="active"><span>Employee</span>
						</li>
					</ol>
					<div class="clearfix">
                
                <!-- Bulk Upload Section Starts-->
                 
                 <?php if($this->session->flashdata('csv_up')==TRUE){?>
					  <div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						  <?php echo $this->session->flashdata('csv_up');?>
						</div>
					<?php }?>
					 
                 <?php $role =  $this->session->userdata('admin_data')['role']; if($role==1) : ?>

					

					<div class="upload-file" style="margin-left:10px;margin-top:10px;margin-bottom:10px;">
					  <div class="col-md-9">
						<form action="<?php echo site_url("employee/bulk_upload"); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
						  <table>
							<tr>
							  <td> Choose your file: </td>
							  <td><input type="file" class="form-control file-option" required name="employee" id="userfile"  align="center"/></td>
							  <td><div class="col-lg-offset-3 col-lg-9">    <button type="submit" name="submit" class="btn btn-info"  >   Save  </button></div></td>
							 </tr>
						  </table>
						</form>
					   </div>	
					   <div class="col-md-3">
						  <a class="btn-csv" href="<?php echo $img_url;?>test.csv"><p class="csv-format"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Sample CSV file</p></a>
					    </div>	
					</div>
                 <?php endif; ?>
					 <!-- Bulk Upload Section Ends-->


						
						 <div class="pull-right top-page-ui">
							 
							  
	                        <a href="<?php echo site_url('employee/add_edit_employee');?>" class="btn btn-success">
	                            <i class="fa fa-plus-circle fa-lg"></i> New
	                        </a>
	                        <a onclick="return DeleteCheckedRow(this,'delete-employee','employee/employee_delete');" class="btn btn-success">
	                            <i class="fa fa-minus-circle fa-lg"></i> Delete
	                        </a>
                           
	                    </div>
					</div>
                    
				</div>
			</div>
			<input type="hidden" name="page_name" class="page_name" value="employee" />
			<?php echo $grid;?>
			<?php //echo '<pre>';print_r($this->session->all_userdata());die;?>
		</div>
	</div>

