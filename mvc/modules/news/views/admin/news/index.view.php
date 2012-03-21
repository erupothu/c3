<?php $this->load->view('admin/common/header.include.php'); ?>
		
		<h2>News</h2>
		
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>&mdash;</th>
					<th>Title</th>
					<th>Author</th>
					<th>Publish Date</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($articles as $article): ?>
				<tr>
					<td class="center"><?php echo $article->id(); ?></td>
					<td><?php echo anchor($article->permalink(true), 'Preview', array('title' => sprintf("Preview '%s'", $article->title()), 'class' => 'icon icon-preview')); ?></td>
					<td><?php echo anchor('admin/news/update/' . $article->id(), $article->title()); ?></td>
					<td><?php echo $article->author(); ?></td>
					<td><?php echo $article->published(); ?></td>
					<td><?php echo anchor('admin/news/delete/' . $article->id(), 'Delete'); ?></td>
				</tr>
				<?php endforeach; ?>
				<?php if(count($articles) === 0): ?>
				<tr>
					<td colspan="7" class="empty">
						There are currently no pages within the system
					</td>
				</tr>
				<?php endif; ?>
			</tbody>	
		</table>

		<ul class="admin-options">
			<li><?php echo anchor('admin/news/create', 'New Article', array('class' => 'button')); ?></li>
		</ul>

<?php $this->load->view('admin/common/footer.include.php'); ?>