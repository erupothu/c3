<?php $this->load->view('common/header.include.php'); ?>

	<div class="column-container constrain clearfix">
	
		<div class="left-column">
		
			<div class="box box-submenu">
				
				<div style="margin: 8px;">
					<h2><span>Technical Equipment</span></h2>
					
					<ul id="sub-menu">
						<li class="first-child"><a href="#">COTS Equipment</a></li>
						<li><a href="#">Tracking (Aquilia)</a></li>
						<li><a href="#">Audio Equipment</a></li>
						<li><a href="#">Video Equipment</a></li>
						<li class="last-child"><a href="#">Technical Assistance</a></li>
					</ul>
				</div>
				
			</div>
			
			<div class="box box-training-and-operations">
				<a href="#">
					<img src="<?php echo $this->uri->skin('assets/images/boxes/training-and-operations.jpg'); ?>" alt="Training &amp; Operations">
					<span class="strip"><em>Training &amp; Operations</em></span>
				</a>
			</div>
		
		</div>
	
		<div class="right-column">
		
			<div class="box">
				
				<div style="margin: 8px;">

					<article>
						<header style="height: 153px; position: relative; background: url(/uploads/header.temp.about-us.jpg) no-repeat top center;">
							<span class="title" style="font-size: 20px; text-transform: uppercase; position: absolute; bottom: 0; right: 0; display: block; padding: 12px 14px; color: #fff;"><?php echo $article->title(); ?></span>
						</header>
						
						<div class="content" style="color: #333 !important;">
							
							<h1><?php echo $article->title(); ?></h1>
							<time pubdate="pubdate"><?php echo $article->published(); ?></time>
							
							<?php echo $article->content(); ?>
						</div>
						
					</article>
					
				</div>
				
			</div>
		
		</div>
	
	</div>

<?php $this->load->view('common/footer.include.php'); ?>