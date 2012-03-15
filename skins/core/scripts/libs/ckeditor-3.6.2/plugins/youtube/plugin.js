(function() {
	CKEDITOR.plugins.add('youtube', {
		lang: ['en'],
		requires: ['dialog'],
		init: function(editor) {		
			var commandName = 'youtube';
			editor.addCommand(commandName, new CKEDITOR.dialogCommand( 'youtube' ));
			
			editor.ui.addButton('Youtube',{
				label: editor.lang.youtube.button,
				command: commandName,
				icon: this.path + 'images/youtube.png'
			});
		
			CKEDITOR.dialog.add(commandName, CKEDITOR.getUrl(this.path + 'dialogs/youtube.js'));
		}
	});
})();