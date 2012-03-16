	
	<div id="modal">
	
		<h2>Image</h2>
	
		<p>Drag a box over your image to crop out a thumbnail. When you are done, click the 'Save' button.</p>
	
		<?php
	
		if($image['image_width'] > 760) {
			/*
			$image['image_original_width'] = $image['image_width'];
			$image['image_original_height'] = $image['image_height'];
		
			$ratio = 760 / $image['image_width'];
		
			$image['image_width'] = 760;
			$image['image_height'] = round($ratio * $image['image_original_height'], 0);
			*/
		}
	
	
		?>
	
	
		<form method="post" action="#" onsubmit="return checkCoords();">
		
			<div class="crop-container" style="width: 760px; display: block;">
			
				<img src="<?php echo $image['image_path']; ?>" style="display: block;" alt="" class="crop" />
			
				<input type="hidden" id="i" name="i" value="<?php echo $image['image_id']; ?>">
				<input type="hidden" id="x" name="x">
				<input type="hidden" id="y" name="y">
				<input type="hidden" id="w" name="w">
				<input type="hidden" id="h" name="h">
			
				<input type="submit" id="save_crop" value="Save Thumbnail" style="width: 98px;">
			
			</div>
		
		</form>
	
		<button class="fancybox-close">Cancel</button>
	
	</div>

	<script>

	var updateCoords = function(xy) {
		$('#x').val(xy.x);
		$('#y').val(xy.y);
		$('#w').val(xy.w);
		$('#h').val(xy.h);
	}

	$(function() {
	
		$('#modal .fancybox-close').click(function() {
			$.fancybox.close();
		});
	
		$('.crop').Jcrop({
			bgColor: '#000000',
			bgOpacity: .25,
			aspectRatio: 4 / 3,
			minSize: [ 225, 169 ],
			boxWidth: 740,
			onSelect: updateCoords
		});
	
		$('#save_crop').click(function(e) {
		
			e.preventDefault();
			$(this).attr('disabled', 'disabled').val('Cropping...');
		
			$.ajax({
				url: '/admin/image/crop/' + $('#i').val(),
				type: 'post',
				data: $('#modal form').serialize(),
				dataType: 'json',
				success: function(data) {
					console.log('OK', data);
					$.fancybox.close();
				},
				error: function() {
					alert('ERROR');
				}
			});
		
		});
	});

	</script>