<?php if(count($values) > 0) { ?> 
<table class="table table-striped table-bordered attr_table" id="example" style="margin-left:16px;width:49.7%">
  <thead>
    <tr>
      <th>S.No
      </th>
      <th>Attribute
      </th>
      <th>Amount
      </th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($values as $key=>$value):  ?>
    <tr>
      <th scope="row">
        <?php echo $i; ?>
      </th>
      <td>
        <label>
          <?php echo $value['attr_val']; ?> 
        </label>
      </td>
      <input type="hidden" name="attr_id[]" value="<?php echo $value['id']; ?>">
      <?php if(isset($attr_price[$value['id']]['price']) && $attr_price[$value['id']]['price']!='') { ?>
      <td>
        <input class="tabledit-input  input-sm" type="text"  name="price[]"  value="<?php echo set_value('price[]',$attr_price[$value["id"]]["price"]); ?>" style="display: block;">
      </td>
      <input type="hidden" name="variation_id[]" value="<?php echo $attr_price[$value['id']]['variation_id']; ?>">
      <?php } else { ?>   
      <td>
        <input class="tabledit-input  input-sm" type="text"  name="price[]"  value="<?php echo set_value('price[]',''); ?>" style="display: block;">
      </td>
      <?php } ?>
    </tr>
    <?php ++$i; endforeach; ?>
  </tbody>
</table>
<span class="vstar" <?php echo form_error('price[]', '<span class="help-block">', '</span>'); ?></span>
<?php } else { ?>
<table style="margin-left:16px;width:49.7%">
  <tbody>
    <tr>
      <td>
        <strong>No Records Found</strong>
      </td>
    </tr>
  </tbody>
</table>
<?php } ?>
