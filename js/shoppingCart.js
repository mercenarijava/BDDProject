window.onload = function(){
    connectViews();
    connectListeners();
}

var subTotalView;
var totalView;

var infoView;
var buyButton;

var chart = new Array();

function connectViews(){
    subTotalView = document.getElementById("subtotal");
    totalView = document.getElementById("total");
    infoView = document.getElementById("info_buy");
    buyButton = document.getElementById("buy");
}

function connectListeners(){
    chart = loadSessionChart();
    buildUI();
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
    infoView.prepend(div1);

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
    span1.innerHTML = game.game_title;
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

    var rowDelete = document.createElement("OBJECT");
    rowDelete.type = "image/svg+xml";
    rowDelete.data = "icon/delete.svg";
    rowDelete.id="delete2";
    rowDelete.style="height:25px;width:25px;"
    rowDelete.innerHTML = "X";
    div5.appendChild(rowDelete);


}

function setSubTotalAndTotal (){
    var total = 0.00;
    for(i = 0; i < chart.length; i++){
        total += parseInt(chart[i].game_price);
    }
    totalView.innerHTML = total + "€";
    subTotalView.innerHTML = total + "€";
}

function loadSessionChart(){
    if(sessionStorage.getItem("chart") != null){
        return JSON.parse(sessionStorage.getItem("chart"));
    }
    return new Array();
}