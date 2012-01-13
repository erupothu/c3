				
				<!-- Rendering: <?php echo $article->id(); ?> -->
				<li>
					<img src="/uploads/news-temp-100x100.jpg" alt="News Temp" style="margin-right: 14px; float: left;">
					<div style="height: 100px; width: 180px; margin-right: 16px; float: left; position: relative;">
						<h3 style="margin: 5px 0 5px; padding: 0; color: #E63812;"><?php echo $article->published('d/m/Y'); ?></h3>
						<p style="margin: 0; color: #15191A;"><?php echo $article->excerpt(); ?></p>
						<a href="<?php echo $article->permalink(); ?>" class="button read-more" style="position: absolute; bottom: 0;">Read More<span></span></a>
					</div>
				</li>
				<!-- End: <?php echo $article->id(); ?> -->