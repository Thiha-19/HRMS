<?php  
include('connect.php');


$tid=$_GET['tid'];

$Delete="DELETE FROM tutor WHERE tid='$tid' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Tutor Deleted')</script>";
	echo "<script>window.location='tutorview.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Tutor Delete Process" . mysqli_error($connection) . "</p>";
}

?>