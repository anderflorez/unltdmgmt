$(document).ready(function() {
	$("#open-sidebar").hide();
	$("#sidebar").css("height", $(document).height());

	$("#close-sidebar").click(function() {
		$("#open-sidebar").show();
		$("#close-sidebar").hide();
	});
	$("#open-sidebar").click(function() {
		$("#open-sidebar").hide();
		$("#close-sidebar").show();		
	})

	var width = $(window).width();
	if (width < 768) {

	}
});