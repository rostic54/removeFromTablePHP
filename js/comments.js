"use strict";


var button = document.querySelector('.btn');
button.onclick = function(){

	event.preventDefault();	
	var form = document.forms.main;
	var elemName = form.elements[0];
	var elemMessag = form.elements[1];

	if( elemName.value.length != 0  && elemMessag.value.length != 0 )
	form.submit();
}
