<?php
session_start();
if(!isset($_SESSION['customer']) || !isset($_SESSION['customer_name']) || !isset($_SESSION['customer_wallet'])) {
	$_SESSION['msg']='Invalid Access';
	header('Location: redirect.php');
}
?>