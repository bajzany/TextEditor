## Text Editor


### How to install

- First you must download ckeditor4

- Now you can add this line in your header html tag `<script src="{$publicPath}/ckeditor/ckeditor.js"></script>`

- Open text-editor/Config/config.neon.dist in vendor dir and paste in into your config directory

- Register TextEditorFactory in Presenter or Control

		/**
    	 * @var TextEditorFactory @inject
    	 */
    	public $textEditorFactory;
    	
- TextEditor can be used so in form control

		$formField = $this->textEditorFactory->createFormCkField('TextBlockFactory.content');
      $form->addComponent($formField, 'content');
       	 	
    	
    	
- For creating new type of editor, please create this example Class
````php
use Bajzany\TextEditor\IType;
use Bundles\TextBlock\Entity\TextBlock;
use Bundles\User\Entity\Role;
use Chomenko\AutoInstall\AutoInstall;
use Chomenko\AutoInstall\Config\Tag;
use Bajzany\TextEditor\EditorManager;
use Nette\Security\User;

/**
 * @Tag({EditorManager::TAG_TYPE=CkEditorClassic::BLOCK_NAME})
 */
class CkEditorClassic implements AutoInstall, IType
{
	const BLOCK_NAME = 'CoreTextBlockInline';

	public function saveContent(string $content, array $args = [])
	{
		
	}

	/**
	 * @param array $args
	 * @return string
	 */
	public function loadData(array $args = []): string
	{
		
	}

	/**
	 * @return bool
	 */
	public function hasPermission(): bool
	{
		
	}
}
````    
- Now important is const BLOCK_NAME this name must be set into js className 

	In this config first be call configure(), and last one bind().
	editorType: 'classic or inline'

````javascript
import {Config, Wrapped} from 'textEditor';
import {validateUrl} from 'Stage';

export class CoreTextBlockInline extends Config {

	getEditorType() {
		return 'inline';
	}

	bind(editor, item, type) {
		
		editor.on('focus', function() {$("#ckeoptions").show();});
		editor.on('blur', function() {$("#ckeoptions").hide();});
		editor.setKeystroke﻿([
			[ window.CKEDITOR.CTRL + 83, 'save' ],
		]);
        
		editor.addCommand( 'save',
			{
				modes : { wysiwyg:1, source:1 },
				exec : function( editor ) {
					const url = item.getAttribute('data-link');
					const type = item.getAttribute('data-type');
					const args = item.getAttribute('data-args');
					const url_string = validateUrl(url);
					const UrlObject = new URL(url_string);
					$.ajax({
						type: 'POST',
						url: UrlObject.toString(),
						data: {
							content: editor.getData(),
							type: type,
							args: args,
						},
					});
				}
			}
		);
		editor.ui.addButton( 'Save',{label : 'Uložit',command : 'save'});
	}
	configure() {
		return {
			sharedSpaces: {
				top: 'ckeoptions',
			}
		};
	}
}

Wrapped.addConfig('CoreTextBlockInline', CoreTextBlockInline);
````     

##### Load js file with npm @nettpack/core package.

##### Process: 

- For including this json file must be use this config in composer.json
````json
{
.......
.......
 "extra": {
    "nettpack": {
      "resolve": {
        "customName": "./src/Assets/main.js"
      }
    }
  }
}
```` 

- main.js file... Path to your config.

````javascript

export * from './CoreTextBlockInline'

````    

- Now you can insert it to webpack build in /app/ModuleName/Assets/app.js

````javascript

if (module.hot) {
	module.hot.accept();
}
import {App} from "Stage";

function importAll (r) {
	r.keys().forEach(r);
}
importAll(require.context('../', true, /\.(js|css|less|png|gif)$/));

//...............
//...............
//...............
// YOUR PACKAGE NAME
import "customName";
//...............
//...............
//...............

$(document).ready(function () {
	App.run();
});

```` 

In .latte call this new type like this, first parameter is name of type, and last parameter array for  function loadData(array $args = []) and function saveContent(string $content, array $args = [])



	{control ckEditor, Bundles\TextBlock\Model\CkEditorClassic::BLOCK_NAME, ['name' => $textBlock->getName()]}
