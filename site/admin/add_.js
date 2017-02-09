// JavaScript Document
$(document).ready(function() {
	alert('hi');
	var a=0;
	var b=0;
	var c=0;
	var d=0;
	
	var ak=0;
	var bk=0;
	var ck=0;
	var dk=0;
	
	var pidErr='PID must have at least 1 and maximum 8 digits';
	var nameErr='specify name';
	var qtyErr='enter quantity';
	var rateErr='enter valid rate of product';
	
	function change() {
		if(a==1 && b==1 && c==1 && d==1)
			$('#submit').removeAttr('disabled');
		else
			$('#submit').attr('disabled','disabled');			
		if($('#submit').is(":disabled")) {
			if(ak==1){
				$('#not').text(pidErr);
				return;
			}if(bk==1){
				$('#not').text(nameErr);	
				return;
			}if(ck==1){
				$('#not').text(qtyErr);
				return;
			}if(dk==1){
				$('#not').text(rateErr);
				return;
			}											  
		}
	}
	 
	$('#pid').focusout(function() { ak=1; if(a==0)  { pidErr='PID must have at least 1 and maximum 8 digits'; $('#pid').css('border','1px solid red').css('background-color','#dcdcdc'); } else { pidErr=''; $('#pid').css('border','inset').css('background-color','white'); } change();});
	$('#name').focusout(function() { bk=1; if(b==0) { nameErr='specify name'; $('#name').css('border','1px solid red').css('background-color','#dcdcdc'); } else { nameErr=''; $('#name').css('border','inset').css('background-color','white'); }change();});
	$('#qty').focusout(function() { ck=1; if(c==0) $('#qty').css('border','1px solid red').css('background-color','#dcdcdc');else $('#qty').css('border','inset').css('background-color','white'); change();});
	$('#rate').focusout(function() { dk=1; if(d==0) $('#rate').css('border','1px solid red').css('background-color','#dcdcdc');else $('#rate').css('border','inset').css('background-color','white'); change();});
	
	$('#pid').focusin(function() { $('#pid').css('border','inset').css('background-color','white');});
	$('#name').focusin(function() { $('#name').css('border','inset').css('background-color','white');});
	$('#qty').focusin(function() { $('#qty').css('border','inset').css('background-color','white');});
	$('#rate').focusin(function() { $('#rate').css('border','inset').css('background-color','white');});
	
	$('#submit').click(function() {
		if(a!=1 || b!=1 || c!=1 || d!=1){
			//$('#not').text(a+' '+b+' '+c+' '+d+' '+e+' '+f+' '+g);
			$(this).attr('disabled','disabled');
		}
		else {
		}
	});
	
	$('#pid').keyup(function() {
		var pid = $('#pid').val();
		var p = /[0-9]{1,8}$/;
		if(!pid.match(p)) {
				a=0;
		}else {
				a=1;
		}
		if(a==1) {
			pic1 = new Image(16, 16); 
			pic1.src = "loader.gif";
			
			var typed=$("#pid").val();
			
			if(typed.length >= 1) {
				$("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking Availability...');
				
				$.ajax({
					type: "POST",
					url: "check.php",
					data: "pid=" + typed,
					success: function(msg) {
						$("#status").ajaxComplete(function(event,request,settings){
							if(msg=='OK') {
								$("#pid").removeClass('object_error'); // if necessary
								$("pid").addClass("object_ok");
								$(this).html('<img src="accepted.png" align="absmiddle" style="margin-right:5px;" /> <font color="Green"> Available </font> ');										
								a=1;
							}else {
								$("#pid").removeClass('object_ok'); // if necessary
								$("#pid").addClass("object_error");
								$(this).html(msg);
								a=0;
							}
						});
					}
				});
			}else {
				a=0;
				$("#status").html('<font color="red">Product ID should have <strong>at least 1</strong>digit.</font>');
				$("#pid").removeClass('object_ok'); // if necessary
				$("#pid").addClass("object_error");			
			}
		}else {
			$('#submit').attr('disabled','disabled');
			$('#status').html('Give unique Product ID.');	
		}
	});
	$('#name').keyup(function() {
	//ak=1;
		var name = $('#name').val();
		name=jQuery.trim(name);
		if(name.length<=0) {
			b=0;
		}
		else {
			b=1;
		}
    });
	$('#qty').keyup(function() {
		var qty=$('#qty').val();
		if(qty.length<1) {
			qtyErr='quantity can\'t be less than 1';
			c=0;
		}else if(qty.length>4) {
			qtyErr='quantity can\'t be more than 9999';
			c=0;
		}else {
			qtyErr='';
			c=1;
		}
	});
	$('#rate').keyup(function() 
		var rate=$('#rate').val();
		var ratePattern=/[\d]*\.[\d]+$/;
		if(!rate.match(ratePattern)) {
			rateErr='rate should contain only 1 decimal point.'
			d=0;
		}else {
			rateErr='';
			d=1;
		}
	});
});