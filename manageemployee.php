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
    <form action="manageemployee.php" method='post' style = "">
    <fieldset>
<legend>Employee List For <?php echo $mdepartment ?>:</legend>
<?php  
$e_List="SELECT DISTINCT e.eid, e.name, e.address, e.info, d.department_name, r.role
        from employee e, department d, role r, employee_data ed
        where ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid and d.department_name = '$mdepartment'
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
        <th>Role</th>
		<th>Department</th>
		<th>Address</th>
		<th>Attendance</th>
		<th>Update</th>
		<th>Detail</th>
		<th>Rating</th>
		<th>Attendance Chart</th>
		<th>Rating Chart</th>
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
		$role=$rows['role'];
		$department=$rows['department_name'];
		$address=$rows['address'];
		$info=$rows['info'];     
        

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$eid</td>";
		echo "<td>$name</td>";
		echo "<td>$role</td>";
		echo "<td>$department</td>";
		echo "<td>$address</td>";
		echo "<td><a href='attendancedetail.php?eid=$eid'>Attendance</a></td>";
		echo "<td><a href='manageremployeeupdate.php?eid=$eid'>Update</a></td>";
		echo "<td><a href='employeedetail.php?eid=$eid'>Detail</a></td>";
		echo "<td><a href='rating.php?eid=$eid'>Rate</a></td>";
		echo "<td><a href='chooseattpie.php?eid=$eid'>View</a></td>";
		echo "<td><a href='chooserate.php?eid=$eid'>View</a></td>";
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