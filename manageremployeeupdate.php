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
	$txteid=$_POST['txteid'];
	$txtname=$_POST['txtname'];
	$txtmail=$_POST['txtmail'];
	$txtpassword=$_POST['txtpassword'];
	$txtaddress=$_POST['txtaddress'];
	$txtecname=$_POST['txtecname'];
	$txtecnum=$_POST['txtecnum'];
	$txtinfo=$_POST['txtinfo'];
	$txtdate=$_POST['txtdate'];
	


	$Update="UPDATE employee
			 SET
			 name='$txtname',
			 password='$txtpassword',
			 address='$txtaddress',
			 ename='$txtecname',
			 enum='$txtecnum',
			 info='$txtinfo'
			 WHERE
			 eid='$txteid'
			 ";
	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{	
		$txt="Admin updated employee ".$txtname." at ". $txtdate;

			$insert="INSERT INTO `log`
			(`eid`, `ltid`, `date`,`text`) 
			VALUES ('$txteid','1','$txtdate','$txt')
			";
			$ret1=mysqli_query($connection,$insert);
		echo "<script>window.alert('SUCCESS : Employee Info Updated')</script>";
		echo "<script>window.location='manageemployee.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
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
		echo "<script>window.alert('ERROR : Employee Info Not Found')</script>";
		echo "<script>window.location='manageemployee.php'</script>";
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


<form action="manageremployeeupdate.php" method="post">

<fieldset class="text-center">
<legend>Enter New Employee Information :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>


    <div class="form-group">        
    	<label class="form-label" for="">Employee ID</label>
    	<input class="form-label" type="text" name="txteid" id=""  value="<?php echo $eid ?>" readonly>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Name</label>
    	<input class="form-label" type="text" name="txtname" id=""  value="<?php echo $name ?>" required>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Email</label>
    	<input class="form-label" type="text" name="txtmail" value="<?php echo $mail ?>" required>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Password</label>
    	<input class="form-label" type="text" name="txtpassword" id=""  value="<?php echo $password ?>" required>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Address</label>
    	<input class="form-label" type="text" name="txtaddress" id=""  value="<?php echo $address ?>" required>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Emergency Contact Name</label>
    	<input class="form-label" type="text" name="txtecname" id=""  value="<?php echo $ename ?>" required>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Emergency Contact Number</label>
    	<input class="form-label" type="text" name="txtecnum" id=""  value="<?php echo $enum ?>" required>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Additional Info   </label>
    	<input class="form-label" type="text" name="txtinfo" id=""  value="<?php echo $info ?>" required>
    </div>

	<input type="submit" class="btn btn-secondary" name="btnup" value="Update">
	<input type="reset" class="btn btn-danger" value="Clear">
</fieldset>



</form>
</body>
</html>