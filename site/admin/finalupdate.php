<?php
	session_start();
	if(!isset($_SESSION['admin']))
		header('Location: ../index.php');

	require '../common/connect.inc.php';
	
	if(isset($_POST['pid']) && isset($_POST['name']) && isset($_POST['qty']) && isset($_POST['rate']) && isset($_POST['pidset'])) {
		$pid=$_POST['pid'];
		$name=$_POST['name'];
		$qty=$_POST['qty'];
		$rate=$_POST['rate'];
		$pidset=$_POST['pidset'];

		$query=mysql_query("UPDATE products SET pid='".mysql_real_escape_string($pid)."', name='".mysql_real_escape_string($name)."', quantity='".mysql_real_escape_string($qty)."', rate='".mysql_real_escape_string($rate)."' WHERE pid='".mysql_real_escape_string($pidset)."'");
		if(($error=mysql_error())!='') {
			$_SESSION['msg']=$error;
			header('Location: redirect.php');
		}else {
			$_SESSION['msg']=$name." has been updated";
			header('Location: redirect.php');
		}
			
		
	}else {
		$_SESSION['msg']='Invalid Access';
		header('Location: redirect.php');
	}
?>
