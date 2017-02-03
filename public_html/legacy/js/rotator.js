// Next line pulls all images in #img-rotator which aren't the prev or next button images.
var images = $("#img-rotator").children("img").not("#prev-button, #next-button");
var selected = images.first(); // Sets the first image as the selected, or to be currently visible, image.

	function fadeNext(){
		selected.fadeOut(200, function(){

			if (selected.is(images.last())){
				selected = images.first();
				selected.fadeIn(200);
			}

			else{
				selected = selected.next("img");
				selected.fadeIn(200);
			}
		});
	}

	function fadePrev(){
		selected.fadeOut(200, function(){

			if (selected.is(images.first())){
				selected = images.last();
				selected.fadeIn(200);
			}

			else{
				selected = selected.prev("img");
				selected.fadeIn(200);
			}
		});
	}

	function rotator(pause){
		if (!pause)
			fadeNext();
	}

$(document).ready(function(){

	$("#prev-button, #next-button").fadeTo(200, 0.0);

	// Prevents prev and next button initialization before images have been loaded so height is properly calculated.
	$(window).load(function(){

		// Initializes next and prev buttons so they stay properly aligned inside the image rotator.
		$("#next-button, #prev-button").css("bottom", ($("#img-rotator img").height() / 2) + 25 + "px");
	});

	// Changes relative position of next and prev buttons if the image rotator image is resized due to browser resizing, etc., and resizes #img-rotator to the image's new height.
	$(window).resize(function(){
		$("#next-button, #prev-button").css("bottom", ($("#img-rotator img").height() / 2) + 25 + "px");
	});

	var pause = false;

	selected.fadeIn(100);

	setInterval(function(){rotator(pause)}, 4000);

	$("#img-rotator").hover(function(){
		$("#prev-button, #next-button").fadeTo(200, 0.75);
		pause = true;

	}, function(){
		$("#prev-button, #next-button").fadeTo(200, 0.0);
		pause = false;
	});

	$("#prev-button").click(function(){
		fadePrev();
	});

	$("#next-button").click(function(){
		fadeNext();
	});

	$("#next-button, #prev-button").hover(function(){
		$(this).fadeTo(200, 1.0);
	}, function(){
		$(this).fadeTo(200, 0.75);
	});

});