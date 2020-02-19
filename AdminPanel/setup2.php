<html>
   <head>
      <title>Welcome </title>
	<img src="header.jpg" style="width:100%;height:150px;">
   </head>
    <style>
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
    <body>
   <!--   <h1>Welcome <?php echo $login_session; ?></h1> -->
	  
	  <div class="navbar">
  <a href="setup.php">Setup Test Enviornment</a>
  <a href="analysis.php">Analysis</a>
   <a href="invite.php">Invite</a>
  <a href = "logout.php">Sign Out</a>
	 
	</div> 
   </body>
   
</html>
<?php
error_reporting(0);
include('session.php');
 include_once 'config.php';
 
 
 $orgname = mysqli_real_escape_string($db,$_POST['orgname']);
 $orgdomain = mysqli_real_escape_string($db,$_POST['orgdomain']);
 $testcode = mysqli_real_escape_string($db,$_POST['testcode']);
 $finaldomain = mysqli_real_escape_string($db,$_POST['finaldomain']);
 $url = mysqli_real_escape_string($db,$_POST['url']);
 $emailid = mysqli_real_escape_string($db,$_POST['email']);
 $email = mysqli_real_escape_string($db,$_POST['emailformat']); //nl2br 
 $query = "insert into organisation (testcode,orgname,orgdomain,finaldomain,url,emailid,email) values ('$testcode','$orgname','$orgdomain','$finaldomain','$url','$emailid','$email');";
 if(mysqli_query($db, $query))
 {
	 echo "<br/>";
    echo "Test Enviornment has been setup, you can go ahead and launch test";
	
} 
else
{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($db);
} 
$firstnameemail = strtok($emailid,'@');
$domain = substr($emailid, strpos($emailid,"@")+1);

$email1 = "$firstnameemail@web$domain";
$email2 = "manager@hr$domain";
$email3 = "helpdesk@it$domain";
$email4 = $emailid;
$email5 = "webadmin@$domain";
$email6 = "noreply@web$domain";
$email7 = "hr@$domain";
$email8 = "webmail@web$domain";
$email9 = "webmail@$domain";
$email10 = "ithelp@1$domain";
$email11 = "admin@$domain";
$email12 = "$firstnameemail@hr$domain";
$email13 = "$firstnameemail@org$domain";

$query1 = "insert into email (testcode,email,type,valid) values ('$testcode','$email1','it','invalid');";
$query2 = "insert into email (testcode,email,type,valid) values ('$testcode','$email2','hr','invalid');";
$query3 = "insert into email (testcode,email,type,valid) values ('$testcode','$email3','it','invalid');";
$query4 = "insert into email (testcode,email,type,valid) values ('$testcode','$email4','it','valid');";
$query5 = "insert into email (testcode,email,type,valid) values ('$testcode','$email5','it','valid');";
$query6 = "insert into email (testcode,email,type,valid) values ('$testcode','$email6','it','invalid');";
$query7 = "insert into email (testcode,email,type,valid) values ('$testcode','$email7','hr','valid');";
$query8 = "insert into email (testcode,email,type,valid) values ('$testcode','$email8','it','invalid');";
$query9 = "insert into email (testcode,email,type,valid) values ('$testcode','$email9','it','valid');";
$query10 = "insert into email (testcode,email,type,valid) values ('$testcode','$email10','it','invalid');";
$query11 = "insert into email (testcode,email,type,valid) values ('$testcode','$email11','it','valid');";
$query12 = "insert into email (testcode,email,type,valid) values ('$testcode','$email12','hr','invalid');";
$query13 = "insert into email (testcode,email,type,valid) values ('$testcode','$email13','hr','invalid');";
mysqli_query($db,$query1);
mysqli_query($db,$query2);
mysqli_query($db,$query3);
mysqli_query($db,$query4);
mysqli_query($db,$query5);
mysqli_query($db,$query6);
mysqli_query($db,$query7);
mysqli_query($db,$query8);
mysqli_query($db,$query9);
mysqli_query($db,$query10);
mysqli_query($db,$query11);
mysqli_query($db,$query12);
mysqli_query($db,$query13);
?>
<html>
<head>
	<title>Welcome</title>
</head>
<body>

	<?php
		if (isset($_GET['e'])) {
			echo $_GET['e'] . '<hr>';
		}
	?>
	
	<?php
		if (isset($_GET['s'])) {
		//	echo '<a href="output.html" target="__blank">Visit Saved Page</a>' . '<hr>';
			echo "<script>window.open('output.html','_blank')</script>";

		}
	?>	


	<form action="saveCompletePage.php" method="post">			
			<input type="hidden" id="url" name="url" value="<?php echo $url; ?>" required>
		Please be patient, While we create your look a like site. Make sure you allow pop-up to view. <br/>
		<input type="submit" name="submit" value="Preview phised page">
		
	</form> 

</body>
</html>

