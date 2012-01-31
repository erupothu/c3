<?php $this->load->view('common/header.include.php'); ?>

	<div class="column-container constrain clearfix">
	
		<div class="left-column">
			
			<div class="box box-submenu">
				<div class="spacing">					
					<h2><span>News</span></h2>
				</div>			
			</div>
			
			<div class="box box-training-and-operations">
				<a href="/training-and-operations" title="Training &amp; Operations">
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
	
			<div class="box">
				
				<div class="spacing">

					<article>
						
						<header style="height: 153px; position: relative; background: url(/uploads/header.temp.about-us.jpg) no-repeat top center;">
							<h1 class="title" style="font-size: 20px; text-transform: uppercase; position: absolute; bottom: 0; right: 0; display: block; padding: 12px 14px; color: #fff; margin: 0;"><?php echo $article->title(); ?></h1>
						</header>
						
						<div class="content">
							<?php echo $article->content(); ?>
						</div>
						
						<div class="meta">
							<div class="published">Published on <time pubdate datetime="<?php echo $article->published('Y-m-d'); ?>"><?php echo $article->published('dS F Y'); ?></time></div>
							<div class="author">by <?php echo $article->author(); ?></div>
						</div>
						
						<a href="/news">&larr; Back to News</a>
						
					</article>
					
				</div>
				
			</div>
		
		</div>
	
	</div>

<?php $this->load->view('common/footer.include.php'); ?>