<div id="content-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
              <div class="col-lg-12" style="margin-left: -10px;">
                <h1 class="pull-left"><b>Attribute Value</b></h1>
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
						<li class="active"><span>Attribute Value</span>
						</li>
						
					</ol>
					<div class="clearfix">
						
						 <div class="pull-right top-page-ui">
							  
	                        <a href="#"  attr_id ="" class="btn btn-success add_attr_val">
	                            <i class="fa fa-plus-circle fa-lg"></i> New
	                        </a>
	                        <a href="<?php echo site_url('attribute');?>" class="btn btn-success">
	                            <i class="fa fa-plus-circle fa-lg"></i> Attribute List
	                        </a>
	                        <a onclick="return DeleteCheckedRow(this,'delete-attribute','attribute/attr_delete1');" class="btn btn-success">
	                            <i class="fa fa-minus-circle fa-lg"></i> Delete
	                        </a>
                           
	                    </div>
					</div>
                    
				</div>
			</div>
			<input type="hidden" name="page_name" class="page_name" value="attribute" />
			<?php echo $grid;?>
			<?php //echo '<pre>';print_r($this->session->all_userdata());die;?>
		</div>
	</div>
    
    <!-- Add Attribute Form -->

    <div class="modal fade" id="attr_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">Add Attribute Value</h3>
        </div>
        <div class="modal-body">
		   <form role="form" name="attribute_sub_cat" id="attribute_sub_cat" method="POST">
		     <input type="hidden" name="edit_id">
		      
		      <div class="form-group">
				<label class="control-label col-md-4">Attribute Name: <span class="required">* </span>
				</label>
				<div class="col-md-8">
					<select name="attr_name" class="form-control attr_names">
					</select>
					<span class="vstar err" style="display:none;">The Attribute Name field is required.</span>  
				</div>
			  </div>

			  <div class="form-group">
				<label class="control-label col-md-4">Attribute Value: <span class="required">* </span>
				</label>
				<div class="col-md-8">
					<input type="text" name="attr_val" class="form-control">
					<span class="vstar err1" style="display:none;">The Attribute Value field is required.</span>  
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-md-2 control-label"> <span class="required">
				 </span>
				</label>
				<div class="col-md-2 pull-right">
					<input type="submit" class="form-control btn btn-primary" style="font-weight: bold; font-size:17px;" name="submit" id="save_attr_value" value="SAVE" />
				</div>
			  </div>
		  </form>
		</div>
	   </div>
	  </div>
	 </div>

	 

