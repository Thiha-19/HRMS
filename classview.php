<?php
	include('connect.php');
	include('adminhead.php');
	
	if(isset($_POST['btnadd'])) 
	{
		echo "<script>window.location='class.php'</script>";
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
    <form action="classview.php" method='post' style = "">
    <fieldset>
<legend>Class List :</legend>
<?php  
$cl_List="SELECT * 
			 FROM class
			 ";
$cl_ret=mysqli_query($connection,$cl_List);
$cl_count=mysqli_num_rows($cl_ret);

if ($cl_count < 1) 
{
	echo "<p>No Class Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-striped">
	<thead>
	<tr>
		<th>#</th>
        <th>Class ID</th>
		<th>Class Name</th>
		<th>Subject</th>
		<th>Description</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$cl_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($cl_ret);
		//print_r($rows);

		$clid=$rows['clid'];
		$name=$rows['cname'];
		$sub=$rows['subject'];
		$desc=$rows['description'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$clid</td>";
		echo "<td>$name</td>";
		echo "<td>$sub</td>";
		echo "<td>$desc</td>";
		echo "<td>
			  <a href='classupdate.php?clid=$clid'>Update</a> 
			  <a href='classdelete.php?clid=$clid'>Delete</a>
			  </td>";
		echo "</tr>";
	}
	 ?>
	 </tbody>
	</table>
	<input type="submit" value="Add Class" class="btn btn-secondary" name="btnadd"> 
<?php
}
?>
</fieldset>
</form>
</body>
</html>