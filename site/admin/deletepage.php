<?php
	session_start();
	if(!isset($_SESSION['admin']))
		header('Location: ../index.php');


	require '../common/connect.inc.php';
	
	if(isset($_POST['pid'])) {
		$pid=$_POST['pid'];
		if(!empty($pid)) {
			$query=mysql_query("SELECT name FROM products WHERE pid='".mysql_real_escape_string($pid)."'");
			
			if(mysql_num_rows($query)!=0) {
				$name=mysql_result($query,0);
				$del_query=mysql_query("DELETE FROM products WHERE pid='".mysql_real_escape_string($pid)."'");
				$_SESSION['msg']=$name." has been deleted";
				header('Location: redirect.php');;
			}else {
				$_SESSION['msg']='No item found with that Product ID';
				header('Location: redirect.php');
			}	
		}else {
			$_SESSION['msg']='Content Unavailable';
			header('Location: redirect.php');
		}
			
	}else {
		$_SESSION['msg']='Invalid Access';
		header('Location: redirect.php');
	}
?>