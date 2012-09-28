$(document).ready(function() {
	$("#username").focus();
	$('.fancybox').fancybox();
	$('#datepicker').datepicker({"dateFormat": "dd.mm.yy"});
	$('#dtform').submit(function(e) {
		e.preventDefault();
		$.post(".", $("#dtform").serialize(), function(data) {
			$("#images").html(data);
		});
	});
	$("#datepicker").change(function() { 
		$('#dtform').submit();	
	});
});

$(".ico").live("click", function() {
	var a = $(this).parent().parent().css("background-image");
	a = a.replace('url("', '').replace('")', '');
	while (a.indexOf("/") > -1) 
		a = a.substring(a.indexOf("/") + 1);
	$.get(".", {"cmd": "delete", "image": a}, function(data) {
		if (data == "nosession") {
			alert("Session time out!");
			document.location.href = '.?cmd=logout';
		} else if (data == "error") {
			alert("Could not delete file!");			
		}
	});
	$(this).parent().parent().hide('explode');
});


