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
    <form action="roleview.php" method='post' style = "">
    <fieldset>
<legend>Role List :</legend>
<?php  
$Role_List="SELECT * 
			 FROM role
			 ";
$Role_ret=mysqli_query($connection,$Role_List);
$Role_count=mysqli_num_rows($Role_ret);

if ($Role_count < 1) 
{
	echo "<p>No Role Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="display">
	<thead>
	<tr>
		<th>#</th>
        <th>Role ID</th>
		<th>Role Name</th>
		<th>Approximate Salary</th>
		<th>Description</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$Role_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($Role_ret);
		//print_r($rows);

		$roleID=$rows['rid'];
		$roleName=$rows['role'];
		$salary=$rows['approx_salary'];
		$desc=$rows['description'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$roleID</td>";
		echo "<td>$roleName</td>";
		echo "<td>$salary</td>";
		echo "<td>$desc</td>";
		echo "<td>
			  <a href='roleupdate.php?rid=$roleID'>Update</a> |
			  <a href='roledelete.php?rid=$roleID'>Delete</a>
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