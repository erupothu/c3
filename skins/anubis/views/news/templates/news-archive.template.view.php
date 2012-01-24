<?php $this->load->view('common/header.include.php'); ?>

	<div class="column-container constrain clearfix">
	
		<div class="left-column">
		
			<div class="box box-submenu">
				
				<div class="spacing">
					
					<h2><span>News</span></h2>
					
					&nbsp;
					
				</div>
				
			</div>
			
			<div class="box box-training-and-operations">
				<a href="/training-and-operations" title="Training &amp; Operations">
					<img src="<?php echo $this->uri->skin('assets/images/boxes/training-and-operations.jpg'); ?>" alt="Training &amp; Operations">
					<span class="strip"><em>Training &amp; Operations</em></span>
				</a>
			</div>
		
		</div>
	
		<div class="right-column">
		
			<div class="box">
				
				<div style="margin: 8px;">

					<header style="height: 153px; position: relative; background: url(/uploads/header.temp.about-us.jpg) no-repeat top center;">
						<span class="title" style="font-size: 20px; text-transform: uppercase; position: absolute; bottom: 0; right: 0; display: block; padding: 12px 14px; color: #fff;">Archive</span>
					</header>
					
					<?php foreach($articles as $article): ?>
					<article>
						<div class="content clearfix">
							<h2><a href="<?php echo $article->permalink(); ?>"><?php echo $article->title(); ?></a></h2>
							<p><?php echo $article->excerpt(210); ?></p>
							<a href="<?php echo $article->permalink(); ?>" class="button read-more orange" style="float: right; margin-top: 0px;">Read More<span></span></a>
						</div>
					</article>
					<?php endforeach; ?>
					
				</div>
				
			</div>
		
		</div>
	
	</div>

<?php $this->load->view('common/footer.include.php'); ?>