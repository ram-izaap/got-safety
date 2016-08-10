<div>
 <h3>Manage Training Records</h3>
</div>

<table class="table-bor convert-pdf">
		  <tr>
			<th>Topic</th>
			<th>Employee Name</th>		
			<th>Employee ID</th>
			<th>Client </th>
			<th>Signature</th>
			<th>Date </th>
		  </tr>
		<?php  foreach($result as $key=>$value ) {   ?>
		  <tr>
			<td><?php echo $value['title']?></td>
			<td><?php echo $value['employee_name']?></td>		
			<td><?php echo $value['emp_id']?></td>
			<td><?php echo $value['client'] ?></td>
			<td><img src="../signature/<?php echo $value['sign']; ?>" height="50px" width="150px"></td>
			<td><?php echo $value['created_date']?></td>
		  </tr>
		<?php }  ?>  
			
			 
    
    
 
</table>


