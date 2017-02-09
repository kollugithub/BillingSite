<?php
require 'checkifloggedin.php';
if(isset($_SESSION['canmakebill']) && !empty($_SESSION['canmakebill'])) {
	if(isset($_SESSION['redirect']) && !empty($_SESSION['redirect'])) {
		require 'checkifcustomerloggedin.php';
		$registered=1;
	}else {
		$registered=0;
	}
}else {
	if(isset($_SESSION['customer'])) {
		unset($_SESSION['customer']);
		unset($_SESSION['customer_wallet']);
	}
	header('Location: profile.php');
}
unset($_SESSION['canmakebill']);

$_SESSION['bill']=1;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bill</title>
<link rel="stylesheet" type="text/css" href="../../common/vdo_style.css" />
<style>
* {
	box-sizing:border-box;
}
#reg { 
	background:url(../../common/bg2.jpg) no-repeat right bottom;
	background-size:cover;
	height:330px;
	width:518px;
	border-radius:10px;
	  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;
	box-shadow:7px 7px 7px black;
	overflow:visible;
}
#inner {
	height:80px;
	background:black;
	opacity:0.6;
	border-radius:10px 10px 0 0;
	margin-bottom:10px;
	margin-top:-30px;
	padding:0px;
}
#inner p {
	color:#FFFFFF;
	font-size:26px;
	font-weight:bold;
	font-family:"comic Sans MS";
	padding:20px 20px 20px 30px;
	text-shadow:2px 2px 1px;
}


hr {
	color:#FFCCCC;
	width:90%;
	margin-top:15px;
}
#center input {
	margin-left:auto;
	margin-right:auto;
	font-size:18px;
	cursor:pointer;
}
table{
	text-align:center;
	margin-left:auto;
	margin-right:auto;
	border-collapse: collapse;
}
#bill td, #bill th {
    font-size: 1em;
    border: 1px solid black;
}

#bill th {
    font-size: 1.1em;
    text-align:center;
    background-color:#6699FF;
	opacity:0.7;
 	color:white;
	height:30px;
}
#add,#remove {
	width:auto;
	opacity=1;
	height:30px;
	display:block;
	margin-left:auto;
	margin-right:auto;
	margin-top:15px;
	font-size:18px;
	color:white;
	box-shadow:7px 7px 7px black;	
	cursor:pointer;
	padding:0px 35px 0px;
	border-radius:5px;
	font-family:"comic Sans MS";
	background:-webkit-linear-gradient(grey,black);
}
input[type="submit"]:disabled {
	width:auto;
	height:30px;
	display:block;
	margin-left:auto;
	margin-right:auto;
	font-size:18px;
	color:white;
	box-shadow:7px 7px 7px black;	
	background-color:black;
	opacity:0.5;
	cursor:pointer;
	border-radius:5px;
	font-family:"comic Sans MS";
	background:-webkit-linear-gradient(grey,black);
}
input[type="submit"]:enabled {
	width:auto;
	height:30px;
	display:block;
	margin-left:auto;
	margin-right:auto;
	font-size:18px;
	color:white;
	box-shadow:7px 7px 7px black;	
	background-color:black;
	opacity:1;
	cursor:pointer;
	border-radius:5px;
	font-family:"comic Sans MS";
	background:-webkit-linear-gradient(grey,black);
}
</style>
<script type="text/javascript" src="../../common/jquery.js"></script>
<script type="text/javascript" src="table.js">

</script>
</head>


<body>

<video autoplay loop id="bgvid" controls>
<source src="../../common/vdo7.mp4" type="video/mp4">
can't play
</video>

<div id="reg">
	<div id="inner">
		<p>Bill</p>	
	</div>
<div id="status" style="height:2px;;display:block;text-align:left;color:#003871; font-weight:bold; position:relative; left:9%"></div><br />
<!--	<div id="not" style="position:relative;left:6%;color:red;font-weight:bold;margin-bottom:5px;margin-top:5px;"></div>
-->		<form action="preparebill.php" method="post" >
	<div id="center">
			 <table id="bill">
  <tr><th>Product ID</th><th>Name</th><th>Quantity</th><th>Total</th></tr>
  <tr><td><input type="text" size="5" name="pid0" id="pid0" onKeyUp="this.value = this.value.replace(/[^\d]+/, '');" /></td><td><input type="text" size="15" value="" name="name0" id="name0" disabled="disabled"/></td><td><input type="text" size="5" name="qty0" id="qty0" onKeyUp="this.value = this.value.replace(/[^\d]+/, '');" disabled="disabled" /></td><td><input type="text" size="8" name="rate0" id="rate0" value="" disabled="disabled"/></td></tr>
</table><input type="hidden" id="hidden" value="0" name="hidden" />
<input type="button" value="Add Row" id="add"><input type="button" value="Remove Row" id="remove"><br /><input type="submit" value="Make Bill" id="makebill" disabled="disabled">
		</form>
		</div>
</div>
</body>
</html>
