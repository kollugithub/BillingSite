<?php

	require 'connect.inc.php';
	$name=$pwd=$cpwd=$mail=$no='';
	ob_start();
	if(isset($_POST['name']) && isset($_POST['pwd']) && isset($_POST['cpwd']) && isset($_POST['mail']) && isset($_POST['no'])) {
		$name=$_POST['name'];
		$mail=$_POST['mail'];
		$pwd=$_POST['pwd'];
		$no=$_POST['no'];
		$pwd=md5($pwd);
		session_start();
		if($_POST['captcha'] != $_SESSION['digit']){ 
			echo "<script> alert('Invalid captcha'); </script>";
			ob_end_flush();
			header('Location: index.php');
		}else {
			$query=mysql_query("INSERT into entry VALUES('','$name','$mail','$pwd','$no')");
		}
		session_destroy();
	}else {
	
	}/*
	if(isset($_POST['captcha'])) {
	session_start();
	if($_POST['captcha'] != $_SESSION['digit']){ 
		echo 'Invalid captcha';
	}else {
		echo 'OK';
	}
	session_destroy();
}
*/
	?>