<?php  

session_start();
include('connect.php');
include('loginhead.php');


if(isset($_GET['reid']))
{
	$reid=$_GET['reid'];

	$select="select * from recruitment
			 where reid='$reid'";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$reid=$data['reid'];
}
else
{
	
}

if(isset($_POST['btnadd'])) 
{
	$txtreid=$_POST['txtreid'];
	$txtname=$_POST['txtname'];
	$txtmail=$_POST['txtmail'];
	$txtdob=$_POST['txtdob'];
	$txtpos=$_POST['txtpos'];
	$txtph=$_POST['txtph'];
	$txtpe=$_POST['txtpe'];
	$txtedu=$_POST['txtedu'];
	$txtgf=$_POST['txtgf'];
	$txtgy=$_POST['txtgy'];
	$txtes=$_POST['txtes'];
	$txtinfo=$_POST['txtinfo'];
	
	

		$Insert="INSERT INTO `candidate`
		(`cname`, `email`,`dob`,`postal`,`phone`,`prior_exp`,`education`,`gradfrom`,`graddate`,`add_info`,`expected_salary`,`reid`) 
		VALUES 
		('$txtname','$txtmail','$txtdob','$txtpos','$txtph','$txtpe','$txtedu','$txtgf','$txtgy','$txtinfo','$txtes','$txtreid')
		";
		$ret=mysqli_query($connection,$Insert);
		if($ret) 
		{
			echo "<script>window.alert('SUCCESS : New Candidate Applied')</script>";
			echo "<script>window.location='recruitmentapply.php'</script>";
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
	<title>Apply Candidate</title>


</head>
<body>


<form action="candidate.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend>Enter Candidate Info :</legend>

    <input type="hidden" name="txtreid" value="<?php echo $reid ?>">

	<div class="form-label">
    	<label class="form-label" for="">Candidate Name</label>
    	<input type="text" class="form-label" pattern="[A-Za-z]*" name="txtname"  placeholder="Eg.Sasha" required/>
    </div>

	<div class="form-label">
    	<label class="form-label" for="">Email</label>
    	<input type="email" class="form-label" name="txtmail" placeholder="Eg.***@gmail.com" required/>
    </div>

	<div class="form-label">
    	<label class="form-label" for="">Date of Birth</label>
    	<input type="date" max="2002-12-31" class="form-label" name="txtdob" required/>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Postal</label>
    	<input type="number" name="txtpos" class="form-label" placeholder="Eg.11101" required/>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Phone</label>
    	<input type="number" name="txtph" class="form-label" placeholder="Eg.000-000-000" required/>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Prior Experience(In Years)</label>
    	<input type="number" max="20" class="form-label" name="txtpe" placeholder="Eg.4 " required/>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Education</label>
        <select name="txtedu" id="">
            <option value="Diploma">Diploma</option>
            <option value="Degree">Degree</option>
            <option value="Master">Master</option>
            <option value="Doctorate">Doctorate</option>
        </select>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Graduated From</label>
    	<input type="text" name="txtgf" class="form-label" placeholder="Eg.Example University" required/>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Graduated Year</label>
    	<input class="form-label"  min="1980" max="2020"  type="number" name="txtgy" placeholder="Eg.2001" required/>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Expected Salary(In Dollar)</label>
    	<input type="number" max="9999" name="txtes"class="form-label" placeholder="Eg.400" required/>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Additional Info</label>
    	<input type="text" class="form-label" name="txtinfo" placeholder="Eg.Description" required/>
    </div>

	<input type="submit" class="btn btn-secondary" name="btnadd" value="Apply"/>
	<input type="reset" class="btn btn-danger" value="Clear"/>
</fieldset>



</form>
</body>
</html>