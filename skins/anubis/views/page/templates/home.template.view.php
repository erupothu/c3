<?php $this->load->view('common/header.include.php'); ?>

	<div class="column-container constrain clearfix">
		
		<div class="left-column">
			
			<div class="box box-training-and-operations">
				<a href="/training-and-operations">
					<img src="<?php echo $this->uri->skin('assets/images/boxes/training-and-operations.jpg'); ?>" alt="Training &amp; Operations">
					<span class="strip"><em>Training &amp; Operations</em></span>
				</a>
			</div>
			
			<div class="box box-special-projects">
				<a href="/special-projects">
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
						<a href="/about-us" class="button orange read-more" style="float: right;">Read More<span></span></a>
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
			
			<div class="news-pane">
				
				<ul class="clearfix news-content">
					<?php echo Modules::run('news/retrieve', 'list-item'); ?>
				</ul>
				
			</div>
			
			<div class="slider"></div>
			
		</div>
		
	</div>

<?php $this->load->view('common/footer.include.php'); ?>