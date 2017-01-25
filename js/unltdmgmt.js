$(document).ready(function() {
	
	$("#sidebar-lg").hide();
	var width = $(window).innerWidth();

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
			$("#page-wrapper").css("margin-left", "70px");
			return false;
		});
		$("#sidebar-lg").click(function() {
			$("#sidebar-sm").show();
			$("#sidebar-lg").hide();
			$(".sidebar-item").show();
			$("#sidebar ul").addClass("sidebar-nav");
			$("#sidebar ul").removeClass("sidebar-sm");
			$("#page-wrapper").css("margin-left", "225px");
			return false;
		});
	}
});