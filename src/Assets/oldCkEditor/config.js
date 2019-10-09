window.CKEDITOR.dtd.$removeEmpty['i'] = false;
window.CKEDITOR.dtd.$removeEmpty['span'] = false;

window.CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'cs';
	config.removePlugins = 'easyimage, cloudservices';
	config.allowedContent = true;
	config.removeFormatAttributes = '';
	config.extraPlugins = 'font,sharedspace,sourcedialog,fontawesome,texttransform,ckeditor-gwf-plugin,lineheight,fontweight,text-shadow';
	config.sharedSpaces = {
		top: 'ckeoptions',
	};
	config.toolbarGroups = [
		{ name: 'others' },
		{ name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },


		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'text-shadow'},
	];

	config.fontSize_sizes = CKEDITOR.config.fontSize_sizes + ";117/117px";
	config.font_names = "Kaushan Script;CaviarDreams;Roboto;Arial;Comic Sans MS;Courier New;Lucida Sans Unicode;Tahoma;Times New Roman;sans-serif;serif;monospace;Caviar_Dreams;Caviar_Dreams_Bold";
};
