<html>
   <head>
      <title>Welcome Employee</title>
	<img src="header.jpg" style="width:100%;height:150px;">
<!--	<link rel="stylesheet" href="style.css"> -->
	 <style>
.button {
  background-color: #555555;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
   </head>
   <body>
   <SCRIPT type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</SCRIPT>
   <button type="button" class="button" onclick="location.href = 'index.php';">Go-back Home</button><br/><br/>
</body>   
</html>
<?php
 include_once 'config.php';
 
if (isset($_POST['submit'])) {
if(isset($_POST['radio']))
{
$empid = mysqli_real_escape_string($db,$_POST['empid']);
$ansgiven = mysqli_real_escape_string($db,$_POST['radio']);
$actualans = "yes";
$testcode = mysqli_real_escape_string($db,$_POST['testcode']);
$query = "insert into answer (empid,testcode,ansgiven,actualans,mode) values ('$empid','$testcode','$ansgiven','$actualans','link');";
mysqli_query($db,$query);
$query1 = "select count(*) from answer where testcode='$testcode' and empid='$empid' and ansgiven=actualans;";
$result = mysqli_query($db,$query1);
$intresult = $result->fetch_array();
$finalresult = intval($intresult[0]);

if ($finalresult>9)
{
	echo "<img src='pass.jpg' height=450 width=600 style='display: block;margin-left: auto;margin-right: auto;'/>";
	
}
else 
{
	echo "You did not achieve the desired score to pass the test!";
}
}
}
?>
