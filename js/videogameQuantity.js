
function setQuantity(value){
	var videogame_id = value;
	var input_quantity = document.getElementById("quantity");
	input_quantity.min = 1;
	console.log("MIN %d", 1);
	/* jQuery.ajax({
		url: 'php/quantity.php',
		type: "POST",
		data: {"id" : videogame_id,
		success: function(data) {
			document.getElementById("quantity").setAttribute("max", data);
		    return data;
		}
	}}); */
}