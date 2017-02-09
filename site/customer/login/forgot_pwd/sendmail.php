
<?php
/*
include 'library.php'; // include the library file
include "classes/class.phpmailer.php"; // include the class name
if(isset($_POST["send"])){
	$email = $_POST["email"];
	$mail	= new PHPMailer; // call the class 
	$mail->IsSMTP(); 

	$mail->Host = SMTP_HOST; //Hostname of the mail server
	$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
	$mail->SMTPAuth = true; //Whether to use SMTP authentication
$mail->SMTPSecure = 'ssl';
	$mail->SMTPDebug = 1;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
	$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
	$mail->Password = SMTP_PWORD; //Password for SMTP authentication
	$mail->AddReplyTo("admin@booklink.com", "admin"); //reply-to address
	$mail->SetFrom("admin@booklink.com", "parthz"); //From address of the mail
	// put your while loop here like below,
	$mail->Subject = "Your SMTP Mail"; //Subject od your mail
	$mail->AddAddress($email, "parth"); //To address who will receive this email
	$mail->MsgHTML("<b>Hi, your first SMTP mail has been received. Great Job!.. <br/><br/>by <a href='http://www.asif18.com/7/php/send-mails-using-smtp-in-php-by-gmail-server-or-own-domain-server/'>Asif18</a></b>"); //Put your body of the message you can place html code here
	$mail->AddAttachment("images/asif18-logo.png"); //Attach a file here if any or comment this line, 
	$send = $mail->Send(); //Send the mails
	if($send){
		echo '<center><h3 style="color:#009933;">Mail sent successfully</h3></center>';
	}
	else{
		echo '<center><h3 style="color:#FF3300;">Mail error: </h3></center>'.$mail->ErrorInfo;
	}
}
*/
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Forgot Password??</title>
<link rel="stylesheet" type="text/css" href="../../../common/vdo_style.css" />
<style>
* {
	box-sizing:border-box;
}
#reg { 
	background:url(../../../common/bg2.jpg) no-repeat right bottom;
	background-size:cover;
	height:200px;
	width:518px;
	border-radius:10px;
	  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;
	box-shadow:7px 7px 7px black;
	
}
#inner {
	height:80px;
	background:black;
	opacity:0.6;
	border-radius:10px 10px 0 0;
	margin-bottom:10px;
	margin-top:-30px;
	padding:0px;
}
#inner p {
	color:#FFFFFF;
	font-size:26px;
	font-weight:bold;
	font-family:"comic Sans MS";
	padding:20px 20px 20px 30px;
	text-shadow:2px 2px 1px;
}
label {
	padding:40px;
	color:black;
	font-weight:bolder;
	font-size:18px;
	font-variant:small-caps;
	position:relative;
	top:9px;
	
	text-shadow:1px 1px 1px #666666;
}

#outer input {
	height:25px;
	border-radius:2px;
	border:inset;
	background-color:#dcdcdc;
	margin-right:45px;
	margin-top:3px;
	float:right;
	font-family:"comic Sans MS";
	font-size:14px;
	cursor:pointer;
}
#outer input:focus {
	background-color:#FFFFFF;
}
#outer input:after {
	clear:both;
}

hr {
	color:#FFCCCC;
	width:90%;
	margin-top:25px;
}
#center input {
	width:auto;
	height:30px;
	display:block;
	margin-left:auto;
	margin-right:auto;
	font-size:18px;
	color:white;
	box-shadow:7px 7px 7px black;	
	cursor:pointer;
	padding:0px 35px 0px;
	border-radius:5px;
	font-family:"comic Sans MS";
	background:-webkit-linear-gradient(grey,black);
}
</style>
</head>


<body>

<video autoplay loop id="bgvid" controls>
<source src="../../../common/vdo7.mp4" type="video/mp4">
can't play
</video>

<div id="reg">
	<div id="inner">
		<p>Forgot Password ??</p>	
	</div>
	
	<div id="outer">
<!--	<div id="not" style="position:relative;left:6%;color:red;font-weight:bold;margin-bottom:5px;margin-top:5px;"></div>
-->		<form action="smtpgmail.php" method="post" autocomplete="off">
				<label>E-mail</label><input type="email" id="mail" name="mail" maxlength="40" size="30"/><br /><br /><br />
			</div>	
		<div id="center">
			<input type="submit" id="submit"  value="submit"/><br /><br />
		</form>
		</div>
</div>
</body>
</html>

