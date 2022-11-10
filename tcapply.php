<?php  
include('connect.php');


$tcid=$_GET['tcid'];
$eid=$_GET['eid'];

$add="INSERT INTO `employeetraining`
(`eid`,`tcid`) 
VALUES 
('$eid','$tcid')
";  
$ret=mysqli_query($connection,$add);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Training  Applied')</script>";
	echo "<script>window.location='employeehome.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Training Application Process" . mysqli_error($connection) . "</p>";
}

?>