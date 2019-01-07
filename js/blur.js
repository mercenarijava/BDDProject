/*
	On settings, option payment onclick or mousehover blur the div with credit card info end show,
	button modify end delete.
*/

function blurElements(elemId){
	document.getElementById(elemId).classList.add("info");
}

function notBlurElements(elemId){
	document.getElementById(elemId).classList.remove("info");
}

function show(button1, button2){
	showSingleElem(button1);
	showSingleElem(button2)
}

function hide(button1, button2){
	hideSingleElem(button1);
	hideSingleElem(button2);
}

function showSingleElem(button1){
	document.getElementById(button1).style.display = "block";
}

function hideSingleElem(button1){
	document.getElementById(button1).style.display = "none";
}



/**/
function activeItem(navItem){
	
	document.getElementById("home").classList.remove("active");
	document.getElementById("pc").classList.remove("active");
	document.getElementById("xbox").classList.remove("active");
	document.getElementById("ps4").classList.remove("active");
	document.getElementById("ps3").classList.remove("active");
	document.getElementById("nintendo").classList.remove("active");
	
	document.getElementById(navItem).classList.add("active");
}
