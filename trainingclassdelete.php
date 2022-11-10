<?php  
include('connect.php');


$tcid=$_GET['tcid'];

$Delete="DELETE FROM trainingclass WHERE tcid='$tcid' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Training Class Deleted')</script>";
	echo "<script>window.location='trainingclassview.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Tutor Delete Process" . mysqli_error($connection) . "</p>";
}

?>