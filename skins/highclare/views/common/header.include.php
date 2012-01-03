<!DOCTYPE html>
<html>
	<head>
		<title>Highclare School - Achieving Individual Excellence</title>
		<?php $this->insight->hook('header', 2); ?>
		<link rel="stylesheet" href="<?php echo $this->uri->skin('styles/screen.css'); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('scripts/libs/fancybox-1.3.4/jquery.fancybox-1.3.4.css'); ?>">
		<script src="<?php echo $this->uri->skin('scripts/jquery-1.6.4.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/jquery-easing-1.3.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/libs/fancybox-1.3.4/jquery.fancybox-1.3.4.pack.js'); ?>"></script>
		<script>
		
		$(function() {
			$('.image-lightbox').fancybox({
				'transitionIn'	:	'elastic',
				'transitionOut'	:	'elastic',
				'speedIn'		:	600, 
				'speedOut'		:	200, 
				'overlayShow'	:	true,
				'overlayColor'	: 	'#000000'
			});
		});
		
		</script>
	</head>
	<body>
		
		<div id="header">
			
			<div class="constraint">
				<img src="<?php echo $this->uri->skin('images/highclare-school-logo.jpg'); ?>" alt="">
			</div>
			
		</div>
		
		<div id="nav" class="constraint">
			&nbsp;
		</div>
		
		<div id="main" class="constraint clearfix">
			
			<div class="column-outer">
				
				<div class="column-outer-left">
				
					<img src="http://www.highclareschool.co.uk/images/big-senior-boys.jpg" alt="">
					