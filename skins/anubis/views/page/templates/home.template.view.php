<?php $this->load->view('common/header.include.php'); ?>

	<div class="column-container constrain clearfix">
		
		<div class="left-column">
			
			<div class="box box-training-and-operations">
				<a href="#">
					<img src="<?php echo $this->uri->skin('assets/images/boxes/training-and-operations.jpg'); ?>" alt="Training &amp; Operations">
					<span class="strip"><em>Training &amp; Operations</em></span>
				</a>
			</div>
			
			<div class="box box-special-projects">
				<a href="#">
					<img src="<?php echo $this->uri->skin('assets/images/boxes/special-projects.jpg'); ?>" alt="Special Projects">
					<span class="strip"><em>Special Projects</em></span>
				</a>
			</div>
			
		</div>
		
		<div class="right-column">
			
			<div class="box box-welcome-to-anubis">
				<article class="article-home" style="position: relative; height: 384px; margin: 8px; background: url(<?php echo $this->uri->skin('assets/images/boxes/welcome-to-anubis.jpg'); ?>) no-repeat top left;">
					
					<div style="position: absolute; bottom: 0; padding: 20px;">
						<?php echo $page->content(); ?>
						<a href="#" class="button read-more" style="float: right;">Read More<span></span></a>
					</div>
					
				</article>
			</div>
			
		</div>
		
	</div>
	
	<div id="news-latest">
		
		<div class="tab">
			<span>Latest News</span>
		</div>
		
		<div class="box tabbed">
			
			<div style="margin: 8px 12px; overflow: hidden; width: 930px;" class="news-pane">
				
				<ul class="clearfix news-content">
					<?php for($i = 1; $i <= 8; $i++): ?>
					<li>
						<img src="/uploads/news-temp-100x100.jpg" alt="News Temp" style="margin-right: 14px; float: left;">
						<div style="height: 100px; width: 180px; margin-right: 16px; float: left; position: relative;">
							<h3 style="margin: 5px 0 5px; padding: 0; color: #E63812;">11/12/2011</h3>
							<p style="margin: 0; color: #15191A;">Anubis have been approved as a City &amp; Guilds Centre&hellip;</p>
							<a href="#" class="button read-more" style="position: absolute; bottom: 0;">Read More <?php echo $i; ?><span></span></a>
						</div>
					</li>
					<?php endfor; ?>
				</ul>
				
			</div>
				<div class="slider"></div>
			
			
		</div>
		
	</div>

<?php $this->load->view('common/footer.include.php'); ?>