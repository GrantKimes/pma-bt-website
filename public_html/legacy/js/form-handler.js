function infoTypeFormatter(infoType){

	switch (infoType){

		case "fname":
		case "mname":
		case "lname":
			return "";
		case "hometown":
			return "Hometown: ";
		case "pledge-class":
			return "Pledge Class: ";
		case "major":
			return "Major: ";
		case "minor":
			return "; Minor: ";
		case "grad-date":
			return "Graduation Date: ";
		case "curr-position":
			return "Current Position: ";
		case "past-position":
			return "Previous Position: "
		default:
			return "Error :(";
	}
}

function updateBioPreview(newInfo, infoType){

	if(infoType !== "major" && infoType !== "minor")
		var selector = $("#" + infoType + "-preview");

	else
		var selector = $("#major-preview");

	var infoPrepend = infoTypeFormatter(infoType);
	if (infoType !== "minor")
		selector.empty();
	selector.append(infoPrepend + newInfo);
}

function isSubmitReady(){

var enableSubmit = true;

	if ($("input[type=radio]").is(":checked")){

		$("input.required").each(function(){

			if ($(this).val() == ""){
				console.log("Setting enableSubmit false.")
				enableSubmit = false;
			}
		});

		if (enableSubmit){
				console.log("Enabling submit.")
				$("button[type=submit]").removeAttr("disabled");
		}
	}
}

$(document).ready(function(){

	$("label.help").hide();

	$("input").focus(function(){
		$("label[for=" + $(this).attr("name") + "]").fadeIn(100);
	});
	$("input").blur(function(){		
		$("label.help[for=" + $(this).attr("name") + "]").fadeOut(200);

		if ($(this).val() || !( $("label[for=" + $(this).attr("name") + "]").hasClass("required") )){
			$("label[for=" + $(this).attr("name") + "]").animate({color: "#606060"}, 200);

			if ($(this).val() !== '')
				updateBioPreview($(this).val(), $(this).attr("name"));
			
			isSubmitReady();
		}
	});

	$("input[type=radio]").click(function(){
		$("label[for=" + $(this).attr("name") + "]").animate({color: "#606060"}, 200);
		isSubmitReady();
	});

	$("input[type=file]").change(function(){
		$("label[for='img']").animate({color: "#606060"}, 200);
		isSubmitReady();
	});

});