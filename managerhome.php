<?php  
session_start();
include('connect.php');
include('managerhead.php');

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
	$_SESSION['eid']=$data['eid'];
}
else
{
	
}




?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Home</title>


</head>
<body>


<form action="managerhome.php" method="post" > 

<fieldset class="text-center">
<legend>Manager Information :</legend>

<input type="hidden" name="txteid"  value="<?php echo $ename ?>" readonly/>
	<div class="form-group">
    	<label class="form-label" for="">Employee Name</label>
    	<input class="form-label" type="text" name="txtname"  value="<?php echo $ename ?>" readonly/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Department</label>
    	<input class="form-label" type="text" name="txtdepartment"  value="<?php echo $depaertment ?>" readonly/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Role</label>
    	<input   type="text" name="txtrole"  value="<?php echo $role ?>" readonly/>
    </div>


</fieldset>



</form>
</body>
</html>