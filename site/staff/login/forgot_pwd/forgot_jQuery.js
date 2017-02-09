$(document).ready(function() {
// JavaScript Document
	var c=0;
	var d=0;
	var cK=0;
	var dK=0;
	var pwdErr='Password must be alphanumeric,must not contain space and special charcters and min length must be 8';
	var cpwdErr='Passwords don\'t match';
	
	$('#pwd').focusout(function() { ck=1; if(c==0) $('#pwd').css('border','1px solid red').css('background-color','#dcdcdc');else $('#pwd').css('border','inset').css('background-color','white');});
	$('#cpwd').focusout(function() { dk=1; if(d==0) $('#cpwd').css('border','1px solid red').css('background-color','#dcdcdc');else $('#cpwd').css('border','inset').css('background-color','white');});
	
	$('#pwd').focusin(function() { $('#pwd').css('border','inset').css('background-color','white');});
	$('#cpwd').focusin(function() { $('#cpwd').css('border','inset').css('background-color','white');});
	
	$('#submit').click(function() {
		if(c!=1 || d!=1){
			//$('#not').text(a+' '+b+' '+c+' '+d+' '+e+' '+f+' '+g);
			$(this).attr('disabled','disabled');
		}else{
			
		}
	});
	
	
	$('#pwd').keyup(function() {
	//	ck=1;
		var name = $('#pwd').val();
		name = jQuery.trim(name);
        var p =/((^[A-Za-z]+[0-9]+)|(^[0-9]+[A-Za-z]+))[0-9A-Za-z]*$/;
		if(!name.match(p) || name.length<8) {
			pwdErr='Password must be alphanumeric,must not contain space and special charcters and min length must be 8';
			$('#not').text(pwdErr);
			c=0;
		}
		else {
			pwdErr='';
			$('#not').text(pwdErr);
			c=1;
		}
		if(dk==1 && $('#pwd').val()!=$('#cpwd').val()) {
			d=0;
			cpwdErr='Passwords don\'t match';
			$('#cpwd').css('border','1px solid red').css('background-color','#dcdcdc');
		}else if(dk==1 && $('#pwd').val()==$('#cpwd').val()){
			d=1;
			cpwdErr='';
			$('#cpwd').css('border','inset').css('background-color','white');		
		}
		if(c==1 && d==1)
			$('#submit').removeAttr('disabled');
		else
			$('#submit').attr('disabled','disabled');
			
		if($('#submit').is(":disabled")) {
			if(c==0 && ck==1){
				$('#not').text(pwdErr);	
			}else if(d==0 && dk==1){
				$('#not').text(cpwdErr);	
			}												  
		}
		
    });
	$('#cpwd').keyup(function() {
	//						  dk=1;
		var cname = $('#cpwd').val();
		cname = jQuery.trim(cname);
		var name = $('#pwd').val();
		name = jQuery.trim(name);
		if(!cname.match(name) || cname.length!=name.length) {
			cpwdErr='Passwords don\'t match';
			$('#not').text(cpwdErr);
			d=0;
		}
		else {
			cpwdErr='';
			$('#not').text(cpwdErr);
			d=1;
		}
		if(c==1 && d==1)
			$('#submit').removeAttr('disabled');
		else
			$('#submit').attr('disabled','disabled');
			
		if($('#submit').is(":disabled")) {
			if(c==0 && ck==1){
				$('#not').text(pwdErr);	
			}else if(d==0 && dk==1){
				$('#not').text(cpwdErr);	
			}												  
		}

    });
});