<?php $this->load->view('admin/common/header.include.php'); ?>

		<h2>Pages</h2>

		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Slug</th>
					<th>Preview</th>
					<!--
					<th>Author</th>
					<th>Links</th>
					-->
					<th>Status</th>
					<th>Last Updated</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($pages as $page): ?>
				<tr>
					<td class="center"><?php echo $page->page_id; ?></td>
					<td><?php echo anchor('admin/page/update/' . $page->page_id, htmlentities($page->page_name)); ?></td>
					<td><?php echo $page->page_slug; ?></td>
					<td class="center">
						<?php if($page->page_status !== 'deleted'): ?>
						<?php echo anchor($page->page_slug, 'Preview', array('rel' => 'external')); ?>
						<?php else: ?>
						&mdash;
						<?php endif; ?>
					</td>
					<!--
					<td><?php echo $page->page_author; ?></td>
					<td>&mdash;</td>
					-->
					<td class="center"><?php echo ucfirst($page->page_status); ?></td>
					<td><?php echo $page->page_date_changed->format('d/m/Y H:i'); ?></td>
					<td class="center"><?php if($page->page_status !== 'deleted'): ?>
						<?php echo anchor('admin/page/delete/' . $page->page_id, 'Delete'); ?>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php if(count($pages) === 0): ?>
				<tr>
					<td colspan="7" class="empty">
						There are currently no pages within the system
					</td>
				</tr>
				<?php endif; ?>
			</tbody>	
		</table>

		<ul class="admin-options">
			<li><?php echo anchor('admin/page/create', 'New Page'); ?></li>
		</ul>

<?php $this->load->view('admin/common/footer.include.php'); ?>