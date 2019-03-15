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
		$typeObject = $this->editorManager->getType($type);
		$content = $typeObject->loadData($args);

		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->content = $content;

		$this->template->link = $this->link('SaveContent!');
		$this->template->type = $type;
		$this->template->args = json_encode($args);
		$this->template->render();
	}

	public function handleSaveContent()
	{
		$type = $this->presenter->getRequest()->getPost('type');
		$content = $this->presenter->getRequest()->getPost('content');
		$args = $this->presenter->getRequest()->getPost('args');
		$typeObject = $this->editorManager->getType($type);
		$typeObject->saveContent($content, json_decode($args, true));
	}


}
