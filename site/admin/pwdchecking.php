<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Options</title>
<link rel="stylesheet" type="text/css" href="../common/vdo_style.css" />
<style>
 #whitebg {
  display:none;
  width:100%;
  height:100%;
  position:fixed;
  top:0;
  left:0;
  z-index:9999;
  opacity:0.7;
  background-color:#fefefe;
 }
 #dlgbox {
  font-family:"comic Sans MS";
  position:fixed;
  display:none;
  width:480px;
  z-index:9999;
  border-radius:10px;
  border:1px solid black;
  box-shadow:5px 5px 5px black;
  background:white;
 }
 #dlg-header {
  background:#000000;
  opacity:0.7;
  font-size:22px;
  color:red;
  font-weight:bolder;
  padding:10px;
  padding-left:20px;
  border-radius:10px 10px 0px 0px;
 }
 #dlg-body {
  padding:10px;
  color:#003871;
  text-align:center;
  font-size:20px;
 }
 #dlg-footer {
  text-align:right;
  padding:10px;
 }
 #dlg-footer input {
  background:-webkit-linear-gradient(#135cc9,#003871);
  opacity:0.7;
  color:white;
  font-family:"comic Sans MS";
  text-decoration:none;
  padding:2px 20px;
  border-radius:5px;
  box-shadow:2px 2px 2px grey;
 }
* {
	box-sizing:border-box;
}
#reg { 
	background:url(../common/bg2.jpg) no-repeat right bottom;
	background-size:cover;
	height:400px;
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
 <source src="../common/vdo7.mp4" type="video/mp4">
 can't play
 </video>
 <div id="whitebg">
 </div>
 
 <div id="dlgbox">
  <div id="dlg-header">
   Admin Log In Says:
  </div>
  <div id="dlg-body">
   Body
  </div>
  <div id="dlg-footer">
   <a href="../index.php"><input type="button" value="OK" ></a>
  </div>
 </div>

<script>
 function show(error) {
 document.title="Error";
  var whitebg=document.getElementById('whitebg');
  var dlg=document.getElementById('dlgbox');
  document.getElementById('dlg-body').innerHTML=error;
  var winWidth=window.innerWidth;
  var winHeight=window.innerHeight;
  dlg.style.display="block";
  whitebg.style.display="block";
  dlg.style.left=(winWidth/2)-(480/2)+"px";
  dlg.style.top="100px";
 }
</script>

<?php
	if(!isset($_POST['pwd'])) {
		echo "<script>show('Log In to Continue');</script>";
		die();
	}else {
		$pwd=$_POST['pwd'];
		if(empty($pwd)) {
			echo "<script>show('Contents Unavailable !!');</script>";
			die();
		}else if($pwd!="iamadmin"){
			echo "<script>show('Incorrect Password !!');</script>";
			die();
		}else {
			session_start();
			$_SESSION['admin']='admin';
			header('Location: index.php');			
		}
	}

?>
</body>
</html>


