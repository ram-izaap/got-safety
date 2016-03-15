<div id="content-wrapper"><div class="row">
<div class="col-lg-12">
    <div class="row">
     <div class="col-lg-12" style="margin-left: -15px;">
        <h1 class="pull-left"><b>SPECIAL OFFER</b></h1>
     </div>
        <div class="col-lg-12">
          <div class="col-lg-8">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/home'); ?>">Home</a></li>
                <li class="active"><a href="<?=site_url('admin/special_offer')?>"><span>Special offer</span></a></li>
            </ol>
            </div>
            <div class="col-lg-4 clearfix">
               
                    <div class="pull-right top-page-ui">
                        <a href="<?php echo site_url('admin/offer/add_edit_special_offer');?>" class="btn btn-success">
                            <i class="fa fa-plus-circle fa-lg"></i> New
                        </a>
                        <a onclick="return DeleteCheckedRow(this,'delete-offer','admin/offer/offer_delete');" class="btn btn-success">
                            <i class="fa fa-minus-circle fa-lg"></i> Delete
                        </a>
                    </div>
            </div>
        </div>
    </div>
    
   <?php /*
    <div class="row" id="menu-list">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list table-hover">
                            <thead>
                                <tr>
                                    <th><span>Logo</span></th>
                                    <th><span>Contact info</span></th>
                                    <th><span>Phone</span></th>
                                    <th class="text-center"><span>Is Active</span></th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                        <tbody>
                        
    			          <?php if(count($this->data['contact_info'])): foreach ($this->data['contact_info'] as $list) : ?>
                            <tr>
                                
                                <td><a href = "<?php echo site_url("admin/header/add_edit_contact_info"); ?>/<?php echo $list['id']; ?>" class="facebook itl-tooltip" data-placement="bottom" title=""><img src="<?php echo base_url()?>assets/frontend/images/logo/<?php echo $list['logo_image'];?>" height="50px;" width="50px;"></a></td>
                                
                                <td><?php echo $list['contact_info_sub'];?></td>
                                <td><?php echo $list['phone_no'];?></td>
                                <td class="text-center"><?php $active = ($list['is_active']==1)?"<span class='label label-default'>Active</span>":"<span class='label label-default'>Inactive</span>"; echo $active; ?></td>
                            </tr>
                    	<?php endforeach; ?>
                        <?php else:?>
            			<tr>
            				<td colspan="3">
            					<h2 class="text-center ">No records found.</h2>
            				</td>
            			</tr>
    			         <?php endif;?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    */ ?>
</div>
</div>

</div>
