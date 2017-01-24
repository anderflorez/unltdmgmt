$(document).ready(function() {
	
	$("#sidebar-lg").hide();
	var width = $(window).innerWidth();

	if (width < 768) {
		$("#sidebar-sm").hide();
		$("#page-wrapper").width(width);
	}
	else {
		$("#page-wrapper").width(width-225);
		$("#sidebar-sm").click(function() {
			$("#sidebar-sm").hide();
			$("#sidebar-lg").show();
			$(".sidebar-item").hide();
			$("#sidebar ul").removeClass("sidebar-nav");
			$("#sidebar ul").addClass("sidebar-sm");
			$("#page-wrapper").width(width-70 + "px");
			return false;
		});
		$("#sidebar-lg").click(function() {
			$("#sidebar-sm").show();
			$("#sidebar-lg").hide();
			$(".sidebar-item").show();
			$("#sidebar ul").addClass("sidebar-nav");
			$("#sidebar ul").removeClass("sidebar-sm");
			$("#page-wrapper").width(width-225 + "px");
			return false;
		});
	}
});