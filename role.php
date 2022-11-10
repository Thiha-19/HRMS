<?php  
include('connect.php');
include('adminhead.php');

if(isset($_POST['btnadd'])) 
{
	$txtrole=$_POST['txtrole'];
	$txtsalary=$_POST['txtsalary'];
	$txtdesc=$_POST['txtdesc'];
	$txtdate=$_POST['txtdate'];
    $Select="SELECT * FROM role
            WHERE role='$txtrole'";
    $retSelect=mysqli_query($connection,$Select);
    $Select_Count=mysqli_num_rows($retSelect);
        if ($Select_Count>0) 
        {
            echo "<script>window.alert('Error :Role Already Exist')</script>";
            echo "<script>window.location='adminhome.php'</script>";
        }
        else 
        {
			

			$Insert="INSERT INTO `role`
			(`role`, `approx_salary`,`description`) 
			VALUES 
			('$txtrole','$txtsalary','$txtdesc')
			";
			$ret=mysqli_query($connection,$Insert);
			if($ret) 
			{	
			
				$txt="Admin created new role ".$txtrole." at ". $txtdate;

				$insert="INSERT INTO `log`
				(`ltid`, `date`,`text`) 
				VALUES ('1','$txtdate','$txt')
				";
				$ret1=mysqli_query($connection,$insert);
				echo "<script>window.alert('SUCCESS : New Role Added')</script>";
				echo "<script>window.location='adminhome.php'</script>";
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
	<title>Add Role</title>


</head>
<body>


<form action="role.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend>Enter New Role :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>
	<div class="form-group">
    	<label for="" class="form-label">Role Name</label>
    	<input type="text" name="txtrole" class="form-label" placeholder="Eg.Marketing Staff" required/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Approximate Salary</label>
    	<input type="number" name="txtsalary" class="form-label" max="5000" placeholder="Eg.$5000" required/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Description</label>
    	<input type="text" name="txtdesc" class="form-label" placeholder="Eg.Description" required/>
    </div>

	<input type="submit" class="btn btn-secondary" name="btnadd" value="Add"/>
	<input type="reset" class="btn btn-danger" value="Clear"/>
</fieldset>



</form>
</body>
</html>