<?php $this->load->view('admin/common/header.include.php'); ?>

		<h2>Calendars</h2>
		
		<table>
			<colgroup>
				<col />
				<col />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Date Created</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($calendars as $calendar): ?>
				<tr>
					<td><?php echo $calendar->id(); ?></td>
					<td><?php echo anchor('admin/calendar/events/' . $calendar->id(), $calendar->name()); ?></td>
					<td><?php echo $calendar->created(); ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>	
		</table>		
		
		<ul class="admin-options">
			<li><?php echo anchor('admin/calendar/create', 'New Calendar', array('class' => 'button')); ?></li>
		</ul>

<?php $this->load->view('admin/common/footer.include.php'); ?>