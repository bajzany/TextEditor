(function() {
 	if (typeof window.CK_EDITOR_CONFIG === "undefined") {
		window.CK_EDITOR_CONFIG = {};
	}
	window.CK_EDITOR_CONFIG.fieldConfig = {
		editorType: 'replace',
 		initial: function() {},
 		configure: function(){
			return {
				removePlugins : "easyimage, cloudservices, font,sharedspace,sourcearea,fontawesome,texttransform,ckeditor-gwf-plugin,lineheight,fontweight,text-shadow,image,flash,save, uploadimage, forms, language, iframe",
			};
		},
		bind: function(editor, item){
			editor.on( 'change', function( evt ) {
				item.value =  evt.editor.getData();
			});
		},
	};
})();
