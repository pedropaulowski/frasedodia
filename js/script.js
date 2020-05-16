function numeroAleatorio() {
	const number = Math.floor(Math.random() * 100 + 1);
	var id = document.querySelector('#numero');
	id.setAttribute('value', number);
}

function clicou() {
	var button = document.querySelector('button');
	button.setAttribute('class', 'click');
	setTimeout(desclique, 500);
}

function desclique() {
	var button = document.querySelector('button');
	button.removeAttribute('class', 'click');
}

function clickfolha() {
	var div = document.querySelector('.div');
	div.setAttribute('class', 'clickfolha');
	setTimeout(desclickfolha, 300);
}

function desclickfolha() {
	var div = document.querySelector('.clickfolha');
	div.removeAttribute('class', 'clickfolha');
	div.setAttribute('class', 'div');

}

$(function(){
	$('#form').bind('submit', function(e){
		e.preventDefault();
		numeroAleatorio();

		var txt = $(this).serialize();

		//enviar para o arquivo php

		$.ajax({
			type: 'GET',
			url: 'ajax.php',
			data: txt,
			dataType:'json',
			success:function(json){
				$('.div').html(json.frase);
			}, 
			error:function(e) {
				console.log(e)
			}
		});
	});
	
});