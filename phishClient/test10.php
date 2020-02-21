<?php
include_once 'config.php';
if (isset($_POST['submit'])) {
if(isset($_POST['radio']))
{
$empid = mysqli_real_escape_string($db,$_POST['empid']);
$ansgiven = mysqli_real_escape_string($db,$_POST['radio']);
$actualans = "B";
$testcode = mysqli_real_escape_string($db,$_POST['testcode']);
$query = "insert into answer (empid,testcode,ansgiven,actualans,mode) values ('$empid','$testcode','$ansgiven','$actualans','attachment');";
mysqli_query($db,$query);
}
$fetch = "select * from organisation where testcode='$testcode'";
$result = mysqli_query($db, $fetch);
$row = mysqli_fetch_assoc($result);
$orgdomain = $row["orgdomain"];
}
?>
<html>
   <head>
      <title>Welcome Employee</title>
	<img src="header.jpg" style="width:100%;height:150px;">
	 <script type="text/javascript" src="progress.js"></script>
	<link rel="stylesheet" type="text/css" href="progress.css">
	 <style>

</style>
   </head>
   <body>
   <SCRIPT type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</SCRIPT><p style="font-family: auto;">
  
   Question 10:
   Observe the website given below thoroughly, 
   Will you refer your friend to visit this website? </p>
    <form action="result.php" method="post">
	<span style="display: inline-block;font-family: auto;">
  <input type="radio" name="radio" value="yes" required> Yes
  &nbsp;<input type="radio" name="radio" value="no"> No 
  &nbsp; <input type="hidden" name="empid" value="<?php echo $empid; ?>" />
  <input type="hidden" name="testcode" value="<?php echo $testcode; ?>" />
  <input type="submit" name="submit" value="Next" />
   </span>
	<div class="progress" style="width: 50%;display: inline-flex;">
				  <div class="progress-bar" role="progressbar" aria-valuenow="30"
				  aria-valuemin="0" aria-valuemax="50" style="width:100%">
				    <span > 100% Complete</span>
				  </div>
			  </div>
</form>  
<iframe srcdoc="<img src='https.jpg' height=17px width=20px align=left>&nbsp;<?php echo "https://$orgdomain"; ?>" width="100%" height="20" scrolling="no" marginheight="0"> </iframe>
 <iframe src="/../AdminPanel/output.html" width="100%" height="400"> </iframe>

</body>   
</html>