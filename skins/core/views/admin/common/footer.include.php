				</div>
			
			</div>
			
			<div class="footer-push"></div>
			
		</div>
		
		<div id="footer">
		
			<div class="constrain">
				C3 &nbsp;<span class="copyright">&copy; Creative Insight <?php echo date('Y'); ?></span>
			</div>
			
		</div>
		
		<script src="<?php echo $this->uri->skin('scripts/jquery-1.6.4.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/jquery-ui-1.8.16.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/libs/jcrop-0.9.9/jquery.jcrop-0.9.9.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/libs/ckeditor-3.6.2/ckeditor.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/libs/ckeditor-3.6.2/adapters/jquery.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/libs/fileuploader-1.0.0/fileuploader-1.0.0.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/libs/fancybox-1.3.4/jquery.fancybox-1.3.4.min.js'); ?>"></script>
		<script>
		
		var adminFlashMessageHide = function() {
			
			$('.flash-message').slideUp(100, function() {
				$(this).remove();
			});
		}
		/*
		var cropShowPreview = function(xy) {
			
			$e = $(this).parents('.crop-container').length > 0 ? $(this).parents('.crop-container:eq(0)') : $('.crop:eq(0)');
			
			var rx = 100 / xy.w;
			var ry = 100 / xy.h;
			
			$('.crop-preview').css({
				width: Math.round(rx * $e.width()) + 'px',
				height: Math.round(ry * $e.height()) + 'px',
				marginLeft: '-' + Math.round(rx * xy.x) + 'px',
				marginTop: '-' + Math.round(ry * xy.y) + 'px'
			});
		}
		*/
		
		$(function() {
			
			var ck_tb_default = {
				toolbar: [
					{ name: 'styles', items: [ 'Format' ] },
					{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike' ] },
					{ name: 'lists', items: [ 'BulletedList', 'NumberedList', '-','Outdent','Indent', '-', 'Blockquote' ] },
					'/',
					{ name: 'justify', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight' ] },
					{ name: 'insert', items: [ 'Link', 'Unlink', 'Anchor', 'SpecialChar' ] },
					{ name: 'document', items: [ 'Source' ] },
					{ name: 'editing', items : [ 'SpellChecker' ] },
				],
				removePlugins: 'elementspath',
				stylesSet: [
					{ name: 'Normal', element: 'p' },
					{ name: 'Heading', element : 'h2', styles : { } },
					{ name: 'Subheading', element: 'h3' }
				],
				contentsCss: [ '<?php echo $this->uri->skin('styles/screen.content.css', 'highclare'); ?>' ],
				bodyClass: 'page-content',
				pasteFromWordRemoveFontStyles: true,
				pasteFromWordRemoveStyles: true,
				forcePasteAsPlainText: true,
				
				height: '400px',
				width: '560px',
				resize_maxWidth: '100%',
				startupShowBorders: false
				
				//filebrowserUploadUrl: '/admin/image/upload_ck'
			};
		
			$areas = $('.ck-default textarea, textarea.ck-default').ckeditor(ck_tb_default);
			
			if($('#file-uploader').length > 0) {
				var uploader = new qq.FileUploader({
					element: $('#file-uploader')[0],
		 			action: '<?php echo site_url('admin/image/upload'); ?>',
					allowedExtensions: ['jpg', 'jpeg'],
					sizeLimit: 10485760,
					debug: true,
					onComplete: function(id, filename, data) {
					
						// Add a hidden input
						$li = $('.qq-upload-list li:last-child');
						$li.append($('<input />', {
							type: 'hidden',
							name: 'page_image_id[]',
							value: parseInt(data.db_id)
						}));
					
						// Set the CB name.
						$cb = $li.find('input.qq-upload-select');
						$cb.attr('name', 'image_select[' + data.db_id + ']');
					
						// After upload, pop a modal
						$.fancybox(
							'/admin/image/modal/' + data.db_id, {
								'type'				: 'ajax',
								'autoDimensions'	: true,
								'autoScale'			: true,
								'centerOnScroll'	: true,
								'width'				: 'auto',
								'height'			: 'auto',
								'transitionIn'		: 'elastic',
								'transitionOut'		: 'elastic',
								'modal'				: true,
								'overlayColor'		: '#000'
							}
						);
					},
					onInit: function() {
						alert('Init is working');
					}
				}); 
			}
			
			
			$('ul.qq-upload-list').sortable({ 
				axis: 'y',
				cursor: 'move'
			});
			
			$('ul.qq-upload-list li a').live('click', function(e) {
				e.preventDefault();
			});
			
			$('input[type="checkbox"]').bind('click change', function() {
				$('.qq-on-select').toggle($('input[type="checkbox"]:checked').length > 0);
			});
			
			$('.qq-delete-images').click(function(e) {
				
				$page_id = $('#page_id').length == 1 ? $('#page_id').val() : null;
				
				e.preventDefault();
				$list = $('.qq-upload-list').find('input[type="checkbox"]:checked').each(function(i, $element) {
					$image_id = $($element).attr('name').substring(13).slice(0, -1);
					$.ajax({
						dataType: 'json',
						url: '/admin/image/delete/' + $image_id + '/' + $page_id + '/true',
						data: [],
						success: function() {
							$($element).parents('li').fadeOut(250, function() {
								$(this).remove();
							});
						},
						error: function() {
							alert('Cannot delete image.');
						}
					});
				});
				
			});
			
			$('#qq_existing li').each(function($index, $element) {
				$('ul.qq-upload-list').append($element);
			});
			
			// Check for race conds.
			$('#qq_existing').remove();
			
			/*Options of both classes

			// url of the server-side upload script, should be on the same domain
			action: '/server/upload',
			// additional data to send, name-value pairs
			params: {},

			// validation    
			// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
			allowedExtensions: [],        
			// each file size limit in bytes
			// this option isn't supported in all browsers
			sizeLimit: 0, // max size   
			minSizeLimit: 0, // min size

			// set to true to output server response to console
			debug: false,

			// events         
			// you can return false to abort submit
			onSubmit: function(id, fileName){},
			onProgress: function(id, fileName, loaded, total){},
			onComplete: function(id, fileName, responseJSON){},
			onCancel: function(id, fileName){},

			messages: {
			    // error messages, see qq.FileUploaderBasic for content            
			},
			showMessage: function(message){ alert(message); }
			*/
			
			
			
			
			
			
			
			
			
			/*
			CKEDITOR.on('dialogDefinition', function(ev) {
				// Take the dialog name and its definition from the event data.
				var dialogName = ev.data.name;
				var dialogDefinition = ev.data.definition;
				
				switch(dialogName) {
					case 'image':
					case 'imagebutton': {
						
						// Remove Advanced and Link tabs.
						dialogDefinition.removeContents('advanced');
						dialogDefinition.removeContents('Link');
						
						$img_info = dialogDefinition.getContents('info');
						$img_info.remove('width'); //.remove();
						
						break;
					}
				}
			});
			*/
			
			$('a[rel="external"]').click(function() {
				window.open($(this).attr('href'));
				return false;
			});
			
			// Flash Messages.
			$('.flash-message').effect('highlight', { color: '#ffd07f' }, 1000);
			
			$('a.flash-close').live('click', adminFlashMessageHide);
			setTimeout(function() { adminFlashMessageHide(); }, 7500);
			
			
			/*
			$('.crop').Jcrop({
				bgColor: '#000000',
				bgOpacity: .25,
				setSelect: [ 320, 240 ],
				aspectRatio: 4 / 3,
				minSize: [ 80, 60 ],
				maxSize: [ 320, 240 ],
				onChange: cropShowPreview,
				onSelect: cropShowPreview
			});
			*/
			
			/*
			$('a.group').fancybox({
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'speedIn'		: 600, 
				'speedOut'		: 200, 
				'overlayShow'	: false
			});*/
			
			/*
			$('a#test').click(function() {
				
				$.fancybox(
					'/admin/image/modal', {
						'type'				: 'ajax',
						'autoDimensions'	: false,
						'autoScale'			: true,
						'centerOnScroll'	: true,
						'width'				: 760,
						'height'			: 'auto',
						'transitionIn'		: 'elastic',
						'transitionOut'		: 'elastic',
						'modal'				: true,
						'overlayColor'		: '#000'
					}
				);
				
			});
			*/
			
			// Image tooltip
			/*
			$('.meta-image').qtip({
				content: function(api) {
					return '<div class="ui-img-contain">\
						<img src="' + $(this).attr('href') + '" alt="" />\
					</div>';
				},
				position: {
					my: 'bottom center', 
					at: 'top left',
					adjust: {
						x: 8,
						y: -2
					}
				},
			   	style: { 
			    	tip: true,
					classes: 'ui-tooltip-tbc ui-tooltip-rounded ui-tooltip-shadow '
				}
			}).click(false);
			*/
		});
		
		</script>
		
	</body>
</html>