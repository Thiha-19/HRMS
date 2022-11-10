<?php  
session_start();
include('connect.php');
include('managerhead.php');

if(isset($_GET['eid']))
{
	$eid=$_GET['eid'];

	$select="select * from employee
			 where eid='$eid'";
			 
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$eid=$data['eid'];
	$name=$data['name'];
    $mail=$data['email'];
	$password=$data['password'];
	$address=$data['address'];
	$ename=$data['ename'];
	$enum=$data['enum'];
	$info=$data['info'];     
}
else
{
	
}

if(isset($_POST['btnup'])) 
{	
	
		echo "<script>window.location='manageemployee.php'</script>";

}


if (isset($_GET['eid'])) 
{
	$eid=$_GET['eid'];

	$e_List="SELECT * 
				 FROM employee
				 ";
	$e_ret=mysqli_query($connection,$e_List);
	$e_count=mysqli_num_rows($e_ret);
	$rows=mysqli_fetch_array($e_ret);

	if($e_count < 1) 
	{
		echo "<script>window.alert('ERROR : Role Info Not Found')</script>";
		echo "<script>window.location='roleview.php'</script>";
	}
}
else
{
	$eid="";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Update</title>


</head>
<body>


<form action="employeedetail.php" method="post">

<fieldset class="text-center">
<legend>Employee Information :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>


    <div class="form-group">        
    	<label for="">Employee ID</label>
    	<input type="text" name="txteid" id=""  value="<?php echo $eid ?>" readonly>
    </div>

	<div class="form-group">
    	<label for="">Name</label>
    	<input type="text" name="txtname" id=""  value="<?php echo $name ?>" readonly>
    </div>

	<div class="form-group">
    	<label for="">Email</label>
    	<input type="text" name="txtmail" value="<?php echo $mail ?>" readonly>
    </div>

    <div class="form-group">
    	<label for="">Address</label>
    	<input type="text" name="txtaddress" id=""  value="<?php echo $address ?>" readonly>
    </div>

    <div class="form-group">
    	<label for="">Emergency Contact Name</label>
    	<input type="text" name="txtecname" id=""  value="<?php echo $ename ?>" readonly>
    </div>

    <div class="form-group">
    	<label for="">Emergency Contact Number</label>
    	<input type="text" name="txtecnum" id=""  value="<?php echo $enum ?>" readonly>
    </div>

    <div class="form-group">
    	<label for="">Additional Info   </label>
    	<input type="text" name="txtinfo" id=""  value="<?php echo $info ?>" readonly>
    </div>

	<input type="submit" class="btn btn-secondary" name="btnup" value="OK">
</fieldset>



</form>
</body>
</html>