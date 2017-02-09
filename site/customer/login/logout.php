<?php
session_start();
unset($_SESSION['customer']);
unset($_SESSION['customer_name']);
unset($_SESSION['customer_wallet']);
header('Location: index.php');
?>