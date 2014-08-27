/**
 * slider
 * 
 */ 
var rsjqu = jQuery.noConflict();

/* Slider Settings. */


    //alert($abc) ; // alerts 'Some string to translate'

rsjqu(window).load(function() {

	/* bx Slider. */
	var $abc = bxslider.slider_controls;
	alert($abc) ;
	rsjqu('.bxslider').bxSlider({
			controls: $abc
			
		 });	

});