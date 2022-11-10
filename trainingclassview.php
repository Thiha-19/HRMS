<?php
	include('connect.php');
	include('adminhead.php');
	
if(isset($_POST['btnadd'])) 
{
    echo "<script>window.location='trainingclass.php'</script>";
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
    <form action="trainingclassview.php" method='post' style = "">
    <fieldset>
<legend>Training Class List :</legend>
<?php  
$tc_List="SELECT cl.*, t.*, tc.*
			 FROM class cl, tutor t, trainingclass tc
             where tc.clid = cl.clid and tc.tid = t.tid
			 ";
$tc_ret=mysqli_query($connection,$tc_List);
$tc_count=mysqli_num_rows($tc_ret);

if ($tc_count < 1) 
{
	echo "<p>No Training Class Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-striped">
	<thead>
	<tr>
		<th>#</th>
        <th>Training Class ID</th>
		<th>Training Class Name</th>
		<th>Class</th>
		<th>Tutor</th>
		<th>Email</th>
		<th>Start Date</th>
		<th>Description</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$tc_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($tc_ret);
		//print_r($rows);

		$tcid=$rows['tcid'];
        $clid=$rows['name'];
        $tid=$rows['name'];
        $name=$rows['tname'];
		$mail=$rows['email'];
        $sdate=$rows['sdate'];
		$description=$rows['description'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$tcid</td>";
		echo "<td>$clid</td>";
		echo "<td>$tid</td>";
		echo "<td>$name</td>";
		echo "<td>$mail</td>";
		echo "<td>$sdate</td>";
		echo "<td>$description</td>";
		echo "<td>
			  <a href='trainingclassupdate.php?tcid=$tcid'>Update</a> 
			  <a href='trainingclassdelete.php?tcid=$tcid'>Delete</a>
			  <a href='tcd.php?tcid=$tcid'>Detail</a>
			  </td>";
		echo "</tr>";
	}
	 ?>
	 </tbody>
	</table>
	<input type="submit" value="Add Training" class="btn btn-secondary" name="btnadd"> 
<?php
}
?>
</fieldset>
</form>
</body>
</html>