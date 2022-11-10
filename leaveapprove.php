<?php  
session_start();
include('connect.php');
include('managerhead.php');

if(isset($_GET['lid']))
{
	$lid=$_GET['lid'];

	$select="SELECT DISTINCT l.lid, l.date, l.reason, l.info, ap.type, r.role, d.department_name, e.name, e.eid
    FROM leave_request l, approval ap, employee_data ed, role r, department d, employee e
    WHERE l.aprovid = ap.aprovid and l.eid = ed.eid and ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid and l.lid = $lid
			 ";
	

	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$newlid=$data['lid'];
	$name=$data['name'];
	$depaertment=$data['department_name'];
	$role=$data['role'];
    $type=$data['type'];
    $date=$data['date'];
    $approv=$data['type'];
    $reason=$data['reason'];
    $info=$data['info'];
	$eid=$data['eid'];
	
}
else
{
	
}

if(isset($_POST['btnaprove'])) 
{	
	$txtlid=$_POST['txtlid'];
	$txteid=$_POST['txteid'];
	$txtdate=$_POST['txtdate'];

    $update1="UPDATE leave_request
			 SET
			 aprovid=1
			 WHERE
			 lid='$txtlid'
			 ";
	$ret1=mysqli_query($connection,$update1);

	
	
	
	
	


	if($ret1) //True
	{
		$insert="INSERT INTO `attendance`
		(`eid`, `atid`, `date`) 
		VALUES ('$txteid','3','$txtdate')
		";
		$ret=mysqli_query($connection,$insert);
		echo "<script>window.alert('SUCCESS : Leave Request Approved')</script>";
		echo "<script>window.location='approveview.php'</script>";
	
	}
	else
	{
		echo "<p>Error : Something went wrong in Approval" . mysqli_error($connection) . "</p>";
	}
}

if(isset($_POST['btndeny'])) 
{	
	$lid=$_POST['txtlid'];

    $update2="UPDATE leave_request
			 SET
			 aprovid=2
			 WHERE
			 lid='$txlid'
			 ";
	$ret2=mysqli_query($connection,$update2);
	if($ret2) //True
	{
		echo "<script>window.alert('SUCCESS : Leave Request Approved')</script>";
		echo "<script>window.location='approveview.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Approval" . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['lid'])) 
{
	$lid=$_GET['lid'];

	$l_List="SELECT * FROM leave_request";
	$l_ret=mysqli_query($connection,$l_List);
	$l_count=mysqli_num_rows($l_ret);
	$rows=mysqli_fetch_array($l_ret);

	if($l_count < 1) 
	{
		echo "<script>window.alert('ERROR : Leave Request Info Not Found')</script>";
	}
}
else
{
	$lid="";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Leave Request Detail</title>


</head>
<body>


<form action="leaveapprove.php" method="post" > 

<fieldset class="text-center">
<legend>Leave Request Detail :</legend>

<input type="hidden" name="txteid" id=""  value="<?php echo $eid ?>" readonly>

    <div class="form-group">        
    	<label class="form-label" for="">Leave ID</label>
    	<input class="form-label" type="text" name="txtlid" id=""  value="<?php echo $newlid ?>" readonly>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Employee Name</label>
    	<input class="form-label" type="text" name="txtname" id=""  value="<?php echo $name ?>" readonly>
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
    	<label class="form-label" for="">Approval</label>
        <input class="form-label" type="text" name="txttype" id=""  value="<?php echo $type ?>" readonly>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Reason</label>
        <input class="form-label" type="text" name="txtreason" id=""  value="<?php echo $reason ?>" readonly>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Request Date</label>
    	<input class="form-label" type="date" name="txtdate" id="" value="<?php echo $date ?>" readonly>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Additional Info</label>
        <input class="form-label" type="text" name="txtrole" id=""  value="<?php echo $info ?>" readonly>
    </div>


	<input class="btn btn-secondary" type="submit" name="btnaprove" value="Approve">
	<input class="btn btn-danger" type="submit" name="btndeny" value="Deny">
</fieldset>



</form>
</body>
</html>