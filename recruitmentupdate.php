<?php  
session_start();
include('connect.php');
include('adminhead.php');

if(isset($_GET['reid']))
{
	$reid=$_GET['reid'];

	$select="select re.*, d.*, r.*
			 from recruitment re, department d, role r
			 where re.reid='$reid'
			 and re.did = d.did 
			 and re.rid = r.rid";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$reid=$data['reid'];
	$didd=$data['did'];
	$did=$data['department_name'];
    $rid=$data['role'];
    $num_position=$data['num_position'];
    $sdate=$data['sdate'];
	$description=$data['description'];
}
else
{
	
}

if(isset($_POST['btnup'])) 
{	
    $txtreid=$_POST['txtreid'];
	$txtdid=$_POST['txtdid'];
	$cborid=$_POST['cborid'];
	$txtnop=$_POST['txtnop'];
	$txtsdate=$_POST['txtsdate'];
	$txtdesc=$_POST['txtdesc'];
	$txtdate=$_POST['txtdate'];


	$Update="UPDATE recruitment
			 SET
			 did='$txtdid',
			 rid='$cborid',
             num_position='$txtnop',
             sdate='$txtsdate',
			 description='$txtdesc'
			 WHERE
			 reid='$txtreid'
			 ";
	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{	
		$txt="Admin updated recruitment ".$txtreid." at ". $txtdate;

			$insert="INSERT INTO `log`
			(`ltid`, `date`,`text`) 
			VALUES ('1','$txtdate','$txt')
			";
			$ret1=mysqli_query($connection,$insert);

		echo "<script>window.alert('SUCCESS : Recruitment Info Updated')</script>";
		echo "<script>window.location='adminrecruit.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['reid'])) 
{
	$reid=$_GET['reid'];

	$re_List="SELECT * 
				 FROM role
				 ";
	$re_ret=mysqli_query($connection,$re_List);
	$re_count=mysqli_num_rows($re_ret);
	$rows=mysqli_fetch_array($re_ret);

	if($re_count < 1) 
	{
		echo "<script>window.alert('ERROR : Recruitment Info Not Found')</script>";
		echo "<script>window.location='adminrecruit.php'</script>";
	}
}
else
{
	$reid="";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Recruitment Update</title>


</head>
<body>


<form action="recruitmentupdate.php" method="post" >

<fieldset class="text-center">
<legend>Recruitment Update Information :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>


    <div class="form-group">      
		<label for="" class="form-label">Recruitment ID</label>  
    	<input type="text" name="txtreid" id=""  value="<?php echo $reid ?>" readonly>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Department</label>
    	<input type="text" class="form-label" name="cbodid" id=""  value="<?php echo $did ?>" readonly>
		<input type="hidden" class="form-label" name="txtdid" id=""  value="<?php echo $didd ?>" readonly>
		
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Current Role</label>
    	<input type="text" name="" id=""  value="<?php echo $rid ?>" readonly>
    </div>

	<div class="form-group">
    	<label for="" class="form-label" class="form-label">New Role</label>
    	<select name="cborid" class="form-label" class="form-label" required>
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

	<div class="form-group">
    	<label class="form-label" for="">Number of position</label>
    	<input class="form-label" type="text" name="txtnop" value="<?php echo $num_position ?>" required>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Start Date</label>
    	<input class="form-label" type="text" name="txtsdate" id=""  value="<?php echo $sdate ?>" readonly>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Description</label>
    	<input class="form-label" type="text" name="txtdesc" id=""  value="<?php echo $description ?>" required>
    </div>

	<input type="submit" name="btnup" class="btn btn-secondary" value="Update">
	<input type="reset" class="btn btn-danger" value="Clear">
</fieldset>



</form>
</body>
</html>