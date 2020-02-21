<?php
//header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
//header("Cache-Control: post-check=0, pre-check=0", false);
//header("Pragma: no-cache");

include_once 'config.php'; 
	
$testcode = mysqli_real_escape_string($db,$_POST['testcode']);
$empid = mysqli_real_escape_string($db,$_POST['empid']);
$query = "insert into employee (testcode,empid) values ('$testcode','$empid');";
if(mysqli_query($db, $query))
 {
$fetch = "select * from organisation where testcode='$testcode'";
$result = mysqli_query($db, $fetch);
$row = mysqli_fetch_assoc($result);
$orgname = $row["orgname"];
$orgdomain = $row["orgdomain"];
$finaldomain = $row["finaldomain"];
$url = $row["url"];
$emailid = $row["emailid"];
$email = $row["email"];
//$preview = $row["preview"];

} 
else
{
    echo "ERROR: Could not able to execute";
} 
$query1 = "(select questionid from questionsdb where posneg = 'neg' order by RAND() limit 3) union (select questionid from questionsdb where posneg = 'pos' order by RAND() limit 3) order by RAND()";
$questions = mysqli_query($db, $query1);
while ($row = mysqli_fetch_assoc($questions))
{
$ques = $row["questionid"];	
$query2 = "insert into testdb(testcode,empid,questionid) values('$testcode','$empid','$ques');";
mysqli_query($db, $query2);
}
?>
<html>
   <head>
      <title>Welcome Employee</title>
	<img src="header.jpg" style="width:100%;height:150px;">
<!--	<link rel="stylesheet" href="style.css"> -->
	 <style>
</style>
  <script type="text/javascript" src="progress.js"></script>
	<link rel="stylesheet" type="text/css" href="progress.css">
   </head>
   <body>
   
<SCRIPT type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</SCRIPT>
</HEAD>
<BODY onload="noBack();" 
	onpageshow="if (event.persisted) noBack();" onunload="">
  <p style="font-family: auto;">
   Question 1:
   Observe the website given below thoroughly, 
   Will you refer your friend to visit this website? 	</p>
    <form action="test2.php" method="post">
	 <span style="display: inline-block;font-family: auto;">
  <input type="radio" name="radio" value="yes" required> Yes
  &nbsp;<input type="radio" name="radio" value="no"> No 
  &nbsp; <input type="hidden" name="empid" value="<?php echo $empid; ?>" />
  <input type="hidden" name="testcode" value="<?php echo $testcode; ?>" />
     <input type="submit" name="submit" value="Next"/> 
	    </span>
	<div class="progress" style="width: 50%;display: inline-flex;">
				  <div class="progress-bar" role="progressbar" aria-valuenow="30"
				  aria-valuemin="0" aria-valuemax="50" style="width:10%">
				    <span > 10% Complete</span>
				  </div>
			  </div>
</form>
<iframe srcdoc="<img src='https.jpg' height=17px width=20px align=left>&nbsp;<?php echo "https://$finaldomain"; ?>" width="100%" height="20" scrolling="no" marginheight="0"> </iframe>
 <iframe src="/../AdminPanel/output.html" width="100%" height="400"> </iframe>

</body>   
</html>