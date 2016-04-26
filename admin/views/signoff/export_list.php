<!DOCTYPE html>

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}
</style>



<table style="width:100%">
  <tr>
    <th>Topic</th>
    <th>Employee Name</th>		
    <th>Employee ID</th>
    <th>Client </th>
    <th>Date </th>
  </tr>
  <?php foreach($result as $data ) { ?>
  <tr>
    <td><?php echo $data['topic']?></td>
    <td><?php echo $data['employee_name']?></td>		
    <td><?php echo $data['emp_id']?></td>
    <td><?php echo $data['name']?></td>
    <td><?php echo $data['created_date']?></td>
  </tr>
  <?php } ?>
  
</table>


