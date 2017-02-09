<?php
session_start();
if(!isset($_SESSION['admin']))
	header('Location: ../index.php');
require '../common/connect.inc.php';
$query=mysql_query("SELECT COUNT(*) FROM `staff`");
$count=mysql_result($query,0);
$query=mysql_query("SELECT * FROM `staff`");
for($i=0;$i<$count;$i++) {
	$mail=mysql_result($query,$i,'mail');
	mysql_query("UPDATE staff SET collect='0' WHERE mail='$mail'");
}
header('Location: index.php');
?>