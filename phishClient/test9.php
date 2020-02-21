<?php
include_once 'config.php';
if (isset($_POST['submit'])) {
if(isset($_POST['radio']))
{
$empid = mysqli_real_escape_string($db,$_POST['empid']);
$ansgiven = mysqli_real_escape_string($db,$_POST['radio']);
$actualans = "report";
$testcode = mysqli_real_escape_string($db,$_POST['testcode']);
$query = "insert into answer (empid,testcode,ansgiven,actualans,mode) values ('$empid','$testcode','$ansgiven','$actualans','sms');";
mysqli_query($db,$query);
}
}
 
?>
<html>
   <head>
      <title>Welcome Employee</title>
	<img src="header.jpg" style="width:100%;height:150px;"> 
	 <script type="text/javascript" src="progress.js"></script>
	<link rel="stylesheet" type="text/css" href="progress.css">
 </head>
 <body>
 <SCRIPT type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</SCRIPT><p style="font-family: auto;">
    Question 9:
   Which of these attachments is more likely to be a phishing attempt? </p>
    <form action="test10.php" method="post">
		<span style="display: inline-block;font-family: auto;">
  <input type="radio" name="radio" value="A" required> A
  &nbsp;<input type="radio" name="radio" value="B"> B 
  &nbsp; <input type="hidden" name="empid" value="<?php echo $empid; ?>" />
  <input type="hidden" name="testcode" value="<?php echo $testcode; ?>" />
  <input type="submit" name="submit" value="Next" />
    </span>
	<div class="progress" style="width: 50%;display: inline-flex;">
				  <div class="progress-bar" role="progressbar" aria-valuenow="30"
				  aria-valuemin="0" aria-valuemax="50" style="width:90%">
				    <span > 90% Complete</span>
				  </div>
			  </div>
</form>  
 <iframe srcdoc="<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>A:</b><img src='sbq-A.jpg' height=141px width=220px align='top'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>B:</b><img src='sbq-B.jpg' height=146px width=240px align='top'>" width="100%" height="300"> </iframe>
 </body>
 
 </html>