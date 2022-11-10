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
    <form action="employeeview.php" method='post' style = "">
    <fieldset>
<legend>Employee List :</legend>
<?php  
$e_List="SELECT *
			 FROM employee
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
	<table id="tableid" class="display">
	<thead>
	<tr>
		<th>#</th>
        <th>Employee ID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Password</th>
		<th>Address</th>
		<th>Emergency Name</th>
		<th>Emergency Phone</th>
		<th>Description</th>
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
		$mail=$rows['email'];
		$password=$rows['password'];
		$address=$rows['address'];
		$ename=$rows['ename'];
		$enum=$rows['enum'];
		$info=$rows['info'];     
        

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$eid</td>";
		echo "<td>$name</td>";
		echo "<td>$mail</td>";
		echo "<td>$password</td>";
		echo "<td>$address</td>";
		echo "<td>$ename</td>";
		echo "<td>$enum</td>";
		echo "<td>$info</td>";
		echo "<td>
			  <a href='employeeupdate.php?eid=$eid'>Update</a>
			  <a href='pie.php?eid=$eid'>Pie</a>
			  <a href='attendancepie.php?eid=$eid'>APie</a>
			  <a href='employeedelete.php?eid=$eid'>Delete</a>
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