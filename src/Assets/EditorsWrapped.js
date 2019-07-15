class EditorsWrapped {

	constructor() {
		this.editors = [];
	}

	/**
	 * @param editor
	 */
	addEditor(editor) {
		this.editors.push(editor);
	}

}

export let Editors = new EditorsWrapped();
