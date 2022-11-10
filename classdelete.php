<?php  
include('connect.php');


$clid=$_GET['clid'];

$Delete="DELETE FROM class WHERE clid='$clid' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Class Deleted')</script>";
	echo "<script>window.location='classview.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Class Delete Process" . mysqli_error($connection) . "</p>";
}

?>