<?php  
include('connect.php');
include('adminhead.php');

if(isset($_POST['btnadd'])) 
{
	$txtdname=$_POST['txtdname'];
	$txtmail=$_POST['txtmail'];
	$txtlocation=$_POST['txtlocation'];
	$txtdesc=$_POST['txtdesc'];
	$txtdate=$_POST['txtdate'];
	$Select="SELECT * FROM department
            WHERE department_name='$txtdname'";
    $retSelect=mysqli_query($connection,$Select);
    $Select_Count=mysqli_num_rows($retSelect);
        if ($Select_Count>0) 
        {
            echo "<script>window.alert('Error :Department Already Exist')</script>";
            echo "<script>window.location='admindepartment.php'</script>";
        }
        else 
        {
			$Insert="INSERT INTO `department`
			(`department_name`, `email`, `location`,`description`) 
			VALUES 
			('$txtdname','$txtmail','$txtlocation','$txtdesc')
			";
			$ret=mysqli_query($connection,$Insert);

			if($ret) 
			{
				$txt="Admin created new department ".$txtdname." at ". $txtdate;

				$insert="INSERT INTO `log`
				(`ltid`, `date`,`text`) 
				VALUES ('1','$txtdate','$txt')
				";
				$ret1=mysqli_query($connection,$insert);

				echo "<script>window.alert('SUCCESS : New Department Added')</script>";
				echo "<script>window.location='admindepartment.php'</script>";
			}
			else
			{
				echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
			}
		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Department</title>


</head>
<body>


<form action="department.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend>Enter New Department :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>
	<div class="form-group">
    	<label for="" class="form-label">Department Name</label>
    	<input type="text" class="form-label" name="txtdname" unique placeholder="Eg.Food" required/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Email</label>
    	<input type="email" class="form-label" name="txtmail" placeholder="Eg.***@gmail.com" required/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Location</label>
    	<input type="text" class="form-label" name="txtlocation" placeholder="Eg.Yangon" required/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Description</label>
    	<input type="text" class="form-label" name="txtdesc" placeholder="Eg.Description" required/>
    </div>

	<input type="submit" name="btnadd" class="btn btn-secondary" value="Add"/>
	<input type="reset"  class="btn btn-danger" value="Clear"/>
</fieldset>



</form>
</body>
</html>