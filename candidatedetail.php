<?php  
session_start();
include('connect.php');
include('adminhead.php');

if(isset($_GET['cid']))
{
	$cid=$_GET['cid'];

	$select="SELECT c.cid, c.cname, c.email, c.dob, c.email, c.postal, c.phone, c.prior_exp, c.education, c.gradfrom, c.graddate, c.expected_salary, c.add_info, d.department_name, r.role
    FROM candidate c, department d, role r, recruitment re
    where c.reid = re.reid and re.did = d.did and re.rid = r.rid and c.cid = '$cid'";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$cid=$data['cid'];
	$cname=$data['cname'];
	$depaertment=$data['department_name'];
	$role=$data['role'];
    $mail=$data['email'];
    $dob=$data['dob'];
    $postal=$data['postal'];
    $phone=$data['phone'];
    $prior=$data['prior_exp'];
    $edu=$data['education'];
    $gf=$data['gradfrom'];
    $gd=$data['graddate'];
    $info=$data['add_info'];
    $es=$data['expected_salary'];
}
else
{
	
}

if(isset($_POST['btnapply'])) 
{	
	$cid=$_POST['cid'];
	$txtname=$_POST['txtname'];
	$txtdepart=$_POST['txtdepart'];
	$txtrole=$_POST['txtrole'];
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
	if($cid) //True
	{	
		
		echo "<script>window.alert('SUCCESS : Candidate Employed')</script>";
		echo "<script>window.location='employee.php ?cid=$cid'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Apply" . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['cid'])) 
{
	$cid=$_GET['cid'];

	$c_List="SELECT * FROM candidate";
	$c_ret=mysqli_query($connection,$c_List);
	$c_count=mysqli_num_rows($c_ret);
	$rows=mysqli_fetch_array($c_ret);

	if($c_count < 1) 
	{
		echo "<script>window.alert('ERROR : Candidate Info Not Found')</script>";
	}
}
else
{
	$cid="";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Candidate Detail</title>


</head>
<body>


<form action="candidatedetail.php" method="post" > 

<fieldset class="text-center">
<legend>Candidate Information :</legend>


    <div class="form-group">        
    	<label for="" class="form-label">Candidate ID</label>
    	<input type="text" class="form-label" name="cid" id=""  value="<?php echo $cid ?>" readonly>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Candidate Name</label>
    	<input type="text" class="form-label" name="txtname"  value="<?php echo $cname ?>" readonly/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Department</label>
    	<input type="text" class="form-label" name="txtdepart"  value="<?php echo $depaertment ?>" readonly/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Role</label>
    	<input type="text" class="form-label" name="txtrole"  value="<?php echo $role ?>" readonly/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Email</label>
    	<input type="text" class="form-label" name="txtmail" value="<?php echo $mail ?>" readonly/>
    </div>

	<div class="form-group">
    	<label for="" class="form-label">Date of Birth</label>
    	<input type="date" class="form-label" name="txtdob" value="<?php echo $dob ?>" readonly/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Postal</label>
    	<input type="text" class="form-label" name="txtpos" value="<?php echo $postal ?>" readonly/>
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
    	<label for="" class="form-label">Expected Salary(In Dollar)</label>
    	<input type="number" class="form-label" name="txtes" value="<?php echo $es ?>" readonly/>
    </div>

    <div class="form-group">
    	<label for="" class="form-label">Additional Info</label>
    	<input type="text" class="form-label" name="txtinfo" value="<?php echo $info ?>" readonly/>
    </div>

	<input type="submit" class="btn btn-secondary" name="btnapply" value="Employ">
	<input type="reset" class="btn btn-danger" value="Clear">
</fieldset>



</form>
</body>
</html>