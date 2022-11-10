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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Attendance List</title>


</head>
<body>


<form action="attendanceview.php" method="post" > 

<fieldset>
<legend>Attendance List For <?php echo $mdepartment?>:</legend>
<?php  
$List="SELECT DISTINCT e.eid, e.name, d.department_name, r.role, att.atype, a.date
FROM employee_data ed, role r, department d, employee e, attendancetype att, attendance a
WHERE ed.eid = e.eid and ed.did = d.did and ed.rid = r.rid and att.atid = a.atid and a.eid = ed.eid and d.department_name = '$mdepartment'
			 ";
$ret=mysqli_query($connection,$List);
$count=mysqli_num_rows($ret);

if ($count < 1) 
{
	echo "<p>No Attendance Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-striped">
	<thead>
	<tr>
		<th>#</th>
		<th>Employee ID</th>
        <th>Employee Name</th>
		<th>Department </th>
		<th>Role</th>
		<th>Date</th>
		<th>Attendance</th>
		
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$count;$i++) 
	{ 
		$rows=mysqli_fetch_array($ret);
		//print_r($rows);

		$eid=$rows['eid'];
		$ename=$rows['name'];
		$depart=$rows['department_name'];
		$role=$rows['role'];
		$date=$rows['date'];
		$atten=$rows['atype'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$eid</td>";
		echo "<td>$ename</td>";
		echo "<td>$depart</td>";
		echo "<td>$role</td>";
		echo "<td>$date</td>";
		echo "<td>$atten</td>";
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