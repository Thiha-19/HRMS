<?php  
session_start();
include('connect.php');
include('adminhead.php');

if(isset($_GET['did']))
{
	$did=$_GET['did'];

	$select="select * from department
			 where did='$did'";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$did=$data['did'];
	$dname=$data['department_name'];
	$mail=$data['email'];
	$location=$data['location'];
	$desc=$data['description'];
}
else
{
	
}

if(isset($_POST['btnup'])) 
{	
	$txtdid=$_POST['txtdid'];
	$txtdname=$_POST['txtdname'];
	$txtmail=$_POST['txtmail'];
	$txtlocation=$_POST['txtlocation'];
	$txtdesc=$_POST['txtdesc'];
	$txtdate=$_POST['txtdate'];


	$Update="UPDATE department
			 SET
			 department_name='$txtdname',
			 email='$txtmail',
			 location='$txtlocation',
             description='$txtdesc'
			 WHERE
			 did='$txtdid'
			 ";
	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{	
		$txt="Admin updated department ".$txtdname." at ". $txtdate;

			$insert="INSERT INTO `log`
			( `ltid`, `date`,`text`) 
			VALUES ('2','$txtdate','$txt')
			";
			$ret1=mysqli_query($connection,$insert);

		echo "<script>window.alert('SUCCESS : Department Info Updated')</script>";
		echo "<script>window.location='admindepartment.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['did'])) 
{
	$did=$_GET['did'];

	$d_List="SELECT * 
				 FROM department
				 ";
	$d_ret=mysqli_query($connection,$d_List);
	$d_count=mysqli_num_rows($d_ret);
	$rows=mysqli_fetch_array($d_ret);

	if($d_count < 1) 
	{
		echo "<script>window.alert('ERROR : Department Info Not Found')</script>";
		echo "<script>window.location='admindepartment.php'</script>";
	}
}
else
{
	$did="";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Department Update</title>


</head>
<body>


<form action="departmentupdate.php" method="post" >

<fieldset class="text-center">
<legend>Enter New Department Information :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>
    <div class="form-group">        
    	<label for="">Department ID</label>
    	<input type="text" name="txtdid"  value="<?php echo $did ?>" readonly>
    </div>

    <div class="form-group">
    	<label for="">Department Name</label>
    	<input type="text" name="txtdname"  value="<?php echo $dname ?>" required/>
    </div>

	<div class="form-group">
    	<label for="">Email</label>
    	<input type="mail" name="txtmail" value="<?php echo $mail ?>" required/>
    </div>

    <div class="form-group">
    	<label for="">Location</label>
    	<input type="text" name="txtlocation" value="<?php echo $location ?>" required/>
    </div>

	<div class="form-group">
    	<label for="">Description</label>
    	<input type="text" name="txtdesc" value="<?php echo $desc ?>" required/>
    </div>

	<input type="submit" name="btnup" class="btn btn-secondary" value="Update">
	<input type="reset" class="btn btn-danger" value="Clear">
</fieldset>



</form>
</body>
</html>