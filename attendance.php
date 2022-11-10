<?php
	include('connect.php');
	include('header.php');
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
    <form action="attendance.php" method='post' style = "">
    <fieldset>
<legend>Attendance Form :</legend>
<?php  
$l_List="SELECT DISTINCT e.eid, e.name, r.role, d.department_name
FROM employee_data ed, role r, department d, employee e
WHERE ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid
			 ";
$l_ret=mysqli_query($connection,$l_List);
$l_count=mysqli_num_rows($l_ret);

if ($l_count < 1) 
{
	echo "<p>No Leave Request Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="display">
	<thead>
	<tr>
		<th>#</th>
		<th>Employee ID</th>
        <th>Employee Name</th>
        <th>Department</th>
		<th>Role</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$l_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($l_ret);
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
		echo "<td>
			<a href='attendancedetail.php?eid=$eid'>Attendance</a> 
			<a href='rating.php?eid=$eid'>Rape</a> 
			</td>";
		echo "<td>
			  </td>";
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