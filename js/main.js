jQuery(document).ready(function($){
	
	// Function to check for screen width and implement mobile navigation
	// dropdown.  This will have a menu button created and hidden on DOM load

	$('ul.dropdownz').prepend('<li style="display:none" id="menu"><a href="Javascript:void(0)" >Menu</a></li>');
	var dropdownCounter = 0;
	$('#menu a').click(function(){
		if (dropdownCounter===0) {
			$('ul.dropdownz').animate({
				'height': '247px'
			})
			dropdownCounter++;
		} else {
			$('ul.dropdownz').animate({
				'height': '36px'
			})
			dropdownCounter--;
		}
	})

	function dropdownz () {
		var windowWidth = window.innerWidth;
		if (windowWidth > 486) {
			$('#menu').css({'display': 'none'});
			$('ul.dropdownz').css({'height': 'auto'})
		} else {
			$('#menu').css({'display': 'block'});
			$('ul.dropdownz').css({'height': '36px'});
		}
	}

	// call dropdownz on DOM load and when screen is resized
	dropdownz()
	$(window).resize(function(){
		dropdownz();
	})
})