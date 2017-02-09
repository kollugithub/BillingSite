
<?php
$KEY = "love@1612";
@$hash = $_GET['hash'];
@$user_id = $_GET['id'];
@$timestamp = $_GET['timestamp'];
$verifyurl = "verify.php?id=".$user_id.'&timestamp='.$timestamp.'&hash='.$hash;
$deactivateurl = "deactivate.php?id=".$user_id.'&timestamp='.$timestamp.'&hash='.$hash;
?>



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../common/vdo_style.css" />
<title>Verify/Deactivate account
</title>

<style>
	body {
		font-family:"comic Sans MS";
	}
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
		padding:10px;
		font-weight:bold;
		text-align:center;
		font-size:20px;
	}
	
	#footer {
		text-align:center;
		padding:15px;
	}
	
	.button {
		background:-webkit-linear-gradient(#135cc9,#003871);
		opacity:0.7;
		color:white;
		text-decoration:none;
		border-radius:5px;
		box-shadow:2px 2px 2px grey;
		height:40px;
		width:120px;
		font-size:15px;
		font-family:"comic Sans MS";
		cursor:pointer;
	}
	#hoverdiv {
	display:none;
	background-color:#cad5e7;
	color:#000000;
	position:fixed;
	font-size:15px;
	padding:2px;
	border:1px solid black;
}
	
</style>
</head>
<body>
	<div id="whitebg">
	</div>
	
	<video autoplay loop id="bgvid" controls>
	<source src="../../common/vdo7.mp4" type="video/mp4">
	can't play
	</video>
	<div id="dlgbox">
		<div id="dlg-header">
			Message
		</div>
		<div id="dlg-body">
			<p>Select your choice !!</p>
		</div>
		<div id="footer">
			<a href="<?php echo $verifyurl;?>" style="text-decoration:none;"><input type="button" id="button" class="button" hovertext="Your account will be verified successfully.Proceed to Log In" value="Verify" ></a>
			<a href="../login/index.php" style="text-decoration:none;"><input type="button" style="display:none;" class="button" id="gotit" value="Got it !!" ></a>
			<a href="<?php echo $deactivateurl;?>"  style="text-decoration:none;"><input type="button" id="button2" class="button" hovertext="Your account will be deactivated and you will be redirected to our home page" value="Deactivate" ></a>
			<div id="hoverdiv"></div>
		</div>
	</div>
	
<script>
	function show(error) {
		var whitebg=document.getElementById('whitebg');
		var dlg=document.getElementById('dlgbox');
		var button=document.getElementById('button');
		var button2=document.getElementById('button2');
		var button3=document.getElementById('gotit');
		document.getElementById('dlg-body').innerHTML=error;
		var winWidth=window.innerWidth;
		var winHeight=window.innerHeight;
		dlg.style.display="block";
		whitebg.style.display="block";
		dlg.style.left=(winWidth/2)-(480/2)+"px";
		dlg.style.top="100px";
		button.style.display="none";
		button2.style.display="none";
		button3.style.display="inline";
		button3.style.textAlign="center";
	}
	function ok(message) {
		var whitebg=document.getElementById('whitebg');
		var dlg=document.getElementById('dlgbox');
		var button3=document.getElementById('gotit');
		document.getElementById('dlg-body').innerHTML=message;
		var winWidth=window.innerWidth;
		var winHeight=window.innerHeight;
		dlg.style.display="block";
		whitebg.style.display="block";
		dlg.style.left=(winWidth/2)-(480/2)+"px";
		dlg.style.top="100px";
		button3.style.display="none";
	}
</script>
<script src="../../common/jquery.js" type="text/javascript"></script>
<script>
$('.button').mousemove(function(e) {
    var htext=$(this).attr('hovertext');
	$('#hoverdiv').text(htext).show();
	$('#hoverdiv').css('top',e.clientY+10).css('left',e.clientX+10);
}).mouseout(function(e) {
    $('#hoverdiv').hide();
});

</script>
</body>
</html>
<?php
if ($hash == md5( $user_id . $timestamp . $KEY )) {
    if ( time() - $timestamp > 1296000 ) { // 15 days
		echo "<script>show('Sorry, This link is expired.');</script>";
        die();
    }else{
		echo "<script>ok('Select your choice !!');</script>";
	}
}else {
	echo "<script>show('Invalid parameters.');</script>";
 //   die();
}
?>
