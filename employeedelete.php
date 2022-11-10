<?php  
include('connect.php');


$eid=$_GET['eid'];

$Delete="DELETE FROM employee WHERE eid='$eid' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Employee Deleted')</script>";
	echo "<script>window.location='adminemployee.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Employee Delete Process" . mysqli_error($connection) . "</p>";
}

?>