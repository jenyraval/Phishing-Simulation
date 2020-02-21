<?php
include_once 'config.php';
if (isset($_POST['submit'])) {
if(isset($_POST['radio']))
{
$empid = mysqli_real_escape_string($db,$_POST['empid']);
$ansgiven = mysqli_real_escape_string($db,$_POST['radio']);
$actualans = mysqli_real_escape_string($db,$_POST['posneg']);
$testcode = mysqli_real_escape_string($db,$_POST['testcode']);
$m = mysqli_real_escape_string($db,$_POST['mode']);
if ($actualans=='neg' && $ansgiven=='reply')
{
	$ansgiven = 'pos';
}
else if ($actualans=='neg' && $ansgiven=='ignore')
{
	$ansgiven = 'pos';
}
else if ($actualans=='neg' && $ansgiven=='report')
{
	$ansgiven = 'neg';
}
else if ($actualans=='pos' && $ansgiven=='reply')
{
	$ansgiven = 'pos';
}
else if ($actualans=='pos' && $ansgiven=='ignore')
{
	$ansgiven = 'neg';
}
else if ($actualans=='pos' && $ansgiven=='report')
{
	$ansgiven = 'neg';
}
$query = "insert into answer (empid,testcode,ansgiven,actualans,mode) values ('$empid','$testcode','$ansgiven','$actualans','$m');";
mysqli_query($db,$query);
}
}
//change here smishing

 
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
  Question 8: </p>
    <form action="test9.php" method="post">
	<span style="display: inline-block;font-family: auto;">
  <input type="radio" name="radio" value="report" required> Report
  &nbsp;<input type="radio" name="radio" value="reply"> Call
  &nbsp;<input type="radio" name="radio" value="ignore"> Ignore
  &nbsp;<input type="hidden" name="empid" value="<?php echo $empid; ?>" />
  <input type="hidden" name="testcode" value="<?php echo $testcode; ?>" />
  <input type="submit" name="submit" value="Next" />
   </span>
	<div class="progress" style="width: 50%;display: inline-flex;">
				  <div class="progress-bar" role="progressbar" aria-valuenow="30"
				  aria-valuemin="0" aria-valuemax="50" style="width:80%">
				    <span > 80% Complete</span>
				  </div>
			  </div>
</form>  
<iframe srcdoc="<center><img src='smishing.jpg' height=270px width=220px>" width="100%" height="300">
</iframe>

 </body>
 
 </html>