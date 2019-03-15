<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

use Nette\Application\UI\Control;

class TextEditorControl extends Control
{

	/**
	 * @var EditorManager
	 */
	private $editorManager;

	public function __construct(EditorManager $editorManager, $name = NULL)
	{
		$this->editorManager = $editorManager;

		parent::__construct($name);
	}


	public function render($type, array $args = [])
	{

	}

	public function handleSaveContent()
	{

	}


}
