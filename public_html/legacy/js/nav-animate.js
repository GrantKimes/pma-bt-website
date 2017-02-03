$(document).ready(function(){

	$("a, .fake-anchor").not("nav a").hover(function(){
		$(this).animate({color: "#c50b33"}, 200);
	}, function(){
		$(this).animate({color: "black"}, 200);
	});

	$("nav ul li").hover(function(){

		$(this).children("a").animate({color: "#c50b33"}, 200);
		$(this).children("ul").slideDown(400, "easeOutCirc");

	}, function(){
		var topAnchor = $(this).children("a").not("ul ul a");

		if (!topAnchor.hasClass("selected")){
			topAnchor.animate({color: "black"}, 200);
		}
		$(this).children("ul").fadeOut(200);
	});

	$("nav ul ul li").hover(function(){

		$(this).animate({backgroundColor: "rgba(200, 200, 200, 0.65)"}, 200);

	}, function(){

		if (!$(this).hasClass("selected")){
			$(this).animate({backgroundColor: "rgba(0, 0, 0, 0.65)"}, 200);
			$(this).children("a").animate({color: "white"}, 200);
		}
	});

});