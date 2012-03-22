				</div>
			
			</div>
			
			<div class="footer-push"></div>
			
		</div>
		
		<div id="footer">
		
			<div class="constrain">
			Memory Usage: {memory_usage} &nbsp;&bull;&nbsp; Elapsed Time: {elapsed_time}s &nbsp;&bull;&nbsp; C3 &nbsp;<span class="copyright">&copy; Creative Insight <?php echo date('Y'); ?></span>
			</div>
			
		</div>
		
		<script src="<?php echo $this->uri->skin('scripts/jquery-1.7.1.min.js', 'core'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/jquery-ui-1.8.17.min.js', 'core'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/libs/jcrop-0.9.9/jquery.jcrop-0.9.9.min.js', 'core'); ?>"></script>
		
		<script src="<?php echo $this->uri->skin('scripts/libs/ckeditor-3.6.2/ckeditor.js', 'core'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/libs/ckeditor-3.6.2/adapters/jquery.js', 'core'); ?>"></script>
		
		<!--
		<script src="<?php echo $this->uri->skin('scripts/libs/ckeditor-r7356/ckeditor.js', 'core'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/libs/ckeditor-r7356/adapters/jquery.js', 'core'); ?>"></script>
		-->
		
		<script src="<?php echo $this->uri->skin('scripts/libs/uploadify-3.0.0/jquery.uploadify-3.0.0.min.js', 'core'); ?>"></script>
		
		<script src="<?php echo $this->uri->skin('scripts/libs/fileuploader-1.0.0/fileuploader-1.0.0.js', 'core'); ?>"></script>
		<script src="<?php echo $this->uri->skin('scripts/libs/fancybox-1.3.4/jquery.fancybox-1.3.4.min.js', 'core'); ?>"></script>
		<script>
		
		var adminFlashMessageHide = function() {
			$('.flash-message').slideUp(100, function() {
				$(this).remove();
			});
		}
		
		$(function() {
			
			/* ckEditor */
			var ckWidth = 600;
			var ck_tb_default = {
				toolbar: [
					{ name: 'styles', items: [ 'Format' ] },
					{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike' ] },
					{ name: 'lists', items: [ 'BulletedList', 'NumberedList', '-','Outdent','Indent', '-', 'Blockquote' ] },
					{ name: 'spelling', items: [ 'atd-ckeditor' ]},
					{ name: 'media', items: [ 'Image', 'Youtube' ]},
					'/',
					{ name: 'justify', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight' ] },
					{ name: 'insert', items: [ 'Link', 'Unlink', 'Anchor', 'SpecialChar', 'HorizontalRule', 'Templates', 'Table' ] },
					{ name: 'document', items: [ 'Source' ] },
					{ name: 'editing', items : [ 'C3Widgets' ] },
					{ name: 'tools', items: [ 'Maximize', 'Preview' ] }
				],
				removePlugins: 'elementspath',
				extraPlugins: 'C3Widgets,atd-ckeditor,youtube',
				stylesSet: [
					{ name: 'Normal', element: 'p' },
					{ name: 'Heading', element : 'h2', styles : { } },
					{ name: 'Subheading', element: 'h3' }
				],
				contentsCss: [ '<?php echo $this->uri->skin('styles/page.css', 'core'); ?>', '<?php echo $this->uri->skin('assets/styles/page.css', $this->insight->config('display/skin')); ?>' ],
				bodyClass: 'page-content',
				pasteFromWordRemoveFontStyles: true,
				pasteFromWordRemoveStyles: true,
				forcePasteAsPlainText: true,
				
				//templates_files: [ '<?php echo $this->uri->skin('scripts/libs/ckeditor-3.6.2/plugins/templates/templates/default.js', 'core'); ?>' ],
				
				height: '200px',
				width: (ckWidth + 43) + 'px',
				resize_maxWidth: '100%',
				startupShowBorders: false,
				autoParagraph: false,
				fillEmptyBlocks: false,
				
				atd_rpc: '/admin/page/spellcheck'
				
				//filebrowserUploadUrl: '/admin/image/upload_ck'
			};
			
			/* Widget Definition */
			CKEDITOR.plugins.add('C3Widgets', {   
				requires: ['richcombo'],
				init: function(editor) {
					
					var config = editor.config, lang = editor.lang.format;
					
					// Gets the list of tags from the settings.
					var tags = [
						['[C3 Contact Form]', 'Contact Form', 'Contact Form', { module: 'contact', method: 'form'} ]
					];
					
					// Create style objects for all defined styles.
					editor.ui.addRichCombo('C3Widgets', {
						
						label: 'Widget',
						title: 'Insert Widget',
						voiceLabel: 'Insert Widget',
						className : 'cke_format',
						multiSelect : false,
						
						panel: {
							css : [ CKEDITOR.getUrl(editor.skinPath + 'editor.css') ],
							voiceLabel : lang.panelVoiceLabel
						},
						
						init: function() {
							this.startGroup('Select Widget');
							
							t = 0;
							for(var this_tag in tags) {
								this.add('{' + t + '}' + tags[this_tag][0], tags[this_tag][1], tags[this_tag][2]);
								t++;
							}
						},
						
						onClick: function(value) {

							editor.focus();
							editor.fire('saveSnapshot');
							
							// Insert Widget (find TAG ID)
							valuem = value.match(/{(\d+)}/);
							tag_id = valuem[1];
							
							// Strip TAG ID
							value = value.replace(/{\d+}/, '');
							attrb = '';
							
							// Convert to attribs.
							if(tags[tag_id][3]) {
								for(var key in tags[tag_id][3]) {
									if(tags[tag_id][3].hasOwnProperty(key)) {
										attrb += ' ' + key + '="' + tags[tag_id][3][key] + '"';
									}
								}
							}
							
							// Inject
							var widgetElement = CKEDITOR.dom.element.createFromHtml('<widget contenteditable="false"' + attrb + '>' + value + '</widget>', editor.document);
							editor.insertElement(widgetElement);

							editor.fire('saveSnapshot');
						}
					});
					
					editor.dataProcessor.writer.setRules('widget', {
						indent: false,
				        breakBeforeOpen: true,
						breakAfterOpen: false,
						breakBeforeClose: false,
						breakAfterClose: true
					});
					
					editor.dataProcessor.writer.setRules('p', {
						indent: true,
				        breakBeforeOpen: true,
						breakAfterOpen: true,
						breakBeforeClose: true,
						breakAfterClose: true
					});
					
					editor.dataProcessor.writer.setRules('li', {
						indent: true,
				        breakBeforeOpen: true,
						breakAfterOpen: false,
						breakBeforeClose: false,
						breakAfterClose: true
					});
				}
			});
			
			/* Allow 'widgets' */
			CKEDITOR.dtd.$body['widget'] = 1;
			
			/* CKEditor Dialogs */
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
						
						img_info = dialogDefinition.getContents('info');
						img_info.remove('width');
						
						break;
					}
					case 'tableProperties':
					case 'table': {
						
						// Remove Advanced (probably not needed).
						dialogDefinition.removeContents('advanced');
						tableTab = dialogDefinition.getContents('info');
						
						fieldWidth = tableTab.get('txtWidth');
						fieldHeaders = tableTab.get('selHeaders');
						fieldBorders = tableTab.get('txtBorder');
						fieldSpacing = tableTab.get('txtCellSpace');
						fieldPadding = tableTab.get('txtCellPad');
						
						tableTab.remove('cmbAlign');
						
						fieldWidth['default'] = '';
						fieldHeaders['default'] = 'none';
						fieldBorders['default'] = '0';
						fieldSpacing['default'] = '0';
						fieldPadding['default'] = '0';
						
						break;
					}
					case 'cellProperties': {
						
						cellTab = dialogDefinition.getContents('info');
						cellTab.remove('hAlign');
						cellTab.remove('vAlign');
						
						cellTab.remove('bgColor');
						cellTab.remove('borderColor');
						cellTab.remove('bgColorChoose');
						cellTab.remove('borderColorChoose');
						
						break;
					}
					default: {
						console.log(dialogName);
					}
				}
			});
			
			// Init.
			$areas = $('.ck-default textarea, textarea.ck-default').ckeditor(ck_tb_default);
			
			// CKEditor > Close Toolbars afterwards.
			$('.ck-close-toolbar textarea').each(function() {
				
				found_instance = false;
				for(i in CKEDITOR.instances) {
					if(CKEDITOR.instances[i].name == $(this).attr('id')) {
						found_instance = CKEDITOR.instances[i];
						break;
					}
				}

				if(!found_instance)
					return;

				// Alter options.
				found_instance.config.toolbarStartupExpanded = false;
			});

			
			if($('#file-uploader').length > 0) {
				
				var uploader = new qq.FileUploader({
					element: $('#file-uploader')[0],
		 			action: '<?php echo site_url('admin/image/upload'); ?>',
					allowedExtensions: ['jpg'],
					sizeLimit: 10485760,
					debug: false,
					template: '<div class="qq-uploader">' + 
						'<div class="qq-upload-drop-area"><span>Drop files here to upload</span></div>' +
						'<div class="qq-upload-button button upload">Upload Image</div>' +
						'<ul class="qq-upload-list"></ul>' + 
					'</div>',
					onSubmit: function(id, filename) {
						$('.qq-upload-list').show();
						//toggle($('.qq-upload-list li').length > 0);
					},
					onComplete: function(id, filename, data) {
						
						//console.log('Complete', id, filename, $('.qq-upload-list'));
						
						// Add a hidden input
						$li = $('.qq-upload-list li').not('.qq-original').eq(id);
						$li.append($('<input />', {
							type: 'hidden',
							class: 'page_image_id',
							name: 'image_id[]',
							value: parseInt(data.db_id)
						}));
						
						// Now enhance the span with a link to the image.
						$li.find('.qq-upload-file').wrapInner('<a href="' + data.data.image_path + '">');
						$li.addClass('qq-bound');
						
						// Set the CB name.
						$cb = $li.find('input.qq-upload-select');
						$cb.attr('name', 'image_select[' + data.db_id + ']');
						
						// Hook onto existing image hook if it exists.
						$('#resource_data').val($('#resource_data').val() + ($('#resource_data').val() == '' ? '' : ',') + data.db_id);
						
						// After upload, pop a modal
						$.fancybox(
							'/image/display/modal/' + data.db_id, {
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
					}
				}); 
			}
			
			/*
			$.fancybox(
				'/image/display/modal/2', {
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
			*/
			
			/* Image Uploads */
			// Sortable!
			$('ul.qq-upload-list').sortable({ 
				axis: 'y',
				cursor: 'move',
				distance: 5,
				delay: 250,
				placeholder: 'ui-state-highlight',
				forcePlaceholderSize: true
			});
			
			
			var imageSortPositions = function() {
				
				id_list = [];
				$('ul.qq-upload-list').find('li').each(function(index, item) {
					image_id = $(item).find('.qq-upload-select').attr('name').match(/image_select\[(\d+)\]/i);
					id_list.push(parseInt(image_id[1]))
				});
				
				// Post to image order function.
				//$.post('/image/resource/order', { order: id_list, fields: $('.resource_field').serialize() }, function(data) {
				//	console.log(data);
				//});
				
				// Set hidden.
				$('#resource_data').val(id_list.join(','));
				//console.log('sort order:', id_list);
			}
			
			imageCheckSelectedImages = function() {
				$('.qq-on-select').toggle($('.qq-upload-list .qq-upload-select:checked').length > 0);
			}
			
			
			
			
			
			
			
			/* Image Upload > Previews */
			$('.qq-upload-list').on('click', '.qq-upload-success a', function(event) {
				
				$.fancybox('/image/display/frame/' + $(this).parents('li').find('.page_image_id').val(), {
					'type'				: 'ajax',
					'autoDimensions'	: true,
					'autoScale'			: true,
					'centerOnScroll'	: true,
					'width'				: 'auto',
					'height'			: 'auto',
					'transitionIn'		: 'elastic',
					'transitionOut'		: 'elastic',
					'modal'				: false,
					'overlayColor'		: '#000'
				});
				
				event.preventDefault();
			});
			
			
			/* Image Upload > Sorting/Checking */
			$('ul.qq-upload-list').on('sortupdate', imageSortPositions);
			$('.qq-upload-list').on('change', 'input[type="checkbox"]', imageCheckSelectedImages);
			
			
			/* Image Upload > Delete Images */
			$('.qq-delete-images').click(function(e) {
				
				$page_id = $('#page_id').length == 1 ? $('#page_id').val() : null;
				
				e.preventDefault();
				$list = $('.qq-upload-list').find('input[type="checkbox"]:checked').each(function(i, $element) {
					$image_id = $($element).attr('name').substring(13).slice(0, -1);
					$.ajax({
						dataType: 'json',
						url: '/admin/image/delete/' + $image_id + '/page/' + $page_id + '/true',
						data: [],
						success: function(data) {
							
							$($element).parents('li').fadeOut(250, function() {
								$(this).remove();
								imageCheckSelectedImages();
								
								// Hide the 'frame' if there are no images left.
								if($('.qq-upload-list li').length == 0) {
									$('.qq-upload-list').hide();
								}
							});
						},
						error: function() {
							alert('Cannot delete image.');
						}
					});
					
				});
				
			});
			
			/* Image Upload > Existing Images */
			$('#qq_existing li').each(function(index, element) {
				
				$('ul.qq-upload-list').append(element);
				$('ul.qq-upload-list:hidden').show();
				
				if($('#qq_existing li').length == 0) {
					imageSortPositions();
				}
			});
			
			// Check for race conds.
			$('#qq_existing').remove();
			
			// On Load.
			imageSortPositions();
			
			
			
			
			$('a[rel="external"]').click(function() {
				window.open($(this).attr('href'));
				return false;
			});
			
			
			// Flash Messages.
			$('.flash-message').effect('highlight', { color: '#ffd07f' }, 1000);
			
			
			$('a.flash-close').live('click', adminFlashMessageHide);
			setTimeout(function() { adminFlashMessageHide(); }, 7500);
			
			
			
			
			
			
			/* http://uploadify.wdwebdesign.com.br/ */
			$('.upload-single').uploadify({
				debug: <?php echo ENVIRONMENT == 'development' ? 'true' : 'false'; ?>,
				auto: true,
				swf: '/skins/core/scripts/libs/uploadify-3.0.0/uploadify.swf',
				cancelImage: '/skins/core/images/sprite.png',
				buttonText: 'Select PDF',
				multi: false,
				file_post_name: 'upload',
				uploader: '/admin/product/upload',
				removeCompleted: false,
				fileTypeExts: '*.pdf',
				progressData: 'all',
				postData: {
					whatever: 1,
					something: 'string',
					testing: [ 'a', 'b', 'c' ]
				},
				onInit: function() {
					//console.log('rockballs.');
				},
				onUploadSuccess: function(file, data, response) {
					
					// Return is JSON.
					data = $.parseJSON(data);
					
					//console.log($(this), file, data, response);
					
					$('#' + $(this).attr('queueID')).after('<a href="' + data.path + '" class="uploaded-pdf-preview" title="Preview"><span>Preview</span></a>', {});
				}
			});
			
			
			// Date Selections.
			$('.date-picker').datepicker({
				dateFormat	: 'yy-mm-dd',
				onSelect	: function(text, inst) {
				}
			});
			
			$('.date-picker-icon').click(function(e) {
				$dp = $(this).parents('.row').find('.date-picker');
				$dp.datepicker('show');
				e.preventDefault();
			});
			
			
			
			// Page
			// Toggle/Collapse.
			$('.xer').click(function(event) {
				
				event.preventDefault();
				
				toggle = $(this).hasClass('open') ? 'closed' : 'open';
				toggleFunc = toggle == 'closed' ? false : true;
				
				parent_id = parseInt($(this).parents('tr').data('id'));
				data_rows = $.grep($(this).parents('tbody').find('tr'), function(el, i) {
					return $.inArray(parent_id, $(el).data('children')) !== -1;
				});
				
				$(this).removeClass('open closed').addClass(toggle).text(toggleFunc ? '-' : '+');
				$(data_rows).toggle(toggleFunc);
				
				if(toggleFunc) {
					$(data_rows).find('td').effect('highlight', { backgroundColor: '#ffd07f' }, 1000);
				}
			});
			
			
			// Auto-Slug code
			$('input.slug_title').blur(function() {
				
				// Find the slug field.
				parent_form = $(this).parents('form');
				parent_field = parent_form.find('input[data-slug-generate]');
				if($.trim(parent_field.val()).length == 0) {
					return;
				}
				
				// Get Slug field.
				slug_field = $('input[name="' + parent_field.data('slug-generate') + '"]').first();
				
				// If there is not slug field, or it has already been filled...
				if(slug_field.length == 0 || (slug_field.val().length > 0 && slug_field.val() != '/')) {
					return;
				}
				
				serialized = parent_form.serialize();
				
				// Are we overriding the module?
				if(parent_field.data('slug-override')) {
					serialized += '&override_module=' + parent_field.data('slug-override');
				}
				
				$.post('/admin/' + parent_field.data('slug-module') + '/ajax/slug', serialized, function(data) {
					
					if(!data.status) {
						return;
					}
					
					slug_field.val(data.result.slug);
					
				}, 'json');
				
				// Effect
				slug_field.effect('highlight', { backgroundColor: '#ffd07f' }, 1000);
			});
			
		});
		</script>
		
	</body>
</html>