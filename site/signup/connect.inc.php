<?php
$sql_host='localhost';
$sql_username='root';
$sql_password='Pani@2829';
$sql_db='site';
if(@!mysql_connect($sql_host,$sql_username,$sql_password) || @!mysql_select_db($sql_db)) {
	die(mysql_error());
}

?>
