<?php  
include('connect.php');
include('adminhead.php');

if(isset($_POST['btnadd'])) 
{
	
            echo "<script>window.alert('SUCCESS : Now loading Rating Pie Chart')</script>";
        
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Role</title>


</head>
<body>


<form action="alert.php" method="post" enctype="multipart/form-data">

<fieldset class="text-center">
<legend></legend>


	<input type="submit" class="btn btn-secondary" name="btnadd" value="Add"/>
</fieldset>



</form>
</body>
</html>