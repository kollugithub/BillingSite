<?php

// This is a sample code in case you wish to check the username from a mysql db table

if(isset($_POST['pid']))
{
		$pid = $_POST['pid'];
		$pidset='';
		if(isset($_POST['pidset']))
			$pidset=$_POST['pidset'];
		if($pid==$pidset) {
			echo 'OK';
		}else {	
			include("../common/connect.inc.php");
			
			$sql_check = mysql_query("SELECT pid FROM products WHERE pid='$pid'");
			
			if(mysql_num_rows($sql_check))
			{
			echo '<img src="wrong.png" align="absmiddle" style="margin-right:5px;"/><font color="red">This Product ID is already registered.</font>';
			}
			else
			{
			echo 'OK';
			}
		}

}else {
	
	session_start();
	if(isset($_SESSION['admin']))
		session_destroy();		
	header('Location: ../index.php');


}

?>
