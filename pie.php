<?php  
session_start();
include('connect.php');
include('managerhead.php');

if(isset($_GET['rateid']))
{
  $eid = $_GET['rateid'];
  $sdate = $_GET['sd'];
  $edate = $_GET['ed'];


  $select="SELECT DISTINCT e.eid, e.name, d.department_name, r.role
    from employee e, department d, role r, employee_data ed
    where ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid and e.eid='$eid'
    ";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$name=$data['name'];
	$role=$data['role'];
	$dept=$data['department_name'];


  
  $List1="SELECT SUM(communication) as cum
  FROM  rating
  WHERE date between '$sdate' and '$edate' and eid = $eid 
  ";
  $List2="SELECT SUM(teamwork) as team
  FROM  rating
  WHERE date between '$sdate' and '$edate' and eid = $eid  
  ";
  $List3="SELECT SUM(execution) as exe
  FROM  rating
  WHERE date between '$sdate' and '$edate' and eid = $eid  
  ";
  $List4="SELECT SUM(adaptability) as ada
  FROM  rating
  WHERE date between '$sdate' and '$edate' and eid = $eid  
  ";
  $List5="SELECT SUM(courage) as cou
  FROM  rating
  WHERE date between '$sdate' and '$edate' and eid = $eid  
  ";

  $ret1=mysqli_query($connection,$List1);
  $ret2=mysqli_query($connection,$List2);
  $ret3=mysqli_query($connection,$List3);
  $ret4=mysqli_query($connection,$List4);
  $ret5=mysqli_query($connection,$List5);
  
}

   


?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['type', 'date'],
          <?php
          $show1 = mysqli_fetch_array($ret1);
          $show2 = mysqli_fetch_array($ret2);
          $show3 = mysqli_fetch_array($ret3);
          $show4 = mysqli_fetch_array($ret4);
          $show5 = mysqli_fetch_array($ret5);
            echo "['Communication', ".$show1['cum']."],";
            echo "['Teamwork', ".$show2['team']."],";
            echo "['Execution', ".$show3['exe']."],";
            echo "['Adaptability', ".$show4['ada']."],";
            echo "['Courage', ".$show5['cou']."]";

            // echo "[Communication, ".$show['communication']."],";
          
      ?>
        ]);

        var options = {
          title: 'Employee Rating Chart',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <table>
      <tr>
        <td>
        <fieldset class="text-center">
                <legend>Employee Info :</legend>
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
                </fieldset>
        <td>
          <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
        </td>
        </td>
      </tr>
    </table>
  </body>
</html>