<?php
require 'checkifloggedin.php';
//unset($_SESSION['canmakebill']);
if(isset($_SESSION['bill']) && !empty($_SESSION['bill'])) {
	unset($_SESSION['bill']);
}else {
	header('Location: profile.php');
}
require '../../common/connect.inc.php';
@date_default_timezone_set("Asia/Kolkata");
$counter=$_POST['hidden'];
$query=mysql_query("SELECT `bill_count` FROM internal");
$count=mysql_result($query,0);
$_SESSION['count']=$count;
if($count==0) {
	$files = glob('bills/*'); // get all file names
	foreach($files as $file){ // iterate files
  		if(is_file($file))
   			unlink($file); // delete file
	}
}
$billfile=fopen("bills/bill".$count.".txt","w");
mysql_query("UPDATE internal SET bill_count=$count+1");
fwrite($billfile,"bill id: bill".$count."\r\n");
if(isset($_SESSION['customer']) && !empty($_SESSION['customer'])) {
	fwrite($billfile,"customer id : ".$_SESSION['customer']."\r\n");
}
fwrite($billfile,"billed by staff id : ".$_SESSION['user']."\r\n");
fwrite($billfile,"on date : ".date('Y-m-d H:i:s')."\r\n");
fwrite($billfile,"Product ID\tname\tquantity\ttotal\r\n");
$pay=0;
for($i=0;$i<=$counter;$i++) {
	$pid=$_POST['pid'.$i];
	$name=$_POST['name'.$i];
	$qty=$_POST['qty'.$i];
	$rate=$_POST['rate'.$i];
	$query=mysql_query("SELECT quantity,rate FROM products WHERE pid='$pid'");
	$storeqty=mysql_result($query,0,'quantity');
	$storerate=mysql_result($query,0,'rate');
	if($storeqty<$qty) {
		$qty=$storeqty;
		$rate=$storerate*$qty;
		mysql_query("UPDATE products SET quantity='0' WHERE pid='$pid'");
	}else {
		$remaining=$storeqty-$qty;
		mysql_query("UPDATE products SET quantity='$remaining' WHERE pid='$pid'");
	}
	if($qty!=0) {
		$pay=$pay+$rate;
		fwrite($billfile,$pid."\t".$name."\t\t".$qty."\t".$rate);
		fwrite($billfile,"\r\n");
	}	
}
fclose($billfile);
$_SESSION['pay']=ceil($pay);
$_SESSION['total']=$counter;
if(isset($_SESSION['customer']) && !empty($_SESSION['customer']) && $_SESSION['customer_wallet']>0) {
	header('Location: finalbillreg.php');
}else {
	header('Location: finalbill.php');
}
?>