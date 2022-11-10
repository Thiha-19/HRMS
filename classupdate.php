<?php  
session_start();
include('connect.php');
include('adminhead.php');

if(isset($_GET['clid']))
{
	$clid=$_GET['clid'];

	$select="select * from class
			 where clid='$clid'";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$clid=$data['clid'];
	$name=$data['cname'];
	$sub=$data['subject'];
	$desc=$data['description'];
}
else
{
	
}

if(isset($_POST['btnup'])) 
{	
	$txtclid=$_POST['txtclid'];
	$txtname=$_POST['txtname'];
	$txtsub=$_POST['txtsub'];
	$txtdesc=$_POST['txtdesc'];
	$txtdate=$_POST['txtdate'];


	$Update="UPDATE class
			 SET
			 cname='$txtname',
			 subject='$txtsub',
			 description='$txtdesc'
			 WHERE
			 clid='$txtclid'
			 ";
	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{
		$txt="Admin updated a class ".$txtname." at ". $txtdate;

				$insert="INSERT INTO `log`
				(`ltid`, `date`,`text`) 
				VALUES ('2','$txtdate','$txt')
				";
				$ret1=mysqli_query($connection,$insert);
		echo "<script>window.alert('SUCCESS : Class Info Updated')</script>";
		echo "<script>window.location='classview.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['clid'])) 
{
	$clid=$_GET['clid'];

	$cl_List="SELECT * 
				 FROM class
				 ";
	$cl_ret=mysqli_query($connection,$cl_List);
	$cl_count=mysqli_num_rows($cl_ret);
	$rows=mysqli_fetch_array($cl_ret);

	if($cl_count < 1) 
	{
		echo "<script>window.alert('ERROR : Class Info Not Found')</script>";
		echo "<script>window.location='classview.php'</script>";
	}
}
else
{
	$clid="";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Class Update</title>


</head>
<body>


<form action="classupdate.php" method="post" >

<fieldset class="text-center"> 
<legend>Enter New Class Information :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>


    <div class="form-group">        
    	<label class="text-center" for="">Class ID</label>
    	<input class="text-center" type="text" name="txtclid" id=""  value="<?php echo $clid ?>" readonly>
    </div>

	<div class="form-group">
    	<label class="text-center" for="">Class Name</label>
    	<input class="text-center" type="text" name="txtname" id=""  value="<?php echo $name ?>">
    </div>

	<div class="form-group">
    	<label class="text-center" for="">Subject</label>
    	<input class="text-center" type="text" name="txtsub" value="<?php echo $sub ?>">
    </div>

	<div class="form-group">
    	<label class="text-center" for="">Description</label>
    	<input class="text-center" type="text" name="txtdesc" id=""  value="<?php echo $desc ?>">
    </div>

	<input class="btn btn-secondary" type="submit" name="btnup" value="Update">
	<input class="btn btn-danger" type="reset" value="Clear">
</fieldset>



</form>
</body>
</html>