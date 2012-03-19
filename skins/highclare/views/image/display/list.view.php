	
	<!-- Image [List Template] -->
	<?php if(count($images) > 0): ?>
	<div class="images">
		
		<ul>
			<?php foreach($images as $image): ?>
			<li><?php echo $image->html(); ?></li>
			<?php endforeach; ?>
		</ul>
		
	</div>
	<?php endif; ?>
	<!-- End Template -->
	