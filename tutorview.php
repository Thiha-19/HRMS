<?php
	include('connect.php');
	include('adminhead.php');

	if(isset($_POST['btnadd'])) 
{
    echo "<script>window.location='tutor.php'</script>";
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
    <form action="tutorview.php" method='post' style = "">
    <fieldset>
<legend>Tutor List :</legend>
<?php  
$t_List="SELECT *
FROM tutor ";

$t_ret=mysqli_query($connection,$t_List);
$t_count=mysqli_num_rows($t_ret);

if ($t_count < 1) 
{
	echo "<p>No Tutur Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-striped">
	<thead>
	<tr>
		<th>#</th>
        <th>Tutor ID</th>
		<th>Tutor Name</th>
		<th>age</th>
		<th>Prior Experience</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$t_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($t_ret);
		//print_r($rows);

		$tid=$rows['tid'];
		$tname=$rows['tname'];
		$age=$rows['age'];
        $prior=$rows['exp'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$tid</td>";
		echo "<td>$tname</td>";
		echo "<td>$age</td>";
		echo "<td>$prior</td>";
		echo "<td></td>";
		echo "<td>
			  <a href='tutordetail.php?tid=$tid'>Detail</a>
			  <a href='tutordelete.php?tid=$tid'>Delete</a>
			  </td>";
		echo "</tr>";
	}
	 ?>
	 </tbody>
	</table>
	<input type="submit" value="Add Tutor" class="btn btn-secondary" name="btnadd"> 
<?php
}
?>
</fieldset>
</form>
</body>
</html>