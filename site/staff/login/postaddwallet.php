<?php
require 'checkifloggedin.php';
require 'checkifcustomerloggedin.php';
require '../../common/connect.inc.php';

if(isset($_POST['wallet'])) {
	$add=$_POST['wallet']+$_SESSION['customer_wallet'];
	@date_default_timezone_set("Asia/Kolkata");
	$time=time();
	$datetime=date('Y_m-d H:i:s',$time);
	$query=mysql_query("INSERT INTO wallet_transaction VALUES('".mysql_real_escape_string($_SESSION['user'])."','".mysql_real_escape_string($_SESSION['customer'])."','".mysql_real_escape_string($_POST['wallet'])."','$datetime')");
	if(($error=mysql_error())!='') {
		$_SESSION['msg']=$error;
	}else {
		mysql_query("UPDATE customer SET wallet='".mysql_real_escape_string($add)."' WHERE mail='".mysql_real_escape_string($_SESSION['customer'])."'");
		$_SESSION['msg']="Rs.".$_POST['wallet']." added successfully in customer id: ".$_SESSION['customer'];
	}
	$query=mysql_query("SELECT collect FROM staff WHERE mail='".$_SESSION['user']."'");
	$now=mysql_result($query,0);
	$now=$now+$_POST['wallet'];
	mysql_query("UPDATE staff SET collect='".$now."' WHERE mail='".$_SESSION['user']."'");
	mysql_query("UPDATE staff SET rating=rating+1 WHERE mail='".$_SESSION['user']."'");
}else {
	$_SESSION['msg']='Invalid access';
}
unset($_SESSION['customer']);
unset($_SESSION['customer_wallet']);
header('Location: redirect.php');
?>