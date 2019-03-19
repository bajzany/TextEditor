<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

use Chomenko\AppWebLoader\AppWebLoader;

class TextEditorFactory
{

	/**
	 * @var ITextEditorControl
	 */
	private $textEditorControl;

	/**
	 * @var EditorManager
	 */
	private $editorManager;

	/**
	 * @var AppWebLoader
	 */
	private $appWebLoader;

	/**
	 * @param ITextEditorControl $textEditorControl
	 * @param EditorManager $editorManager
	 * @param AppWebLoader $appWebLoader
	 */
	public function __construct(ITextEditorControl $textEditorControl, EditorManager $editorManager, AppWebLoader $appWebLoader)
	{
		$this->textEditorControl = $textEditorControl;
		$this->editorManager = $editorManager;
		$this->appWebLoader = $appWebLoader;
	}

	/**
	 * @return TextEditorControl
	 */
	public function createCkEditor()
	{
		return $this->textEditorControl->create();
	}

	/**
	 * @param string $label
	 * @return TextEditorField
	 */
	public function createFormCkField(string $label = NULL)
	{
		return new TextEditorField($this->editorManager, $label);
	}


}
