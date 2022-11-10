<?php  
session_start();
include('connect.php');
include('header.php');

if(isset($_SESSION['eid']))
{
	$eid=$_SESSION['eid'];

	$select="SELECT e.eid, e.name, d.department_name, r.role
    from employee e, department d, role r, employee_data ed
    where e.eid = '$eid' and ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid
    ";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$neweid=$data['eid'];
	$ename=$data['name'];
	$depaertment=$data['department_name'];
	$role=$data['role'];
}
else
{
	
}

if(isset($_POST['btnre'])) 
{	
    $txteid=$_POST['txteid'];
	$txtreason=$_POST['txtreason'];
	$txtdate=$_POST['txtdate'];
	$txtinfo=$_POST['txtinfo'];
	$date=$_POST['date'];


	$Insert="INSERT INTO `leave_request`
    (`eid`, `aprovid`, `reason`,`date`,`info`) 
    VALUES 
    ('$txteid','3','$txtreason','$txtdate','$txtinfo')
			 ";
	$ret=mysqli_query($connection,$Insert);

	if($ret) //True
	{	
		$txt="Employee ".$ename." requested new leave for".$txtdate." at ". $date;

				$insert="INSERT INTO `log`
				(`ltid`, `date`,`text`) 
				VALUES ('1','$date','$txt')
				";
				$ret1=mysqli_query($connection,$insert);
		echo "<script>window.alert('SUCCESS : Leave Info Requested')</script>";
		echo "<script>window.location='employeehome.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['eid'])) 
{
	$eid=$_GET['eid'];

	$e_List="SELECT * 
				 FROM employee
				 ";
	$e_ret=mysqli_query($connection,$e_List);
	$e_count=mysqli_num_rows($e_ret);
	$rows=mysqli_fetch_array($e_ret);

	if($e_count < 1) 
	{
		echo "<script>window.alert('ERROR : Employee Info Not Found')</script>";
		echo "<script>window.location='employeehome.php'</script>";
	}
}
else
{
	$eid="";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Leave Request Form</title>


</head>
<body>


<form action="leaverequest.php" method="post" >

<fieldset class="text-center">
<legend>Enter Leave Request Information :</legend>
<input type="hidden" name="date" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>


    <div class="form-group">        
    	<label class="form-label" for="">Employee ID</label>
    	<input class="form-label" type="text" name="txteid" id=""  value="<?php echo $neweid ?>" readonly>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Employee Name</label>
    	<input class="form-label" type="text" name="txtdepart" id=""  value="<?php echo $ename ?>" readonly>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Department Name</label>
    	<input class="form-label" type="text" name="txtdepart" id=""  value="<?php echo $depaertment ?>" readonly>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Role Name</label>
    	<input class="form-label" type="text" name="txtrole" id=""  value="<?php echo $role ?>" readonly>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Reason</label>
    	<!-- <input type="textarea" name="txtreason" placeholder="Fill out resaon"> -->
        <textarea class="form-label" name="txtreason" id="" cols="30" rows="10" placeholder="Fill out resaon"></textarea>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Request Date</label>
    	<input class="form-label" type="date" name="txtdate" id="" required>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Additional Info</label>
    	<!-- <input type="textarea" name="txtinfo" id=""  placeholder="Fill out additional information"> -->
        <textarea class="form-label" name="txtinfo" id="" cols="30" rows="10" placeholder="Fill out info"></textarea>
    </div>

	<input class="btn btn-secondary" type="submit" name="btnre" value="Request">
	<input class="btn btn-danger" type="reset" value="Clear">
</fieldset>



</form>
</body>
</html>