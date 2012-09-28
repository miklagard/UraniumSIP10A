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
});
