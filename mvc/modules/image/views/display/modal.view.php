	
	<div id="modal" style="width: 760px;">
	
		<h2>Create an Image Thumbnail</h2>
	
		<p>
			Drag a box with your mouse over your image to crop 
			out a thumbnail. When you are done, click the '<strong>Save Thumbnail</strong>' button.
		</p>
	
		<form method="post" action="#" onsubmit="return checkCoords();">
		
			<div class="crop-container clearfix" style="width: 760px; display: block; margin-top: 1.0em;">
			
				<img src="<?php echo $image->path(); ?>" style="display: block;" alt="" class="crop" />
			
				<input type="hidden" id="i" name="i" value="<?php echo $image->id(); ?>">
				<input type="hidden" id="x" name="x">
				<input type="hidden" id="y" name="y">
				<input type="hidden" id="w" name="w">
				<input type="hidden" id="h" name="h">
			
				<div class="button-row clearfix">
					<input type="submit" id="save_crop" value="Save Thumbnail" style="width: 98px; float: left; margin-right: 10px;">
					<!--<button class="crop-deselect button-active">Deselect</button>-->
					<button class="fancybox-close" style="float: left;">Skip</button>
				</div>
			
			</div>
		
		</form>
	
	</div>

	<script>

	var updateCoords = function(xy, a) {
		$('#x').val(xy.x);
		$('#y').val(xy.y);
		$('#w').val(xy.w);
		$('#h').val(xy.h);
	}
	
	var jcrop_api;
	var minCropDimensions = [300, 227];
	
	
	$(function() {
		
		$('.crop-deselect').on('click', function(event) {
			event.preventDefault();
			jcrop_api.release();
			$(this).removeClass('button-active').addClass('button-disabled');
		});
		
		$('#modal .fancybox-close').click(function(event) {
			$.fancybox.close();
			event.preventDefault();
		});
		
		
		$('.crop').Jcrop({
			bgColor: '#000000',
			bgOpacity: .25,
			aspectRatio: 4 / 3,
			minSize: minCropDimensions,
			boxWidth: 740,
			onSelect: updateCoords,
			createHandles: ['n','s','e','w','nw','ne','se','sw'],
			createDragbars: ['n','s','e','w'],
			createBorders: ['n','s','e','w']
		}, function() {
			
			jcrop_api = this;
			bounds = jcrop_api.getBounds();
			
			// Auto-Select the middle.
			if(minCropDimensions && (bounds[0] > minCropDimensions[0] && bounds[1] > minCropDimensions[1])) {
				jcrop_api.setSelect([ Math.floor((bounds[0] - minCropDimensions[0]) / 2), Math.floor((bounds[1] - minCropDimensions[1]) / 2), minCropDimensions[0], minCropDimensions[1] ]);
			}
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
					$.fancybox.close();
				},
				error: function() {
					alert('ERROR');
				}
			});
		
		});
	});

	</script>