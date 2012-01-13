
				<!-- Rendering: <?php echo $page->id(); ?> -->
				<tr>
					<td class="center"><?php echo $page->id(); ?></td>
					<td><span class="icon icon-locked">Locked</span></td>
					<td><?php echo $page->depth() > 0 ? '<span class="depth depth-' . $page->depth() . '" style="color: #ccc;">' . str_repeat('&mdash;', $page->depth()) . '</span>&nbsp;' : ''; ?><?php echo anchor($page->link(Page_Object::LINK_ADMIN_UPDATE), $page->title()); ?></td>
					<td><?php echo $page->slug(true); ?></td>
					<td>preview link</td>
					<td class="center">Status</td>
					<td><?php echo $page->updated(); ?></td>
					<td class="center"><?php echo anchor($page->link(Page_Object::LINK_ADMIN_DELETE), 'Delete'); ?></td>
				</tr>
				<!-- End: <?php echo $page->id(); ?> -->
