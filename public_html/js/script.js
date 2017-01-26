
$(document).ready(function() {


	styleNavbarOnClick();
});


function styleNavbarOnClick() {
	$('.navbar-default .navbar-nav>li>a').on('click', function(e) {
		$('.navbar-default .navbar-nav>li').removeClass('active');
		$(this).parent('li').addClass('active');
	});
}