<?php  

session_start();
include('connect.php');
include('adminhead.php');


if(isset($_GET['cid']))
{
	$cid=$_GET['cid'];

	$select="select * from candidate
			 where cid='$cid'";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$cid=$data['cid'];
}
else
{
	
}

if(isset($_POST['btnadd'])) 
{
	$txtcid=$_POST['txtcid'];
	$txtname=$_POST['txtname'];
	$txtmail=$_POST['txtmail'];
	$Select="SELECT * FROM employee
            WHERE email='$txtmail'";
    $retSelect=mysqli_query($connection,$Select);
    $Select_Count=mysqli_num_rows($retSelect);
        if ($Select_Count>0) 
        {
            echo "<script>window.alert('Error :Email Already Exists')</script>";
            echo "<script>window.location='candidateview.php'</script>";
        }
        else 
        {
            $txtpassword=$_POST['txtpassword'];
	        $txtaddress=$_POST['txtaddress'];
	        $txtecname=$_POST['txtecname'];
	        $txtecnum=$_POST['txtecnum'];
	        $txtinfo=$_POST['txtinfo'];
			$txtdate=$_POST['txtdate'];
	


		    $Insert="INSERT INTO `employee`
		    (`name`, `email`,`password`,`address`,`ename`,`enum`,`info`,`cid`) 
		    VALUES 
		    ('$txtname','$txtmail','$txtpassword','$txtaddress','$txtecname','$txtecnum','$txtinfo','$txtcid')
		    ";

		    $ret=mysqli_query($connection,$Insert);

		    if($ret) 
		    {
				$txt="Admin employed ".$txtname." at ". $txtdate;

				$insert="INSERT INTO `log`
				(`eid`, `ltid`, `date`,`text`) 
				VALUES ('1','$txtdate','$txt')
				";
				$ret1=mysqli_query($connection,$insert);
			    echo "<script>window.alert('SUCCESS : New Employee Added')</script>";
			    echo "<script>window.location='adminemployee.php'</script>";
		    }
		    else
		    {
			    echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
				echo "<script>window.location='admincandidate.php'</script>";
		    }

			$insert1 ="UPDATE candidate
			SET
			status='Employed'
			WHERE
			cid='$txtcid'
			";
			$ret2=mysqli_query($connection,$insert1);
	        
			$Select="SELECT  e.eid, d.did, r.rid
			from candidate c, employee e, recruitment re, department d, role r
			where e.cid = c.cid
			and c.reid = re.reid
			and re.did = d.did
			and re.rid = r.rid";

			$ed_ret = mysqli_query($connection,$Select);
            $ed_count = mysqli_num_rows($ed_ret);
			for($i=0; $i<$ed_count; $i++)
			{
                $row=mysqli_fetch_array($ed_ret);
				$eid=$row['eid'];
				$rid=$row['rid'];
				$did=$row['did'];
			
				
				    $insert="INSERT INTO `employee_data`
		            (`eid`, `rid`, `did`) 
		            VALUES 
		            ('$eid','$rid','$did')
		            ";
					$ret1=mysqli_query($connection,$insert);
			    
			}
		}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>


</head>
<body>


<form action="employee.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend>Enter New Employee Info :</legend>
<input type="hidden" name="txtdate" id="currentTime">
 
<script>
var today = new Date();
var time = today.getFullYear() + "-" + today.getMonth() + "-" + today.getDate();
  document.getElementById("currentTime").value = time;
</script>
    
	<input type="hidden" name="txtcid" value="<?php echo $cid ?>">

	<div class="form-group">
    	<label class="form-label" for="">Name</label>
    	<input class="form-label" type="text" pattern="[A-Za-z]*" name="txtname"  placeholder="Eg.John" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Email</label>
    	<input class="form-label" type="email" name="txtmail" placeholder="Eg.***@gmail.com" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Password</label>
    	<input class="form-label" type="password" pattern=".{8,}" name="txtpassword" placeholder="Eg.Password" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Address</label>
    	<input class="form-label" type="text" name="txtaddress" placeholder="Eg.Address" required/>
    </div>
    
	<div class="form-group">
    	<label class="form-label" for="">Emergency Contact Name</label>
    	<input class="form-label" pattern="[A-Za-z]*" type="text" name="txtecname" placeholder="Eg.Sins" required/>
    </div>
    
	<div class="form-group">
    	<label class="form-label" for="">Emergency Contact Number</label>
    	<input class="form-label" type="number" name="txtecnum" placeholder="Eg.000-000-000" required/>
    </div>

	<div class="form-group">
    	<label class="form-label" for="">Additional Info</label>
    	<input class="form-label" type="text" name="txtinfo" placeholder="Eg.Description" required/>
    </div>

	<input type="submit" class="btn btn-secondary" name="btnadd" value="Add"/>
	<input type="reset" class="btn btn-danger" value="Clear"/>
</fieldset>



</form>
</body>
</html>