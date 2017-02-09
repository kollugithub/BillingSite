<?php
	session_start();
	if(!isset($_SESSION['admin']))
		header('Location: ../index.php');

	require '../common/connect.inc.php';
	
	if(isset($_POST['pid']) && isset($_POST['name']) && isset($_POST['qty']) && isset($_POST['rate'])) {
		$pid=$_POST['pid'];
		$name=$_POST['name'];
		$qty=$_POST['qty'];
		$rate=$_POST['rate'];

		$query=mysql_query("INSERT into products VALUES('".mysql_real_escape_string($pid)."','".mysql_real_escape_string($name)."','".mysql_real_escape_string($qty)."','".mysql_real_escape_string($rate)."')");
		if(($error=mysql_error())!='') {
			$_SESSION['msg']=$error;
			header('Location: redirect.php');
		}else {
			$_SESSION['msg']=$name." has been added";
			header('Location: redirect.php');
		}
			
		
	}else {
		$_SESSION['msg']='Invalid Access';
		header('Location: redirect.php');
	}
?>