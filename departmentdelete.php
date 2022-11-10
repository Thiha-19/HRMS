<?php  
include('connect.php');


$did=$_GET['did'];


$Delete="DELETE FROM department WHERE did='$did' ";
$ret=mysqli_query($connection,$Delete);


if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Department Deleted')</script>";
	echo "<script>window.location='admindepartment.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Department Delete Process" . mysqli_error($connection) . "</p>";
}

?>

