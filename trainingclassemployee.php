<?php  
session_start();
include('connect.php');
include('header.php');

if(isset($_GET['tcid']))
{
	$tcid=$_GET['tcid'];

	$select="SELECT tc.*, tc.name, c.cname, t.tname
	FROM tutor t, class c, trainingclass tc
	WHERE tc.tid = t.tid and tc.clid = c.clid and tc.tcid = '$tcid'
	";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$tcid=$data['tcid'];
	$tcname=$data['name'];
    $cname=$data['cname'];
    $tname=$data['tname'];
	$mail=$data['email'];
    $sdate=$data['sdate'];
	$description=$data['description'];

	
}
else
{
	
}

if(isset($_POST['btnup'])) 
{	
	$txttcid=$_POST['txttcid'];
	$txtmail=$_POST['txtmail'];
	$txtsdate=$_POST['txtsdate'];
	$txtdesc=$_POST['txtdesc'];
	$date=$_POST['date'];


	$Update="UPDATE trainingclass
			 SET
			 email='$txtmail',
             sdate='$txtsdate',
			 description='$txtdesc'
			 WHERE
			 tcid='$txttcid'
			 ";
	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{
		$txt="Admin updated new training class ".$txtname." at ". $date;

			$insert="INSERT INTO `log`
			(`ltid`, `date`,`text`) 
			VALUES ('2','$date','$txt')
			";
			$ret1=mysqli_query($connection,$insert);
		echo "<script>window.alert('SUCCESS : Training Class Info Updated')</script>";
		echo "<script>window.location='trainingclassview.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['tcid'])) 
{
	$tcid=$_GET['tcid'];

	$re_List="SELECT *
	FROM trainingclass
				 ";
	$re_ret=mysqli_query($connection,$re_List);
	$re_count=mysqli_num_rows($re_ret);
	$rows=mysqli_fetch_array($re_ret);

	if($re_count < 1) 
	{
		echo "<script>window.alert('ERROR : Training Class Info Not Found')</script>";
		echo "<script>window.location='trainingclassview.php'</script>";
	}
}
else
{
	$tcid="";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Training Class Update</title>


</head>
<body>


<form action="trainingclassupdate.php" method="post" >

<fieldset class="text-center">
<legend>Enter New Training Class Information :</legend>
<input type="hidden" name="date" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>

    	<input class="form-label" type="hidden" name="txttcid" value="<?php echo $tcid ?>" readonly/>

	<div class="form-group">
    	<label class="form-label" for="">Training Class</label>
    	<input class="form-label" type="text" name="txttcname" value="<?php echo $tcname ?>" readonly/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Class</label>
    	<input class="form-label" type="text" name="txtcname" value="<?php echo $cname ?>" readonly/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Tutor</label>
    	<input class="form-label" type="text" name="txttname" value="<?php echo $tname ?>" readonly/>
    </div>

    <div class="form-group">
    	<label class="form-label" for="">Email</label>
    	<input class="form-label" type="text" name="txtmail" value="<?php echo $mail ?>" required/>
    </div>
    
    <div class="form-group">
    	<label class="form-label" for="">Start Date</label>
    	<input class="form-label" type="date" name="txtsdate" value="<?php echo $sdate ?>" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Description</label>
    	<input class="form-label" type="text" name="txtdesc" value="<?php echo $description ?>" required/>
    </div>

	<input class="btn btn-secondary" type="submit" name="btnup" value="Update"/>
	<input class="btn btn-danger" type="reset" value="Clear"/>

</fieldset>



</form>
</body>
</html>