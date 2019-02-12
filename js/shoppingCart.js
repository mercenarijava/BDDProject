window.onload = function(){
    connectViews();
    connectListeners();
}

var subTotalView;
var totalView;

var ordersContainer;
var infoView;
var buyButton;

var chart = new Array();

function connectViews(){
    subTotalView = document.getElementById("subtotal");
    totalView = document.getElementById("total");
    infoView = document.getElementById("info_buy");
    buyButton = document.getElementById("buy");
    ordersContainer = document.getElementById("orders_layout");
}

function connectListeners(){
    chart = loadSessionChart();
    buildUI();

   buyButton.onclick = buyGames;
}

function buyGames (){
    if(chart.length == 0) return;
	jQuery.ajax({
		url: 'php/buy.php',
		type: "POST",
		data: {"games" : JSON.stringify(chart)},
		success: function(data) {
		    if(data == "e1"){
		        // manage payment type not setted
		        alert("Payment type not set");
		        window.location.href = "settings.php";
				return false;
		    }
		    var success = data == "s1";

		    if(success){
                emptyChart();
		    }
		    window.location.href = "buy.php?buy=" + (success? "success" : "failed");
		}
	});
}

function emptyChart(){
    sessionStorage.setItem("chart", JSON.stringify(new Array()));
}

function buildUI(){
    buyButton.disabled = chart.length == 0;
    setSubTotalAndTotal();

    for(i = 0; i < chart.length; i++){
        buildRow(chart[i]);
    }
}

function buildRow(game){
    var div1 = document.createElement("DIV");
    div1.className = "row boder-bottom align-items-center py-5";

    var div2 = document.createElement("DIV");
    div2.className = "col-sm-7";
    div1.appendChild(div2);

    var img = document.createElement("IMG");
    img.src = game.game_logo;
    img.style="height:150px;width:120px";
    img.className = "mr-3";
    div2.appendChild(img);

    var span1 = document.createElement("SPAN");
    span1.className = "font-weight";
    span1.innerHTML = game.game_title+" "+game.console_name;
    div2.appendChild(span1);

    var div3 = document.createElement("DIV");
    div3.className = "col-sm-2 text-right";
    div1.appendChild(div3);

    var input = document.createElement("INPUT");
    input.type ="number";
    input.min = "01";
    input.max = "" + game.game_quantity;
    input.id = "num-game-2";
    input.placeholder = "1";
    input.value = 1;
    input.className = "form-input num-items";
    input.onchange = handlerOnInput;
    input.name = chart.indexOf(game);
    div3.appendChild(input);


    var div4 = document.createElement("DIV");
    div4.className = "col-sm-2 text-right";
    div1.appendChild(div4);

    var price = document.createElement("SPAN");
    price.className = "font-weight";
    price.innerHTML = "" + game.game_price + ",00€";
    div4.appendChild(price);

    var div5 = document.createElement("DIV");
    div5.className = "col-sm-1 text-right";
    div1.appendChild(div5);

    var rowDelete = document.createElement("DIV");
    rowDelete.type = "image/svg+xml";
    rowDelete.data = "icon/delete.svg";
    rowDelete.style="height:25px;width:25px;"
    rowDelete.innerHTML = "X";
    rowDelete.name = JSON.stringify(game);
    rowDelete.onclick = handleRemoveItem;
    div5.appendChild(rowDelete);


    ordersContainer.prepend(div1);
}

function handleRemoveItem(e){
	chart.splice(chart.indexOf(JSON.parse(e.target.name)), 1);
    ordersContainer.removeChild(e.target.parentNode.parentNode);
    setSubTotalAndTotal();
    updateSessionChart();
}

function handlerOnInput(e){
    chart[parseInt(e.target.name)].buyQuantity = e.target.value;
    setSubTotalAndTotal();
}

function setSubTotalAndTotal (){
    var total = 0.00;
    for(i = 0; i < chart.length; i++){
        total += parseInt(chart[i].game_price) * parseInt(chart[i].buyQuantity);
    }
    totalView.innerHTML = total + "€";
    subTotalView.innerHTML = total + "€";
}

function updateSessionChart(){
    sessionStorage.setItem("chart", JSON.stringify(chart));
}

function loadSessionChart(){
    if(sessionStorage.getItem("chart") != null){
        return JSON.parse(sessionStorage.getItem("chart"));
    }
    return new Array();
}