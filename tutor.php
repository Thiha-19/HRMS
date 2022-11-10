<?php  
include('connect.php');
include('adminhead.php');

if(isset($_POST['btnadd'])) 
{
	$txtname=$_POST['txtname'];
	$txtmail=$_POST['txtmail'];
	$txtage=$_POST['txtage'];
	$txtaddress=$_POST['txtaddress'];
	$txtph=$_POST['txtph'];
	$txtprior=$_POST['txtprior'];
	$txtedu=$_POST['txtedu'];
	$txtgf=$_POST['txtgf'];
	$txtgy=$_POST['txtgy'];
	$txtai=$_POST['txtai'];
	$txtdate=$_POST['txtdate'];

		$Insert="INSERT INTO `tutor`
		(`tname`, `email`,`age`,`address`,`phone`,`exp`,`education`,`gradfrom`,`graddate`,`addinfo`) 
		VALUES 
		('$txtname','$txtmail','$txtage','$txtaddress','$txtph','$txtprior','$txtedu','$txtgf','$txtgy','$txtai')
		";
		$ret=mysqli_query($connection,$Insert);
		if($ret) 
		{	
			$txt="Admin added new tutor ".$txtname." at ". $txtdate;

				$insert="INSERT INTO `log`
				(`ltid`, `date`,`text`) 
				VALUES ('1','$txtdate','$txt')
				";
				$ret1=mysqli_query($connection,$insert);
			echo "<script>window.alert('SUCCESS : New Tutor Added')</script>";
			echo "<script>window.location='tutorview.php'</script>";
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
	<title>Add Tutor</title>


</head>
<body>


<form action="tutor.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend>Enter New Tutor :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>
	<div class="form-group">
    	<label class="form-label" for="">Tutor Name</label>
    	<input class="form-label" type="text" name="txtname"  placeholder="Eg.Terry" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Email</label>
    	<input class="form-label" type="email" name="txtmail" placeholder="Eg.***@gmail.com" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Age</label>
    	<input class="form-label" min="20" max="60" type="number" name="txtage" placeholder="Eg.22" required/>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Address</label>
    	<input class="form-label" type="text" name="txtaddress" placeholder="Eg.City" required/>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Phone</label>
    	<input class="form-label" type="text" name="txtph" placeholder="Eg.000-000-000" required/>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Prior Experience</label>
    	<input class="form-label" max="40" type="number" name="txtprior" placeholder="Eg.4" required/>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Education</label>
    	<select name="txtedu" id="" required>
            <option value="Diploma">Diploma</option>
            <option value="Degree">Degree</option>
            <option value="Master">Master</option>
            <option value="Doctorate">Doctorate</option>
        </select>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Graduated From</label>
    	<input class="form-label" type="text" name="txtgf" required placeholder="Eg.Description"/>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Graduated Year</label>
    	<input class="form-label" min="1950" max="2020" type="number" name="txtgy" placeholder="Eg.2001" required/>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Additional Info</label>
    	<input class="form-label" type="text" name="txtai" placeholder="Eg.Description" required/>
    </div>
	<input class="btn btn-secondary" type="submit" name="btnadd" value="Add"/>
	<input class="btn btn-danger" type="reset" value="Clear"/>
</fieldset>



</form>
</body>
</html>