<?php  
session_start();
include('connect.php');
include('managerhead.php');

if(isset($_GET['eid']))
{   
	$eid=$_GET['eid'];

	$select="SELECT e.eid, e.name, d.department_name, r.role
    from employee e, department d, role r, employee_data ed
    where e.eid = '$eid' and ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid
    ";
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$neweid=$data['eid'];
	$ename=$data['name'];
	$depaertment=$data['department_name'];
	$role=$data['role'];
}
else
{
	
}

if(isset($_POST['btnsave'])) 
{
    $cboatid=$_POST['cboatid'];
    $txtdate=$_POST['txtdate'];
    $txteid=$_POST['txteid'];



	$insert = "INSERT INTO `attendance`
    (`eid`, `atid`,`date`) 
    VALUES 
    ('$txteid','$cboatid','$txtdate')
    ";
    $ret=mysqli_query($connection,$insert);
    if($ret) 
    {
        echo "<script>window.alert('SUCCESS : New Attendance Added')</script>";
        echo "<script>window.location='attendanceview.php'</script>";
    }
    else
    {
        echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Attendance Detail</title>


</head>
<body>


<form action="attendancedetail.php" method="post" > 

<fieldset class="text-center">
<legend>Employee Information :</legend>

    <input type="hidden" name="txteid"  value="<?php echo $neweid ?>" readonly/>
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
    	<input class="form-label" type="text" name="txtrole"  value="<?php echo $role ?>" readonly/>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Date</label>
    	<input class="form-label" type="date" name="txtdate" required/>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Attendance Type</label>
    	<select name="cboatid" id="">
			<?php  
			$a_query="SELECT * FROM attendancetype ";
			$a_ret=mysqli_query($connection,$a_query);
			$a_count=mysqli_num_rows($a_ret);

			for($i=0;$i<$a_count;$i++) 
			{ 
				$row=mysqli_fetch_array($a_ret);
				$atid=$row['atid'];
				$atype=$row['atype'];

				echo "<option value='$atid'>$atid - $atype</option>";
			}
			?>
		</select>
    </div>
    
	<input class="btn btn-secondary" type="submit" name="btnsave" value="Save">

</fieldset>



</form>
</body>
</html>