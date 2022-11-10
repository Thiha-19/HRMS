<?php
	include('connect.php');
	include('managerhead.php');
	session_start();

	$mdepartment;
    if(isset($_SESSION['eid']))
{   
	$meid=$_SESSION['eid'];

	$select="SELECT DISTINCT e.eid, d.department_name
    from employee e, department d, employee_data ed
    where e.eid = '$meid' and ed.eid = e.eid and ed.did = d.did 
    ";
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
    $meid=$_SESSION['eid'];
	$mdepartment=$data['department_name'];
   
    
}
else
{
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
<legend>Leave Request List For <?php echo $mdepartment?>:</legend>
<?php  

$l_List="SELECT DISTINCT l.lid, l.date, ap.type, r.role, d.department_name, e.name
FROM leave_request l, approval ap, employee_data ed, role r, department d, employee e
WHERE l.aprovid = ap.aprovid and l.eid = ed.eid and ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid and d.department_name = '$mdepartment'
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
		<th>Status</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$l_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($l_ret);
		//print_r($rows);

		$lid=$rows['lid'];
		$name=$rows['name'];
		$department=$rows['department_name'];
		$role=$rows['role'];
		$date=$rows['date'];
        $type=$rows['type'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$lid</td>";
		echo "<td>$name</td>";
		echo "<td>$department</td>";
		echo "<td>$role</td>";
		echo "<td>$date</td>";
		echo "<td>$type</td>";
		echo "<td>
			  </td>";
        echo "<td>
			  <a href='leaveapprove.php?lid=$lid'>Detail</a> 
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