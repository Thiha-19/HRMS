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
    <form action="departmentview.php" method='post' style = "">
    <fieldset>
<legend>Recruitment List :</legend>
<?php  
$re_List="SELECT re.*, d.*, r.*
			 FROM recruitment re, department d, role r
             where re.did = d.did and re.rid = r.rid
			 ";
$re_ret=mysqli_query($connection,$re_List);
$re_count=mysqli_num_rows($re_ret);

if ($re_count < 1) 
{
	echo "<p>No Recruitment Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="display">
	<thead>
	<tr>
		<th>#</th>
        <th>Recruitment ID</th>
		<th>Department</th>
		<th>Role</th>
		<th>Number of Position</th>
		<th>Start Date</th>
		<th>Description</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$re_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($re_ret);
		//print_r($rows);

		$reid=$rows['reid'];
        $did=$rows['department_name'];
        $rid=$rows['role'];
        $num_position=$rows['num_position'];
        $sdate=$rows['sdate'];
		$description=$rows['description'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$reid</td>";
		echo "<td>$did</td>";
		echo "<td>$rid</td>";
		echo "<td>$num_position</td>";
		echo "<td>$sdate</td>";
		echo "<td>$description</td>";
		echo "<td>
			  <a href='recruitmentupdate.php?reid=$reid'>Update</a> 
			  <a href='recruitmentdelete.php?reid=$reid'>Delete</a>
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