(function() {
	var ckEditor = {};

	Stage.addComponent('ckEditor', ckEditor);

	/**
	 * @param Stage Stage
	 */
	ckEditor.onBuild = function (Stage) {

		var editors = $('.ckEditor');
		var timeout;
		$.each(editors, function (i, item) {
			ClassicEditor
				.create(item, {
					// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
				} )
				.then( editor => {
					editor.model.document.on( 'change', ( evt, data ) => {
						clearTimeout(timeout);
						timeout = setTimeout(function(){

							var url = item.getAttribute('data-link');
							var type = item.getAttribute('data-type');
							var args = item.getAttribute('data-args');
							var url_string = Stage.validateUrl(url);
							var UrlObject = new URL(url_string);
							// UrlObject.searchParams.append('content', editor.getData());

							// console.log(UrlObject.toString());
							// return

							new Stage.Ajax({
								method: 'POST',
								url: UrlObject.toString(),
								data: {
									content: editor.getData(),
									type: type,
									args: args,
								},
								actionsAfterExecuteSnippets: [
									function (Ajax) {
										var AjaxListener = Stage.App.getListener('AjaxListener');
										$.each(Ajax.executedSnippets, function (name, el) {
											initializeTextBlocks(Stage.App, el);
											AjaxListener.init(Stage.App, el)
										});
									}
								],
							});
							//
							// console.log( data );
							// console.log( url);
						}, 1000);
					} );
				} )
				.catch( err => {
					console.error( err.stack );
				});

		})
	};

	/**
	 * @param Stage Stage
	 */
	ckEditor.init = function (Stage) {
		// console.log('AAAA')
	}

})();
