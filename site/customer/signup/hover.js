// JavaScript Document	

$('.hover').mousemove(function(e) {
    var htext=$(this).attr('hovertext');
	$('#hoverdiv').text(htext).show();
	$('#hoverdiv').css('top',e.clientY+10).css('left',e.clientX+10);
}).mouseout(function(e) {
    $('#hoverdiv').hide();
});

