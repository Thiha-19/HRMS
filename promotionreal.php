<?php  
session_start();
include('connect.php');
include('adminhead.php');

if(isset($_GET['eid']))
{   
	$eid=$_GET['eid'];

	$select="SELECT e.eid, e.name, d.department_name, r.role
    from employee e, department d, role r, employee_data ed
    where e.eid = '$eid' and ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid
    ";
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$eid=$data['eid'];
	$ename=$data['name'];
	$depaertment=$data['department_name'];
	$role=$data['role'];
}
else
{
	
}

if(isset($_POST['btnpro'])) 
{
	$txtname=$_POST['txtname'];
	$txteid=$_POST['txteid'];
	$txteid=$_POST['txteid'];
	$txtrole=$_POST['txtrole'];
	$txtdepartment=$_POST['txtdepartment'];
	$txtdate=$_POST['txtdate'];


	$Update="UPDATE employee_data
			 SET
			 did='$txtdepartment',
             rid='$txtrole'
			 WHERE
			 eid='$txteid'
			 ";
	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{   
		$txt="Admin Promoted employee ".$txtname." at ". $txtdate;
		
					$insert="INSERT INTO `log`
					( `ltid`, `date`,`text`) 
					VALUES ('2','$txtdate','$txt')
					";
					$ret1=mysqli_query($connection,$insert);

		echo "<script>window.alert('SUCCESS : Employee Promoted')</script>";
		echo "<script>window.location='promotion.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Promotion</title>

</head>
<body>


<form action="promotionreal.php" method="post" > 

<fieldset class="text-center">
<legend>Employee Promotion :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>


<input type="hidden" name="txteid"  value="<?php echo $eid ?>" readonly/>
	<div class="form-label">
    	<label for="">Employee Name</label>
    	<input type="text" name="txtname"  value="<?php echo $ename ?>" readonly/>
    </div>

	<div class="form-label">
    	<label for="">Current Department</label>
    	<input type="text" name=""  value="<?php echo $depaertment ?>" readonly/>
    </div>

	<div class="form-label">
    	<label for=""> Current Role</label>
    	<input type="text" name=""  value="<?php echo $role ?>" readonly/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Department</label>
    	<select name="txtdepartment" class="form-label">
			<option class="form-label">Choose New Department</option>
			<?php  
			$d_query="SELECT * FROM department";
			$d_ret=mysqli_query($connection,$d_query);
			$d_count=mysqli_num_rows($d_ret);

			for($i=0;$i<$d_count;$i++) 
			{ 
				$row=mysqli_fetch_array($d_ret);
				$did=$row['did'];
				$dname=$row['department_name'];

				echo "<option value='$did'>$did - $dname</option>";
			}
			?>
			</select>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Role</label>
    	<select name="txtrole" class="form-label">
			<option>Choose New Role</option>
			<?php  
			$r_query="SELECT * FROM role";
			$r_ret=mysqli_query($connection,$r_query);
			$r_count=mysqli_num_rows($r_ret);

			for($i=0;$i<$r_count;$i++) 
			{ 
				$row=mysqli_fetch_array($r_ret);
				$rid=$row['rid'];
				$role=$row['role'];

				echo "<option value='$rid'>$rid - $role</option>";
			}
			?>
			</select>
    </div>  

	<div class="form-label">
		<input type="submit" name="btnpro" class="btn btn-secondary" value="Promote">
	</div>
	

</fieldset>



</form>
</body>
</html>