	
	<!-- List area -->
	<?php if(count($images) > 0): ?>
	<ul id="qq_existing">
		<?php foreach($images as $image): ?>
		<li class="qq-upload-success qq-original">
			<input class="qq-upload-select" type="checkbox" name="image_select[<?php echo $image->id(); ?>]" />
			<span class="qq-upload-file"><a href="<?php echo $image->path(); ?>"><?php echo !$image->alt() ? $image->name() : $image->alt(); ?></a></span>
			<span class="qq-upload-size" style="display: inline;"><?php echo $image->size(); ?> Kb</span>
			<input type="hidden" name="page_image_id[]" class="page_image_id" value="<?php echo $image->id(); ?>" />
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	
	<!-- Hook area for jQuery -->
	<input type="hidden" name="resource_link" id="resource_link" value="image">
	<input type="hidden" name="resource_data" id="resource_data" value="">
	<!-- End Hook area -->
	