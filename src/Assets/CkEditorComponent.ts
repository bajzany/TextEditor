if (module.hot) {
	module.hot.accept();
}

import {App, BaseComponent, SAGA_REDRAW_SNIPPET, Saga} from "Stage"
import {Wrapped} from './ConfigWrapped.js';
import {Config} from './Config';

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

		$.each(editors, function (i, item) {
			let type = item.getAttribute('data-type');

			let config = new Config();
			if (Wrapped.getConfigByName(type)) {
				config = Wrapped.getConfigByName(type);
			}
			if (config.getEditorType() === 'inline') {
				const editor = window.CKEDITOR.inline( item, config.configure());
				$(item).attr('contenteditable', 'true');
				config.bind(editor, item, type);
			} else {
				const editor = window.CKEDITOR.replace( item, config.configure());
				config.bind(editor, item, type);
			}
		})
	}
}

App.addComponent("CkEditorComponent", CkEditorComponent);
