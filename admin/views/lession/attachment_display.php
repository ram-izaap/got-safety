<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
	
	<div class="att-main">
<?php if(count($attachment_list)>0 && $attachment_list !="" ) { ?>
<h2>Attachment List</h2>

<table class="att-lesson table table-stripped">
  <tr>
    <th>S.No</th>
    <th>Language</th>
    <th>Title</th>
    <th>Is Active</th>
    <th>Action</th>
  </tr>
  <?php $i=1;foreach($attachment_list as $data){ ?>
  <tr>
    <td align="center"><?php echo $i;?></td>
    <td><?php echo $data['lang'];?></td>
    <td><?php echo $data['title'];?></td>
    <td><?php echo $data['is_active'];?></td>
    <td><a href="<?php echo site_url("attachment/add_edit_attachment");?>/<?php echo $data['id']; ?>"> <?php echo "Edit";?></a></td>
  </tr>
  <?php $i++; } ?>
</table>

<div class="col-md-12">
<a href="<?php echo site_url('lession'); ?>" class="btn-back att-back">Back</a>
</div>

<?php } ?>
</div>
</body>
</html>


