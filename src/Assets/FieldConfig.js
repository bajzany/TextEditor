import {Wrapped} from './ConfigWrapped';
import {Config} from './Config';
import {validateUrl} from 'Stage';

export class FieldConfig extends Config {

	getEditorType() {
		return 'classic';
	}

	bind(editor, item, type) {
		editor.on( 'change', function( evt ) {
			item.value =  evt.editor.getData();
		});
	}
	configure() {
		return {
			sharedSpaces : {
				// top: 'ckeoptions',
			}
		};
	}
}

Wrapped.addConfig('field', FieldConfig);
