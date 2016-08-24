
<?php if($this->session->flashdata('csv_up')==TRUE){?>
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?php echo $this->session->flashdata('csv_up');?>
		</div>
		<?php }?>
<div class="upload-file">
	<div class="col-md-9">
		
		
		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
		<table>
		<tr>
		<td> Choose your file: </td>
		<td><input type="file" class="form-control file-option" required name="employee" id="userfile"  align="center"/>
		</td>
		<td><div class="col-lg-offset-3 col-lg-9">    <button type="submit" name="submit" class="btn btn-info"  >   Save  </button>
		</div></td></tr></table>
		</form>
    </div>	
    <div class="col-md-3">
		<a class="btn-csv" href="<?php echo $img_url;?>test.csv"><p class="csv-format"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Sample CSV file</p></a>
    </div>	
</div>
