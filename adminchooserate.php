<?php  
include('connect.php');
include('adminhead.php');
session_start();

$eid;
if(isset($_GET['eid']))
{
	$eid=$_GET['eid'];

	$select="SELECT DISTINCT e.eid, e.name, d.department_name, r.role
    from employee e, department d, role r, employee_data ed
    where ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid and e.eid='$eid'
    ";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$name=$data['name'];
	$role=$data['role'];
	$dept=$data['department_name'];
}
if(isset($_POST['btnadd'])) 
{
	$rateid=$_POST['txteid'];
	$sdate=$_POST['txts'];
	$edate=$_POST['txte'];
	$neweid=$_POST['txteid'];
    

    
	echo "<script>window.alert('SUCCESS :Now loading Rating Pie Chart')</script>";
	echo "<script>window.location='adminpie.php?rateid=$rateid  & sd=$sdate & ed=$edate & eid=$neweid'</script>";
	

	// & sdate=$txts & edate=$txte
	

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Chart Info</title>


</head>
<body>


<form action="adminchooserate.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend>Enter Chart Info :</legend>
<input class="form-label" type="hidden" name="txteid" value="<?php echo $eid ?>" readonly/>
	<div class="form-group">
    	<label class="form-label" for="">Name</label>
    	<input class="form-label" type="text" name="txtname" value="<?php echo $name ?>" readonly/>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Role</label>
    	<input class="form-label" type="text" name="txtrole" value="<?php echo $role ?>" readonly/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Department</label>
    	<input class="form-label" type="text" name="txtname" value="<?php echo $dept ?>" readonly/>
    </div>
    
    <div class="form-group">
    	<label class="form-label" for="">Starting Date</label>
    	<input class="form-label" type="date" name="txts" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Ending Date</label>
    	<input class="form-label" type="date" name="txte" required/>
    </div>

	<input type="submit" class="btn btn-secondary" name="btnadd" value="Chart"/>
	<input type="reset" class="btn btn-danger" value="Clear"/>
</fieldset>



</form>
</body>
</html>