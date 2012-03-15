(function() {
	CKEDITOR.dialog.add('youtube', function(editor) {		
		return {
			title: editor.lang.youtube.title,
			minWidth: CKEDITOR.env.ie && CKEDITOR.env.quirks ? 200: 250,
			minHeight: 180,
			onShow: function() {
				this.getContentElement('general', 'content').getInputElement().setValue('');
			},
			onOk: function() {
				
				val = this.getContentElement('general', 'content').getInputElement().getValue();
				if(!(match = val.match(/(v|embed)[=\/]([a-z0-9\-\_]{11})/i))) {
					return;
				}
				
				video_id = match[2];
				var text = '<iframe class="youtube-player" title="YouTube video player" type="text/html" width="600" height="365" src="http://www.youtube.com/embed/' + video_id + '?rel=0&amp;modestbranding=1&amp;showsearch=0&amp;autohide=1&amp;showinfo=0&amp;hd=1" frameborder="0"></iframe>';
				this.getParentEditor().insertHtml(text);
			},
			contents: [{
				label: editor.lang.common.generalTab,
				id: 'general',
				elements:
				[{
					type: 'html',
					id: 'pasteMsg',
					html: '<div style="white-space: normal;"><img alt="" style="display: block; margin: 5px auto 15px;" src="' + CKEDITOR.getUrl(CKEDITOR.plugins.getPath('youtube') + 'images/youtube_large.png') + '">' 
					+ editor.lang.youtube.pasteMsg
					+ '</div>'
				},
				{
					type: 'html',
					id: 'content',
					style: 'width:180px; height:90px',
					html: '<input type="text" size="40" style="border:1px solid black; background: white">',
					focus: function() {
						this.getElement().focus();
					}
				}]
			}]
		}
	});
})();