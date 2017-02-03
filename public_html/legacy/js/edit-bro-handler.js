// Finds the appropriate span within the edit-bro.php page and edits content within it to reflect user input.
function updateBioPreview(newInfo, infoType){

	if(newInfo == "fall")
		newInfo = "Fall";

	else if(newInfo == "spring")
		newInfo = "Spring";

	$("#" + infoType + "-preview").html(newInfo);
}

// Grabs the user's first and last name from inputs filled by PHP for use in the bio preview.
function updateFirstLastName(){

	var fname = $("input[name=fname]").val();
	var lname = $("input[name=lname]").val();

	$("#fname-preview").html(fname);
	$("#lname-preview").html(lname);
}

$(document).ready(function(){

	updateFirstLastName();

	// For cases where user information is already in xml file or user must resubmit information
	$("input").each(function(){

		updateBioPreview($(this).val(), $(this).attr("name"));
	});
	
	$("input").change(function(){

		updateBioPreview($(this).val(), $(this).attr("name"));
	});

});