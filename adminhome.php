<?php  
session_start();
include('connect.php');
include('adminhead.php');

if(isset($_POST['btnadd'])) 
{
    echo "<script>window.location='role.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Home</title>


</head>
<body>


<form action="adminhome.php" method="post" > 

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
	<table id="tableid" class="table table-striped">
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
    <input type="submit" value="Add Role" class="btn btn-secondary" name="btnadd"> 
<?php
}
?>
</fieldset>


</form>
</body>
</html>