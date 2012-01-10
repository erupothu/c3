<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="author" content="Creative Insight">
		<title>Administration</title>
		<link rel="canonical" href="<?php echo site_url(); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('styles/core.css'); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('scripts/libs/jcrop-0.9.9/jquery.jcrop-0.9.9.css'); ?>" />
		<link rel="stylesheet" href="<?php echo $this->uri->skin('scripts/libs/fileuploader-1.0.0/fileuploader-1.0.0.css'); ?>" />
		<link rel="stylesheet" href="<?php echo $this->uri->skin('scripts/libs/fancybox-1.3.4/jquery.fancybox-1.3.4.css'); ?>" />
		<script src="<?php echo $this->uri->skin('scripts/modernizr-2.0.6.min.js'); ?>"></script>
	</head>
	<body>
		
		<div id="admin">
			
			<div id="header">
				
				<div class="constrain">
				
					<h1>Administration</h1>
					
					<h6>Logged in as <span><?php echo $this->session->get('user/data/user_firstname'); ?></span></h6>
					
					<ul id="menu-admin" class="clearfix">
						<li<?php echo $this->router->fetch_class() == 'main' ? ' class="selected"' : ''; ?>><?php echo anchor('admin', 'Home'); ?></li>
						<?php foreach($this->insight->modules() as $module_name => $module_title): ?>
						<li<?php echo $this->router->fetch_module() == $module_name ? ' class="selected"' : ''; ?>><?php echo anchor('admin/' . $module_name, $module_title); ?></li>
						<?php endforeach; ?>
						<?php /*
						
						<li<?php echo $this->router->fetch_class() == 'page' ? ' class="selected"' : ''; ?>><?php echo anchor('admin/page', 'Pages'); ?></li>
						<li<?php echo $this->router->fetch_class() == 'settings' ? ' class="selected"' : ''; ?>><?php echo anchor('admin/settings', 'Settings'); ?></li>
						*/
						?>
						<li class="right-child last-child"><?php echo anchor('admin/logout', 'Log Out'); ?></li>
					</ul>
				</div>
				
			</div>
			
			<div id="main">
				
				<div class="constrain">
			
					<?php if(false !== $this->session->flashdata('admin/message', false)): ?>
					<div class="flash-message">
						<?php echo $this->session->flashdata('admin/message'); ?>
						<a class="flash-close" href="javascript:;">x</a>
					</div>
					<?php endif; ?>
				
