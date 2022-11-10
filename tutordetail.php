<?php  
session_start();
include('connect.php');
include('adminhead.php');

if(isset($_GET['tid']))
{
	$tid=$_GET['tid'];

	$select="SELECT *
    FROM tutor
    where tid = '$tid'
    ";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$tname=$data['tname'];
    $mail=$data['email'];
    $age=$data['age'];
    $address=$data['address'];
    $phone=$data['phone'];
    $prior=$data['exp'];
    $edu=$data['education'];
    $gf=$data['gradfrom'];
    $gd=$data['graddate'];
    $info=$data['addinfo'];
}
else
{
	
}




if (isset($_GET['tid'])) 
{
	$tid=$_GET['tid'];

	$c_List="SELECT * FROM tutor";
	$c_ret=mysqli_query($connection,$c_List);
	$c_count=mysqli_num_rows($c_ret);
	$rows=mysqli_fetch_array($c_ret);

	if($c_count < 1) 
	{
		echo "<script>window.alert('ERROR : Tutor Info Not Found')</script>";
	}
}
else
{
	$tid="";
}
if (isset($_POST['btnback']))
{
    echo "<script>window.location='tutorview.php'</script>";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Tutor Detail</title>


</head>
<body>


<form action="tutordetail.php" method="post" > 

<fieldset class="text-center">
<legend>Tutor Information :</legend>

	<div class="form-group">
    	<label for="" class="form-label">Tutor Name</label>
    	<input type="text" class="form-label" name="txtname"  value="<?php echo $tname ?>" readonly/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Email</label>
    	<input type="text" class="form-label" name="txtmail" value="<?php echo $mail ?>" readonly/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Age</label>
    	<input type="date" class="form-label" name="txtdob" value="<?php echo $age ?>" readonly/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Address</label>
    	<input type="text" class="form-label" name="txtpos" value="<?php echo $address ?>" readonly/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Phone</label>
    	<input type="text" class="form-label" name="txtph" value="<?php echo $phone ?>" readonly/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Prior Experience(In Years)</label>
    	<input type="number" class="form-label" name="txtpe" value="<?php echo $prior ?>" readonly/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Education</label>
    	<input type="text" class="form-label" name="txtedu" value="<?php echo $edu ?>" readonly/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Graduated From</label>
    	<input type="text" class="form-label" name="txtgf" value="<?php echo $gf ?>" readonly/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Graduated Year</label>
    	<input type="number" class="form-label" name="txtgy" value="<?php echo $gd ?>" readonly/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Additional Info</label>
    	<input type="text" class="form-label" name="txtinfo" value="<?php echo $info ?>" readonly/>
    </div>

	<input type="submit" class="btn btn-danger" name="btnback" value="Back">
</fieldset>



</form>
</body>
</html>