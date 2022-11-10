<?php  
include('connect.php');
include('adminhead.php');
session_start();

if(isset($_POST['btnadd'])) 
{
	$cboclid=$_POST['cboclid'];
	$cbotid=$_POST['cbotid'];
    $txtname=$_POST['txtname'];
	$txtmail=$_POST['txtmail'];
	$txtsdate=$_POST['txtsdate'];
	$txtdesc=$_POST['txtdesc'];
	$date=$_POST['date'];
	
		$Insert="INSERT INTO `trainingclass`
		(`clid`, `tid`, `name`, `email`, `sdate`, `description`) 
		VALUES 
		('$cboclid','$cbotid','$txtname','$txtmail','$txtsdate','$txtdesc')
		";
		$ret=mysqli_query($connection,$Insert);

		if($ret) 
		{
			$txt="Admin created new training class ".$txtname." at ". $date;

			$insert="INSERT INTO `log`
			(`ltid`, `date`,`text`) 
			VALUES ('1','$date','$txt')
			";
			$ret1=mysqli_query($connection,$insert);
			echo "<script>window.alert('SUCCESS : New Training Class Added')</script>";
			echo "<script>window.location='trainingclassview.php'</script>";
			
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
	<title>Add Training Class</title>


</head>
<body>


<form action="trainingclass.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend>Enter New Training Class :</legend>
<input type="hidden" name="date" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>

	<div class="form-group">
    	<label class="form-label" for="">Class</label>
    	<select name="cboclid">
			<option>Choose Class</option>
			<?php  
			$cl_query="SELECT * FROM class";
			$cl_ret=mysqli_query($connection,$cl_query);
			$cl_count=mysqli_num_rows($cl_ret);

			for($i=0;$i<$cl_count;$i++) 
			{ 
				$row=mysqli_fetch_array($cl_ret);
				$clid=$row['clid'];
				$clname=$row['cname'];

				echo "<option value='$clid'>$clid - $clname</option>";
			}
			?>
			</select>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Tutor</label>
    	<select name="cbotid">
			<option>Choose Tutor</option>
			<?php  
			$t_query="SELECT * FROM tutor";
			$t_ret=mysqli_query($connection,$t_query);
			$t_count=mysqli_num_rows($t_ret);

			for($i=0;$i<$t_count;$i++) 
			{ 
				$row=mysqli_fetch_array($t_ret);
				$tid=$row['tid'];
				$tname=$row['tname'];

				echo "<option value='$tid'>$tid - $tname</option>";
			}
			?>
			</select>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Name</label>
    	<input class="form-label" type="text" name="txtname" placeholder="Eg.Marketing Class" required />
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Email</label>
    	<input class="form-label" type="email" name="txtmail" placeholder="Eg.***@gmail.com" required/>
    </div>
    
    <div class="form-group">
    	<label class="form-label" for="">Start Date</label>
    	<input class="form-label" type="date" name="txtsdate" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Description</label>
    	<input class="form-label" type="text" name="txtdesc" placeholder="Eg.Description" required/>
    </div>

	<input class="btn btn-secondary" type="submit" name="btnadd" value="Add"/>
	<input class="btn btn-danger" type="reset" value="Clear"/>
</fieldset>



</form>
</body>
</html>