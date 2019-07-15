<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

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
	 * @param ITextEditorControl $textEditorControl
	 * @param EditorManager $editorManager
	 */
	public function __construct(ITextEditorControl $textEditorControl, EditorManager $editorManager)
	{
		$this->textEditorControl = $textEditorControl;
		$this->editorManager = $editorManager;
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
