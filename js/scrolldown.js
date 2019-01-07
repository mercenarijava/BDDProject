$(document).ready(function() {
	$('.arrow-icon').click(function(event) {scrollToShop()});
	
	$('.bckg-page-link').click(function(event) {scrollToShop()});
	/*$('#pc').click(function(event) {
		if(document.getElementById("home-video").style.display != 'none'){scrollToShop();}
	});*/
	
	
	
	
});

function scrollToShop(){
	event.preventDefault();
	$('html, body').animate({ scrollTop: $('#shop').offset().top	}, 900);
	//                                       |                          |
	//                                       |                          --- duration (milliseconds) 
	//                                       ---- distance from the top
}
