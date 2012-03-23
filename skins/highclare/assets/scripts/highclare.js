/* Highclare */
Cufon.replace('.swiss-th, .page-content h1', { fontFamily: 'Swis721 Th BT' });
Cufon.replace('.swiss-lt, .box h2, .title, #slider a', { fontFamily: 'Swis721 Lt BT', hover: true });
Cufon.replace('.swiss-md, .page-content h1 strong', { fontFamily: 'Swis721 Md BT' })
Cufon.replace('.swiss-bd, .page-content h2', { fontFamily: 'Swis721 Bd BT' })

$(function() {
	
	// Make Logo behave.
	$('#logo').hover(function() {
		$(this).css({ cursor: 'pointer' });
	}).click(function() {
		window.location = '/';
	});
	
	
	// User-Friendly Search
	$('.search-box').focus(function() {
		if($(this).val() == 'Search') {
			$(this).val('');
		}
	}).blur(function() {
		if($(this).val() == '') {
			$(this).val('Search');
		}
	});
	
	$('#quicklink').change(function(event) {
		window.location = $(this).val();
		return event.preventDefault();
	});
	
	
	// Lightboxing
	$('a.image-lightbox').fancybox({
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		'speedIn'		: 600, 
		'speedOut'		: 200, 
		'overlayShow'	: true,
		'overlayColor'	: '#000000'
	});
	
	
	// Menu
	$('header nav > ul li').hover(function() {
		$(this).has('ul').addClass('selected');
	}, function() {
		$(this).removeClass('selected');
	});
	
	
	// Slider
	$('#gallery').nivoSlider({
		effect: 'random',
		slices: 15,
		boxCols: 8,
		boxRows: 4,
		animSpeed: 1000,
		pauseTime: 4000,
		startSlide: 0,
		directionNav: false,
		directionNavHide: true,
		controlNav: false,
		controlNavThumbs: false,
		controlNavThumbsFromRel: false,
		controlNavThumbsSearch: '.jpg',
		controlNavThumbsReplace: '_thumb.jpg',
		keyboardNav: false,
		pauseOnHover: true,
		manualAdvance: false,
		captionOpacity: 0.8,
		prevText: 'Prev',
		nextText: 'Next',
		randomStart: false,
		beforeChange: function() {
			
			// Slider disappears
			$('#slider ul').stop().animate({ left: '-284px' }, 250);
		},
		afterChange: function() {
			
			// Slider re-appears
			$('#slider ul').stop().animate({ left: 0 }, 250);
			nivoSliderSetTab();
		}
	});
	
	nivoSliderSetTab = function() {
		$('#slider ul').attr('class', $($('#gallery').data('nivo:vars').currentImage[0]).data('tab'));
	}
	
	
	// Page Curl (Prospectus)
	$('#prospectus').fold({
		side: 'right',
		directory: '/skins/highclare/assets/images',
		turnImage: 'fold.png',
		maxHeight: 140,
		startingWidth: 80,
		startingHeight: 80,
		autoCurl: true
	});
	
	pageCurlWaggle = function() {
		obj = $('#turn_object');
		obj.animate({ width: 100, height: 100 }, 1500, 'easeOutCubic').delay(500).animate({ width: 80, height: 80 }, 750, 'easeInCubic', function() {
			pageCurlWaggle();
		});
	}
	
	$('#turn_object').hover(function() {
		$(this).stop(true, true);
	});
	
	pageCurlWaggle();
	nivoSliderSetTab();
});