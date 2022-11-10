<?php
	include('connect.php');
	include('adminhead.php');
	
	
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
    <form action="log.php" method='post' style = "">
    <fieldset>
<legend>Log History List :</legend>
<?php  
$cl_List="SELECT * 
			 FROM log
			 ";
$cl_ret=mysqli_query($connection,$cl_List);
$cl_count=mysqli_num_rows($cl_ret);

if ($cl_count < 1) 
{
	echo "<p>No Log Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-striped">
	<thead>
	<tr>
		
        <th>Log  ID</th>
        <th>Date</th>
		<th>Description</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$cl_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($cl_ret);
		//print_r($rows);

		$lid=$rows['lid'];
		$date=$rows['date'];
		$text=$rows['text'];

		echo "<tr>";
		echo "<td>$lid</td>";
		echo "<td>$date</td>";
		echo "<td>$text</td>";
		
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