<?php
	include('connect.php');
	include('adminhead.php');
	session_start();

    $mdepartment;
    if(isset($_GET['tcid']))
{   
	$tcid=$_GET['tcid'];

	$select="SELECT tc.*
    FROM trainingclass tc
    where tc.tcid = '$tcid'
    ";
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$name=$data['name'];
   
    
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
    <form action="tcd.php" method='post' style = "">
    <fieldset>
<legend>Employee List For <?php echo $name ?>:</legend>
<?php  
$e_List="SELECT DISTINCT et.eid, e.name, d.department_name, r.role
from employee e, department d, role r, employee_data ed, employeetraining et
where et.eid = ed.eid and ed.eid = e.eid and ed.did = d.did and ed.rid = r.rid and et.tcid = '$tcid'
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
        

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$eid</td>";
		echo "<td>$name</td>";
		echo "<td>$role</td>";
		echo "<td>$department</td>";
		
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