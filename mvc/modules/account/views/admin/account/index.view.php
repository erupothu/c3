<?php $this->load->view('admin/common/header.include.php'); ?>

		<h2>Accounts</h2>

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
					<th>Name</th>
					<th>Email Address</th>
					<th>Group</th>
					<th></th>
					<th>Created</th>
					<th>Last Seen</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($accounts as $account): ?>
				<tr>
					<td class="center"><?php echo $account->id(); ?></td>
					<td><?php echo anchor('admin/account/update/' . $account->id(), $account->name()); ?></td>
					<td><?php echo $account->email(); ?></td>
					<td><?php echo $account->group(); ?></td>
					<td></td>
					<td><?php echo $account->created(); ?></td>
					<td><?php echo $account->seen(); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>	
		</table>
		
		<ul class="admin-options">
			<li><?php echo anchor('admin/account/export', 'CSV Export', array('class' => 'button')); ?></li>
		</ul>

<?php $this->load->view('admin/common/footer.include.php'); ?>