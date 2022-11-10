<?php  
include('connect.php');


$reid=$_GET['reid'];

$Delete="DELETE FROM role WHERE reid='$reid' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Recruitment Info Deleted')</script>";
	echo "<script>window.location='adminrecruit.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Recruitment Delete Process" . mysqli_error($connection) . "</p>";
}

?>