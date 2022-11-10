<?php  
include('connect.php');
include('adminhead.php');

if(isset($_POST['btnadd'])) 
{
	$txtname=$_POST['txtname'];
	$txtsub=$_POST['txtsub'];
	$txtdesc=$_POST['txtdesc'];
	$txtdate=$_POST['txtdate'];
	
	

		$Insert="INSERT INTO `class`
		(`cname`, `subject`,`description`) 
		VALUES 
		('$txtname','$txtsub','$txtdesc')
		";
		$ret=mysqli_query($connection,$Insert);
		if($ret) 
		{
			$txt="Admin created new class ".$txtname." at ". $txtdate;

				$insert="INSERT INTO `log`
				(`ltid`, `date`,`text`) 
				VALUES ('1','$txtdate','$txt')
				";
				$ret1=mysqli_query($connection,$insert);
			echo "<script>window.alert('SUCCESS : New Class Added')</script>";
			echo "<script>window.location='classview.php'</script>";
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
	<title>Add Class Info</title>


</head>
<body>


<form action="class.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend>Enter Class Info :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>

	<div class="form-group">
    	<label class="form-label" for="">Class Name</label>
    	<input class="form-label" type="text" name="txtname"  placeholder="Eg.Marketing" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Subject</label>
    	<input class="form-label" type="text" name="txtsub" placeholder="Eg.Marketing 101" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Description</label>
    	<input class="form-label" type="text" name="txtdesc" placeholder="Eg.Description" required/>
    </div>

	<input type="submit" class="btn btn-secondary" name="btnadd" value="Add"/>
	<input type="reset" class="btn btn-danger" value="Clear"/>
</fieldset>



</form>
</body>
</html>