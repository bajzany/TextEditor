if (module.hot) {
	module.hot.accept();
}

import {App, BaseComponent, SAGA_REDRAW_SNIPPET, Saga} from "Stage"
import {Wrapped} from './ConfigWrapped';
import {Config} from './Config';

import * as CKEDITOR from '@nettpack/ckeditor';
import {Editors} from './EditorsWrapped';

class CkEditorComponent extends BaseComponent {

	initial() {
		super.initial();
		this.installPlugins();
	}

	@Saga(SAGA_REDRAW_SNIPPET)
	installPlugins(action = null){
		let target = document;
		if (action) {
			const {content} = action.payload;
			target = content
		}

		let editors = $(target).find('.ckEditor');

		Editors.editors = [];

		$.each(editors, function (i, item) {
			let type = item.getAttribute('data-type');

			let config = new Config();
			if (Wrapped.getConfigByName(type)) {
				config = Wrapped.getConfigByName(type);
			}
			if (config.getEditorType() === 'inline') {
				CKEDITOR.InlineEditor
					.create(item, config.configure())
					.then(editor => {
						editor.fire( 'inlineReady' );
						Editors.addEditor(editor);
						config.bind(editor, item)
					})
					.catch( err => {
						console.error( err.stack );
					} );
			} else {

				 CKEDITOR.ClassicEditor
					.create(item, config.configure())
					.then(editor => {
						editor.fire( 'classicReady' );
						Editors.addEditor(editor);
						config.bind(editor, item)
					})
					.catch( err => {
						console.error( err.stack );
					} );
			}
		})
	}
}

App.addComponent("CkEditorComponent", CkEditorComponent);
