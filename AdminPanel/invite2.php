<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
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
	
	<?php
	$server= strval($_POST['server']);
	$username= strval($_POST['username']);
	$password= strval($_POST['password']);
	$mailbody = strval($_POST['mailbody']);
	$mail = new PHPMailer(true);
try {
    //Server settings smtp.gmail.com
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = $server;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $username;                      // SMTP username
    $mail->Password   = $password;                          // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($username, 'Mailer');
	
	 $query = "SELECT distinct * FROM invite";
	$result1 = mysqli_query($db, $query);
	if(mysqli_num_rows($result1) > 0){
	//write for each here
	while ($row = mysqli_fetch_array($result1))
	{
		$mail->addAddress($row[1], $row[0]); 
	//echo $row['email'];
	}
	mysqli_free_result($result1);
	}
 // Add a recipient
 //   $mail->addAddress('jenyraval@gmail.com');               // Name is optional
 //   $mail->addReplyTo('jenyraval@gmail.com', 'Information');
 //   $mail->addCC('jenyraval@gmail.com');
 //   $mail->addBCC('jenyraval@gmail.com');
	 // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Invite!';
    $mail->Body    = $mailbody;
    $mail->AltBody = $mailbody;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
	?>