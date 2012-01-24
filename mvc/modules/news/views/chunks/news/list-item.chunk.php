				
				<!-- Rendering Article: <?php echo $article->id(); ?> -->
				<li class="news-article news-<?php echo $article->id(); ?>">
					
					<a href="<?php echo $article->permalink(); ?>">
						<img src="/uploads/news-temp-100x100.jpg" alt="News Temp" style="margin-right: 14px; float: left;">
					</a>
					
					<div style="height: 100px; width: 180px; margin-right: 16px; float: left; position: relative;">
						<h3 style="margin: 5px 0 5px; padding: 0; color: #E63812;"><?php echo $article->published('d/m/Y'); ?></h3>
						<p style="margin: 0; color: #15191A; max-height: 42px; overflow: hidden;"><?php echo $article->excerpt(57); ?></p>
						<a href="<?php echo $article->permalink(); ?>" class="button orange read-more" title="Read More &gt;" style="position: absolute; bottom: 0;">Read More<span></span></a>
					</div>
				</li>
				<!-- End Article: <?php echo $article->id(); ?> -->