<?php
   include('session.php');
?>
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
  <a href = "logout.php">Sign Out</a>
	 
	</div> 
   </body>
   
</html>