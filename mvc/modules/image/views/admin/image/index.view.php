<?php $this->load->view('admin/common/header.include.php'); ?>
		
		<h2>Image Galleries</h2>
		
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Images</th>
					<th>Last Updated</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($galleries as $gallery): ?>
				<tr>
					<td class="center"><?php echo $gallery->id(); ?></td>
					<td><?php echo anchor('admin/image/gallery/update/' . $gallery->id(), $gallery->name()); ?></td>
					<td class="center"><?php echo count($gallery); ?></td>
					<td>&mdash;</td>
					<td><?php echo anchor('admin/image/gallery/delete/' . $gallery->id(), 'Delete'); ?></td>
				</tr>
				<?php endforeach; ?>
				<?php if(count($galleries) === 0): ?>
				<tr>
					<td colspan="7" class="empty">
						There are currently no Image Gallaries within the system
					</td>
				</tr>
				<?php endif; ?>
			</tbody>	
		</table>
		
		<ul class="admin-options">
			<li><?php echo anchor('admin/image/gallery/create', 'New Image Gallery', array('class' => 'button')); ?></li>
		</ul>
		
<?php $this->load->view('admin/common/footer.include.php'); ?>