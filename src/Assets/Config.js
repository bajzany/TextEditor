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
			sharedSpaces: {
			}
		};
	}

	bind(editor, item, type) {

	}

}
