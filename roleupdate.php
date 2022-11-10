<?php  
session_start();
include('connect.php');
include('adminhead.php');

if(isset($_GET['rid']))
{
	$rid=$_GET['rid'];

	$select="select * from role
			 where rid='$rid'";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$rid=$data['rid'];
	$role=$data['role'];
	$salary=$data['approx_salary'];
	$desc=$data['description'];
}
else
{
	
}

if(isset($_POST['btnup'])) 
{	
	$txtid=$_POST['txtid'];
	$txtrole=$_POST['txtrole'];
	$txtsalary=$_POST['txtsalary'];
	$txtdesc=$_POST['txtdesc'];
	$txtdate=$_POST['txtdate'];


	$Update="UPDATE role
			 SET
			 role='$txtrole',
			 approx_salary='$txtsalary',
			 description='$txtdesc'
			 WHERE
			 rid='$txtid'
			 ";
	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{	
		$txt="Admin updated a role ".$txtrole." at ". $txtdate;

				$insert="INSERT INTO `log`
				(`ltid`, `date`,`text`) 
				VALUES ('2','$txtdate','$txt')
				";
				$ret1=mysqli_query($connection,$insert);
		echo "<script>window.alert('SUCCESS : Role Info Updated')</script>";
		echo "<script>window.location='adminhome.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['rid'])) 
{
	$rid=$_GET['rid'];

	$role_List="SELECT * 
				 FROM role
				 ";
	$role_ret=mysqli_query($connection,$role_List);
	$role_count=mysqli_num_rows($role_ret);
	$rows=mysqli_fetch_array($role_ret);

	if($role_count < 1) 
	{
		echo "<script>window.alert('ERROR : Role Info Not Found')</script>";
		echo "<script>window.location='adminhome.php'</script>";
	}
}
else
{
	$rid="";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Role Update</title>


</head>
<body>


<form action="roleupdate.php" method="post" >

<fieldset class="text-center">
<legend>Enter New Role Information :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>


    <div class="form-group">        
    	<label class="form-label" for="">Role ID</label>
    	<input class="form-label" type="text" name="txtid" id=""  value="<?php echo $rid ?>" readonly>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Role Name</label>
    	<input class="form-label" type="text" name="txtrole" id=""  value="<?php echo $role ?>" required>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Approximate Salary</label>
    	<input class="form-label" type="text" name="txtsalary" value="<?php echo $salary ?>" required>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Description</label>
    	<input class="form-label" type="text" name="txtdesc" id=""  value="<?php echo $desc ?>" required>
    </div>

	<input type="submit" name="btnup" class="btn btn-secondary" value="Update">
	<input type="reset" class="btn btn-danger" value="Clear">
</fieldset>



</form>
</body>
</html>