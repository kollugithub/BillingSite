<?php
	session_start();
	if(!isset($_SESSION['canlogin'])) {
		$_SESSION['msg']='Sorry,This link has already been used by you to reset password,if you want to reset your password please click on OK then forgot your password button.';
		header('Location: mailredirect.php');
	}	
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../../common/vdo_style.css" />
<title>Reset Password
</title>
<script  type="text/javascript" src="../../../common/jquery.js"></script>
<script  type="text/javascript" src="forgot_jQuery.js"></script>
<style>
/* css for dialog box*/
* {
	box-sizing:border-box;
}
#reg { 
	background:url(../../../common/bg2.jpg) no-repeat right bottom;
	background-size:cover;
	height:300px;
	width:518px;
	border-radius:10px;
	  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;
	box-shadow:7px 7px 7px black;
	
}
#inner {
	height:80px;
	background:black;
	opacity:0.6;
	border-radius:10px 10px 0 0;
	margin-bottom:10px;
	margin-top:-30px;
	padding:0px;
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
	margin-top:15px;
}
#center input {
	width:auto;
	height:30px;
	display:block;
	margin-left:auto;
	margin-right:auto;
	font-size:18px;
	color:white;
	box-shadow:7px 7px 7px black;	
	cursor:pointer;
	padding:0px 35px 0px;
	border-radius:5px;
	font-family:"comic Sans MS";
	background:-webkit-linear-gradient(grey,black);
}
input[type="submit"]:disabled {
	opacity:0.3;
}
input[type="submit"]:enabled {
	opacity:1;
}
</style>
</head>
<body>
 <div id="whitebg">
 </div>
 
 <video autoplay loop id="bgvid" controls>
 <source src="../../../common/vdo7.mp4" type="video/mp4">
 can't play
 </video>

<?php
unset($_SESSION['canlogin']);
$KEY = "love@1612";
@$hash = $_GET['hash'];
@$user_id = $_GET['id'];
@$timestamp = $_GET['timestamp'];
$url = "resetpassword.php?id=".$user_id.'&timestamp='.$timestamp.'&hash='.$hash;
if ($hash == md5( $user_id . $timestamp . $KEY )) {
    if ( time() - $timestamp > 10800 ) { // three hour
		$_SESSION['msg']='Content Unavailable';
		header('Location: mailredirect.php');
    }else{
		//mysql_query	
		//echo "OK"; open login page
		require '../../../common/connect.inc.php';
		if(isset($_POST['pwd']) && isset($_POST['cpwd'])){
			$pwd=$_POST['pwd'];
			if(!empty($pwd) && !empty($_POST['cpwd'])){
				$pwd=md5($pwd);
				$query=mysql_query("UPDATE staff SET password='$pwd' WHERE mail='$user_id'");
				
				$_SESSION['msg']='Congratulations !! Your password is updated successfully.';
				header('Location: mailredirect.php');
			}else{
				$_SESSION['msg']='Content Unavailable';
				header('Location: mailredirect.php');
			}
		}else{
		?>
			 <div id="reg">
                 <div id="inner">
                  <p>Reset Password !!</p> 
                 </div>
                 
                 <div id="outer">
                 <div id="not" style="position:relative;left:6%;color:red;font-weight:bold;margin-bottom:5px;margin-top:5px;"></div>
                  <form action="<?php echo $url;?>" method="post" autocomplete="off">
                    <label>New Password</label><input type="password" id="pwd" name="pwd" maxlength="20" size="28"/><hr />
                    <label>Confirm Password </label><input type="password" id="cpwd" name="cpwd" maxlength="20" size="28" /><br /><br /><br />
                   </div> 
                  <div id="center">
                   <input type="submit" id="submit"  value="submit" style="background:-webkit-linear-gradient(grey,black);"  disabled/><br /><br />
                  </form>
                   
                  </div>
            </div>
            
<?php
		}
 	}
}
else
{
	$_SESSION['msg']='Invalid parameters';
	header('Location: mailredirect.php');
}
//validation passed
//header('Location: reset_pwd_form.php');
?>
</body>
</html>