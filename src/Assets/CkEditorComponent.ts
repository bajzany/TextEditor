if (module.hot) {
	module.hot.accept();
}

import {App, BaseComponent, SAGA_REDRAW_SNIPPET, Saga} from "Stage"
import {Wrapped} from './ConfigWrapped';
import {Config} from './Config';
import './oldCkEditor/loader.js'
import 'ckeditor/ckeditor'

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
		window.CKEDITOR.plugins.addExternal('fontawesome', '/ckeditorExtraPlugins/fontawesome/');
		window.CKEDITOR.plugins.addExternal('texttransform', '/ckeditorExtraPlugins/texttransform/');
		window.CKEDITOR.plugins.addExternal('ckeditor-gwf-plugin', '/ckeditorExtraPlugins/ckeditor-gwf-plugin/plugin.js');
		window.CKEDITOR.plugins.addExternal('lineheight', '/ckeditorExtraPlugins/lineheight/');
		window.CKEDITOR.plugins.addExternal('fontweight', '/ckeditorExtraPlugins/fontweight/');
		window.CKEDITOR.plugins.addExternal('text-shadow', '/ckeditorExtraPlugins/text-shadow/');

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
