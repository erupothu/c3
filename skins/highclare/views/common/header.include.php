<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Highclare School - Achieving Individual Excellence</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		<meta name="generator" content="C3">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('assets/styles/screen.css'); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('assets/styles/page.css'); ?>">
		<style>
		
		html, body {
			height: 100%;
		}
		
		body {
			color: #010101;
			font: normal 15px/20px 'Arial', sans-serif;
			background: #fff url(<?php echo $this->uri->skin('assets/images/bg.body.png'); ?>) no-repeat top left;
		}
		
		#highclare {
			min-height: 100%;
			height: auto !important;
			height: 100%;
			margin: 0 auto -369px;
		}
		
		.constrain {
			width: 930px;
			margin-left: auto;
			margin-right: auto;
		}
		
		a {
			color: #991a2e;
			text-decoration: underline;
		}
		
		ul {
			list-style: none;
			margin: 0;
			padding: 0;
		}
		
		header {
			
		}
			
			header nav {
				margin: 21px 0 13px;
				height: 41px;
				background: #a1a2a3;
			}
			
			header nav > ul {
				margin-left: 6px;
			}
			
			header nav > ul > li {
				float: left;
				background: url(<?php echo $this->uri->skin('assets/images/header.separator.png'); ?>) no-repeat center right;
			}
			
			header nav > ul > li a {
				display: block;
				line-height: 41px;
				color: #ffffff;
				text-decoration: none;
				padding-left: 7px;
				padding-right: 10px;
				font-size: 14px;
			}
			
			header nav > ul li a:hover {
				color: #fff;
				text-decoration: underline;
			}
			
			header nav > ul li.age-group > a {
				
				color: #ffffff;
				background: #96192e;
				
				margin-left: 2px;
				margin-right: 2px;
				
				height: 44px;
				line-height: 46px;
				text-align: center;
				
				position: relative;
				bottom: 3px;
				
				white-space: nowrap;
				
				border-radius: 6px 6px 0 0;
				-moz-border-radius: 6px 6px 0 0;
				-webkit-border-radius: 6px 6px 0 0;
				
				padding-left: 5px;
				padding-right: 5px;
			}
			
			header nav > ul > li.selected {
				position: relative;
				bottom: 3px;
			}
			
			header nav > ul li.selected.age-group > a {
				bottom: 0px;
			}
			
			header nav > ul > li.selected > a,
			header nav > ul > li > a:hover {
				color: #991a2e;
				text-decoration: none;
				background: #ffbc00;
				height: 44px;
				line-height: 46px;
				
				border-radius: 6px 6px 0 0;
				-moz-border-radius: 6px 6px 0 0;
				-webkit-border-radius: 6px 6px 0 0;
			}
			
			header nav > ul li.two-lines > a {
				white-space: normal;
				max-width: 85px;
				line-height: 16px;
				padding-top: 6px;
				height: 38px;
			}
			
			header nav > ul li.last-child, nav li.no-separator, header nav > ul li.age-group {
				background-image: none;
			}
			
			header nav > ul > li > ul {
				display: none;
				position: absolute;
				width: 180px;
				background: #ffbc00;
				border-radius: 0 6px 6px 6px;
				z-index: 101;
			}
			
			header nav > ul > li.age-group > ul {
				margin-left: 2px;
			}
			
			header nav > ul > li.last-child > ul,
			header nav > ul > li.flip-menu > ul {
				display: none;
				position: absolute !important;
				width: 180px;
				z-index: 100;
				background: #ffbc00;
				border-radius: 6px 0 6px 6px;
				right: 0;
				text-align: right;
			}
			
			header nav > ul > li.selected > ul {
				display: block;
			}
			
			header nav > ul > li.selected.first-child > ul {
				border-radius: 0 0 6px 6px;
			}
			
			header nav > ul > li > ul > li {
				position: relative;
			}
			
			header nav > ul > li > ul li.last-child a {
				border: 0;
			}
			
			header nav > ul > li > ul > li a {
				color: #000;
				border-bottom: solid 1px #991a2e;
				padding: 0;
				line-height: 36px;
				margin: 0 10px;
			}
			
			header nav > ul > li > ul > li > a {
				z-index: 102;
				background: #ffbc00;
				position: relative;
			}
			
			header nav > ul > li > ul > li.selected a, header nav > ul > li > ul > li a:hover {
				color: #991a2e;
				text-decoration: none;
			}
			
			/* 3 deep */
			header nav > ul > li > ul > li ul {
				position: absolute;
				top: 0;
				width: 180px;
				background: #ffbc00;
				border-radius: 0 6px 6px 0;
				-moz-border-radius: 0 6px 6px 0;
				-webkit-border-radius: 0 6px 6px 0;
				z-index: 100;
			}
			
			header nav > ul > li > ul > li.selected ul {
				display: block;
				right: -180px;
			}
			
			header nav > ul > li > ul > li.selected ul li {
			}
			
			
			
			#subnav {
				position: absolute;
				top: 80px;
				right: 0;
			}
			
			#subnav li {
				float: left;
				background: url(<?php echo $this->uri->skin('assets/images/header.sub.separator.png'); ?>) no-repeat right center;
				padding: 0 10px 0 8px;
			}
			
			#subnav li.last-child {
				background: none;
				padding-right: 0;
			}
			
			#subnav li a {
				color: #838383;
				text-decoration: none;
			}
			
			#subnav li a:hover {
				color: #111;
				text-decoration: underline;
			}
			
			
			#logo {
				width: 415px;
				height: 102px;
				display: block;
				background: url(<?php echo $this->uri->skin('assets/images/logo.png'); ?>) no-repeat top left;
				text-indent: -9001em;
			}
			
			
			header #slider {
				display: block;
				width: 930px;
				height: 304px;
				position: relative;
				overflow: hidden;
				background: #e7e8e9;
			}
			
			header #slider ul {
				width: 284px;
				height: 304px;
				position: absolute;
				top: 0;
				left: 0;
				display: block;
				background: url(<?php echo $this->uri->skin('assets/images/header.map.png'); ?>) no-repeat top left;
				z-index: 99;
			}
			
			header #slider ul.item-1 {
				background-position: 0 0;
			}
			
			header #slider ul.item-2 {
				background-position: -284px 0;
			}
			
			header #slider ul.item-3 {
				background-position: -568px 0;
			}
			
			header #slider ul.item-4 {
				background-position: -852px 0;
			}
			
			header #slider ul.item-5 {
				background-position: -1136px 0;
			}
			
			header #slider ul li a {
				display: block;
				color: #ffffff;
				height: 58px;
				line-height: 56px;
				margin-bottom: 3px;
				font-size: 1.65em;
				padding-left: 0.5em;
				text-decoration: none;
				
				letter-spacing: 0px;
			}
			
			header #slider ul li a:hover {
				color: #ffbc00;
			}
			
			header #slider #gallery {
				height: 304px;
				width: 930px !important;
			}
		
		
		#main {
			
		}
		
		#main .left {
			width: 600px; /* 620 */
			float: left;
		}
		
			/* Breadcrumb */
			.breadcrumb ul {
				
			}
			
			.breadcrumb ul li {
				float: left;
				margin-right: 10px;
			}
			
			.breadcrumb ul li a {
				
			}
		
		
		
		
		#main .right {
			width: 322px;
			float: right;
			padding: 10px 0 0 0;
			margin-top: -104px;
			z-index: 99;
			position: relative;
			background: #fff;
		}
		
		.boxes {
			background: #fff;
			border: solid 1px #000;
			margin-bottom: 0;
			margin-bottom: -129px;
			position: relative;
			z-index: 2;
		}
		
			.boxes > .box {
				float: left;
				z-index: 3;
			}
			
			.box {
				font-size: 13px;
				line-height: 17px;
				background: #fff;
				margin: 10px 0;
			}
			
			.box .pad {
				margin: 0 10px;
				width: 289px;
				height: 240px;
			}
			
			.box a {
				font-weight: bold;
				text-decoration: none;
			}
			
			.box h2 {
				display: block;
				color: #ffffff;
				font-size: 20px;
				height: 34px;
				line-height: 34px;
				font-weight: normal;
				border-style: solid;
				border-color: #ffffff;
				border-width: 0 0 6px;
				margin: 0;
				padding: 0 0.5em;
				
				position: relative;
			}
			
			.box h2 small {
				font-size: 11px;
				display: block;
				position: absolute;
				bottom: 0.5em;
				right: 0.5em;
				line-height: normal;
			}
			
			.box h2 small a {
				color: #ffffff;
				text-decoration: underline;
			}
			
			.cufon-active .box h2 {
				line-height: 32px;
			}
			
			
			.box p {
				padding: 10px;
				background: #ffffff;
				margin: 0 0 10px;
			}
			
			.ask-a-question .pad {
				background: #c7ae97;
			}
			
			.ask-a-question a {
				color: #c7ae97;
			}
			
			.hipe .pad {
				background: #991a2e;
			}
			
			.hipe a {
				color: #991a2e;
			}
			
			.ofsted .pad {
				background: #41ad49;
			}
			
			.ofsted a {
				color: #41ad49;
			}
			
			.ask-a-question, .hipe {
				border-right: solid 1px #000000;
			}
			
			
			
			
			.right > .box {
				margin: 0 0 10px 10px;
				border-style: solid;
				border-width: 1px;
				width: 310px;
			}
			
			.right > .box .pad {
				margin: 10px;
				height: auto;
				
				padding-bottom: 8px;
			}
			
			.right > .box .pad p:last-child, .news-container article:last-child {
				margin-bottom: 0;
			}
			
			.news-container {
				background: #ffffff;
				padding: 0 0.5em;
			}
			
			.admissions {
				border-color: #8043a0;
			}
			
			.admissions .pad {
				background: #8043a0;
			}
			
			.news {
				border-color: #ac3139;
			}
			
			.news .pad {
				background: #ac3139;
			}
			
			.diary {
				border-color: #c7ae97;
			}
			
			.diary .pad {
				background: #c7ae97;
			}
			
			
			.news-article {
			}
			
			.news-article h1 {
				margin: 0 0 0.5em 0;
				font-size: 1.1em;
			}
			
			.news-article .excerpt {
				padding-bottom: 1.0em;
			}
			
			
			
			
			
		
		footer, .shove {
			height: 369px;
		}
		
		footer {
			z-index: 1;
			background: #991a2e;
			position: relative;
		}
		
		footer ul a {
			color: #fff;
		}
		
		
		footer .column {
			float: left;
			padding-top: 150px;
			width: 310px;
		}
		
		footer .column.right .pinch {
			width: 240px;
			float: right;
		}
		
		footer ul {
			font-size: 14px;
			line-height: 18px;
		}
		
		footer .column.left ul {
			float: left;
			margin-right: 3.0em;
		}
		
		footer .column.left ul.last-child {
			margin-right: 0;
		}
		
		footer .column.left ul li {
			padding-bottom: 2px;
		}
		
		footer .column.left ul a {
			text-decoration: none;
		}
		
		footer .column.left ul a:hover {
			color: #ffffff;
			text-decoration: underline;
		}
		
			
			/* Footer > Social Links */
			#social {
				display: block;
				clear: both;
			}
			
			#social li { 
				float: left;
				margin-left: 20px;
			}
			
			#social li.first-child {
				margin: 0;
			}
			
			#social li a {
				display: block;
				text-indent: -9999em;
				line-height: 45px;
				width: 45px;
				height: 45px;
				background-image: url(<?php echo $this->uri->skin('assets/images/spritemap.png'); ?>); 
				background-repeat: no-repeat;
			}
			
			#social .facebook a {
				background-position: 0 0;
			}
			
			#social .linkedin a {
				background-position: -45px 0;
			}
			
			#social .twitter a {
				background-position: -90px 0;
			}
			
			#social .rss-feed a {
				background-position: -135px 0;
			}
			
			#social .email-us a {
				background-position: -180px 0;
			}
			
			#social .facebook a:hover {
				background-position: 0 -45px;
			}
			
			#social .linkedin a:hover {
				background-position: -45px -45px;
			}
			
			#social .twitter a:hover {
				background-position: -90px -45px;
			}
			
			#social .rss-feed a:hover {
				background-position: -135px -45px;
			}
			
			#social .email-us a:hover {
				background-position: -180px -45px;
			}
			
			
			/* Footer > Nav */
			#footer-nav {
				position: absolute;
				border-top: solid 1px #fff;
				height: 38px;
				bottom: 0;
			}
			
			#footer-nav li {
				float: right;
				line-height: 38px;
				background: url(<?php echo $this->uri->skin('assets/images/footer.separator.png'); ?>) no-repeat center left;
			}
			
			#footer-nav li a {
				display: block;
				color: #ffffff;
				margin-right: 8px;
				padding-left: 10px;
				text-decoration: none;
			}
			
			#footer-nav li a:hover {
				text-decoration: underline;
			}
			
			#footer-nav li.first-child a {
				margin-right: 0;
				padding-left: 0;
			}
			
			#footer-nav li.last-child, #footer-nav li.first-child {
				background: none;
			}
			
			#footer-nav li.creative-insight a {
				margin-right: 0;
			}
			
			#footer-nav li.creative-insight a span {
				font-weight: bold;
			}
		
			#footer-nav li.first-child {
				float: left;
			}
			
			
			/* Footer > Search */
			#form-search {
				margin-bottom: 20px;
			}
			
			.search {
				border-style: solid;
				border-color: #e4e4e4;
			}
			
			.search-box {
				border-width: 1px 0 1px 1px;
				float: left;
				outline: none;
				height: 28px;
				width: 205px;
				color: #9c9c9c;
				font-size: 11px;
				padding: 0 0 0 6px;
				font-family: 'Lucida Grande', 'Trebuchet MS', sans-serif;
			}
			
			.search-submit {
				border-width: 1px 1px 1px 0;
				float: left;
				outline: none;
			}
			
			
			/* Footer > Quick Links */
			#form-quicklinks {
				margin-bottom: 20px;
			}
			
			#form-quicklinks label {
				font-size: 18px;
				color: #ffffff;
				display: block;
				margin: 0 0 4px 0;
			}
			
			#form-quicklinks select {
				width: 240px;
			}
			
			
			
			
			
		.clearfix:before, .clearfix:after { content: ""; display: table; }
		.clearfix:after { clear: both; }
		.clearfix { *zoom: 1; }
		
		
		
		
		
		#prospectus {
			display: none;
			background: #991a2d;
			width: 300px;
			height: 300px;
		}
		
		#prospectus a {
			margin: 8px 8px 0 0;
			display: block;
			width: 66px;
			height: 68px;
			background: url(<?php echo $this->uri->skin('assets/images/fold.prospectus.png'); ?>) no-repeat top left;
			text-indent: -9000em;
		}
		
		#turn_wrapper {
		  width: 80px;
		  height: 80px;
		  display:block;
		  position: absolute;
		  top:0;
		  left:0;
		}
		
		#turn_hideme {
		  width: 73%;
		  height: 73%;
		  overflow:hidden;
		  display:block;
		  position:absolute;
		  float:left;
		  top:0;
		  left: 0;
		  z-index:1;
		}

		#turn_object {
		  display:block;
		  position: absolute;
		  top: 0;
		  left: 0;
		  overflow:hidden;
		  float:left;
		  border:none;
			cursor: pointer;
		}

		#turn_wrapper.right #turn_hideme *,
		#turn_wrapper.right #turn_object {
		  float: right !important;
		}

		#turn_wrapper.right #turn_hideme {
		  float: right !important;
		  right: 0;
		  left: auto;
		}
		#turn_wrapper.right #turn_object {
		  right: 0 !important;
		  left: auto !important;
		}

		#turn_wrapper.right {
		  position: absolute;
		  top: 0;
		  width: 100%;
		  height: 0;
		  right: 0 !important;
		}

		#turn_wrapper.right #turn_object * {
		  position: absolute;
		  right: 0 !important;
		}

		#turn_wrapper #turn_object img#turn_fold {
		  display:block;
		  width: 100%;
		  height:100%;
		  z-index:1000;
		  position:absolute;
		}

		#turn_wrapper .ui-wrapper {
		  left: 0 !important;
		  top: 0 !important;

		}

		#turn_wrapper .ui-resizable-handle {
		  border: none !important;
		  border-width: 0 !important;
		  background: none !important;
		  width: 100% !important;
		  height: 100% !important;
		}
		
		
		
		
		
		/*
		 * jQuery Nivo Slider v2.7.1
		 * http://nivo.dev7studios.com
		 *
		 * Copyright 2011, Gilbert Pellegrom
		 * Free to use and abuse under the MIT license.
		 * http://www.opensource.org/licenses/mit-license.php
		 * 
		 * March 2010
		 */


		/* The Nivo Slider styles */
		.nivoSlider {
			position:relative;
		}
		.nivoSlider img {
			position:absolute;
			top:0px;
			left:0px;
		}
		/* If an image is wrapped in a link */
		.nivoSlider a.nivo-imageLink {
			position:absolute;
			top:0px;
			left:0px;
			width:100%;
			height:100%;
			border:0;
			padding:0;
			margin:0;
			z-index:6;
			display:none;
		}
		/* The slices and boxes in the Slider */
		.nivo-slice {
			display:block;
			position:absolute;
			z-index:5;
			height:100%;
		}
		.nivo-box {
			display:block;
			position:absolute;
			z-index:5;
		}
		/* Caption styles */
		.nivo-caption {
			position:absolute;
			left:0px;
			bottom:0px;
			background:#000;
			color:#fff;
			opacity:0.8; /* Overridden by captionOpacity setting */
			width:100%;
			z-index:8;
		}
		.nivo-caption p {
			padding:5px;
			margin:0;
		}
		.nivo-caption a {
			display:inline !important;
		}
		.nivo-html-caption {
		    display:none;
		}
		/* Direction nav styles (e.g. Next & Prev) */
		.nivo-directionNav a {
			position:absolute;
			top:45%;
			z-index:9;
			cursor:pointer;
		}
		.nivo-prevNav {
			left:0px;
		}
		.nivo-nextNav {
			right:0px;
		}
		/* Control nav styles (e.g. 1,2,3...) */
		.nivo-controlNav a {
			position:relative;
			z-index:9;
			cursor:pointer;
		}
		.nivo-controlNav a.active {
			font-weight:bold;
		}
		
		
		
		
		.calendar-container {
			background: #ffffff;
			padding: 7px 10px;
		}
		
		.calendar-dates {
			width: 100%;
			border: 0;
		}
		
		.calendar-dates thead {
			display: none;
		}
		
		.calendar-dates tbody td {
			padding: 3px 3px;
		}
		
		.calendar-dates td.date {
			font-weight: bold;
			width: 70px;
		}
		
		.calendar-dates td.name {}
		
		
		
		
		</style>
		
		<meta name="robots" content="noindex, nofollow">
		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body class="homepage">
		
		<div id="highclare">
			
			<header class="constrain" style="position: relative;">
				
				<div id="logo">
					<h1>Highclare School</h1>
					<h2>Achieving Individual Excellence</h2>
				</div>
				
				<nav>
					<ul class="clearfix">
						<li class="first-child">
							<a href="#">Introduction</a>
							<ul>
								<li class="first-child">
									<a href="#">Meeting Individual Needs</a>
									<ul>
										<li class="first-child last-child"><a href="#">In More Detail</a></li>
									</ul>
								</li>
								<li><a href="#">Governors &amp; Staff</a></li>
								<li class="last-child"><a href="#">Policies &amp; Downloads</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Administration</a>
							<ul>
								<li class="first-child"><a href="#">School Offices</a></li>
								<li><a href="#">Transport</a></li>
								<li><a href="#">Uniforms</a></li>
								<li><a href="#">School Calendar</a></li>
								<li><a href="#">Catering</a></li>
								<li>
									<a href="#">Vacancies</a>
									<ul>
										<li class="first-child last-child"><a href="#">Downloads</a></li>
									</ul>
								</li>
								<li class="last-child"><a href="#">Snow &amp; Bad Weather</a></li>
							</ul>
						</li>
						<li class="no-separator">
							<a href="#">Admissions</a>
							<ul>
								<li class="first-child"><a href="#">Fees</a></li>
								<li><a href="#">Scholarships</a></li>
								<li><a href="#">Prospectus Download</a></li>
								<li><a href="#">Open Days</a></li>
								<li class="last-child"><a href="#">Admission Policy</a></li>
							</ul>
						</li>
						<li class="age-group two-lines">
							<a href="#">Nursery&nbsp;&amp; Pre-School</a>
							<ul>
								<li class="first-child last-child"><a href="#">Admissions</a></li>
							</ul>
						</li>
						<li class="age-group">
							<a href="#">Infants</a>
							<ul>
								<li class="first-child"><a href="#">School Life</a></li>
								<li><a href="#">Curriculum</a></li>
								<li><a href="#">Extra Curricular</a></li>
								<li><a href="#">Diary Dates</a></li>
								<li><a href="#">The School Day</a></li>
								<li><a href="#">Sports</a></li>
								<li class="last-child"><a href="#">News</a></li>
							</ul>
						</li>
						<li class="age-group">
							<a href="#">Juniors</a>
							<ul>
								<li class="first-child"><a href="#">School Life</a></li>
								<li><a href="#">Curriculum</a></li>
								<li><a href="#">Extra Curricular</a></li>
								<li><a href="#">Diary Dates</a></li>
								<li><a href="#">The School Day</a></li>
								<li><a href="#">Clubs</a></li>
								<li><a href="#">Sports</a></li>
								<li><a href="#">Assessment</a></li>
								<li><a href="#">KS2</a></li>
								<li class="last-child"><a href="#">News</a></li>
							</ul>
						</li>
						<li class="age-group">
							<a href="#">Seniors</a>
							<ul>
								<li class="first-child"><a href="#">School Life</a></li>
								<li><a href="#">Curriculum</a></li>
								<li><a href="#">Extra Curricular</a></li>
								<li><a href="#">Maths, English &amp; Science</a></li>
								<li><a href="#">Diary Dates</a></li>
								<li><a href="#">The School Day</a></li>
								<li><a href="#">Clubs</a></li>
								<li><a href="#">Sports</a></li>
								<li><a href="#">Music &amp; Drama</a></li>
								<li class="last-child"><a href="#">News</a></li>
							</ul>
						</li>
						<li class="age-group">
							<a href="#">Sixth Form</a>
							<ul>
								<li class="first-child"><a href="#">School Life</a></li>
								<li><a href="#">Subjects</a></li>
								<li><a href="#">Results</a></li>
								<li class="last-child"><a href="#">News</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Results</a>
							<ul>
								<li class="first-child last-child"><a href="#">OFSTED Reports</a></li>
							</ul>
						</li>
						<li>
							<a href="#">Photo Gallery</a>
							<ul>
								<li class="first-child"><a href="#">General</a></li>
								<li><a href="#">Nursery</a></li>
								<li><a href="#">Pre-School &amp; Infants</a></li>
								<li><a href="#">Juniors</a></li>
								<li><a href="#">Seniors</a></li>
								<li class="last-child"><a href="#">Sixth Form</a></li>
							</ul>
						</li>
						<li class="flip-menu">
							<a href="#">PTA</a>
							<ul>
								<li class="first-child"><a href="#">Diary Dates</a></li>
								<li class="last-child"><a href="#">News</a></li>
							</ul>
						</li>
						<li class="flip-menu last-child">
							<a href="#">TOPS</a>
							<ul>
								<li class="first-child"><a href="#">Diary Dates</a></li>
								<li class="last-child"><a href="#">News</a></li>
							</ul>
						</li>
					</ul>
				</nav>
				
				<ul id="subnav">
					<li class="first-child"><a href="/">Home</a></li>
					<li><a href="#">News</a></li>
					<li><a href="#">Downloads</a></li>
					<li><a href="#">Contact Us</a></li>
					<li class="last-child"><a href="#">Site Map</a></li>
				</ul>
				
				<div id="slider">
					
					<div id="gallery">
						<img src="<?php echo $this->uri->skin('assets/images/slider/seniors-01.jpg'); ?>" alt="" data-tab="item-5">
						<img src="<?php echo $this->uri->skin('assets/images/slider/seniors-02.jpg'); ?>" alt="" data-tab="item-4">
					</div>
					
					<ul class="item-5">
						<li class="first-child"><a href="#">Nursery &amp; Pre-School</a></li>
						<li><a href="#">Infants</a></li>
						<li><a href="#">Juniors</a></li>
						<li class="selected"><a href="#">Seniors</a></li>
						<li class="last-child"><a href="#">Sixth Form</a></li>
					</ul>
					
				</div>
				
			</header>
			
			<div id="prospectus">
				<a href="http://www.google.com/">Online Prospectus</a>
			</div>
			
			<div role="main" id="main" class="constrain clearfix">
				
				