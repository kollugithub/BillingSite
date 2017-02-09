<?php
require 'checkifcustomerloggedin.php';
require '../../common/connect.inc.php';
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
	height:240px;
	width:718px;
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
	width:auto;
	height:40px;
	display:block;
	margin-left:auto;
	margin-right:auto;
	font-size:18px;
	color:white;
	box-shadow:7px 7px 7px black;	
	cursor:pointer;
	padding:0px 35px 0px;
	border-radius:5px;
	font-family:"comic Sans MS";
	background:-webkit-linear-gradient(grey,black);
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
</head>
<body>

<video autoplay loop id="bgvid" controls>
<source src="../../common/vdo7.mp4" type="video/mp4">
can't play
</video>
<script>
	function inc() {
		var el=document.getElementById('reg');
		var height = el.offsetHeight;
    	var newHeight = height + 20;
    	if(newHeight>=window.innerHeight) {
			el.style.position='relative';
		}else {
			el.style.position='absolute';
		}
		el.style.height = newHeight + 'px';
		
	}
</script>
<div id="reg">
	<div id="inner">
		<p>Your last month's bills</p>	
	</div>
<!--	<div id="not" style="position:relative;left:6%;color:red;font-weight:bold;margin-bottom:5px;margin-top:5px;"></div>
-->
	<br /><div id="center">
			 <table id="bill" width="90%">
  <tr><col width="150"><col width="150"><col width="150"><col width="50"><th>Staff ID</th><th>Customer ID</th><th>Datetime</th><th>Wallet</th></tr>
 <?php
 	$query=mysql_query("SELECT * FROM `wallet_transaction` WHERE `cid`='".$_SESSION['customer']."' ORDER BY `wallet_transaction`.`datetime` DESC");
	$counter=mysql_num_rows($query);
//	echo $counter,$_SESSION['customer'];
	if($counter==0) {
		$_SESSION['link']="profile.php";
		$_SESSION['msg']="no wallet money addition to show in last month for you ".$_SESSION['customer_name'];
		header('Location: redirect.php');
	}else {
		for($i=0;$i<$counter;$i++) {
			$sid=mysql_result($query,$i,'sid');
			$cid=mysql_result($query,$i,'cid');
			$dt=mysql_result($query,$i,'datetime');
			$wallet=mysql_result($query,$i,'wallet_amount');
			echo "<tr><td>".$sid."</td><td>".$cid."</td><td>".$dt."</td><td>".$wallet."</td></tr>";
			echo "<script>inc();</script>";
		}
	}
		
 ?>
</table><br />
		<a href="profile.php" style="text-decoration:none;" ><input type="button" value="Back" /> </a><br />
		</div>
		
</div>
</body>
</html>

