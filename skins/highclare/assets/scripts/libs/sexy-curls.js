/**
 * The Sexy Curls JQuery Plugin
 * By Elliott Kember - http://twitter.com/elliottkember
 * Released under the MIT license (MIT-LICENSE.txt)
 */
(function($){
	
	$.fn.fold = function(options) {
		
		var ie55 = (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion) == 4 && navigator.appVersion.indexOf("MSIE 5.5") != -1);
		var ie6 = (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion) == 4 && navigator.appVersion.indexOf("MSIE 6.0") != -1);
	
		// We just won't show it for IE5.5 and IE6.
		if (ie55 || ie6) {this.remove(); return true;}
		
		options = options || {};
	
		var defaults = {
			directory: '.',
			side: 'left',
			turnImage: 'fold.png',
			maxHeight: 400,
			startingWidth: 80,
			startingHeight: 80,
			autoCurl: false
		};
	
		// Change turnImage if we're running the default image, and they've specified 'right'
		if (options.side == 'right' && !options.turnImage) defaults.turnImage = 'fold-sw.png';
	
		// Merge options with the defaults
		var options = $.extend(defaults, options);
	
		// Set up the wrapper objects
		var turn_hideme = $('<div id="turn_hideme">');
		var turn_wrapper = $('<div id="turn_wrapper">');
		var turn_object = $('<div id="turn_object">');
		var img = $('<img id="turn_fold" src="'+ (options.directory+'/'+options.turnImage) +'">');
	
		turn_object.css({
			width: options.startingWidth, 
			height: options.startingHeight
		});
	
		// CSS considerations for a top-right fold.
		if(options.side == 'right') turn_wrapper.addClass('right');
	
		this.wrap(turn_wrapper).wrap(turn_object).after(img).wrap(turn_hideme);
		this.show();
	
		// Make this clickable.
		img.bind('click', function(e) {
			e.preventDefault();
			location.href = turn_wrapper.find('a:eq(0)').attr('href');
		});
		
		turn_wrapper = $('#turn_wrapper');
		turn_object = $('#turn_object');
		
		if(!options.autoCurl) {
			
			turn_object.resizable({ 
				maxHeight: options.maxHeight, 
				aspectRatio: true,
				handles: options.side == 'left' ? 'se' : 'sw'
			});
			
		} 
		else {
		
			turn_wrapper.hover(
				function() {
					turn_object.stop().animate({
						width: options.maxHeight,
						height: options.maxHeight
					});
				},
				function() {
					turn_object.stop().animate({
						width: options.startingHeight,
						height: options.startingHeight
					});
				}
			);
		}
	};
	
})(jQuery);