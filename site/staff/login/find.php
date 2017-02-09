<?php
if(isset($_POST['pid']) && !empty($_POST['pid'])) {
	require '../../common/connect.inc.php';
	$pid=$_POST['pid'];
	$query=mysql_query("SELECT * FROM products WHERE pid='$pid'");
	if(mysql_num_rows($query)==0) {
		echo 'NO';
	}else {
		$name=mysql_result($query,0,'name');
		$qty=mysql_result($query,0,'quantity');
		$rate=mysql_result($query,0,'rate');
		echo $name."?".$qty."?".$rate."?";
	}
}else {
	echo '';
}

?>
