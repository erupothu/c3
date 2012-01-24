			
			<!-- Sub-Menu -->
			<div class="box box-submenu">
			
				<div class="inner" style="margin: 8px;">
					
					<h2><a href="<?php echo $parent->permalink(); ?>" title="<?php echo $parent->title(); ?>"><span><?php echo $parent->title(); ?></span></a></h2>
				
					<ul id="sub-menu">
						<?php foreach($pages as $page): ?>
						<li class="page-<?php echo $page->id(); ?><?php echo $page == end($pages) ? ' last-child' : ($page == reset($pages) ? ' first-child' : ''); ?><?php echo $page->active() ? ' selected' : ''; ?>"><a href="<?php echo $page->permalink(); ?>" title="<?php echo $page->title(); ?>"><?php echo $page->title(); ?></a></li>
						<?php endforeach; ?>
					</ul>
					
				</div>
			
			</div>
			<!-- End Sub-Menu -->
			