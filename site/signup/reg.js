// JavaScript Document
$(document).ready(function() {
		var a='0';
	var b='0';
	var c='0';
	var d='0';
	var e='0';
    $('#uname').blur(function() {
        var name = $('#uname').val();
		name=jQuery.trim(name);
		if(name.length<=5) {
			$('#unames').text('Atleast 5 characters required').css('font-style','italic').css('color','red');
			a='0';
		}
		else {
			a='1';
			$('#unames').text('');
			}
		if(a==1 && b==1 && c==1 && d==1 && e==1)
			$('#submit').removeAttr('disabled');
		else
			$('#submit').attr('disabled','disabled');
    });
	$('#pwd').blur(function() {
		var name = $('#pwd').val();
		name = jQuery.trim(name);
        var p =/((^[0-9]+[a-z]+)|(^[a-z]+[0-9]+))+[0-9a-z]+$/i;
		if(!name.match(p) && name!='' && name.length<8) {
			$('#pwds').html('Password must be alphanumeric,must not contain space and min length must be 8').css('color','red');
			b=0;
		}
		else {
			$('#pwds').html('');
			b=1;
		}
		if(a==1 && b==1 && c==1 && d==1 && e==1)
			$('#submit').removeAttr('disabled');
		else
			$('#submit').attr('disabled','disabled');

    });;
	$('#file').change(function() {
        var p = /((\.jpg)|(\.gif)|(\.png))$/;
		var name = $('#file').val();
		if(!name.match(p)) {
			$('#pho').html('Please select an image file').css('font-style','italic').css('color','red');
			c=0;
		}
		else {
			$('#pho').html('');
			c=1
			}
		if(a==1 && b==1 && c==1 && d==1 && e==1)
			$('#submit').removeAttr('disabled');
		else
			$('#submit').attr('disabled','disabled');
	
    });
	$('#email').blur(function() {
		var p=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var name = $('#email').val();
		if(!p.test(name)) {
			$('#emails').html('Enter a valid email id').css('font-style','italic').css('color','red');
			d=0;
		}
		else {
			$('#emails').html('');
			d=1;
			}
		if(a==1 && b==1 && c==1 && d==1 && e==1)
			$('#submit').removeAttr('disabled');
		else
			$('#submit').attr('disabled','disabled');
    });
	$('#no').blur(function() {
		var p = /[0-9]{10}$/;
		var name = $('#no').val();
		if(!p.test(name) || name.length!=10) {
			$('#nos').html('Number must have 10 digits').css('font-style','italic').css('color','red');
			e=0;
		}
		else {
			$('#nos').html('');
			e=1;
			}
		if(a==1 && b==1 && c==1 && d==1 && e==1)
			$('#submit').removeAttr('disabled');
		else
			$('#submit').attr('disabled','disabled');
	});
});