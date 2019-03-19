## Text Editor


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
        	const BLOCK_NAME = 'textBlockClassic';
        
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
        
        	/**
        	 * @return string|null
        	 */
        	public function getConfigFile(): ?string
        	{
        		return __DIR__ . '/textBlockClassicConfig.js';
        	}
        }

- Now important is create config file for you new Type. Etc. textBlockClassicConfig.js

	Name config must be same as const BLOCK_NAME in php file. 'textBlockClassic' + Config.
	In this config first be call initial() function, next one be configure(), and last one bind().
	editorType: 'replace or inline'

		(function() {
        	if (typeof window.CK_EDITOR_CONFIG === "undefined") {
        		window.CK_EDITOR_CONFIG = {};
        	}
        
        	var textBlockClassicConfig = {
        		editorType: 'replace',
        		initial: function(ckEditor, item, type){
        			var url = item.getAttribute('data-link');
        			var args = item.getAttribute('data-args');
        			.... 
        			....
        			ETC. AJAX REQUEST FOR SAVE

        		},
        		configure: function(){
        			return {
        				removePlugins : "easyimage, cloudservices",
        			};
        		},
        		bind: function(editor, item){
        
        		},
        	};
        	window.CK_EDITOR_CONFIG.textBlockClassicConfig = textBlockClassicConfig;
        })();
        
        
- In .latte call this new type like this, first parameter is name of type, and last parameter array for  function loadData(array $args = []) and function saveContent(string $content, array $args = [])


	{control ckEditor, Bundles\TextBlock\Model\CkEditorClassic::BLOCK_NAME, 		['name' => $textBlock->getName()]}
