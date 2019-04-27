<?php
include_once 'config.php';
if (isset($_POST['submit'])) {
if(isset($_POST['radio']))
{
$empid = $_POST['empid'];
$ansgiven = $_POST['radio'];
$actualans = $_POST['posneg'];
$testcode = $_POST['testcode'];
$m = $_POST['mode'];
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
$query1= "select questionid from testdb where empid='$empid' and testcode='$testcode';";
$result = mysqli_query($db,$query1);
$interest = array();
//$question2id = array();

while( $row = mysqli_fetch_assoc($result))
{
	$interest[] = $row;
}
$question2id = implode($interest[3]);
 
 $query2 = "select emailheading from questionsdb where questionid='$question2id';";
 $result1 = mysqli_query($db,$query2);
 $emailheading = implode(mysqli_fetch_assoc($result1));
 $query3 = "select question from questionsdb where questionid='$question2id';";
 $result2 = mysqli_query($db,$query3);
 $emailbody = implode(mysqli_fetch_assoc($result2));
 $query4 = "select type from questionsdb where questionid='$question2id';";
 $result3 = mysqli_query($db,$query4);
 $type = implode(mysqli_fetch_assoc($result3));
 $query5 = "select posneg from questionsdb where questionid='$question2id';";
 $result4 = mysqli_query($db,$query5);
 $posneg = implode(mysqli_fetch_assoc($result4));
 $query6 = "select mode from questionsdb where questionid='$question2id';";
 $result5 = mysqli_query($db,$query6);
 $mode = implode(mysqli_fetch_assoc($result5));
 if ($posneg == 'pos')
	 { $valid = 'valid';}
 else {$valid = 'invalid';}
 $query7 = "select email from email where valid = '$valid' and type='$type' and testcode='$testcode' order by RAND() limit 1;";
 $result6 = mysqli_query($db,$query7);
 $emailid = implode(mysqli_fetch_assoc($result6));
 
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
  Question 5:
   <br/>
    <form action="test6.php" method="post">
  <input type="radio" name="radio" value="report" required> Report
  &nbsp;<input type="radio" name="radio" value="reply"> Click/Reply/Download
  &nbsp;<input type="radio" name="radio" value="ignore"> Ignore
  &nbsp;<input type="hidden" name="empid" value="<?php echo $empid; ?>" />
  <input type="hidden" name="testcode" value="<?php echo $testcode; ?>" />
  <input type="hidden" name="posneg" value="<?php echo $posneg; ?>" />
  <input type="hidden" name="mode" value="<?php echo $mode; ?>" />
  <input type="submit" name="submit" value="Next" />
</form>  
<iframe srcdoc="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='logo_tiny.png'>&nbsp;&nbsp;<input type='text' name='search'>&nbsp; &nbsp;<input type='button' value='Search'><br/><img src='ribbon.jpg' height=40 width=1000 align=right><img src='gcompose.jpg' height=250 width=250 align=left><br/>

<div id='emailcontent' style='
    position: absolute;
    top: 120px;
    left: 300px;
	font-size: 20px;
	font-weight: bold;
'>
        <?php echo $emailheading; ?>&nbsp;&nbsp;<img src='inboxicon.jpg' height=20 width=70 align=right>
</div>
<div id='fromemail' style='
	position: absolute;
	top: 165px;
	left: 300px;
	font-size: 15px;
'>
<img src='fromicon.jpg' height=35 width=35 align=left> &nbsp; &lt; <?php echo $emailid; ?> &gt; <br/>&nbsp;&nbsp;&nbsp;<img src='tome.jpg' height=20 width=45></div>

<div id='forward' style=' position: absolute; top:165px; left: 950px; color: #5f6368; '> <?php echo date("M d, Y, h:i A"); ?> &nbsp;&nbsp;
<img src=forward.jpg height=25 width=100 align=right></div>

<div id='emailbody' style='
	position: absolute;
	top: 230px;
	left: 300px;
	
	'>
	<?php echo nl2br($emailbody); ?> <br><?php if ($mode=='attachment') { echo '<br/><img src=download.jpg height=100 width=140><br/>';} ?> <img src='reply.jpg' height=50 width=400></div>
	



" width="100%" height="400"> 


</iframe>

 </body>
 
 </html>