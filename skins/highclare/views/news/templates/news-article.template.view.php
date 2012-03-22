<?php $this->load->view('common/header.include.php'); ?>
				
				<div class="left">
					
					<?php //echo Modules::run('page/breadcrumb', $articles); ?>
					
					<div class="page-content news-content">
						
						<h1>News</h1>
						
						<article style="margin: 0 0 1.5em 0;">
							
							<header style="margin-top: 0;">
								<h2 style="margin-top: 0;"><a href="<?php echo $article->permalink(true); ?>"><?php echo $article->title(); ?></a></h2>
							</header>
							
							<div class="excerpt">
								<?php echo $article->content(); ?>
							</div>
							
							<div class="meta" style="margin-top: 1.0em;">
								Published: <?php echo $article->published('jS F Y'); ?>
							</div>
							
						</article>
					</div>
					
				</div>
				
				<div class="right neutral">
					<?php //echo Modules::run('image/resource/hook', 'page', $ne->id(), 'list'); ?>
				</div>
				
<?php $this->load->view('common/footer.include.php'); ?>