<?php
	session_start();
	if(!isset($_SESSION['admin']))
		header('Location: ../index.php');
	if(isset($_POST['clear'])) {
		require '../common/connect.inc.php';
		mysql_query("UPDATE internal SET best_emp='1'");
		header('Location: index.php');
	}else {
		$_SESSION['msg']="Invalid Access";
		header('Location: redirect.php');
	}
?>