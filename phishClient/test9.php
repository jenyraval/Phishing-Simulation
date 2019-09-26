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
 </head>
 <body>
 <SCRIPT type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</SCRIPT>
 
    Question 9:
   Which of these attachments is more likely to be a phishing attempt? <br/><br/>
    <form action="test10.php" method="post">
  <input type="radio" name="radio" value="A" required> A
  &nbsp;<input type="radio" name="radio" value="B"> B 
  &nbsp; <input type="hidden" name="empid" value="<?php echo $empid; ?>" />
  <input type="hidden" name="testcode" value="<?php echo $testcode; ?>" />
  <input type="submit" name="submit" value="Next" />
</form>  
 <iframe srcdoc="<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>A:</b><img src='sbq-A.jpg' height=141px width=220px align='top'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>B:</b><img src='sbq-B.jpg' height=146px width=240px align='top'>" width="100%" height="300"> </iframe>
 </body>
 
 </html>