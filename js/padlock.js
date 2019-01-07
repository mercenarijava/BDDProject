
/**
	Disable and enable input
*/
function padlock($padlock, $input){
	if(document.getElementById($input).readOnly == true){
		document.getElementById($padlock).classList.remove('zmdi-lock-outline');
		document.getElementById($padlock).classList.add('zmdi-lock-open');
		document.getElementById($input).readOnly = false;
		document.getElementById($input).style.backgroundColor = "#fff";
	}
	else{
		document.getElementById($padlock).classList.remove('zmdi-lock-open');
		document.getElementById($padlock).classList.add('zmdi-lock-outline');
		document.getElementById($input).readOnly = true;
		document.getElementById($input).style.backgroundColor = "#ebebe4";
	}
}

function enableInput($input){
	document.getElementById($input).removeAttribute('disabled');
}
