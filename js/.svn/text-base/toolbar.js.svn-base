$(document).ready(function() {

	( function() {
		
		var fadeSpeed = 200, fadeTo = 0.1, topDistance = 30;
		var topbarME = function() { $('#header').fadeTo(fadeSpeed,1); }, topbarML = function() { $('#header').fadeTo(fadeSpeed,fadeTo); };
		var inside = false;

		$(window).scroll(function() {
			
			position = $(window).scrollTop();
			
			if(position > topDistance && !inside) {
				
				topbarML();
				
				$('#header').bind('mouseenter',topbarME);
				$('#header').bind('mouseleave',topbarML);
				
				inside = true;
				
			} else if (position < topDistance){

				topbarME();

				$('#header').unbind('mouseenter',topbarME);
				$('#header').unbind('mouseleave',topbarML);

				inside = false;

			}

		});

	})();

});