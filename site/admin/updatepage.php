<?php
	session_start();
	if(!isset($_SESSION['admin']))
		header('Location: ../index.php');
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../common/vdo_style.css" />
<title>Update Details
</title>
<script  type="text/javascript" src="../common/jquery.js"></script>
<script  type="text/javascript" src="update.js"></script>
<style>
/* css for dialog box*/

 #whitebg {
  display:none;
  width:100%;
  height:100%;
  position:fixed;
  top:0;
  left:0;
  z-index:9999;
  opacity:0.7;
  background-color:#fefefe;
 }
 #dlgbox {
  font-family:"comic Sans MS";
  position:fixed;
  display:none;
  width:480px;
  z-index:9999;
  border-radius:10px;
  border:1px solid black;
  box-shadow:5px 5px 5px black;
  background:white;
 }
 #dlg-header {
  background:#000000;
  opacity:0.7;
  font-size:22px;
  color:red;
  font-weight:bolder;
  padding:10px;
  padding-left:20px;
  border-radius:10px 10px 0px 0px;
 }
 #dlg-body {
  padding:15px;
  color:#003871;
  text-align:center;
  font-size:20px;
 }
 #dlg-footer {
  text-align:right;
  padding:10px;
 }
 #dlg-footer input {
  background:-webkit-linear-gradient(#135cc9,#003871);
  opacity:0.7;
  color:white;
  font-family:"comic Sans MS";
  text-decoration:none;
  padding:2px 20px;
  border-radius:5px;
  box-shadow:2px 2px 2px grey;
 }
/* css for form */ 
 
* {
	box-sizing:border-box;
}
#reg { 
	background:url(../common/bg2.jpg) no-repeat right bottom;
	background-size:cover;
	height:442px;
	width:518px;
	border-radius:10px;
	margin-left:auto;
	margin-right:auto;
	margin-top:6%;
	margin-bottom:auto;
	box-shadow:7px 7px 7px black;
}
#inner {
	height:80px;
	background:black;
	opacity:0.6;
	border-radius:10px 10px 0 0;
	margin-bottom:8px;
}
#inner p {
	color:#FFFFFF;
	font-size:26px;
	font-weight:bold;
	font-family:"comic Sans MS";
	padding:20px 20px 20px 30px;
	text-shadow:2px 2px 1px;
}
label {
	padding:40px;
	color:black;
	font-weight:bolder;
	font-size:18px;
	font-variant:small-caps;
	position:relative;
	top:9px;
	
	text-shadow:1px 1px 1px #666666;
}

#outer input {
	height:25px;
	border-radius:2px;
	border:inset;
	background-color:#dcdcdc;
	margin-right:45px;
	margin-top:3px;
	float:right;
	font-family:"comic Sans MS";
	font-size:14px;
	cursor:pointer;
}
#outer input:focus {
	background-color:#FFFFFF;
}
#outer input:after {
	clear:both;
}

hr {
	color:#FFCCCC;
	width:90%;
	margin-top:25px;
}
input[type="submit"]:disabled {
	width:130px;
	height:30px;
	display:block;
	margin-left:auto;
	margin-right:auto;
	font-size:18px;
	color:white;
	box-shadow:7px 7px 7px black;	
	background-color:black;
	opacity:0.3;
	cursor:pointer;
}
input[type="submit"]:enabled {
	width:130px;
	height:30px;
	display:block;
	margin-left:auto;
	margin-right:auto;
	font-size:18px;
	color:white;
	box-shadow:7px 7px 7px black;	
	background-color:black;
	opacity:0.7;
	cursor:pointer;
}
#hoverdiv {
	display:none;
	background-color:#cad5e7;
	color:#000000;
	position:absolute;
	font-size:18px;
	padding:2px;
	border:1px solid black;
}
</style>
</head>
<body>
 <div id="whitebg">
 </div>
 
 <video autoplay loop id="bgvid" controls>
 <source src="../common/vdo7.mp4" type="video/mp4">
 can't play
 </video>
 <div id="dlgbox">
  <div id="dlg-header">
   Error
  </div>
  <div id="dlg-body">
   Body
  </div>
  <div id="dlg-footer">
   <a href="update.php"><input type="button" value="OK" ></a>
  </div>
 </div>

<script>
 function show(error) {
  var whitebg=document.getElementById('whitebg');
  var dlg=document.getElementById('dlgbox');
  document.getElementById('dlg-body').innerHTML=error;
  var winWidth=window.innerWidth;
  var winHeight=window.innerHeight;
  dlg.style.display="block";
  whitebg.style.display="block";
  dlg.style.left=(winWidth/2)-(480/2)+"px";
  dlg.style.top="100px";
 }
</script>


<?php

		//mysql_query	
		//echo "OK"; open login page
		require '../common/connect.inc.php';
		if(!isset($_POST['pid'])) {
			echo "<script>show('Invalid Credentials')</script>";
			die();
		}else {
			$pid=$_POST['pid'];
			if(empty($pid)) {
				echo "<script>show('Contents Unavailable !!')</script>";
				die();
			}else {
				$query=mysql_query("SELECT * FROM products WHERE pid='".mysql_real_escape_string($pid)."'");
				if(mysql_num_rows($query)==0) {
					echo "<script>show('OOPS !! There product is no product with id ".$pid."')</script>";
					die();
				}else {
					$product=mysql_fetch_assoc($query);
					$name=$product['name'];
					$qty=$product['quantity'];
					$rate=$product['rate'];
?>
									
					<div id="reg">
					<div id="inner">
						<p>Update Product</p>	
					</div>
					
					<div id="outer">
					<div id="not" style="position:relative;left:6%;color:red;font-weight:bold;margin-bottom:8px;"></div>
						<form action="finalupdate.php" autocomplete="off" method="post" autocomplete="off">
							<label>Product ID </label><input type="text" id="pid" name="pid" value="<?php echo "$pid"; ?>" maxlength="20" size="30"  onKeyUp="this.value = this.value.replace(/[^\d]+/, '');" autofocus /><br /><br /><span id="status" style="height:2px;;display:block;text-align:center;color:#003871; font-weight:bold; position:relative; left:9%">Give unique Product ID.</span><hr />
								<label>Name</label><input type="text" id="name" name="name" maxlength="40" value="<?php echo "$name"; ?>" size="30"/><hr />
								<label>Quantity </label><input type="text" id="qty" name="qty" class="hover" maxlength="20" value="<?php echo "$qty"; ?>" hovertext="" size="30" onKeyUp="this.value = this.value.replace(/[^\d]+/, '');" /><hr />
								<label>Rate</label><input type="text" id="rate" class="hover" name="rate"  hovertext="" maxlength="20" size="30" value="<?php echo "$rate"; ?>" onKeyUp="this.value = this.value.replace(/[^\d.]+/, '');" /><hr />
								
								<input type="text" name="pidset" value="<?php echo "$pid"; ?>" style="display:none;" />
							
					</div>
						<br />
						<br />
							
						
							<input type="submit" id="submit" value="Update"  />
						</form>
						</div>
					
					 </div>
<?php					
				}	
			}
		}
?>

</body>
</html>
