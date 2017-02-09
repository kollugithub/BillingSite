<?php
	session_start();
	if(!isset($_SESSION['admin']))
		header('Location: ../index.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Items</title>
<link rel="stylesheet" type="text/css" href="../common/vdo_style.css" />
<script  type="text/javascript" src="../common/jquery.js"></script>
<script  type="text/javascript" src="add.js"></script>
<style>
* {
	box-sizing:border-box;
}
#reg { 
	background:url(../common/bg2.jpg) no-repeat right bottom;
	background-size:cover;
	height:442px;
	width:518px;
	border-radius:10px;
	margin-left:auto;
	margin-right:auto;
	margin-top:6%;
	margin-bottom:auto;
	box-shadow:7px 7px 7px black;
}
#inner {
	height:80px;
	background:black;
	opacity:0.6;
	border-radius:10px 10px 0 0;
	margin-bottom:8px;
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
#hoverdiv {
	display:none;
	background-color:#cad5e7;
	color:#000000;
	position:absolute;
	font-size:18px;
	padding:2px;
	border:1px solid black;
}
</style>
</head>


<body>

<video autoplay loop id="bgvid" controls>
<source src="../common/vdo7.mp4" type="video/mp4">
can't play
</video>

<div id="reg">
	<div id="inner">
		<p>Add Products</p>	
	</div>
	
	<div id="outer">
	<div id="not" style="position:relative;left:6%;color:red;font-weight:bold;margin-bottom:8px;"></div>
		<form action="add.php" autocomplete="off" method="post" autocomplete="off">
			<label>Product ID </label><input type="text" id="pid" name="pid" maxlength="20" size="30"  onKeyUp="this.value = this.value.replace(/[^\d]+/, '');" autofocus /><br /><br /><span id="status" style="height:2px;;display:block;text-align:center;color:#003871; font-weight:bold; position:relative; left:9%">Give unique Product ID.</span><hr />
				<label>Name</label><input type="text" id="name" name="name" maxlength="40" size="30"/><hr />
				<label>Quantity </label><input type="text" id="qty" name="qty" class="hover" maxlength="20" hovertext="" size="30" onKeyUp="this.value = this.value.replace(/[^\d]+/, '');" /><hr />
				<label>Rate</label><input type="text" id="rate" class="hover" name="rate"  hovertext="" maxlength="20" size="30" onKeyUp="this.value = this.value.replace(/[^\d.]+/, '');" /><hr />
			
	</div>
        <br />
		<br />
            
		
			<input type="submit" id="submit" value="Add"  disabled="disabled" />
		</form>
		</div>
	
</div>
</body>
<script  type="text/javascript" src="hover.js"></script>
	<script type="text/javascript">


      $( function () {
        
  twitter.screenNameKeyUp();
  $('#user_screen_name').focus();

      });
    

</script>
</html>
