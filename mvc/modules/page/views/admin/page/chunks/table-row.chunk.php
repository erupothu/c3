
				<!-- Rendering: <?php echo $page->id(); ?> -->
				<tr data-children="<?php echo $page->id_recursive(); ?>" data-id="<?php echo $page->id(); ?>">
					<td class="center"><?php echo $page->id(); ?></td>
					<!--<td><span class="icon icon-locked">Locked</span></td>-->
					<td>
						<?php echo $page->depth() > 0 ? '<span class="depth depth-' . $page->depth() . '" style="color: #ccc;">' . str_repeat('&mdash;', $page->depth()) . '</span>&nbsp;' : ''; ?>
						<?php if($page->hasChildren()): ?><a href="#" class="xer open">-</a><?php endif; ?>
						<?php echo anchor($page->link(Page_Object::LINK_ADMIN_UPDATE), $page->title()); ?>
					</td>
					<td><?php echo anchor($page->slug(true), $page->slug(false)); ?></td>
					<td class="center"><?php echo $page->status(true); ?></td>
					<td><?php echo $page->updated(); ?></td>
					<td class="center"><?php echo anchor($page->link(Page_Object::LINK_ADMIN_DELETE), 'Delete'); ?></td>
				</tr>
				<!-- End: <?php echo $page->id(); ?> -->
