<?php
require 'checkifloggedin.php';
require 'checkifcustomerloggedin.php';

if(!isset($_SESSION['pay']) || empty($_SESSION['pay'])) {
	unset($_SESSION['customer']);
	unset($_SESSION['customer_wallet']);
	header('Location: profile.php');
}else {
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Wallet</title>
<link rel="stylesheet" type="text/css" href="../../common/vdo_style.css" />
<style>
* {
	box-sizing:border-box;
}
#reg { 
	background:url(../../common/bg2.jpg) no-repeat right bottom;
	background-size:cover;
	height:240px;
	width:518px;
	border-radius:10px;
	  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;
	box-shadow:7px 7px 7px black;
	
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
label {
	padding:40px;
	color:black;
	font-weight:bolder;
	font-size:18px;
	font-variant:small-caps;
	position:relative;
	top:9px;
	
	text-shadow:1px 1px 1px #666666;
}

#outer input {
	height:25px;
	border-radius:2px;
	border:inset;
	background-color:#dcdcdc;
	margin-right:45px;
	margin-top:3px;
	float:right;
	font-family:"comic Sans MS";
	font-size:14px;
	cursor:pointer;
}
#outer input:focus {
	background-color:#FFFFFF;
}
#outer input:after {
	clear:both;
}

hr {
	color:#FFCCCC;
	width:90%;
	margin-top:25px;
}
input[type="submit"]:disabled {
	width:130px;
	height:30px;
	display:block;
	margin-left:auto;
	margin-right:auto;
	font-size:18px;
	color:white;
	box-shadow:7px 7px 7px black;	
	background-color:black;
	opacity:0.3;
	cursor:pointer;
}
input[type="submit"]:enabled {
	width:130px;
	height:30px;
	display:block;
	margin-left:auto;
	margin-right:auto;
	font-size:18px;
	color:white;
	box-shadow:7px 7px 7px black;	
	background-color:black;
	opacity:0.7;
	cursor:pointer;
}
</style>
</head>

<script>

</script>
<body>

<video autoplay loop id="bgvid" controls>
<source src="../../common/vdo7.mp4" type="video/mp4">
can't play
</video>

<div id="reg">
	<div id="inner">
		<p>Enter Amount</p>	
	</div>
	
	<div id="outer">
<!--	<div id="not" style="position:relative;left:6%;color:red;font-weight:bold;margin-bottom:5px;margin-top:5px;"></div>
-->		<form action="finalbill.php" method="post" autocomplete="off">
			<?php  if($_SESSION['pay']>$_SESSION['customer_wallet']) {
						$can=$_SESSION['customer_wallet'];	
					}else {
						$can=$_SESSION['pay'];
					}
			?>
				<label>Wallet(Rs.)</label><input type="text" id="wallet" name="paybywallet" onKeyUp="this.value = this.value.replace(/[^\d]+/, '');if(this.value > <?php echo $can;?> || !this.value) { document.getElementById('submit').disabled=true;} else {document.getElementById('submit').disabled=false;}" maxlength="40" size="30"/><br /><br /><span id="status" style="height:2px;;display:block;text-align:center;color:#003871; font-weight:bold; position:relative; left:9%">Give wallet amount from 1 to <?php echo $can;?>.</span><br /><br />
			</div>	
		<div id="center">
			<input type="submit" id="submit"  value="Deduct" disabled="disabled"/><br /><br />
		</form>
			
		</div>
</div>
</body>
</html>




<?php

}
?>