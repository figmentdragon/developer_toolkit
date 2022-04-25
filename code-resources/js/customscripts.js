jQuery(document).ready(function(){

	 jQuery(".menu-button").click(function(){
	    jQuery('body').toggleClass('menu-opened');
			if (jQuery("body").hasClass("menu-opened")) {
			var findInsiders = function(elem) {
					var tabbable = elem.find('select, input, textarea, button, a');

					var firstTabbable = tabbable.first();
					var lastTabbable = tabbable.last();
					/*set focus on first input*/
					firstTabbable.focus();

					/*redirect last tab to first input*/
					lastTabbable.on('keydown', function (e) {
						 if ((e.which === 9 && !e.shiftKey)) {
								 e.preventDefault();
								 firstTabbable.focus();
						 }
					});

					/*redirect first shift+tab to last input*/
					firstTabbable.on('keydown', function (e) {
							if ((e.which === 9 && e.shiftKey)) {
									e.preventDefault();
									lastTabbable.focus();
							}
					});

					/* allow escape key to close insiders div */
					elem.on('keyup', function(e){
						if (e.keyCode === 27 ) {
							elem.hide();
						};
					});
				};
			findInsiders(jQuery('.overlay'));
		};
	 });
});
