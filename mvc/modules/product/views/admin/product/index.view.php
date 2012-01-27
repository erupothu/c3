<?php $this->load->view('admin/common/header.include.php'); ?>

		<h2>Products</h2>

		<table>
			<colgroup>
				<col />
				<col />
				<col />
				<col />
				<col />
				<col />
				<col />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th>ID</th>
					<th>&mdash;</th>
					<th>Name</th>
					<th>Permalink</th>
					<th>Preview</th>
					<th>Status</th>
					<th>Last Updated</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($products as $product): ?>
				<tr>
					<td><?php echo $product->id(); ?></td>
					<td>-</td>
					<td><?php echo $product->name(); ?></td>
					<td><?php echo $product->permalink(); ?></td>
					<td><?php echo $product->code(); ?></td>
					<td><?php echo $product->price(); ?></td>
					<td>Update Link</td>
				</tr>
				<?php endforeach; ?>
			</tbody>	
		</table>
		
		<ul class="admin-options">
			<li><?php echo anchor('admin/product/create', 'New Product', array('class' => 'button')); ?></li>
		</ul>

<?php $this->load->view('admin/common/footer.include.php'); ?>