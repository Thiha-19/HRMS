<?php  
session_start();
include('connect.php');
include('adminhead.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Home</title>


</head>
<body>


<form action="admincandidate.php" method="post" > 

<fieldset>
<legend>Candidate List :</legend>

<?php  
$c_List="SELECT c.cid, c.cname, d.department_name, r.role, c.dob, c.education, c.expected_salary
FROM candidate c, recruitment re, department d, role r 
WHERE c.reid = re.reid and d.did = re.did and r.rid = re.rid and c.status = ''";
$c_ret=mysqli_query($connection,$c_List);
$c_count=mysqli_num_rows($c_ret);

if ($c_count < 1) 
{
	echo "<p>No Role Records Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-striped">
	<thead>
	<tr>
		<th>#</th>
        <th>Candidate ID</th>
		<th>Candidate Name</th>
		<th>Department Name</th>
		<th>Role</th>
		<th>Date of Birth</th>
		<th>Education</th>
		<th>Expected Salary</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$c_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($c_ret);
		//print_r($rows);

		$cid=$rows['cid'];
		$cname=$rows['cname'];
		$depaertment=$rows['department_name'];
		$role=$rows['role'];
        $dob=$rows['dob'];
        $edu=$rows['education'];
        $es=$rows['expected_salary'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$cid</td>";
		echo "<td>$cname</td>";
		echo "<td>$depaertment</td>";
		echo "<td>$role</td>";
		echo "<td>$dob</td>";
		echo "<td>$edu</td>";
		echo "<td>$es</td>";
		echo "<td></td>";
		echo "<td>
			  <a href='candidatedetail.php?cid=$cid'>Detail</a>
              <a href='candidatedelete.php?cid=$cid'>Delete</a>
			  </td>";
		echo "</tr>";
	}
	 ?>
	 </tbody>
	</table>
<?php
}
?>
</fieldset>


</form>
</body>
</html>