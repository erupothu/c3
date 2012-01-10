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
	
		<link rel="author" href="<?php echo site_url('humans.txt'); ?>">
		<link rel="canonical" href="<?php echo site_url($this->uri->uri_string()); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('assets/styles/core.css'); ?>">

		<script src="<?php echo $this->uri->skin('assets/scripts/jquery-1.7.1.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/jquery-ui-1.8.16.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/cufon-1.09i.yui.js'); ?>"></script>
		
		<script src="<?php echo $this->uri->skin('assets/scripts/neosans-400.font.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/neosans-500.font.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/neosans-700.font.js'); ?>"></script>
		<script>
		
		$(function() {
			
			// Font Replacement.
			Cufon.replace('h2 > span, a.button', { fontFamily: 'NeoSans-700' });
			Cufon.replace('#secondary li a, h1, h2, .tab, span.title', { fontFamily: 'NeoSans-500', hover: true });
			Cufon.replace('.left-column em', { fontFamily: 'NeoSans-400' });
			
			// News Scroller.
			var scrollSpeed = 200;
			var scrollPane = $('.news-pane');
			var scrollContent = $('.news-content');
			
			$('#news-latest .slider').slider({
				animate: scrollSpeed,
				range: 'min',
				min: 1,
				max: $('#news-latest li').length - 2,
				slide: function(event, ui) {
					
					if(scrollContent.width() > scrollPane.width()) {
						
						scrollContent.animate({ marginLeft: Math.round(
							-(ui.value - 1) * scrollPane.find('li:eq(0)').width()
						) + 'px' },	scrollSpeed);

					}
					else {
						
						scrollContent.css('margin-left', 0);
					}
				}
			});
		});
		
		</script>
	</head>
	<body>
		
		<div id="container">
			
			<header>
				
				<div class="constrain clearfix">
					
					<ul id="primary">
						<?php if($this->auth->is_logged_in()): ?>
						<li class="first-child"><a href="#">Logged in as <span><?php echo $this->session->get('user/data/user_firstname'); ?></span></a></li>
						<li class="highlight"><a href="#">My Account</a></li>
						<li class="highlight"><a href="#">Logout</a></li>
						<?php else: ?>
						<li class="first-child"><a href="#">Login</a></li>
						<li class="highlight no-separator"><a href="#">Register</a></li>
						<?php endif; ?>
						<li class="last-child">
							<ul>
								<li><a href="#">Shopping Cart <span>&nbsp;0 items</span></a></li>
								<li class="highlight"><a href="#">Checkout</a></li>
								<li class="last-child"><a href="#">Credit Application</a></li>	
							</ul>
						</li>
					</ul>
					
					<div id="logo">
						<h1>Anubis</h1>
					</div>
					
					<h2>&quot;<span>Exceeding Expectations</span>&quot;</h2>
					
					<div class="menu-center constrain">
						
						<ul id="secondary">
							<li class="first-child"><a href="/">Home</a></li>
							<li>
								<a href="#">About Us</a>
								<ul class="sub-menu">
									<li><a href="#">Management Team</a></li>
									<li><a href="#">Mission Statement</a></li>
									<li><a href="#">Employment Opportunities</a></li>
								</ul>
							</li>
							<li class="grey"><a href="#"><span>Training &amp; Operations</span></a></li>
							<li class="grey"><a href="#"><span>Special Projects</span></a></li>
							<li><a href="#">News</a></li>
							<li class="last-child">
								<a href="#">Contact Us</a>
								<ul class="sub-menu">
									<li><a href="#">Contact Form</a></li>
									<li><a href="#">Map</a></li>
									<li><a href="#">Company Regulatory Information</a></li>
								</ul>
							</li>
						</ul>
						
					</div>
					
				</div>
				
			</header>
			
			<div id="main" role="main">
				
				<div class="constrain">
					
					