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
					<th>Category</th>
					<th>Code</th>
					<th>Price (<abbr title="Great British Pounds">&pound;GBP)</abbr></th>
					<th>Last Updated</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($products as $product): ?>
				<tr>
					<td class="center"><?php echo $product->id(); ?></td>
					<td><?php echo anchor($product->permalink(), 'Preview', array('title' => sprintf("Preview '%s'", $product->name()), 'class' => 'icon icon-preview')); ?></td>
					<td><?php echo anchor('admin/product/update/' . $product->id(), $product->name()); ?></td>
					<td><?php echo $product->category(); ?></td>
					<td><?php echo $product->code(); ?></td>
					<td class="right"><?php echo $product->price(); ?></td>
					<td><?php echo $product->updated(); ?></td>
					<td>Delete</td>
				</tr>
				<?php endforeach; ?>
			</tbody>	
		</table>
		
		<ul class="admin-options">
			<li><?php echo anchor('admin/product/create', 'New Product', array('class' => 'button')); ?></li>
		</ul>

<?php $this->load->view('admin/common/footer.include.php'); ?>