$(document).ready(function(){       
   var scroll_start = 0;
   var startchange = $('section');
   var offset = startchange.offset();
	if (startchange.length){
   $(document).scroll(function() { 
	  scroll_start = $(this).scrollTop();
	  if(scroll_start > offset.top) {
		  $("#logo").css('background-color', 'black');
	   } else {
		  $('#logo').css('background-color', 'transparent');
	   }
   });
	}
});