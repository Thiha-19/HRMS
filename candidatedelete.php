<?php  
include('connect.php');


$cid=$_GET['cid'];

$Delete="DELETE FROM candidate WHERE cid='$cid' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Candidate Information Deleted')</script>";
	echo "<script>window.location='candidateview.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Candidate Delete Process" . mysqli_error($connection) . "</p>";
}

?>