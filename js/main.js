var NUM_ELEM_PAGE = 9;

var HOME_URL = "home.php"

//////////////// GET PARAMS /////////////////
var GET_CONSOLE = "console";
var GET_CATEGORY = "category";
var GET_ORDER_PRICE = "orderPrice";
var GET_ORDER_WORDS = "orderWords";

var games_container_view;
var input_search_view;
var button_search_view;

//////////////// RADIO INPUT CONSOLE ////////////////////
var ifSwitch;
var ifXboxOne;
var ifPs4;
var ifPs3;
var ifNintendo;
//////////////// RADIO INPUT CATEGORY ///////////////////
var ifAzione;
var ifGuida;
var ifGuerra;
var ifSimulazione;
var ifSport;
var ifStrategia;
//////////////// RADIO INPUT ORDER PRICE ////////////////
var ifPrezzoCrescente;
var ifPrezzoDecrescente;
//////////////// RADIO INPUT ORDER WORDS ////////////////
var ifAZ;
var ifZA;

var button_load_filter;

var pageStepper;
var viewChartButton;

var chart = new Array();

class filter{
	constructor(offset = 0,
					size = NUM_ELEM_PAGE,
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
    setViews();
	setListeners();
}

function setViews(){
    games_container_view = document.getElementById("cards_container");
    input_search_view = document.getElementById("input_search");
    button_search_view = document.getElementById("btn_search");
    button_load_filter = document.getElementById("b_applica_filtro");

    ifSwitch = document.getElementById("c_pc");
    ifXboxOne = document.getElementById("c_xboxone");
    ifPs4 = document.getElementById("c_ps4");
    ifPs3 = document.getElementById("c_ps3");
    ifNintendo = document.getElementById("c_nintendo");

    ifAzione = document.getElementById("c_action");
    ifGuida = document.getElementById("c_guida");
    ifGuerra = document.getElementById("c_picchiaduro");
    ifSimulazione = document.getElementById("c_simulazione");
    ifSport = document.getElementById("c_sport");
    ifStrategia = document.getElementById("c_strategia");

    ifPrezzoCrescente = document.getElementById("c_prezzo_crescente");
    ifPrezzoDecrescente = document.getElementById("c_prezzo_decrescente");

    ifAZ = document.getElementById("c_AZ");
    ifZA = document.getElementById("c_ZA");

    pageStepper = document.getElementById("pageStepper");
    viewChartButton = document.getElementById("viewChartButton");
}

function setListeners(){
    loadSessionChart();
    input_search_view.oninput = handleSearch;
    button_load_filter.onclick = updateFilter;
    loadFilter(window.location.href);

}

function updateFilter (){
    var url = HOME_URL;

    var fConsole = getFilterConsole();
    var fCategory = getFilterCategory();
    var fOrderPrice = getFilterOrderPrice();
    var fOrderWords = getFilterOrderWords();

    var hasGetParams = fConsole != null ||
        fCategory != null ||
        fOrderPrice != null ||
        fOrderWords != null;


    if(hasGetParams){
        url += "?";
        url += getGetParam(GET_CONSOLE, fConsole);
        url += getGetParam(GET_CATEGORY, fCategory);
        url += getGetParam(GET_ORDER_PRICE, fOrderPrice);
        url += getGetParam(GET_ORDER_WORDS, fOrderWords);
    }

    window.location.href = url + "#shop";
}

function getGetParam(paramName, paramValue){
    if(paramValue != null){
        return paramName + "=" + paramValue + "&";
    }
    return "";
}

function getFilterConsole (){
    if(ifSwitch != null && getRadioValueIfChecked(ifSwitch) != null){
        return getRadioValueIfChecked(ifSwitch);
    }
    if(ifXboxOne != null && getRadioValueIfChecked(ifXboxOne) != null){
        return getRadioValueIfChecked(ifXboxOne);
    }
    if(ifPs4 != null && getRadioValueIfChecked(ifPs4) != null){
        return getRadioValueIfChecked(ifPs4);
    }
    if(ifPs3 != null && getRadioValueIfChecked(ifPs3) != null){
        return getRadioValueIfChecked(ifPs3);
    }
    if(ifNintendo != null && getRadioValueIfChecked(ifNintendo) != null){
        return getRadioValueIfChecked(ifNintendo);
    }
    return null;
}

function getFilterCategory (){
    if(getRadioValueIfChecked(ifAzione) != null){
        return getRadioValueIfChecked(ifAzione);
    }
    if(getRadioValueIfChecked(ifGuida) != null){
        return getRadioValueIfChecked(ifGuida);
    }
    if(getRadioValueIfChecked(ifGuerra) != null){
        return getRadioValueIfChecked(ifGuerra);
    }
    if(getRadioValueIfChecked(ifSimulazione) != null){
        return getRadioValueIfChecked(ifSimulazione);
    }
    if(getRadioValueIfChecked(ifSport) != null){
        return getRadioValueIfChecked(ifSport);
    }
    if(getRadioValueIfChecked(ifStrategia) != null){
        return getRadioValueIfChecked(ifStrategia);
    }
    return null;
}

function getFilterOrderPrice (){
    if(getRadioValueIfChecked(ifPrezzoCrescente) != null){
        return getRadioValueIfChecked(ifPrezzoCrescente);
    }
    if(getRadioValueIfChecked(ifPrezzoDecrescente) != null){
        return getRadioValueIfChecked(ifPrezzoDecrescente);
    }
    return null;
}

function getFilterOrderWords(){
    if(getRadioValueIfChecked(ifAZ) != null){
        return getRadioValueIfChecked(ifAZ);
    }
    if(getRadioValueIfChecked(ifZA) != null){
        return getRadioValueIfChecked(ifZA);
    }
    return null;
}

function getRadioValueIfChecked(radio){
    if(radio.checked == false) return null;
    return radio.value;
}

function loadFilter (url){
    var url = new URL(url);
    var console = url.searchParams.get(GET_CONSOLE);
    var category = url.searchParams.get(GET_CATEGORY);
    var orderPrice = url.searchParams.get(GET_ORDER_PRICE);
    var orderWords = url.searchParams.get(GET_ORDER_WORDS);

    game_filter.console = console;
    game_filter.category = category;
    game_filter.order_name = orderWords;
    game_filter.order_price = orderPrice;

    initCategoryRadio(category);
    initOrderRadio(
        orderPrice == null? null : orderPrice == "true",
        orderWords == null? null : orderWords == "true"
    );

    handleFilterUpload();
}

function initCategoryRadio(category){
    switch (category){
        case "azione":{
            ifAzione.checked = true;
        }break;
        case "guida":{
            ifGuida.checked = true;
        }break;
        case "guerra":{
            ifGuerra.checked = true;
        }break;
        case "simulazione":{
            ifSimulazione.checked = true;
        }break;
        case "sport":{
            ifSport.checked = true;
        }break;
        case "strategia":{
            ifStrategia.checked = true;
        }break;
    }
}

function initOrderRadio(orderPrice, orderWords){
    if(orderPrice != null){
        ifPrezzoCrescente.checked = orderPrice;
        ifPrezzoDecrescente.checked = !orderPrice;
    }

    if(orderWords != null){
        ifAZ.checked = orderWords;
        ifZA.checked = !orderWords;
    }

}

function updateFilerConsole (console){
    game_filter.console = console;
    handleFilterUpload();
}

function handleFilterUpload(){
	if(mustUpdateGames()){
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
			var start_object = data.split("[");
			var jsonData = JSON.parse("[" + start_object[1]);

			clearAllChild(games_container_view);
			buildGamesContainer(jsonData);


			if(mustUpdateGames()){
				clearAllChild(pageStepper);
				buildStepper(Math.ceil(parseInt(start_object[0]) / NUM_ELEM_PAGE), 0);
				copyFilter(game_filter, last_filter);
			}

		}
	});
}

function handleSearch(o){
	var text = input_search.value; //+ String.fromCharCode(keynum);
	game_filter.title = (!text || text === "") ? null : text;
	handleFilterUpload();
}

function buildGamesContainer(games){
	if(games.length == 0){
		games_container_view.innerHTML = "Non ci sono giochi con queste caratteristiche";
		return;
	}

	for(var i = 0; i < games.length; i++){
	    games_container_view.appendChild(buildGameCard(games[i]));
	}
}

function buildGameCard(game){
	var card = document.createElement("DIV");
	card.className = "col-sm restrict";

	var cardHeader = document.createElement("DIV");
	cardHeader.className = "header-content";
	cardHeader.href = "#game";

	card.appendChild(cardHeader);

	var gameCard = document.createElement("DIV");
	gameCard.className = "game-card";

	cardHeader.appendChild(gameCard);

	var gameCardHeader = document.createElement("DIV");
	gameCardHeader.className = "card-head";
	gameCardHeader.style = "background:url("+ game.game_logo +"); background-size: cover;";

	var gameCardBody = document.createElement("DIV");
	gameCardBody.className = "card-body-";

	gameCard.appendChild(gameCardHeader);
	gameCard.appendChild(gameCardBody);

	var gameCardDesc = document.createElement("DIV");
    gameCardDesc.className = "product-desc";

	var gameCardProperties = document.createElement("DIV");
    gameCardProperties.className = "product-properties";

    gameCardBody.appendChild(gameCardDesc);
    gameCardBody.appendChild(gameCardProperties);

    var productTitle = document.createElement("SPAN");
    productTitle.className = "product-title";
    productTitle.innerHTML = game.game_title;

    gameCardDesc.appendChild(productTitle);

    var productCaption = document.createElement("SPAN");
    productCaption.className = "product-caption";
    productCaption.innerHTML = game.game_category;

    gameCardDesc.appendChild(productCaption);
    gameCardDesc.appendChild(buildGameRating());

    var gameConsole = document.createElement("SPAN");
    gameConsole.className = "product-size";

    gameCardProperties.appendChild(gameConsole);

    var gameConsoleTxt = document.createElement("H4");
    gameConsoleTxt.innerHTML = game.console_name;

    gameConsole.appendChild(gameConsoleTxt);

    var gamePrice = document.createElement("BUTTON");
    gamePrice.className ="product-price";
    gamePrice.innerHTML = "€";
    gamePrice.name = JSON.stringify(row);
    gamePrice.onclick = handleBuyGame;

    gameCardProperties.appendChild(gamePrice);

    var gamePriceTxt = document.createElement("B");
    gamePriceTxt.innerHTML = game.game_price;

    gamePrice.appendChild(gamePriceTxt);


    return card;
}

function buildGameRating(){

    var rate = randomIntFromInterval(1, 5);

    var rating = document.createElement("SPAN");
    rating.className = "product-rating";

    for(i = 0; i < 5; i++ ){
        var star = document.createElement("I");
        star.className = i < rate? "fa fa-star" : "fa fa-star grey";
        rating.appendChild(star);
    }

    return rating;
}

function buildStepper(steps, selected){
    for(i = 0; i < steps; i++){
        var item = document.createElement("LI");
        item.className = "page-item" + (i == selected? " active" : "");

        pageStepper.appendChild(item);

        var itemA = document.createElement("A");
        itemA.className = "page-link bckg-page-link";
        itemA.innerHTML = "" + (i + 1);
        itemA.href = "#shop";
        itemA.onclick = function(e){
                clearAllChild(pageStepper);
                buildStepper(steps, parseInt(e.target.innerHTML) - 1);
                game_filter.offset = NUM_ELEM_PAGE * (parseInt(e.target.innerHTML) - 1);
                handleFilterUpload();
        };

        item.appendChild(itemA);
    }
}

function handleBuyGame(e){
    var gameJson = JSON.parse(e.target.name);

    if(isAlreadyInChart(gameJson)){
        return;
    }

    chart.push(gameJson);
    buildChartRow(gameJson);
    updateSessionChart();
}

function buildChartRow(game){
    // TODO
}

function updateSessionChart(){
    // TODO
}

function loadSessionChart(){
    return new Array(); // TODO
}

function isAlreadyInChart(g){
    for(i = 0; i < chart.length ; i++){
        if(chart[i].game_title == g.game_title &&
            chart[i].console_name == g.console_name){
            return true;
        }
    }
    return false;
}

function mustUpdateGames(){
	return game_filter.size != last_filter.size ||
		game_filter.order_price != last_filter.order_price ||
		game_filter.order_name != last_filter.order_name ||
		game_filter.category != last_filter.category ||
		game_filter.console != last_filter.console ||
		game_filter.title != last_filter.title;
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

//////////////////////////////////////////// UI UTILS /////////////////////////////////////
function clearAllChild(node){
    while (node.hasChildNodes()) {
        node.removeChild(node.lastChild);
    }
}

function randomIntFromInterval(min,max){
    return Math.floor(Math.random()*(max-min+1)+min);
}
