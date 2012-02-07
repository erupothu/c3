<?php $this->load->view('admin/common/header.include.php'); ?>

		<h2>Orders</h2>

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
					<th>Transaction Code</th>
					<th>Customer</th>
					<th>Net</th>
					<th>Tax</th>
					<th>Total</th>
					<th>Status</th>
					<th>Date Placed</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($orders as $order): ?>
				<tr>
					<td class="center"><?php echo $order->id(); ?></td>
					<td>.</td>
					<td><?php echo $order->code(); ?></td>
					<td><?php echo $order->name(); ?></td>
					<td class="right"><?php echo $order->net(); ?></td>
					<td class="right"><?php echo $order->tax(); ?></td>
					<td class="right"><?php echo $order->total(); ?></td>
					<td><?php echo $order->status(true); ?></td>
					<td><?php echo $order->date(); ?></td>
					<td><?php echo anchor('admin/order/update/' . $order->id(), 'View'); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>	
		</table>
		
<?php $this->load->view('admin/common/footer.include.php'); ?>