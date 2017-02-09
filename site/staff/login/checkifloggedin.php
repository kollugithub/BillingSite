<?php
session_start();
if(!isset($_SESSION['user']) || !isset($_SESSION['user_name']))
	header('Location: index.php');
?>