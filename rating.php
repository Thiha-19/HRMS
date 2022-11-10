<?php  
include('connect.php');
include('managerhead.php');

if(isset($_GET['eid']))
{   
	$eid=$_GET['eid'];

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

if(isset($_POST['btnrate'])) 
{
	$txteid=$_POST['txteid'];
    $txtdate=$_POST['txtdate'];
	$cbocom=$_POST['cbocom'];
	$cboteam=$_POST['cboteam'];
	$cboex=$_POST['cboex'];
	$cboadapt=$_POST['cboadapt'];
	$cboco=$_POST['cboco'];
	$txtcmt=$_POST['txtcmt'];
	$date=$_POST['date'];
	
	

		$Insert="INSERT INTO `rating`
        (`eid`, `communication`, `teamwork`, `execution`, `adaptability`, `courage`, `comment`, `date`) 
        VALUES ('$txteid','$cbocom','$cboteam','$cboex','$cboadapt','$cboco','$txtcmt','$txtdate')
		";
		$ret=mysqli_query($connection,$Insert);
		if($ret) 
		{   
            $txt="Manager rateed new rating for employee ".$ename." at ". $date;

				$insert="INSERT INTO `log`
				(`ltid`, `date`,`text`) 
				VALUES ('1','$date','$txt')
				";
				$ret1=mysqli_query($connection,$insert);
			echo "<script>window.alert('SUCCESS : New Rating Added')</script>";
			echo "<script>window.location='managerhome.php'</script>";
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
	<title>Rate Employee</title>


</head>
<body>


<form action="rating.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend>Rate Employee :</legend>
<input type="hidden" name="date" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>

<input type="hidden" name="txteid" value="<?php echo $neweid ?>" readonly />
	<div class="form-label">
    	<label class="form-label" for="">Employee Name</label>
    	<input class="form-label" type="text" name="txtrole" value="<?php echo $ename ?>" readonly />
    </div>

	<div class="form-label">
    	<label class="form-label" for="">Department</label>
    	<input class="form-label" type="text" name="txtsalary" value="<?php echo $depaertment ?>" readonly/>
    </div>

	<div class="form-label">
    	<label class="form-label" for="">Role</label>
    	<input class="form-label" type="text" name="txtdesc" value="<?php echo $role ?>" readonly/>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Date</label>
    	<input class="form-label" type="date" name="txtdate" required/>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Communication</label>
    	<select name="cbocom" id="" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Teamwork</label>
    	<select name="cboteam" id="" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Execution</label>
    	<select name="cboex" id="" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Adaptability</label>
    	<select name="cboadapt" id="" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Courage</label>
    	<select name="cboco" id="" required> 
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

    <div class="form-label">
    	<label class="form-label" for="">Comment</label>
    	<input class="form-label" type="text" name="txtcmt" required/>
    </div>

	<input type="submit" class="btn btn-secondary" name="btnrate" value="Rate"/>
	<input type="reset" class="btn btn-danger" value="Clear"/>
</fieldset>



</form>
</body>
</html>