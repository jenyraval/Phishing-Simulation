<html>
   <head>
      <title>Welcome Employee</title>
	<img src="header.jpg" style="width:100%;height:150px;">
	<link rel="stylesheet" href="style.css"> 
   </head>
 <div>  
 
<SCRIPT type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</SCRIPT>
</HEAD>
<BODY onload="noBack();" 
	onpageshow="if (event.persisted) noBack();" onunload="">
<form method="post" action="test.php">
You will be presented with set of 10 questions, all you have to do is to choose your actions by looking at the content. We have kept the passing score as 100%, because all it takes is just one click! All the Best!<br/><br/>
Enter Test Code: <input type="text" name="testcode" /><br/>
Enter Employee Id: <input type="number" name="empid" style="width: 100%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;"/><br/>
<input type="submit" value="Start Test"/>
</form>
</html>
<?php
  //php code if only needed    
?>
