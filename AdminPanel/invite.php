<?php
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
	<br/>
	Upload CSV file having Employee Name and EmailId
	
	<form class="form-horizontal" action="" method="post" name="uploadCSV"
    enctype="multipart/form-data">
    <div class="input-row">
    <br/>    <label class="col-md-4 control-label">Choose CSV File</label> <input
            type="file" name="file" id="file" accept=".csv">
        <button type="submit" id="submit" name="import"
            class="btn-submit">Import</button>
        <br />

    </div>
    <div id="labelError"></div>
</form>
<script type="text/javascript">
	$(document).ready(
	function() {
		$("#frmCSVImport").on(
		"submit",
		function() {

			$("#response").attr("class", "");
			$("#response").html("");
			var fileType = ".csv";
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("
					+ fileType + ")$");
			if (!regex.test($("#file").val().toLowerCase())) {
				$("#response").addClass("error");
				$("#response").addClass("display-block");
				$("#response").html(
						"Invalid File. Upload : <b>" + fileType
								+ "</b> Files.");
				return false;
			}
			return true;
		});
	});
</script>

<?php

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into invite (username,email)
                   values ('" . $column[0] . "','" . $column[1] . "')";
            $result = mysqli_query($db, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>

Users Selected for invite are:
<?php
if (isset($_POST["import"]))
{
$sqlSelect = "SELECT distinct * FROM invite";
$result = mysqli_query($db, $sqlSelect);
            
if (mysqli_num_rows($result) > 0) {
?>
<table id='userTable'>
    <thead>
        <tr>
            <th>User Name</th>
            <th>Email Id</th>
        </tr>
    </thead>
    <?php
	while ($row = mysqli_fetch_array($result)) {
    ?>

    <tbody>
        <tr>
            <td><?php  echo $row['username']; ?></td>
            <td><?php  echo $row['email']; ?></td>
        </tr>
     <?php
     }
     ?>
    </tbody>
</table>
<?php }} ?>
<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
<input type="submit" name="submit" value="Invite">
</form>
<form action="invite2.php" method="post">
<?php 

 if(array_key_exists('submit', $_POST)) { 
           sendmail(); 
       } 
function sendmail()
{
	echo "<br/>";
	echo "Please enter below details to send email";
	echo "<br/><br/>";
	echo "SMTP Server Name. eg:smtp1.example.com ";
	echo "<br/>";
	echo "<input type='text' name='server'/>";
	echo "<br/>";
	echo "SMTP User Name. eg:user@example.com ";
	echo "<br/>";
	echo "<input type='text' name='username'/>";
	echo "<br/>";
	echo "SMTP Password. eg:secret ";
	echo "<br/>";
	echo "<input type='password' name='password'/>";
	echo "<br/>";
	echo "Mail Body ";
	echo "<br/>";
	echo "<textarea name='mailbody' rows='10' cols='70'></textarea>";
	echo "<br/><br/>";
	echo "<input type='submit' name='saveconfig' value='Send Mail'/>";
	
}		
?>

</form>
