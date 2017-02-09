

<?php
require '../../common/connect.inc.php';
if(isset($_POST['mail']) && isset($_POST['pwd'])) {
	$mail=$_POST['mail'];
	$pwd=$_POST['pwd'];
	if(!empty($mail) && !empty($pwd)) {
		$pwd=md5($pwd);
		$query_run=mysql_query("SELECT mail,password,name FROM staff WHERE mail='$mail'");
		if(@mysql_num_rows($query_run)==1) {
			$row=mysql_fetch_assoc($query_run);
			if($pwd==$row['password']) {
				session_start();
				$_SESSION['user']=$mail;
				$_SESSION['user_name']=$row['name'];
				header('Location: profile.php');
			}else {
				session_start();
				$_SESSION['msg']='Incorrect password';
				header('Location: redirect.php');
			}
		}else {
			session_start();
			$_SESSION['msg']='This email id is not registered';
			header('Location: redirect.php');
		}
	}else {
		session_start();
		$_SESSION['msg']='Please fill all fields';
		header('Location: redirect.php');
	}
} else {
	session_start();
	$_SESSION['msg']='Invalid Credentials';
	header('Location: redirect.php');
}

?>