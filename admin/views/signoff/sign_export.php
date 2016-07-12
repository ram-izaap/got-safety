


<table class="table-bor convert-pdf">
		  <tr>
			<th>Topic</th>
			<th>Employee Name</th>		
			<th>Employee ID</th>
			<th>Client </th>
			<th>Date </th>
		  </tr>
		<?php  foreach($this->data['result'] as $data ) {   ?>
		  <tr>
			<td><?php echo $data['title']?></td>
			<td><?php echo $data['employee_name']?></td>		
			<td><?php echo $data['emp_id']?></td>
			<td><?php echo $data['name'] ?></td>
			<td><?php echo $data['created_date']?></td>
		  </tr>
		<?php }  ?>  
			
			 
    
    
 
</table>


