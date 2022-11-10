<?php  
session_start();
include('connect.php');
include('header.php');

if(isset($_SESSION['eid']))
{   
	$eid=$_SESSION['eid'];

	$select="SELECT e.eid, e.name, d.department_name, r.role
    from employee e, department d, role r, employee_data ed
    where e.eid = '$eid' and ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid
    ";
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$eid=$_SESSION['eid'];
	$ename=$data['name'];
	$depaertment=$data['department_name'];
	$role=$data['role'];
}
else
{
	
}

if(isset($_POST['btnleave'])) 
{
	
		$_SESSION['eid']=$eid;

		echo "<script>window.location='leaverequest.php'</script>";
	
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Home</title>


</head>
<body>


<form action="employeehome.php" method="post" > 

<fieldset class="text-center">
<legend>Employee Information :</legend>

<input type="hidden" name="txteid"  value="<?php echo $ename ?>" readonly/>
	<div class="form-label">
    	<label for="">Employee Name</label>
    	<input type="text" name="txtname"  value="<?php echo $ename ?>" readonly/>
    </div>

	<div class="form-label">
    	<label for="">Department</label>
    	<input type="text" name="txtdepartment"  value="<?php echo $depaertment ?>" readonly/>
    </div>

	<div class="form-label">
    	<label for="">Role</label>
    	<input type="text" name="txtrole"  value="<?php echo $role ?>" readonly/>
    </div>

	
	

</fieldset>



</form>
</body>
</html>