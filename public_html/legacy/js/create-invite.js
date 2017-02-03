$(document).ready(function(){

	$("#invite-box").hide();

	$("input").click(function(){

		$.ajax({
	        type:"post",
	        url:"php/generate-ajax-invite.php",
	        data:"type=" + $(this).val(),
	        success:function(url){
	        	
	        	$("#invite-box").slideUp(200, function(){
	        		$(this).empty();
	        		$(this).append(url);
	        		$(this).slideDown(200);
	        	});
	        }
	    });
	});

});