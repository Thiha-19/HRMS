<?php  
include('connect.php');
include('adminhead.php');
session_start();

if(isset($_POST['btnadd'])) 
{
	$cbodid=$_POST['cbodid'];
	$cborid=$_POST['cborid'];
	$txtnop=$_POST['txtnop'];
	$txtsdate=$_POST['txtsdate'];
	$txtdesc=$_POST['txtdesc'];
	$txtdate=$_POST['txtdate'];
	
		$Insert="INSERT INTO `recruitment`
		(`did`, `rid`, `num_position`, `sdate`, `description`) 
		VALUES 
		('$cbodid','$cborid','$txtnop','$txtsdate','$txtdesc')
		";
		$ret=mysqli_query($connection,$Insert);

		if($ret) 
		{	
			$txt="Admin created new recruitment with ".$txtdname." at ".$txtdname." at ". $txtdate;

			$insert="INSERT INTO `log`
			(`ltid`, `date`,`text`) 
			VALUES ('1','$txtdate','$txt')
			";
			$ret1=mysqli_query($connection,$insert);


			echo "<script>window.alert('SUCCESS : New Recruitment Added')</script>";
			echo "<script>window.location='adminrecruit.php'</script>";
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
	<title>Add Recruitment</title>


</head>
<body>


<form action="recruitment.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend>Enter New Recruitment :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>

	<div class="form-group">
    	<label for="" class="form-label">Department</label>
    	<select name="cbodid" class="form-label">
			<option class="form-label">Choose Department</option>
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
    	<select name="cborid" class="form-label">
			<option>Choose Role</option>
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

	<div class="form-group">
    	<label for="" class="form-label">Number of positions</label>
    	<input type="number" class="form-label" name="txtnop" max="10" placeholder="Eg.5" required/>
    </div>
    
    <div class="form-group">
    	<label for="" class="form-label">	Date</label>
    	<input type="date" class="form-label" name="txtsdate" required/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Description</label>
    	<input type="text" class="form-label" name="txtdesc" placeholder="Eg.Description" required/>
    </div>

	<input type="submit" class="btn btn-secondary" name="btnadd" value="Add"/>
	<input type="reset" class="btn btn-danger" value="Clear"/>
</fieldset>



</form>
</body>
</html>