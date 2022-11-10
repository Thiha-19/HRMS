<?php
	include('connect.php');
	include('adminhead.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>
</head>
<body >

<script>
	$(document).ready( function () {
		$('#tableid').DataTable();
	} );
</script>
    <form action="promotion.php" method='post' style = "">
    <fieldset>
<legend>Employee List :</legend>
<?php  
$e_List="SELECT DISTINCT ed.eid, e.name, r.role, d.department_name
from employee e, role r, department d, employee_data ed
where ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid
        ";
$e_ret=mysqli_query($connection,$e_List);
$e_count=mysqli_num_rows($e_ret);

if ($e_count < 1) 
{
	echo "<p>No Employee Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-striped">
	<thead>
	<tr>
		<th>#</th>
        <th>Employee ID</th>
		<th>Name</th>
		<th>Department</th>
		<th>Role</th>
		<th>Attendance Chart</th>
		<th>Rating Chart</th>
		<th>Promotion</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$e_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($e_ret);
		//print_r($rows);

		$eid=$rows['eid'];
		$name=$rows['name'];
		$department=$rows['department_name'];
		$role=$rows['role'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$eid</td>";
		echo "<td>$name</td>";
		echo "<td>$department</td>";
		echo "<td>$role</td>";
		echo "<td><a href='adminchooseattpie.php?eid=$eid'>View</a></td>";
		echo "<td><a href='adminchooserate.php?eid=$eid'>View</a></td>";
		echo "<td><a href='promotionreal.php?eid=$eid'>Promote</a></td>";
		echo "</tr>";
	}
	 ?>
	 </tbody>
	</table>
<?php
}
?>
</fieldset>
</form>
</body>
</html>