<?php
require 'checkifloggedin.php';
if(isset($_SESSION['customer'])) {
	unset($_SESSION['customer']);
	unset($_SESSION['customer_wallet']);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome  <?php echo $_SESSION['user_name'];?></title>
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
</style>
</head>


<body>

<video autoplay loop id="bgvid" controls>
<source src="../../common/vdo7.mp4" type="video/mp4">
can't play
</video>

<div id="reg">
	<div id="inner">
		<p>Staff Options <?php  require '../../common/connect.inc.php';
								$query=mysql_query("SELECT * FROM best_mail");
								$count=mysql_num_rows($query);
								if($count!=0) {
									$query=mysql_query("SELECT mail FROM best_mail WHERE mail='".$_SESSION['user']."'");
									$result=mysql_num_rows($query);
									if($result==1) {
										?>
										(Best Employee)
										<?php
									}
								}
						 ?></p>	
	</div>

<!--	<div id="not" style="position:relative;left:6%;color:red;font-weight:bold;margin-bottom:5px;margin-top:5px;"></div>
-->		
	<div id="center">
			<br /><a href="customerlogin.php" style="text-decoration:none;" ><input type="button" value="Add to wallet"  /> </a><br /><br /> 
			<a href="customeroptions.php" style="text-decoration:none;" ><input type="button" value="Make bill"  /> </a><br /><br />  
			<a href="logout.php" style="text-decoration:none;" ><input type="button" value="Log out" /></a>
		</div>
</div>
</body>
</html>




