<?php $this->load->view('common/header.include.php'); ?>

	<div class="column-container constrain clearfix">
	
		<div class="left-column">
			
			Left.
			
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