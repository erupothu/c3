<?php $this->load->view('admin/common/header.include.php'); ?>

		<h2><?php echo anchor('admin/calendar', 'Calendars') ?> &rarr; <span><?php echo $calendar->name(); ?></span></h2>
		
		<table>
			<colgroup>
				<col />
				<col />
				<col />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th>ID</th>
					<th>Date</th>
					<th>Name</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($calendar->events() as $event): ?>
				<tr class="<?php echo $event->classes(); ?>">
					<td class="center"><?php echo $event->id(); ?></td>
					<td><?php echo $event->date('d/m/Y'); ?></td>
					<td><?php echo anchor('admin/calendar/events/update/' . $event->id(), $event->name()); ?></td>
					<td><?php echo anchor('admin/calendar/events/delete/' . $event->id(), 'Delete'); ?></td>
				</tr>
				<?php endforeach; ?>
				<?php if(count($calendar) === 0): ?>
				<tr>
					<td colspan="4" class="empty">There are no Events associated with this Calendar</td>
				</tr>
				<?php endif; ?>
			</tbody>	
		</table>		
		
		<ul class="admin-options">
			<li><?php echo anchor('admin/calendar/events/create/' . $calendar->id(), 'New Event', array('class' => 'button')); ?></li>
		</ul>
		
		<?php echo anchor('admin/calendar', 'Back to Calendar List'); ?>

<?php $this->load->view('admin/common/footer.include.php'); ?>