$(document).ready(function() {
	$("#sidebar-lg").hide();
	var width = $(window).innerWidth();
	console.log(width);
	if (width < 768) {
		$("#sidebar-sm").hide();
	}
	else {
		$("#sidebar-sm").click(function() {
			$("#sidebar-sm").hide();
			$("#sidebar-lg").show();
			$(".sidebar-item").hide();
			$("#sidebar ul").removeClass("sidebar-nav");
			$("#sidebar ul").addClass("sidebar-sm");
			return false;
		});
	}
});