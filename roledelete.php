<?php  
include('connect.php');


$rid=$_GET['rid'];

$Delete="DELETE FROM role WHERE rid='$rid' ";
$ret=mysqli_query($connection,$Delete);



if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Role Deleted')</script>";
	echo "<script>window.location='adminhome.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Role Delete Process" . mysqli_error($connection) . "</p>";
}

?>