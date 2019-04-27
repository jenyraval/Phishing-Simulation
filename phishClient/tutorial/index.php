<?php include_once '../config.php'; ?>
<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta name="viewport" content="width = 1050, user-scalable = no" />
<script type="text/javascript" src="../tutorial/extras/jquery.min.1.7.js"></script>
<script type="text/javascript" src="../tutorial/extras/modernizr.2.5.3.min.js"></script>
</head>
<body>

<div class="flipbook-viewport">
	<div class="container">
		<div class="flipbook">
			<div name="page1" style="background-image:url(pages/bg.jpg);color:white;font-family:calibri;">
			<br/><br/><br/><br/><br/><br/><br/><br/><br/>
			<center><h1> Phishing</h1></center>
			<br/>
			<center><h2>Don't take the bait !!</h2></center>
			</div>
			<div name="page2"style="background-image:url(pages/bg.jpg);color:white;font-family:calibri;" ><br/>
<center><h1> What is Phishing? </h1></center>
 <p style=" position: absolute;padding-right: 18px;padding-left: 15px;text-align: justify;">
<?php 
$query = "select data from tutorial where pageno=2;";
$res = mysqli_query($db,$query);
$result1 = implode(mysqli_fetch_assoc($res));
echo nl2br($result1);
?> 
</p>
 </div>
			<div  name="page3" style="background-image:url(pages/bg.jpg);color:white;font-family:calibri;"><br/>
			<center><h1> What damage it does? </h1></center>
 <p style=" position: absolute;padding-right: 18px;padding-left: 15px;text-align: justify;">
<?php 
$query = "select data from tutorial where pageno=3;";
$res = mysqli_query($db,$query);
$result1 = implode(mysqli_fetch_assoc($res));
echo nl2br($result1);
?> 
<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src="pages/whatisphishing.jpg" align="center" height="160px" width="250px"/>
</p>

			
			</div>
			<div name="page4" style="background-image:url(pages/bg.jpg);color:white;font-family:calibri;">
			<br/>
<center><h1> Why you should know it? </h1></center>
 <p style=" position: absolute;padding-right: 18px;padding-left: 15px;text-align: justify;">
<?php 
$query = "select data from tutorial where pageno=4;";
$res = mysqli_query($db,$query);
$result1 = implode(mysqli_fetch_assoc($res));
echo nl2br($result1);
?> 
</p>
 </div>
			<div  name="page5" style="background-image:url(pages/bg.jpg);color:white;font-family:calibri;"><br/>
			<center><h1> Techniques </h1></center>
 <p style=" position: absolute;padding-right: 18px;padding-left: 15px;text-align: justify;">
<?php 
$query = "select data from tutorial where pageno=5;";
$res = mysqli_query($db,$query);
$result1 = implode(mysqli_fetch_assoc($res));
echo nl2br($result1);
?> 
</p>
			
			
			</div>
			
			<div name="page6"style="background-image:url(pages/bg.jpg);color:white;font-family:calibri;">
			<center><h1> Techniques </h1></center>
 <p style=" position: absolute;padding-right: 18px;padding-left: 15px;text-align: justify;">
<?php 
$query = "select data from tutorial where pageno=6;";
$res = mysqli_query($db,$query);
$result1 = implode(mysqli_fetch_assoc($res));
echo nl2br($result1);
?> 
</p>
			
			</div>
			<div name="page7" style="background-image:url(pages/bg.jpg);color:white;font-family:calibri;">
			<center><h1> Stop being victim, be attentive! </h1></center>
 <p style=" position: absolute;padding-right: 18px;padding-left: 15px;text-align: justify;">
<?php 
$query = "select data from tutorial where pageno=7;";
$res = mysqli_query($db,$query);
$result1 = implode(mysqli_fetch_assoc($res));
echo nl2br($result1);
?> 
</p>
			</div>
			<div name="page8" style="background-image:url(pages/bg.jpg);color:white;font-family:calibri;">
			<br/><br/><br/><br/><br/><br/><br/><br/><br/>
			<center><h1>Thank you</h1></center>
			<br/>
			<center><h2>Remember, All it takes is just one click!</h2></center>
			</div>
		<!--	<div style="background-image:url(pages/7.jpg)"></div>
			<div style="background-image:url(pages/8.jpg)"></div>
			<div style="background-image:url(pages/9.jpg)"></div>
			<div style="background-image:url(pages/10.jpg)"></div>
			<div style="background-image:url(pages/11.jpg)"></div>
			<div style="background-image:url(pages/12.jpg)"></div> -->
		</div>
	</div>
</div>


<script type="text/javascript">

function loadApp() {

	// Create the flipbook

	$('.flipbook').turn({
			// Width

			width:922,
			
			// Height

			height:600,

			// Elevation

			elevation: 50,
			
			// Enable gradients

			gradients: true,
			
			// Auto center this flipbook

			autoCenter: true

	});
}

// Load the HTML4 version if there's not CSS transform

yepnope({
	test : Modernizr.csstransforms,
	yep: ['../tutorial/lib/turn.js'],
	nope: ['../tutorial/lib/turn.html4.min.js'],
	both: ['css/basic.css'],
	complete: loadApp
});

</script>

</body>
</html>