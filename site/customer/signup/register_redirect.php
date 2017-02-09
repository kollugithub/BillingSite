<?php
	session_start();
	if(!isset($_SESSION['msg']))
		header('Location: ../login/index.php',303);
	else {
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../common/vdo_style.css" />
<title>Register
</title>
<style>
	body {
		font-family:"comic Sans MS";
	}
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
		height:30px;
		opacity:0.7;
		color:white;
		font-family:"comic Sans MS";
		text-decoration:none;
		padding:2px 20px;
		border-radius:5px;
		box-shadow:2px 2px 2px grey;
	}
</style>
</head>
<body>
	<div id="whitebg">
	</div>
	
	<video autoplay loop id="bgvid" controls>
	<source src="../../common/vdo7.mp4" type="video/mp4">
	can't play
	</video>
	<div id="dlgbox">
		<div id="dlg-header">
			Message
		</div>
		<div id="dlg-body">
			Body
		</div>
		<div id="dlg-footer">
			<a href="../login/index.php"><input type="button" value="OK" ></a>
		</div>
	</div>

<script>
	function show(error) {
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
</body>
</html>
<?php
		echo "<script>show('".$_SESSION['msg']."');</script>";
		unset($_SESSION['msg']);
	}
?>