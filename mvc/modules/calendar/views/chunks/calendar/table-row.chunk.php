				
				<!-- Rendering Event: <?php echo $event->id(); ?> -->
				<tr class="<?php echo $event->classes(); ?>">
					<td class="date"><?php echo $event->date('M jS'); ?></td>
					<td class="name"><?php echo $event->name(); ?></td>
				</tr>
				<!-- End Event: <?php echo $event->id(); ?> -->
				