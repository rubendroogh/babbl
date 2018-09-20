require('./bootstrap');

$( document ).ready(function() {

	var triggered = false;
	$( "#menuToggle" ).click(function( event ) {
		var width = (triggered) ? '0' : '60vw';
		var display = (triggered) ? 'none' : 'initial';
		triggered = !triggered;

	    $( "#mobileMenu" ).css('width', width);
	    $( "#mobileMenu .navbar-nav" ).css('display', display);
	});

});

