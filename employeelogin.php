<?php  
session_start();
include('connect.php');
include('loginhead.php');



if(isset($_POST['btnlogin'])) 
{
	$txtmail=$_POST['txtmail'];
	$txtpassword=$_POST['txtpassword'];

	$Check="SELECT DISTINCT e.name, e.password, r.role, e.eid
	FROM employee_data ed, department d, role r, employee e
	WHERE ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid and e.email = '$txtmail' and e.password = '$txtpassword'
			";

	$ret=mysqli_query($connection,$Check);
	$count=mysqli_num_rows($ret);
	$rows=mysqli_fetch_array($ret);
	$role=$rows['role'];

	if($count < 1) 
	{
		echo "<script>window.alert('Error : Login Failed | Check Email or Password')</script>";
		echo "<script>window.location='employeelogin.php'</script>";
	}
	else
	{
		$_SESSION['eid']=$rows['eid'];
		$_SESSION['name']=$rows['name'];
		if($role=='Manager')
		{
			echo "<script>window.alert('Success : Manager Login Success')</script>";
			echo "<script>window.location='managerhome.php'</script>";
		}
		else
		{
			echo "<script>window.alert('Success : Employee Login Success')</script>";
			echo "<script>window.location='employeehome.php'</script>";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Login</title>
</head>
<body>

<form action="employeelogin.php" method="post" style = "">

<fieldset class="text-center">
<legend>Enter Employee Login Information :</legend>

<div class="form-label">
    	<label for="" class="form-label">Email</label>
    	<input type="email" name="txtmail" class="col-sm-2 col-form-label"  placeholder="Eg.***@gmail.com" required/>
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