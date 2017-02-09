// JavaScript Document
$(document).ready(function() {
	var counter = 0;
	var a = [];
	var b = [];
	var ratearr = [];
	var qtyarr = [];
	var qtyenter = [];
	var name='';
	a[0]=0;
	b[0]=0;
	ratearr[0]=0;
	qtyarr[0]=0;
jQuery('#add').click(function(event){
    event.preventDefault();
    counter++;
    var newRow = jQuery('<tr><td><input type="text" size="5" name="pid' + counter + '" id="pid' + counter + '" /></td><td><input type="text" size="15" value="" name="name' + counter + '" id="name' + counter + '" disabled /></td><td><input type="text" size="5" name="qty' + counter + '" id="qty' + counter + '" disabled /></td><td><input type="text" size="8" id="rate' + counter + '" value="" name="rate' + counter + '" disabled/></td></tr>');
    jQuery('#bill').append(newRow);
	var h = $('#reg').height();
	h=h+30;
	$('#reg').height(h);
	if(h>=$(window).height()) {
		$('#reg').css('position','relative');
	}
	a[counter]=0;
	b[counter]=0;
	ratearr[counter]=0;
	qtyarr[counter]=0;
	qtyenter[counter]=-1;
	check();
	$('#hidden').val(counter);
//	$('#rate0').val($("#name0").attr('id'));
});		

function check() {
	var l=0;
	var flag=0;
	for(l=0;l<=counter;l++) {
		if(a[l]==0 || b[l]==0) {
			flag=1;
			break;
		}
	}
	if(flag==1) {
		$('#makebill').attr('disabled','disabled');	
	}else {
		$('#makebill').removeAttr('disabled');	
	}
}

$("#makebill").click(function(){
	var i=0;
	for(i=0;i<=counter;i++) {
		$('#name'+i).removeAttr('disabled');
		$('#rate'+i).removeAttr('disabled');
	}
});
$("#remove").click(function(){
	if(counter>0) {
	 $('#bill tr:last-child').remove();
	 var h = $('#reg').height();
		h=h-30;
		$('#reg').height(h);
		if(h<$(window).height()) {
			$('#reg').css('position','absolute');
		}
		a[counter]=0;
		b[counter]=0;
		ratearr[counter]=0;
		qtyarr[counter]=0;
		qtyenter[counter]=-1;
		counter--;
		$('#hidden').val(counter);
	}
	check();
 });


	$("[id^=pid]").live("keyup", function () {            
         var can=1;
		 if (this.value.match(/[^\d\t]+/)) {
             can=0;
			 this.value = this.value.replace(/[^\d]+/, '');           
          }
		 if(can==1) {
				var x = $(this).attr('id').length;
				var str=$(this).attr('id');
				var i=0;
				var j=1;
				var num=0;
				var k=0;
				for(i=x-1;i>2;i--) {
					k=str.charAt(i);
					k=k-'0';
					num=num+k*j;
					j=j*10;
				}
				var typed=$(this).val();
				var n= num.toString();
				if(typed.length>=1) {
					pic1 = new Image(16, 16); 
						pic1.src = "loader.gif";
						
							$("#status").html('<img src="loader.gif" align="absmiddle">&nbsp;Checking...');
							
							$.ajax({
								type: "POST",
								url: "find.php",
								data: "pid=" + typed,
								success: function(msg) {
									$("#status").ajaxComplete(function(event,request,settings){
						//				alert(num);
										if(msg=='NO') {
											$(this).html('<img src="wrong.png" align="absmiddle" style="margin-right:5px;" /> <font color="Red">No such product available</font> ');
											a[num]=0;
											$('#name'+n).val('');
											$('#qty'+n).val('');
											$('#rate'+n).val('');
											name='';
											$('#qty'+n).attr('disabled','disabled');
											qtyarr[num]=0;
											ratearr[num]=0;
											b[num]=0;
										//	alert(1);
										}else if(msg=='') {
											$(this).html('');
											a[num]=0;
											$('#name'+n).val('');
											$('#qty'+n).val('');
											$('#rate'+n).val('');
											name='';
											$('#qty'+n).attr('disabled','disabled');
											qtyarr[num]=0;
											ratearr[num]=0;
											b[num]=0;
										}else {
											for(i=0;msg.charAt(i)!='?';i++) {
												name+=msg.charAt(i);
											}
											var qtystr='';
											i++;
											while(msg.charAt(i)!='?') {
												qtystr+=msg.charAt(i);
												i++;
											}
											qty=0;
											k=1;
											for(j=qtystr.length-1;j>=0;j--) {
												qty=qty+(qtystr.charAt(j)-'0')*k;
												k=k*10;
											}
											i++;
											var ratestr='';
											while(msg.charAt(i)!='?') {
												ratestr+=msg.charAt(i);
												i++;
											}
											rate=0;
											k=1;
											flag=0;
											for(j=ratestr.length-1;j>=0;j--) {
												if(ratestr.charAt(j)=='.') {
													flag=1;
													break;
												}
												rate=rate+(ratestr.charAt(j)-'0')*k;
												k=k*10;
											}
											if(flag==1) {
												j--;
												rate=rate/k;
												k=1;
												while(j>=0) {
													rate=rate+(ratestr.charAt(j)-'0')*k;
													k=k*10;
													j--;
												}
											}
											ratearr[num]=rate;
											qtyarr[num]=qty;
											$(this).html('');
											$('#name'+n).val(name);
											qty=$('#qty'+n).val();
											if(qty.length>0) {
												if(qty>qtyarr[num]) {
													$('#status').html('<img src="wrong.png" align="absmiddle" style="margin-right:5px;" /> <font color="Red">Only ' + qtyarr[num] + ' available in store</font>');	
													$('#rate'+n).val('--NA--');
													b[num]=0;
													
												}else {
													$('#status').html('');	
													$('#rate'+n).val(ratearr[num]*qty);
													b[num]=1;
													
												}
										    }else {
												b[num]=0;
												$('#rate'+n).val('');
												
												$('#makebill').attr('disabled','disabled');
											}
										//	$('#rate'+n).val(rate);
											a[num]=1
											name='';
											$('#qty'+n).removeAttr('disabled');
											if(qtyenter[num]!=-1 && qtyenter[num]<=qtyarr[num]) {
												$('#qty'+n).val(qtyenter[num]);
												$('#rate'+n).val(ratearr[num]*qtyenter[num]);
												b[num]=1;
											}
										}
									});
								}
							});
					}else if(typed.length==0) {
						a[num]=0;
						b[num]=0;
						$('#name'+n).val('');
						$('#qty'+n).val('');
						$('#rate'+n).val('');
						name='';
						$('#qty'+n).attr('disabled','disabled');
						qtyarr[num]=0;
						qtyenter[num]=-1;
						ratearr[num]=0;	
					}
			}
			
			check();
		
    }
 );
	
	$("[id^=qty]").live("keyup", function () {            
        var can=1;
		 if (this.value.match(/[^\d\t]+/)) {
             can=0;
			 this.value = this.value.replace(/[^\d\t]+/, '');           
          }
		 if(can==1) {
				var x = $(this).attr('id').length;
				var str=$(this).attr('id');
				var i=0;
				var j=1;
				var num=0;
				var k=0;
				for(i=x-1;i>2;i--) {
					k=str.charAt(i);
					k=k-'0';
					num=num+k*j;
					j=j*10;
				}
				var typed=$(this).val();
				var pid=$('#pid' +n).val();
				var n= num.toString();
				if(typed.length>0) {
					if(typed>qtyarr[num]) {
				//		var qtystring=qty.toString();
						$('#status').html('<img src="wrong.png" align="absmiddle" style="margin-right:5px;" /> <font color="Red">Only ' + qtyarr[num] + ' available in store</font>');	
				//		document.getElementById('status').innerHtml='only ' + qtystring + ' available';
						$('#rate'+n).val('--NA--');
						b[num]=0;
						qtyenter[num]=-1;
					}else if(typed==0) {
						$('#status').html('<img src="wrong.png" align="absmiddle" style="margin-right:5px;" /> <font color="Red">Quantity must always be greater than 0</font>');
						$('#rate'+n).val('--NA--');
						b[num]=0;
						qtyenter[num]=-1;
					}
					else {
						$('#status').html('');	
						$('#rate'+n).val(ratearr[num]*typed);
						b[num]=1;
						qtyenter[num]=typed;
					}
		 		}else {
					b[num]=0;
					$('#rate'+n).val('');
					qtyenter[num]=-1;
					$('#makebill').attr('disabled','disabled');
				}
		 }
		 check();
	});

});