<?php

	require '../../common/connect.inc.php';
//	$name=$pwd=$cpwd=$mail=$no='';
	
	if(isset($_POST['name']) && isset($_POST['pwd']) && isset($_POST['cpwd']) && isset($_POST['mail']) && isset($_POST['no']) && isset($_POST['captcha'])) {
		$name=$_POST['name'];
		$mail=$_POST['mail'];
		$pwd=$_POST['pwd'];
		$no=$_POST['no'];
		$pwd=md5($pwd);
		@date_default_timezone_set("Asia/Kolkata");
		$time=time();
		$time=date('Y-m-d',$time);
		$query_check=mysql_query("SELECT * FROM customer_dup WHERE mail='$mail'");
		if(mysql_num_rows($query_check)==1) {
			$user=mysql_fetch_assoc($query_check);
			mysql_query("UPDATE customer_dup SET name='$name',password='$pwd',contact='$no',date='$time' WHERE mail='$mail'");
		}else {
			$query=mysql_query("INSERT into customer_dup VALUES('$name','$mail','$pwd','$no','$time')");
			$query_check=mysql_query("SELECT * FROM customer_dup WHERE mail='$mail'");
			$user=mysql_fetch_assoc($query_check);
		}

		require "../login/forgot_pwd/classes/class.phpmailer.php"; // include the class name
		$KEY = "love@1612"; //key should be long and secret
		
		$time = time();
		$hash = md5( $user['mail'] . $time . $KEY);
		$url = "localhost/site/customer/signup/verify_deactivate.php?id=".$user['mail'].'&timestamp='.$time.'&hash='.$hash;
		//	send_email($email, 'reset password email from xxx.com', ' Please click the following link to reset password'. $url);
		$pmail = new PHPMailer(); // create a new object
		$pmail->IsSMTP(); // enable SMTP
		$pmail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		$pmail->SMTPAuth = true; // authentication enabled
		$pmail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$pmail->Host = "smtp.gmail.com";
		$pmail->Port = 465; // or 587
		$pmail->IsHTML(true);
		$pmail->Username = "2013ucp1652@mnit.ac.in";
		$pmail->Password = "parthzsoft2895";
		$pmail->AddReplyTo("2013ucp1652@mnit.ac.in", "admin"); //reply-to address
		$pmail->SetFrom("2013ucp1652@mnit.ac.in", "XStore"); //From address of the mail
		// put your while loop here like below,
		$pmail->Subject = "XStore verify account";
		//	$mail->Body = "<b>Hi, please click following link to reset your password. The link will expire in 3 hours automatically.<br/><br/></b>";
		$pmail->MsgHTML("<b>Hi ".$name.",<br />An account has been from your mail id on <a href='localhost/site/index.php' style='font-weight:bold;color:orange;font-size:20px;'>XStore. </a> Please click the following link to verify your account.(if this is not your activity, please deactivate the account by clicking on same link).This link will be expired after 15 days and your account will be automatically deactivated.<br/><br/><a style=\"font-size:20px;font-weight:bold;\" href='$url'>verify/deactivate</a></b>");
		$pmail->AddAddress($mail);
		if(!$pmail->Send()){
			session_start();
			$_SESSION['msg']=$pmail->ErrorInfo;
		}
		else{
			session_start();
			$_SESSION['msg']='Verification mail has been sent to your email id.Please verify your account to login';
		}		
	}else {
		session_start();
		$_SESSION['msg']='Invalid Credentials';
	}
	header('Location: register_redirect.php',303);
?>