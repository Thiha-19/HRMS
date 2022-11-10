<?php
	include('connect.php');
	include('header.php');
	session_start();
	if(isset($_SESSION['eid']))
{
	$eid=$_SESSION['eid'];
}
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
    <form action="leaveview.php" method='post' style = "">
    <fieldset>
<legend>Leave Request List :</legend>
<?php  
$l_List="SELECT DISTINCT l.lid, l.date, ap.type, r.role, d.department_name, e.name
FROM leave_request l, approval ap, employee_data ed, role r, department d, employee e
WHERE l.aprovid = ap.aprovid and l.eid = ed.eid and ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid and e.eid = '$eid'
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
	<table id="tableid" class="table table-striped">
	<thead>
	<tr>
		<th>#</th>
        <th>Leave ID</th>
        <th>Employee Name</th>
        <th>Department</th>
		<th>Role</th>
		<th>Requested Date</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$l_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($l_ret);
		//print_r($rows);

		$lid=$rows['lid'];
		$department=$rows['department_name'];
		$role=$rows['role'];
		$name=$rows['name'];
		$date=$rows['date'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$lid</td>";
		echo "<td>$department</td>";
		echo "<td>$name</td>";
		echo "<td>$role</td>";
		echo "<td>$date</td>";
		echo "<td>
			  </td>";
		echo "</tr>";
	}
	 ?>
	 </tbody>
	</table>
	<input type="submit" value="Leave Request" class="btn btn-secondary" name="btnadd"> 
<?php
}
?>
</fieldset>
</form>
</body>
</html>