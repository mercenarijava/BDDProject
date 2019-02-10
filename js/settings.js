
function deletePaymentType(payment_type_id,email){

	jQuery.ajax({
		url: 'php/deletePaymentType.php',
		type: "POST",
		data: {"payment_type" : payment_type_id,
			"username" : email},
		success: function(data) {
		    var success = data == "s1";
		    window.location.href = "settings.php?payment_type="+payment_type_id+"&email="+email+"&delete=" + (success? "success" : "failed");
		}
	});
}