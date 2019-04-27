<?php

?>

<html>
<head>
<style>
#bottom{
    height: 100%;
    width: 100%;
}
img
{
	border = none;
}
.row {
  display: flex; 
}
.col {
  flex: 1; 
  padding: 6em;
}
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
<a href="#bottom"><img src="bg.jpg" height="100%" width="100%" ></img></a>
<div id="bottom">
<div class="row">
<div class="col"><b>DON'T TAKE THE BAIT!</b></div>
<div class="col"> The idea of having this tool in place is two fold: <br/><br/>
1. To educate end-users about the phishing attack <br/><br/>
2. To know your organization’s current awareness posture <br/><br/><br/>
<button type="button" class="button" onclick="location.href = 'tutorial/index.php';">Start Tutorial</button> <br/> <br/>
<button type="button" class="button" onclick="location.href = 'assessment.php';">Start Assessment</button> 
</div>
</div>
</div>

</html>