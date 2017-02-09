<?php
require 'checkifloggedin.php';

if(!isset($_SESSION['pay']) || empty($_SESSION['pay'])) {
	unset($_SESSION['customer']);
	unset($_SESSION['customer_wallet']);
	header('Location: profile.php');
}else {
require '../../common/connect.inc.php';
@date_default_timezone_set("Asia/Kolkata");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../common/vdo_style.css" />
<title>Message
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
			<a href="profile.php" style="text-decoration:none;cursor:pointer;"><input type="button" value="OK" ></a>
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
	$user=$_SESSION['user'];
	$total=$_SESSION['pay'];
	$time=time();
	$datetime=date('Y-m-d H:i:s',$time);
	$billfile=fopen("bills/bill".$_SESSION['count'].".txt","a");
	fwrite($billfile,"\r\n");
	if(isset($_SESSION['customer'])) {
		if(isset($_POST['paybywallet'])) {
			$customer=$_SESSION['customer'];
			$wallet=$_POST['paybywallet'];
			$cash=$_SESSION['pay']-$_POST['paybywallet'];
		}else {
			$customer=$_SESSION['customer'];
			$wallet=0;
			$cash=$total;
		}
		$_SESSION['msg']="wallet : ".$wallet." cash : ".$cash;
		mysql_query("INSERT INTO bill VALUES('$user','$customer','$total','$wallet','$cash','$datetime')");
		if(isset($_POST['paybywallet'])) {
			$remaining=$_SESSION['customer_wallet']-$_POST['paybywallet'];
			mysql_query("UPDATE customer SET wallet='$remaining' WHERE mail='$customer'");
		}
		$query=mysql_query("SELECT collect FROM staff WHERE mail='".$_SESSION['user']."'");
		$now=mysql_result($query,0);
		$now=$now+$cash;
		mysql_query("UPDATE staff SET collect='$now' WHERE mail='$user'");
		fwrite($billfile,"Total : ".$total."\r\nWallet : ".$wallet."\r\nCash : ".$cash);
	}else {
		$_SESSION['msg']="cash : ".$total;
		mysql_query("INSERT INTO bill VALUES('$user','NULL','$total','0','$total','$datetime')");
		$query=mysql_query("SELECT collect FROM staff WHERE mail='".$_SESSION['user']."'");
		$now=mysql_result($query,0);
		$now=$now+$total;
		mysql_query("UPDATE staff SET collect='$now' WHERE mail='$user'");
		fwrite($billfile,"Total : ".$total."\r\nCash : ".$total);
	}
	mysql_query("UPDATE staff SET rating=rating+1+'".$_SESSION['total']."' WHERE mail='$user'");
	fclose($billfile);
	unset($_SESSION['customer']);
	unset($_SESSION['customer_wallet']);
	unset($_SESSION['pay']);
	unset($_SESSION['total']);
//	unset($_SESSION['count']);
	unset($_SESSION['paybywallet']);
	unset($_SESSION['redirect']);	
	$_SESSION['msg'].=" bill id: bill".$_SESSION['count'];
	$_SESSION['link']="printbill.php";
	$_SESSION['value']="Download";
	header('Location: redirect.php');
}
?>