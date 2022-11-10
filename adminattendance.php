<?php  
session_start();
include('connect.php');
include('adminhead.php');

if(isset($_GET['pieid']))
{
  $eid = $_GET['pieid'];
  $sdate = $_GET['sdate'];
  $edate = $_GET['edate'];


  $select="SELECT DISTINCT e.eid, e.name, d.department_name, r.role
    from employee e, department d, role r, employee_data ed
    where ed.did = d.did and ed.rid = r.rid and ed.eid = e.eid and e.eid='$eid'
    ";
	
	$query=mysqli_query($connection,$select);
	$data=mysqli_fetch_array($query);
	$name=$data['name'];
	$role=$data['role'];
	$dept=$data['department_name'];

  $List1="SELECT COUNT(a.atid) as catid
  FROM  attendance a
  WHERE a.date between '$sdate' and '$edate' and a.atid = 1 and a.eid = $eid
  ";
  $List2="SELECT COUNT(a.atid) as catid
  FROM  attendance a
  WHERE a.date between '$sdate' and '$edate' and a.atid = 2 and a.eid = $eid
  ";
  $List3="SELECT COUNT(a.atid) as catid
  FROM  attendance a
  WHERE a.date between '$sdate' and '$edate' and a.atid = 3 and a.eid = $eid
  ";

// select [Type], count(*) as Total From DBase.dbo.MyTable group by [Type]

  $ret1=mysqli_query($connection,$List1);
  $ret2=mysqli_query($connection,$List2);
  $ret3=mysqli_query($connection,$List3);

  // print_r($ret1);

}
else
{

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
            echo "['Presnet', ".$show1['catid']."],";
            echo "['Absent', ".$show2['catid']."],";
            echo "['Leave', ".$show3['catid']."]";
            // echo "[Communication, ".$show['communication']."],";
          
          ?>
          ]);

          var options = {
          title: 'Employee Attendence Chart',
          is3D: true,
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
          chart.draw(data, options);
          }
          </script>
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
              </td>
              <td><div id="piechart_3d" style="width: 900px; height: 500px;"></div></td>
            </tr>
          </table>
          
          
          
          
        
    
  </head>
  <body>
    
    
  </body>
</html>


