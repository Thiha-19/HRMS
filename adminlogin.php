<?php  
session_start();
include('connect.php');
include('loginhead.php');



if(isset($_POST['btnlogin'])) 
{
	$txtmail=$_POST['txtmail'];
	$txtpassword=$_POST['txtpassword'];

	if($txtmail == 'admin@gmail.com' && $txtpassword == 'admin123') 
	{   
        
			echo "<script>window.alert('Success : Admin Login Success')</script>";
			echo "<script>window.location='adminhome.php'</script>";
            
	}
	else
	{
		
		echo "<script>window.alert('Error : Login Failed | Check Email or Password')</script>";
		echo "<script>window.location='adminlogin.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Login</title>
</head>
<body>

<form action="adminlogin.php" method="post" style = "">

<fieldset class="text-center">
<legend>Enter Admin Login Information :</legend>

<div class="form-label">
    	<label for="" class="form-label">Email</label>
    	<input type="text" name="txtmail" class="col-sm-2 col-form-label"  placeholder="Eg.***@gmail.com" required/>
</div>

<div class="form-label">
    	<label for="" class="form-label">Password</label>
    	<input type="password" name="txtpassword" class="col-sm-2 col-form-label" placeholder="*********" required/>
</div>

		<input type="submit" class="btn btn-secondary" name="btnlogin" value="Login" />
		<input type="reset" class="btn btn-danger" name="btnClear" value="Clear" />
</fieldset>


</form>
</body>
</html>