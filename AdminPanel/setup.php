<html>
   <head>
      <title>Welcome </title>
	<img src="header.jpg" style="width:100%;height:150px;">
	<link rel="stylesheet" href="style.css"> 
   </head>
 <div>  
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
Enter Test Code: 
<br/>
(Test code is unique for each test. You will pass this test code to everyone attempting the test so that they will receive questions according to your configuration. You can have different configuration for diffrent departments allowing you to configure test for each department uniquely. eg: Finance_orgname)
<input type="text" name="testcode" value="<?php echo isset($_POST['testcode']) ? $_POST['testcode']:''?>"/>
<br/>
Enter Organisation Name: 
<br/>
(This is to help build test question using this organisation name.)
<input type="text" name="orgname" value="<?php echo isset($_POST['orgname']) ? $_POST['orgname']:''?>"/><br/>
Enter Domain: 
<br/>
(We will create look-a-like set of domains of the domain name entered here.You can choose the one which is not legit and looks more like your domain such that enduser will not notice the difference eg of input: www.domainname.com the domain you should choose which is close match to this is: www.domainame.com -note the missing 'n')
<input type="text" name="orgdomain" value="<?php echo isset($_POST['orgdomain']) ? $_POST['orgdomain']:''?>"/><br/>
<input type="submit" value="Generate Domain Variation"/>
</form>
</html>
<?php
error_reporting(0);
   include('session.php');
   if (isset ($_POST['orgdomain']))
   {
   $pyscript = 'C:\\xampp\\htdocs\\AdminPanel\\dnstwist-master\\dnstwist.py';
$python = 'C:\\Python27\\python.exe';
$filepath = '--dictionary C:\\xampp\\htdocs\\AdminPanel\\dnstwist-master\\dictionaries\\english.dict --format idle';
$orgdomain = htmlspecialchars($_POST['orgdomain']);
$orgname = htmlspecialchars($_POST['orgname']);
$orgdomainstr=str_replace('|','\|',$orgdomain);
if (preg_match("/^(?!\-)(?:[a-zA-Z\d\-]{0,62}[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/","$orgdomainstr"))
	{
		$orgdomain1=$_POST['orgdomain'];
	}
	else
	{
		echo "Please enter correct domain name";
	}
$testcode = htmlspecialchars($_POST['testcode']);
//echo $cmd;
$cmd = "$python $pyscript $filepath $orgdomain1";
   $tmp = shell_exec("$cmd");
  echo "<div>";
  echo "<form method='post' action='setup2.php'>";
  echo "<textarea name='domains' rows='10' cols='80'>";
  echo $tmp;
  echo "</textarea><br/><br/>";
  echo "Enter Selected Domain: <br/>";
  echo "(Please enter the name of final domain which you have selected from above list)";
  echo "<input type='text' name='finaldomain'/>";
  echo "Valid Email-Id: <br/>";
  echo "(Enter one of the valid email-id here from which generally mass communication happens, we will use this as a base to generate phishing email-ids)<br/>";
  echo "<input type='email' name='email' style='width: 100%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;'/><br/>";
  echo "Email Format: <br/>";
  echo "(Please paste one legit email content here eg: Password change email)<br/>";
  echo "<textarea name='emailformat' rows='15' cols='90'></textarea><br/>";
  echo "Enter URL: <br/>";
  echo "(Enter the URI of the site here which you want us to replicate as-is to create a phishing site eg: https://www.domainame.com/)<br/>";
  echo "<input type='url' name='url' style='width: 100%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;'/><br/>";
  echo "<input type='submit' value='Submit'/>";
  echo "<input type='hidden' name='orgname' value='$orgname'/>";
  echo "<input type='hidden' name='orgdomain' value='$orgdomain1'/>";
  echo "<input type='hidden' name='testcode' value='$testcode'/>";
  echo "</form>";
  echo "</div>";
   }   
?>
