(function() {

	if (typeof window.CK_EDITOR_CONFIG === "undefined") {
		window.CK_EDITOR_CONFIG = {};
	}

	var ckEditor = {
		config: window.CK_EDITOR_CONFIG
	};

	var local = {};

	Stage.addComponent('ckEditor', ckEditor);
	window.CKEDITOR_BASEPATH = '/bower/ck-editor-ultra-pro/';
	ace.config.set('basePath', '/bower/ace-build/src-min');
	/**
	 * @param Stage Stage
	 * @param el
	 */
	ckEditor.onBuild = function (Stage, el) {
		var editors = $(el ? el :document).find('.ckEditor');
		$.each(editors, function (i, item) {
			var type = item.getAttribute('data-type');
			var config = local.loadConfig(type);

			//Initial
			config.initial(ckEditor, item, type);

			//Configure
			var editor = CKEDITOR[config.editorType]( item , config.configure());

			//Bind
			config.bind(editor, item, type, ckEditor)
		})
	};


	/**
	 * @param Stage Stage
	 */
	ckEditor.init = function (Stage) {
	};

	/**
	 * @param name
	 */
	local.loadConfig = function(name) {

		if(typeof ckEditor.config[name + 'Config'] === "undefined"){
			return {
				initial: function(){

				},
				configure: function () {
					return {};
				},
				bind: function () {

				},
				editorType: 'replace'
			};
		}

		return ckEditor.config[name + 'Config']
	};


	Stage.App.addActionAfterExecuteSnippet('ckEditor', ckEditor.onBuild);

})();
