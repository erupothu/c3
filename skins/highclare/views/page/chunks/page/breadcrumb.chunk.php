				
				<!-- Chunk: Breadcrumb -->
				<nav class="breadcrumb clearfix">
					
					<ol>
						<li class="first-child">You are here:</li>
						<?php foreach($breadcrumbs as $breadcrumb_path => $breadcrumb_title): ?>
						<li<?php echo $breadcrumb_title == end($breadcrumbs) ? ' class="last-child"' : ''; ?> itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<?php if($breadcrumb_title !== end($breadcrumbs)): ?><a href="<?php echo $breadcrumb_path; ?>" title="<?php echo htmlentities($breadcrumb_title); ?>" itemprop="url"><?php endif; ?><span itemprop="title"><?php echo htmlentities($breadcrumb_title); ?></span><?php if($breadcrumb_title !== end($breadcrumbs)): ?></a><?php endif; ?>
						</li>
						<?php endforeach; ?>
					</ol>
					
				</nav>
				<!-- End Chunk: Breadcrumb -->
				