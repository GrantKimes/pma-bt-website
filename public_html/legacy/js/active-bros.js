function tagNameFormatter(broItem){

	switch (broItem){

		case "full-name":
			return "full-name";
		case "hometown":
			return "Hometown: ";
		case "initiated":
			return "Initiated: ";
		case "major":
			return "Major: ";
		case "graduating":
			return "Graduating: ";
		case "position":
			return "Position: ";
		default:
			console.log("Error trying to find the parent of" + itemParent);
			return "Error, element parent unknown.";
	}

}

function expandBrotherInfo(name, list){

	var brothers = list.getElementsByTagName("brother");

	for (var i = 0; i < brothers.length; i++)
	{
		if (brothers[i].getAttribute("name") === name)
		{
			$("#bro-info-drop").slideUp(400, function(){

				$(this).empty();
				//Delete this line and remove comment from front of second below when images are loaded.
				var imgLoc = "img/brothers/cat.jpg"
				//var imgLoc = "../img/" + name + ".jpg"; // Reference to find images for loading into the info drop.
				$(this).append("<img src = '" + imgLoc + "' alt = '" + name + "'>"); // Appends the image.
				var brotherInfo = brothers[i].childNodes;

				for (var j = 0; j < brotherInfo.length; j++)
				{
					if (brotherInfo[j].nodeType === 1) // if nodeType is element
					{
						var itemName = tagNameFormatter(brotherInfo[j].nodeName);

						if (itemName === "full-name")
							$("#bro-info-drop").append("<h4>" + brotherInfo[j].childNodes[0].nodeValue + "</h4>")

						else
							$("#bro-info-drop").append("<p>" + itemName + brotherInfo[j].childNodes[0].nodeValue + "</p>");
					}
				}
				
				$(this).slideDown(400);
			});

			break;
		}
	}
}

function broSorter(sorterListItem){

	var sorterText = sorterListItem.children("p");	// DOM object for the visible text.
	var sorterName = sorterListItem.text().toLowerCase();	// Name of the sorter, defined by it's visible text. Is a string.
	var ascendResults = sorterListItem.hasClass("selected-sorter");
	var siblings = sorterListItem.siblings();
	console.log(ascendResults);

	siblings.removeClass("selected-sorter reverse-sorter");
	siblings.children("p").animate({color: "#3a3a3a"}, 200);

	if (ascendResults){
		sorterText.animate({color: "#b49160"}, 200);
		sorterListItem.addClass("reverse-sorter").removeClass("selected-sorter");

	}
	else{
		sorterText.animate({color: "#c50b33"}, 200);
		sorterListItem.addClass("selected-sorter");
	}

	$("#active-sort").slideUp(200, function(){
			$(this).empty();

			if (ascendResults)
				$(this).append("Currently sorting by " + sorterName + " in ascending order.");
			else
				$(this).append("Currently sorting by " + sorterName + " in descending order.");

			$(this).slideDown(200);
		});
}

$(document).ready(function(){

	var actives_xml = loadXMLDoc("xml/active-bros.xml");

	$(".selected-sorter").children("p").animate({color: "#c50b33"}, 10);

	$("#sort-pointer").hover(function(){
		$(this).animate({color: "#c50b33"}, 200);
	}, function(){
		$(this).animate({color: "#3a3a3a"}, 200)
	});

	$("#sort-pointer").click(function(){
		$("#bro-sorter").animate({backgroundColor: "#e6e6e6"}, 200).delay(1000).animate({backgroundColor: "white"}, 200);
		$("#bro-sorter>p").animate({color: "#c50b33"}, 200).delay(1000).animate({color: "#3a3a3a"}, 200);
	});

	$(".bro-box").hover(function(){

		$(this).animate({backgroundColor: "#e6e6e6"}, 200);
		$(this).children("h4").animate({color: "#c50b33"}, 200);

	}, function(){

		$(this).animate({backgroundColor: "white"}, 200);
		$(this).children("h4").animate({color: "black"}, 200);
	});

	$(".bro-box").click(function(){
		var broName = $(this).attr("id");
		console.log(broName);
		expandBrotherInfo(broName, actives_xml);
	});

	$("#bro-sorter li p").hover(function(){

		if ($(this).parent().hasClass("selected-sorter"))
			$(this).animate({color: "#b49160"}, 200);
		else
			$(this).animate({color: "#c50b33"}, 200);

	}, function(){

		if ($(this).parent().hasClass("selected-sorter"))
			$(this).animate({color: "#c50b33"}, 200);
		else if ($(this).parent().hasClass("reverse-sorter"))
			$(this).animate({color: "#b49160"}, 200);
		else
			$(this).animate({color: "#3a3a3a"}, 200);

	});

	$("#bro-sorter li").click(function(){
		broSorter($(this));
	})


});