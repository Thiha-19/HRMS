<?php
	include('connect.php');
	include('adminhead.php');

    if(isset($_POST['btnadd'])) 
{
    echo "<script>window.location='department.php'</script>";
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
    <form action="admindepartment.php" method='post' style = "">
    <fieldset>
<legend>Department List :</legend>
<?php  
$d_List="SELECT * 
			 FROM department
			 ";
$d_ret=mysqli_query($connection,$d_List);
$d_count=mysqli_num_rows($d_ret);

if ($d_count < 1) 
{
	echo "<p>No Department Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-striped">
	<thead>
	<tr>
		<th>#</th>
        <th>Department ID</th>
		<th>Department Name</th>
		<th>Email</th>
		<th>Location</th>
		<th>Description</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$d_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($d_ret);
		//print_r($rows);

		$did=$rows['did'];
		$dname=$rows['department_name'];
		$mail=$rows['email'];
		$location=$rows['location'];
		$desc=$rows['description'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$did</td>";
		echo "<td>$dname</td>";
		echo "<td>$mail</td>";
		echo "<td>$location</td>";
		echo "<td>$desc</td>";
		echo "<td>
			  <a href='departmentupdate.php?did=$did'>Update</a> 
			  <a href='departmentdelete.php?did=$did'>Delete</a>
			  </td>";
		echo "</tr>";
	}
	 ?>
	 </tbody>
	</table>
    <input type="submit" value="Add Department" class="btn btn-secondary" name="btnadd"> 
<?php
}
?>
</fieldset>
</form>
    
</body>
</html>