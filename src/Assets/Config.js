export class Config {

	/**
	 * @return {string}
	 */
	getEditorType() {
		return 'classic';
	}

	/**
	 * @return {{}}
	 */
	configure() {
		return {
			toolbar:{
				items: [
					'heading',
					'|',
					'source',
					'|',
					'bold',
					'italic',
					'link',
					'bulletedList',
					'numberedList',
					'imageUpload',
					'blockQuote',
					'insertTable',
					'mediaEmbed',
					'undo',
					'redo'
				],
			},
		};
	}

	bind() {

	}

}
