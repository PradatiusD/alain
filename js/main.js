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


	// Function to get widget data and pass it to the #events div

	// Get the number of total events
	var allEvents = $('.widget.widget_text.apeventwidget');
	var numEvents = allEvents.length;

	// Cycle through each event and compose the correct html
	// for the events section, and then push it to the APevents array.
	var APevents = [];

	for (var i = 0; i < numEvents; i++) {
		var eventH3 = "<h3>"+ allEvents.eq(i).find('h3').text()+"</h3>";
		var eventH4 = "<h4>"+ allEvents.eq(i).find('h4').text()+"</h4>";
		var eventStrong = "<strong>"+ allEvents.eq(i).find('strong').text()+"</strong>";
		var eventP = "<p>"+ allEvents.eq(i).find('p').text()+"</p>";
		// Now compose the correct html and push to the AP events array
		var EventHTML = "<li><div class='left'>"+eventH3+eventH4+"</div><div class='right'>"+eventStrong+eventP+"</div></li>";
		APevents.push(EventHTML);
	};

	for (var i = 0; i < APevents.length; i++) {
		$("#events").find('ul').append(APevents[i])
	};
})