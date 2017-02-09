// JavaScript Document
$(document).ready(function() {
	var pwd="iamadmin";
	$('#pwd').keyup(function() { 
		var typed=$(this).val();
		if(typed==pwd)
			$('#button').removeAttr('disabled');
		else
			$('#button').attr('disabled','disabled');
	});	
						   
});