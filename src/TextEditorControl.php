<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

use Bajzany\Notify\Notification;
use Bajzany\Notify\NotifyTrait;
use Nette\Application\UI\Control;
use Nette\Utils\Html;

class TextEditorControl extends Control
{

	use NotifyTrait;

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

		$html = Html::el('div', [
			'data-link' => $this->link('SaveContent!'),
			'data-type' => $type,
			'data-args' => json_encode($args),
		]);

		if ($typeObject->hasPermission()) {
			$html->setAttribute('class', 'ckEditor');
			$html->setAttribute('contenteditable', 'true');
		}

		$html->setHtml($content);
		echo $html->render();
	}

	public function handleSaveContent()
	{
		$type = $this->presenter->getRequest()->getPost('type');
		$content = $this->presenter->getRequest()->getPost('content');
		$args = $this->presenter->getRequest()->getPost('args');
		$typeObject = $this->editorManager->getType($type);

		if (!$typeObject->hasPermission()) {
			$this->addNotify('You dont have permission to save content', 'Error', Notification::TYPE_DANGER);
			return;
		}
		$typeObject->saveContent($content, json_decode($args, true));

		$this->addNotify('Content saved', 'Success', Notification::TYPE_SUCCESS);
	}

}
