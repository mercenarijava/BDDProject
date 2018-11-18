var NUM_ELEMS_PAGE = 12;

var i_username;
var i_password;
var b_login_action;
var b_signin_action;
var b_logout_action;
var b_login;
var l_auth_info;

var c_azione;
var c_guida;
var c_picchiaduro;
var c_simulazione;
var c_sport;
var c_strategia;

var c_xboxone;
var c_ps4;
var c_ps3;
var c_nintendo;
var c_switch;

var p_crescente;
var p_decrescente;
var o_az;
var o_za;

var cont_cards;
var b_applica_filtro;

var input_search;
var page_stepper_container;

var carrello_body;
var carrello_price;
var carrello_buy_button;
var carrello_p = 0;

var carrello = new Array();

class filter{
	constructor(offset = 0,
					size = NUM_ELEMS_PAGE,
					order_price = null,
					order_name = null,
					category = null,
					console = null,
					title = null){
		this.offset = offset;
		this.size = size;
		this.order_price = order_price;
		this.order_name = order_name;
		this.category = category;
		this.console = console;
		this.title = title;
	}
}

var game_filter = new filter();
var last_filter = new filter();
last_filter.size = game_filter.size + 1;

window.onload = function (){
	i_username = document.getElementById("i_username");
	i_password = document.getElementById("i_password");
	b_login_action = document.getElementById("btn_accedi"); 
	b_signin_action = document.getElementById("btn_registrati"); 
	b_logout_action = document.getElementById("btn_logout");
	b_login = document.getElementById("b_login");
	l_auth_info = document.getElementById("auth_status");
	c_azione = document.getElementById("c_action");
	c_guida = document.getElementById("c_guida");
	c_picchiaduro = document.getElementById("c_picchiaduro");
	c_simulazione = document.getElementById("c_simulazione");
	c_sport = document.getElementById("c_sport");
	c_strategia = document.getElementById("c_strategia");
	c_xboxone = document.getElementById("c_xboxone");
	c_ps4 = document.getElementById("c_ps4");
	c_ps3 = document.getElementById("c_ps3");
	c_nintendo = document.getElementById("c_nintendo");
	c_switch = document.getElementById("c_switch");
	p_crescente = document.getElementById("c_prezzo_crescente");
	p_decrescente = document.getElementById("c_prezzo_decrescente");
	o_az = document.getElementById("c_AZ");
	o_za = document.getElementById("c_ZA");
	cont_cards = document.getElementById("cards_container");
	b_applica_filtro = document.getElementById("b_applica_filtro");
	input_search = document.getElementById("input_search");
	page_stepper_container = document.getElementById("pageStepper");
	carrello_body = document.getElementById("carrello_body");
	carrello_price = document.getElementById("carrello_price")
	carrello_buy_button = document.getElementById("carrello_buy_button");
	carrello_price.innerHTML = carrello_p + "€"

	setListeners();
}

function setListeners(){
	c_azione.onclick = handleCategoryClick;
	c_guida.onclick = handleCategoryClick;
	c_picchiaduro.onclick = handleCategoryClick;
	c_simulazione.onclick = handleCategoryClick;
	c_sport.onclick = handleCategoryClick;
	c_strategia.onclick = handleCategoryClick;

	c_xboxone.onclick = handleConsoleClick;
	c_ps4.onclick = handleConsoleClick;
	c_ps3.onclick = handleConsoleClick;
	c_nintendo.onclick = handleConsoleClick;
	c_switch.onclick = handleConsoleClick;

	p_crescente.onclick = handlePriceClick;
	p_decrescente.onclick = handlePriceClick;

	o_az.onclick = handleOrderClick;
	o_za.onclick = handleOrderClick;

	b_applica_filtro.onclick = handleFilterUpload;

	input_search.oninput = handleSearch;
	b_login.onclick = login
	b_logout_action.onclick = configureLoggedOut;
	
	carrello_buy_button.onclick = buyProducts;
	handleFilterUpload();
}


function handleFilterUpload(){
	if(mustUpdateStepper()){
		game_filter.offset = 0;
	}
	jQuery.ajax({
		url: 'php/games_request.php',
		type: "GET",
		data: {offset : game_filter.offset,
				size : game_filter.size,
				order_price : game_filter.order_price,
				order_name : game_filter.order_name,
				category : game_filter.category,
				console : game_filter.console,
				title : game_filter.title},
		success: function(data) {
			var objs = data.split("[");
			var jsonData = JSON.parse("[" +objs[1]);
			clearChilds(cont_cards);
			buildContainer(jsonData);
			if(mustUpdateStepper()){
				clearChilds(page_stepper_container);
				buildStepper(Math.ceil(parseInt(objs[0]) / NUM_ELEMS_PAGE));
				copyFilter(game_filter, last_filter);
			}
			$('html, body').animate({scrollTop : 0},500);
		}
	});
}

function buyProducts(){
    if(sessionStorage.getItem("user_logged") == null){
        $('#login_model').modal();
        return;
    }
    sessionStorage.setItem("chart_data", JSON.stringify(carrello));
	location.href = "carrello.html";
}

function login(){
	jQuery.ajax({
		url: 'php/login.php',
		type: "POST",
		data: {username : i_username.value ,
				pass : i_password.value},
		success: function(data) {
			var stateFailed = data == 'false';
			!stateFailed? handleSuccessLogin(JSON.parse(data)) : handleErrorLogin();
		}
	});
}
function handleSuccessLogin(o){
	configureLoggedIn(o);
}

function handleErrorLogin(){
	l_auth_info.innerHTML = "AUTHENTICATION FAILED";
	l_auth_info.style.color = "red";
}
function configureLoggedIn(o){
    sessionStorage.setItem("user_logged", JSON.stringify(o));
	l_auth_info.innerHTML = "User logged:  " + o.username;
	l_auth_info.style.color = "#00FF00";
	b_login_action.style.display = "none";
	b_signin_action.style.display = "none";
	b_logout_action.style.display = "initial";
}
function configureLoggedOut(){
    sessionStorage.remove("user_logged");
	l_auth_info.innerHTML = "";
	l_auth_info.style.color = "#00FF00";
	b_login_action.style.display = "initial";
	b_signin_action.style.display = "initial";
	b_logout_action.style.display = "none";
}


function buildContainer(o){
	if(o.length == 0){
		cont_cards.innerHTML = "Ho trovato 0 elementi con il filtro impostato";
		return;
	}

	var elems = 0;
	var tot = 0;
	var row;
	for(var i = 0; i < o.length; i++){
		if(elems == 0){
			row = buildRow();
		}
		var card = buildCard(o[i]);
		row.appendChild(card);
		if(elems == 2){
			cont_cards.appendChild(row);
			elems = 0;
		}else{
			elems ++;
		}
		tot++;
	}
	if(elems != 0){
		cont_cards.appendChild(row);
	}
}

function buildRow(){
	var row = document.createElement("DIV");
	row.className = "row justify-content-start mt-2";
	var inrow1 = document.createElement("DIV");
	inrow1.className = "col-12";
	var inrow2 = document.createElement("DIV");
	inrow2.className = "card-deck";
	row.appendChild(inrow1);
	inrow1.appendChild(inrow2);
	return row;
}

function buildCard(row){
	var card = document.createElement("DIV");
	card.className = "card";
	var img = document.createElement("IMG");
	img.className = "card-img-top";
	img.setAttribute("src", row.game_logo);
	img.setAttribute("alt", "Card image cap");
	var body = document.createElement("DIV");
	body.className = "card-body";
	var h5 = document.createElement("H5");
	h5.className = "card-title";
	h5.innerHTML = row.game_title;
	var ih5 = document.createElement("I");
	ih5.className = "fas fa-gamepad ml-2";
	h5.append(ih5);
	var p1 = document.createElement("P");
	p1.className = "card-category";
	p1.innerHTML = row.game_category;
	var ip1 = document.createElement("I");
	ip1.className = "fas fa-dice ml-2";
	p1.append(ip1);
	var p2 = document.createElement("P");
	p2.className = "card-money";
	p2.innerHTML = row.game_price;
	var ip2 = document.createElement("I");
	ip2.className = "fas fa-euro-sign mr-2";
	p2.prepend(ip2);

	body.appendChild(h5);
	body.appendChild(p1);
	body.appendChild(p2);
	
	var c_console = document.createElement("DIV");
	c_console.className = getConsoleClass(row.console_model);
	var c_console1 = document.createElement("DIV");
	c_console1.className = "container ml-1";
	var c_console2 = document.createElement("DIV");
	c_console2.className = "fas fa-power-off";
	c_console2.innerHTML = row.console_model;
	
	c_console.append(c_console1);
	c_console1.append(c_console2);
	
	var b = document.createElement("BUTTON");
	b.className = "btn btn-lg";
	b.setAttribute('type', 'button');
	b.innerHTML = "Acquista";
	b.name = JSON.stringify(row);
	
	b.onclick = handleBuyProduct;

	card.appendChild(c_console);
	card.appendChild(img);
	card.appendChild(body);
	card.appendChild(b);

	return card;
}
function getConsoleClass(model){
	if(model == "ps4"){
		return "card-console-ps4";
	}else if(model == "ps3"){
		return "card-console-ps3";
	}else if(model == "xboxone"){
		return "card-console-xboxone";
	}else if(model == "nintendo"){
		return "card-console-nintendo";
	}else if(model == "switch"){
		return "card-console-switch";
	}else{
		return "";
	}
}

function buildStepper(size){
	for(var i = 0; i < size; i++){
		page_stepper_container.appendChild(buildPageItem(i));
	}
}
function buildPageItem(i){
	var li = document.createElement("LI");
	li.className = "page-item";
	
	var a = document.createElement("A");
	a.className = "page-link";
	a.innerHTML = ""+ (i+1);
	a.onclick = handleStepClick;
	
	li.appendChild(a);
	return li;
}

function buildChartRow(elem){
	var tr = document.createElement("TR");
	var th = document.createElement("TH");
	th.setAttribute('scope', 'row');
	var h1 = document.createElement("H1");
	h1.innerHTML = elem.game_title;
	var p = document.createElement("P");
	p.innerHTML = elem.console_model;
	th.appendChild(h1);
	th.appendChild(p);
	tr.appendChild(th);
	
	var td1 = document.createElement("TD");
	td1.className = "text-center";
	var ul = document.createElement("UL");
	ul.className = "pagination pagination-sm";
	
	var span = document.createElement("SPAN");
	span.setAttribute("id", elem.game_id + elem.game_title);
	span.className = "badge badge-primary";
	span.innerHTML = "1";
	
	var li = document.createElement("LI");
	li.name = elem.game_id;
	li.className = "page-item";
	var div = document.createElement("DIV");
	div.name = elem.game_id;
	div.className = "page-link";
	div.innerHTML = "-";
	li.appendChild(div);
	li.onclick = function(e){
		carrello_p -= parseInt(getGameFromChart(e.target.name).game_price);
		$(carrello_price).text(carrello_p + "€");
		if(getGameFromChart(e.target.name).count == 1){
			carrello_body.removeChild(tr);
			carrello.splice(carrello.indexOf(getGameFromChart(e.target.name)), 1);
		}else{
			getGameFromChart(e.target.name).count --;
			$(span).text(getGameFromChart(e.target.name).count);
		}
		if(carrello.length == 0){
			carrello_buy_button.classList.add("disabled");
		}
	};
	
	
	
	var li1 = document.createElement("LI");
	li1.name = elem.game_id;
	li1.className = "page-item";
	var div1 = document.createElement("DIV");
	div1.name = elem.game_id;
	div1.className = "page-link";
	div1.innerHTML="+";
	li1.appendChild(div1);
	li1.onclick = function (e){
		carrello_p += parseInt(getGameFromChart(parseInt(e.target.name)).game_price);
		$(carrello_price).text(carrello_p + "€");
		getGameFromChart(parseInt(e.target.name)).count ++;
		$(span).text(getGameFromChart(parseInt(e.target.name)).count);
	}
	
	ul.appendChild(li);
	ul.appendChild(span);
	ul.appendChild(li1);
	
	td1.appendChild(ul);
	tr.appendChild(td1);
	
	carrello_body.appendChild(tr);
	carrello_p += parseInt(elem.game_price);
	$(carrello_price).text(carrello_p + "€");
	
}


function handleStepClick(o){
	game_filter.offset = (parseInt(o.target.innerHTML)-1) * NUM_ELEMS_PAGE;
	handleFilterUpload();
}

function getElemCountOnPage(elem){
	return document.getElementById(elem.game_id + elem.game_title);
}

function getGameFromChart(id){
	for(i = 0; i < carrello.length; i++){
		if(carrello[i].game_id == id){
			return carrello[i];
		}
	}
	return null;
}

function handleBuyProduct(x){
    carrello_buy_button.classList.remove("disabled");
	var gameJSON = JSON.parse(x.target.name);
	var elemCount = getElemCountOnPage(gameJSON);
	if(elemCount != null){
		getGameFromChart(gameJSON.game_id).count++;
		
		carrello_p += parseInt(getGameFromChart(gameJSON.game_id).game_price);
		$(carrello_price).text(carrello_p + "€");
		$(elemCount).text(parseInt(elemCount.innerHTML) + 1);
	}else{
		gameJSON.count = 1;
		carrello.push(gameJSON);
		buildChartRow(carrello[carrello.length - 1]);
	}
}

////////////////////////////////////// FILTER EVENTS HANDLERS /////////////////////////////////////
function setCheckedCategory(o){
	c_azione.checked = false;
	c_guida.checked = false;
	c_picchiaduro.checked = false;
	c_simulazione.checked = false;
	c_sport.checked = false;
	c_strategia.checked = false;
	o.target.checked = true;
}
function handleCategoryClick(o){
	setCheckedCategory(o);
	game_filter.category = o.target.value;
}

function setCheckedConsole(o){
	c_xboxone.checked = false;
	c_ps4.checked = false;
	c_ps3.checked = false;
	c_nintendo.checked = false;
	c_switch.checked = false;
	o.target.checked = true;
}
function handleConsoleClick(o){
	setCheckedConsole(o);
	game_filter.console = o.target.value;
}

function setCheckedPrice(o){
	p_decrescente.checked = false;
	p_crescente.checked = false;
	o.target.checked = true;
}
function handlePriceClick(o){
	setCheckedPrice(o);
	game_filter.order_price = o.target.value;
}

function setCheckedOrder(o){
	o_az.checked = false;
	o_za.checked = false;
	o.target.checked = true;
}
function handleOrderClick(o){
	setCheckedOrder(o);
	game_filter.order_name = o.target.value;
}

function handleSearch(o){
	var text = input_search.value; //+ String.fromCharCode(keynum);
	game_filter.title = (!text || text === "") ? null : text;
	handleFilterUpload();
}

function copyFilter(s,o){
	o.offset = s.offset;
	o.size = s.size;
	o.order_price = s.order_price;
	o.order_name = s.order_name;
	o.category = s.category;
	o.console = s.console;
	o.title = s.title;
}
function mustUpdateStepper(){
	return game_filter.size != last_filter.size ||
		game_filter.order_price != last_filter.order_price ||
		game_filter.order_name != last_filter.order_name ||
		game_filter.category != last_filter.category ||
		game_filter.console != last_filter.console ||
		game_filter.title != last_filter.title;
}

//////////////////////////////////////////// UI UTILS /////////////////////////////////////
function clearChilds(node){
	while (node.hasChildNodes()) {
		node.removeChild(node.lastChild);
	}
}