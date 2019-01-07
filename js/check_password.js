
(function($) {

    $('#password, #confirm_password').on('keyup', function () {
	  if ($('#password').val() == $('#confirm_password').val()) {
		$('#message').css('color', 'green');
		$('#submit').removeAttr('disabled');
		$('#confirm_password').css('border-color','');
		if($('#message').hasClass("zmdi-close-circle")){
			$('#message').toggleClass("zmdi-close-circle zmdi-shield-check");
		}
		else{
			$('#message').addClass("zmdi-shield-check");
		}
	  } else{ 
		$('#message').css('color', 'red');
		$('#submit').attr('disabled', 'true');
		$('#confirm_password').css('border-color','red');
		if($('#message').hasClass("zmdi-shield-check")){
			$('#message').toggleClass("zmdi-shield-check zmdi-close-circle");
		}
		else{
			$('#message').addClass("zmdi-close-circle");
		}

	  }
	});
	
})(jQuery);
