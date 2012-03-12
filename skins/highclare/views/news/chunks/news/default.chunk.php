			
			<!-- Rendering Article: <?php echo $article->id(); ?> -->
			<article class="news-article news-<?php echo $article->id(); ?>">
				
				<header>
					<h1 class="title"><a href="<?php echo $article->permalink(); ?>"><?php echo $article->title(); ?></a></h1>
 				</header>
				
				<div class="excerpt">
					<?php echo $article->excerpt(164); ?>
				</div>
				
			</article>
			<!-- End Article: <?php echo $article->id(); ?> -->
			