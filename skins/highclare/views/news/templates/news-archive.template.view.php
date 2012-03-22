<?php $this->load->view('common/header.include.php'); ?>
				
				<div class="left">
					
					<?php //echo Modules::run('page/breadcrumb', $articles); ?>
					
					<div class="page-content news-content">
						
						<?php foreach($articles as $article): ?>
						<article style="margin: 0 0 1.5em 0;">
							
							<header>
								<a href="<?php echo $article->permalink(true); ?>">
									<?php echo $article->title(); ?>
								</a>
							</header>
							
							<?php if($article->categories()->count() > 0): ?>
							<div class="categories">
								Category:
								<?php foreach($article->categories() as $category): // @TODO Chunk? ?>
								<a href="<?php echo $category->permalink(true); ?>" title="<?php echo $category->title(); ?>"><?php echo $category->title(); ?></a>
								<?php endforeach; ?>
							</div>
							<?php endif; ?>
							
							<div class="excerpt">
								<?php echo $article->excerpt(300); ?>
							</div>
							
							<div class="meta">
								<?php echo $article->published('jS F Y'); ?>
							</div>
							
						</article>
						<?php endforeach; ?>
					</div>
					
				</div>
				
				<div class="right neutral">
					<?php //echo Modules::run('image/resource/hook', 'page', $ne->id(), 'list'); ?>
				</div>
				
<?php $this->load->view('common/footer.include.php'); ?>