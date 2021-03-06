<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title>Anubis</title>
		<meta name="description" content="">
		<meta name="author" content="">
	
		<!-- Mobile viewport optimized: j.mp/bplateviewport -->
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta http-equiv="imagetoolbar" content="false">
	
		<!-- Facebook: Open Graph -->
		<meta property="og:title" content="">
		<meta property="og:description" content="">
		<meta property="og:image" content="">
		
		<meta name="robots" content="noindex, nofollow">
		
		<link rel="author" href="<?php echo site_url('humans.txt'); ?>">
		<link rel="canonical" href="<?php echo site_url($this->uri->uri_string()); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('assets/styles/core.css'); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('assets/styles/page.css'); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('assets/styles/fancybox.css'); ?>">
		
		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<script src="<?php echo $this->uri->skin('assets/scripts/jquery-1.7.1.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/jquery-ui-1.8.16.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/jquery.mousewheel-3.0.6.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/jquery.fancybox-2.0.4.pack.js'); ?>"></script>
		
		<script src="<?php echo $this->uri->skin('assets/scripts/cufon-1.09i.yui.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/neosans-400.font.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/neosans-500.font.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/neosans-700.font.js'); ?>"></script>
		
		<script>
		
		$(function() {
			
			// Font Replacement.
			Cufon.replace('h2 > span, a.button', { fontFamily: 'NeoSans-700' });
			Cufon.replace('#secondary li a, h1, h2:not(header h2), .tab, span.title, #cart th', { fontFamily: 'NeoSans-500', hover: true });
			Cufon.replace('.left-column em', { fontFamily: 'NeoSans-400' });
			
			
			// Trigger forms.
			$('form .submit').click(function(e) {
				$(this).parents('form').submit();
				e.preventDefault();
			});
			
			
			// News Scroller.
			var scrollSpeed = 200;
			//var scrollPane = $('.news-pane');
			//var scrollContent = $('.news-content');
			
			var scrollSlider = $('.slider').slider({
				animate: scrollSpeed,
				range: 'min',
				min: 1,
				slide: function(event, ui) {
					
					// Find Slider Parent.
					slideParent = $(this).parent();
					slideContent = slideParent.find('.slide-content');
					slidePane = slideParent.find('.slide-pane');
					
					if(slideContent.width() > slidePane.width()) {
						
						slideContent.animate({ marginLeft: Math.round(
							-(ui.value - 1) * slidePane.find('li:eq(0)').width()
						) + 'px' },	scrollSpeed);
						
					}
					else {
						
						slideContent.css('margin-left', 0);
					}
				},
				create: function(event, ui) {
					
					$w = 0;
					slideParent	= $(this).parent();
					slideParent.find('.slide-content li').each(function() {
						$w += $(this).width();
					});
					
					// Work out number of visible items.
					slideVisible = Math.round(slideParent.find('.slide-pane').width() / slideParent.find('.slide-content li:eq(0)').width());
					
					// Set the maximum.
					$(this).slider('option', 'max', slideParent.find('.slide-content li').length - (slideVisible - 1));
					
					// Set the scroller to the correct width.
					slideParent.find('.slide-content').css({ width: $w + 'px' });
					
					if(slideParent.find('.slide-content li').length <= slideVisible) {
						$(this).slider('destroy');
					}
				}
			});
			
			$('.lightbox').fancybox({
				padding: 12,
				wrapCSS: 'zoom',
				openEffect: 'elastic',
				openSpeed: 'fast',
				closeBtn: false,
				closeClick: true
			});
			
		});
		
		</script>
	</head>
	<body>
		
		<div id="container">
			
			<header>
				
				<div id="header" class="constrain clearfix">
					
					<ul id="primary">
						<?php if($this->user->authenticated() && $this->user->can('do stuff')): ?>
						<li class="first-child"><a href="/account">Logged in as <span><?php echo $this->user->name(); ?></span></a></li>
						<li class="highlight"><a href="/account">My Account</a></li>
						<li class="highlight no-separator"><a href="/account/log-out">Logout</a></li>
						<?php else: ?>
						<li class="first-child"><a href="/account/log-in">Login</a></li>
						<li class="highlight no-separator"><a href="/account/register">Register</a></li>
						<?php endif; ?>
						<li class="last-child">
							<ul>
								<li><a href="/cart">Shopping Cart <span>&nbsp;<?php echo Modules::run('cart/meta', 'size'); ?></span></a></li>
								<li class="highlight"><a href="/cart/checkout">Checkout</a></li>
								<li class="last-child"><a href="/account/credit-application">Credit Application</a></li>	
							</ul>
						</li>
					</ul>
					
					<div id="logo">
						<h1>Anubis</h1>
					</div>
					
					<h2>&quot;<span>Exceeding Expectations</span>&quot;</h2>
					
					<span class="date">
						<?php echo sprintf('%s %s %s', strtoupper(date('l')), date('jS'), strtoupper(date('F'))); ?>
					</span>
					
					<div class="menu-center constrain">
						
						<ul id="secondary">
							<li class="first-child<?php echo !$this->uri->segment(1) ? ' selected' : ''; ?>"><a href="/">Home</a></li>
							<li<?php echo $this->uri->segment(1) == 'about-us' ? ' class="selected"' : ''; ?>>
								<a href="/about-us">About Us</a>
								<ul class="sub-menu">
									<li><a href="/about-us/management-team">Management Team</a></li>
									<li><a href="/about-us/mission-statement">Mission Statement</a></li>
									<li><a href="/about-us/employment-opportunities">Employment Opportunities</a></li>
								</ul>
							</li>
							<li class="grey<?php echo $this->uri->segment(1) == 'training-and-operations' ? ' selected' : ''; ?>"><a href="/training-and-operations"><span>Training &amp; Operations</span></a></li>
							<li class="grey<?php echo $this->uri->segment(1) == 'special-projects' ? ' selected' : ''; ?>"><a href="/special-projects"><span>Special Projects</span></a></li>
							<li<?php echo $this->uri->segment(1) == 'news' ? ' class="selected"' : ''; ?>><a href="/news">News</a></li>
							<li class="last-child<?php echo $this->uri->segment(1) == 'contact-us' ? ' selected' : ''; ?>">
								<a href="/contact-us">Contact Us</a>
								<ul class="sub-menu">
									<li><a href="/contact-us/contact-form">Contact Form</a></li>
									<li><a href="/contact-us/map">Map</a></li>
									<li><a href="/contact-us/company-regulatory-information">Company Regulatory Information</a></li>
								</ul>
							</li>
						</ul>
												
					</div>
					
				</div>
				
			</header>
			
			<div id="main" role="main">
				
				<div class="constrain">
					
					