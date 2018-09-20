require('./bootstrap');

$( document ).ready(function() {

	var triggered = false;
	$( "#menuToggle" ).click(function( event ) {
		var val = (triggered) ? '-60vw' : '0';
		triggered = !triggered;

	    $( "#mobileMenu" ).css('right', val);
	});

});

