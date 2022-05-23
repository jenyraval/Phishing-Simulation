<?php
 error_reporting(0);
 include('session.php');
include_once 'config.php';
?>
<html>
   <head>
      <title>Welcome Employee</title>
	<img src="header.jpg" style="width:100%;height:150px;">
	<style>
.selectBox{
  border-radius:4px;border:1px solid #AAAAAA;background: none repeat scroll 0 0 #FFFFFF;
  background-color:  #e0e0eb; height: 23px;
}
  .navbar a:hover {
  background: #ddd;
  color: black;
}
.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}
.navbar {
  overflow: hidden;
  background-color: #333;
  top: 0;
  width: 100%;
}
	</style>
   </head>
   <body> 
     <div class="navbar">
  <a href="setup.php">Setup Test Enviornment</a>
  <a href="analysis.php">Analysis</a>
  <a href="invite.php">Invite</a>
  <a href = "logout.php">Sign Out</a>
	 
	</div> 
   Select testcode for which you want to view analysis: 
   <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
   <select name="testcode" class="selectBox">
   <?php 
   $query = "select distinct testcode from organisation";
   $result = mysqli_query($db,$query);
   while ($rows = mysqli_fetch_array($result))
   {
	   ?>
	<option value="<?php echo $rows['testcode'];?>"><?php echo $rows['testcode'];?></option> 
<?php	
   }
   ?>
   </select>
	<input type="submit" name="submit" value="Analyse">
	</form>
   <?php
   if (isset($_POST['submit'])) {
   $testcode1 = mysqli_real_escape_string($db,$_POST['testcode']);
   }
 //employee who passed test
   $query1= "select distinct empid from answer where testcode = '$testcode1'; ";
   $query2= "select empid,COUNT(*) as total from answer where ansgiven=actualans and testcode = '$testcode1' GROUP by empid HAVING total > 9;";
   $result1 = mysqli_query($db,$query1);
   $result2 = mysqli_query($db,$query2);
   $totalemp = mysqli_num_rows($result1);
   $passed = mysqli_num_rows($result2);
   $failed = $totalemp - $passed ;
   ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		   var data = google.visualization.arrayToDataTable([
		   ['Passed','Failed'],
		   <?php
			   echo "['Passed',".$passed."],";
			   echo "['Failed',".$failed."],";
		   ?>
		   ]);
		    var options = {
          title: 'Number of employees who passed test'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
  </script>
       <div id="piechart" style='width: 550px; height: 400px;
    position: absolute;
    top: 250px;
    left: 50px;
'></div>
<?php
// Number of employees who will click on the malicious links	   
 $query3 = "select empid,COUNT(*) as total from answer where ansgiven!=actualans and testcode = '$testcode1' and mode = 'link' GROUP by empid";
 $result3 = mysqli_query($db,$query3);
 $linkemp = mysqli_num_rows($result3);
 $safe = $totalemp - $linkemp;
?>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		   var data = google.visualization.arrayToDataTable([
		   ['Click','Won\'t Click'],
		   <?php
			   echo "['Click',".$linkemp."],";
			   echo "['Won\'t Click',".$safe."],";
		   ?>
		   ]);
		    var options = {
          title: 'Number of employees who will click on the malicious links'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart.draw(data, options);
      }
  </script>
       <div id="piechart1" style='width: 550px; height: 400px;
    position: absolute;
    top: 250px;
    left: 550px;
'></div>
<?php
// Number of employees who will download the dangerous attachments	   
 $query4 = "select empid,COUNT(*) as total from answer where ansgiven!=actualans and testcode = '$testcode1' and mode = 'attachment' GROUP by empid";
 $result4 = mysqli_query($db,$query4);
 $attachemp = mysqli_num_rows($result4);
 $nodownload = $totalemp - $attachemp;
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		   var data = google.visualization.arrayToDataTable([
		   ['Download','Won\'t Download'],
		   <?php
			   echo "['Download',".$attachemp."],";
			   echo "['Won\'t Download',".$nodownload."],";
		   ?>
		   ]);
		    var options = {
          title: 'Number of employees who will download the dangerous attachments'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
  </script>
       <div id="piechart2" style='width: 550px; height: 400px;
    position: absolute;
    top: 600px;
    left: 50px;
'></div>
<?php
 $query5 = "select empid,COUNT(*) as total from answer where ansgiven!=actualans and testcode = '$testcode1' and mode = 'email' GROUP by empid";
 $result5 = mysqli_query($db,$query5);
 $emailemp = mysqli_num_rows($result5);
 $noreply = $totalemp - $emailemp;
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		   var data = google.visualization.arrayToDataTable([
		   ['Reply','Won\'t Reply'],
		   <?php
			   echo "['Reply',".$emailemp."],";
			   echo "['Won\'t Reply',".$noreply."],";
		   ?>
		   ]);
		    var options = {
          title: 'Number of employees who will reply to phishing emails'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart3'));

        chart.draw(data, options);
      }
  </script>
       <div id="piechart3" style='width: 550px; height: 400px;
    position: absolute;
    top: 600px;
    left: 550px;
'></div>
<?php
 $average = ($passed + $nodownload + $safe + $noreply )/4;
 $unaware = $totalemp - $average;
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		   var data = google.visualization.arrayToDataTable([
		   ['Aware','Unaware'],
		   <?php
			   echo "['Aware',".$average."],";
			   echo "['Unaware',".$unaware."],";
		   ?>
		   ]);
		    var options = {
          title: 'Average awareness of the organisation'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart4'));

        chart.draw(data, options);
      }
  </script>
       <div id="piechart4" style='width: 550px; height: 400px;
    position: absolute;
    top: 920px;
    left: 50px;
'></div>
  <div id="report" style='
    position: absolute;
    top: 970px;
    left: 600px;
'>
<?php
$download= "select empid,COUNT(*) as NumberOfRightAnswers from answer where ansgiven=actualans and testcode = '$testcode1' GROUP by empid;";
   $downresult = mysqli_query($db,$download); ?>
 <table border="2" style= "background-color: #DCDCDC; color: #000000; margin: 0 auto;" >
      <thead>
	  <b> Employee wise result </b> <br/><br/>
        <tr>
          <th>Employee id</th>
          <th>No of right answers</th>
        </tr>
      </thead>
      <tbody>
 <?php
          while( $row = mysqli_fetch_assoc( $downresult ) ){
            echo
            "<tr>
              <td>{$row['empid']}</td>
              <td>{$row['NumberOfRightAnswers']}</td>
            </tr>\n";
          }
        ?>
      </tbody>
    </table>
     <?php mysqli_close($db); ?>
</div>
</body>   
</html>
