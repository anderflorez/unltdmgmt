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
			$(".page-wrapper").css("margin-left", "70px");
			return false;
		});
		$("#sidebar-lg").click(function() {
			$("#sidebar-sm").show();
			$("#sidebar-lg").hide();
			$(".sidebar-item").show();
			$("#sidebar ul").addClass("sidebar-nav");
			$("#sidebar ul").removeClass("sidebar-sm");
			$(".page-wrapper").css("margin-left", "225px");
			return false;
		});
	}

	$(".sidebar-toggle").click(function() {
		$("#sidebar").slideToggle("fast", function() {
			var sideheight = $(".sidebar-nav").height() + 100;
			$(".page-wrapper").css("margin-top", sideheight + "px");
		});
	})

	var filename = function() {
		var url = document.location.href;
		url = url.substring(0, (url.indexOf("#") == -1) ? url.length : url.indexOf("#"));
		url = url.substring(0, (url.indexOf("?") == -1) ? url.length : url.indexOf("?"));
		url = url.substring(0, (url.indexOf(".") == -1) ? url.length : url.indexOf("."));
		url = url.substring(url.lastIndexOf("/") + 1, url.length);
		return url;
	}
	$("#" + filename()).addClass("active");
});