var NUM_ELEM_PAGE = 9;

var games_container_view;
var input_search_view;
var button_search_view;

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
}

function setListeners(){
    input_search_view.oninput = handleSearch;
    loadFilter(window.location.href);
}

function loadFilter (url){
    var url = new URL(url);
    var console = url.searchParams.get("console");
    var category = url.searchParams.get("category");
    var orderPrice = url.searchParams.get("orderPrice");
    var orderWords = url.searchParams.get("orderWords");

    game_filter.console = console;
    game_filter.category = category;
    game_filter.order_name = orderWords;
    game_filter.order_price = orderPrice;


    handleFilterUpload();
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
/*
			if(mustUpdateGames()){
				clearAllChild(page_stepper_view); // fixme
				buildStepper(Math.ceil(parseInt(start_object[0]) / NUM_ELEM_PAGE));
				copyFilter(game_filter, last_filter);
			}
			*/
			//$('html, body').animate({scrollTop : 0},500);  fixme
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
