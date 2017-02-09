<?php
@session_start();
if(!isset($_SESSION['customer']))
	header('Location: profile.php');
?>