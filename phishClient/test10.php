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
<!--	<link rel="stylesheet" href="style.css"> -->
	 <style>

</style>
   </head>
   <body>
   <SCRIPT type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</SCRIPT>
  
   Question 10:
   Observe the website given below thoroughly, 
   Will you refer your friend to visit this website? <br/><br/>
    <form action="result.php" method="post">
  <input type="radio" name="radio" value="yes" required> Yes
  &nbsp;<input type="radio" name="radio" value="no"> No 
  &nbsp; <input type="hidden" name="empid" value="<?php echo $empid; ?>" />
  <input type="hidden" name="testcode" value="<?php echo $testcode; ?>" />
  <input type="submit" name="submit" value="Next" />
</form>  
<iframe srcdoc="<img src='https.jpg' height=17px width=20px align=left>&nbsp;<?php echo "https://$orgdomain"; ?>" width="100%" height="20" scrolling="no" marginheight="0"> </iframe>
 <iframe src="/../AdminPanel/output.html" width="100%" height="400"> </iframe>

</body>   
</html>