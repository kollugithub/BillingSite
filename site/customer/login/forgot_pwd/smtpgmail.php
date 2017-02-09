<?php
require '../../../common/connect.inc.php';
if(isset($_POST['mail'])) {
	session_start();
	$email=$_POST['mail'];
	if(!empty($email)) {
		$query=mysql_query("SELECT mail FROM customer WHERE mail='$email'");
		if(mysql_num_rows($query)==1) {
			require "classes/class.phpmailer.php"; // include the class name
			
			$KEY = "love@1612"; //key should be long and secret
			$user=mysql_fetch_assoc($query);
			$time = time();
			$hash = md5( $user['mail'] . $time . $KEY);
			$url = "localhost/site/customer/login/forgot_pwd/resetpassword.php?id=".$user['mail'].'&timestamp='.$time.'&hash='.$hash;
		//	send_email($email, 'reset password email from xxx.com', ' Please click the following link to reset password'. $url);
			$mail = new PHPMailer(); // create a new object
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587
			$mail->IsHTML(true);
			$mail->Username = "2013ucp1652@mnit.ac.in";
			$mail->Password = "parthzsoft2895";
			$mail->AddReplyTo("2013ucp1652@mnit.ac.in", "admin"); //reply-to address
		$mail->SetFrom("2013ucp1652@mnit.ac.in", "XStore"); //From address of the mail
		// put your while loop here like below,
		$mail->Subject = "XStore Reset Password";
		//	$mail->Body = "<b>Hi, please click following link to reset your password. The link will expire in 3 hours automatically.<br/><br/></b>";
			$mail->MsgHTML("<b>Hi, please click following link to reset your password. The link will expire in 3 hours automatically.<br/><br/><a style=\"font-size:20px;font-weight:bold;\" href='$url'>Reset Password</a></b>");
			$mail->AddAddress($email);
			 if(!$mail->Send()){
			 	$_SESSION['msg']=$mail->ErrorInfo;
				header('Location: mailredirect.php');
			}
			else{
				$_SESSION['msg']='Password reset link has been sent to your email id';
				$_SESSION['canlogin']=1;
				header('Location: mailredirect.php');
			}			
		}else {
			$_SESSION['msg']='Oops !! This email id has not been registered';
			header('Location: mailredirect.php');
		}
	}else {
		$_SESSION['msg']='Please provide your registered email id';
		header('Location: mailredirect.php');
	}
}else {
	header('Location: sendmail.php');
}

?>