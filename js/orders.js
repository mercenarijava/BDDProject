
function filterOrders() {
	// Declare variables
	var input, filter, orders, data, username, id;
	input = document.getElementById("orderSearch");
	filter = input.value.toUpperCase();
	orders = document.getElementsByClassName('order');

	// Loop through all list items, and hide those who don't match the search query
	for (i = 0; i < orders.length; i++) {
		date = orders[i].getElementsByTagName('span')[0];
		username = orders[i].getElementsByTagName('span')[1];
		id = orders[i].getElementsByTagName('span')[2];

		if ( id.innerHTML.toUpperCase().indexOf(filter) > -1 || username.innerHTML.toUpperCase().indexOf(filter) > -1 || date.innerHTML.toUpperCase().indexOf(filter) > -1) {
			orders[i].style.display = "";
		} else {
			orders[i].style.display = "none";
		}
	}
}

function filterVideogames() {
	// Declare variables
	var input, filter, table, contets, id, title, console, price, quantity;
	input = document.getElementById("videogameSearch");
	filter = input.value.toUpperCase();
	table = document.getElementById('videogameTable');
	contets = table.getElementsByTagName('tr');
	
	// Loop through all list items, and hide those who don't match the search query
	for (i = 1; i < contets.length; i++) {
		id = contets[i].getElementsByTagName("td")[0];
		title = contets[i].getElementsByTagName("td")[2];
		console = contets[i].getElementsByTagName("td")[3];
		price = contets[i].getElementsByTagName("td")[4];
		quantity = contets[i].getElementsByTagName("td")[5];
		
		if ( id.innerHTML.toUpperCase().indexOf(filter) > -1 || title.innerHTML.toUpperCase().indexOf(filter) > -1 || console.innerHTML.toUpperCase().indexOf(filter) > -1 || price.innerHTML.toUpperCase().indexOf(filter) > -1 || quantity.innerHTML.toUpperCase().indexOf(filter) > -1) {
			contets[i].style.display = "";
		} else {
			contets[i].style.display = "none";
		}
	}
}

function deleteOrders(order_id){
	jQuery.ajax({
		url: 'php/deleteOrders.php',
		type: "POST",
		data: {"id" : order_id},
		success: function(data) {
		    var success = data == "s1";
		    window.location.href = "orders.php?delete=" + (success? "success" : "failed");
		}
	});
}

function deleteContent(videogame_id, orderId, v_quantity){
	jQuery.ajax({
		url: 'php/deleteContent.php',
		type: "POST",
		data: {"id_videogame" : videogame_id,
				"id_order" : orderId,
		"quantity": v_quantity},
		success: function(data) {
		    var success = data == "s1";
		    window.location.href = "modifyOrder.php?orderId="+orderId+"&quantity="+v_quantity+"&delete=" + (success? "success" : "failed");
		}
	});
}