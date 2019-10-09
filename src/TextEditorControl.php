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

	/**
	 * @var array
	 */
	private $privateParameters = [];

	/**
	 * @param EditorManager $editorManager
	 * @param null $name
	 */
	public function __construct(EditorManager $editorManager, $name = NULL)
	{
		$this->editorManager = $editorManager;
		parent::__construct($name);
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 */
	public function addPrivateParameter(string $name, $value)
	{
		$this->privateParameters[$name] = $value;
	}

	/**
	 * @return array
	 */
	public function getPrivateParameters()
	{
		return $this->privateParameters;
	}

	public function render($type, array $args = [], array $privateArgs = [])
	{
		$privateArgs = array_merge_recursive($privateArgs, $this->privateParameters);
		$typeObject = $this->editorManager->getType($type);

		$html = Html::el('div', [
			'data-link' => $this->link('SaveContent!'),
			'data-type' => $type,
			'data-args' => json_encode($args),
		]);

		if ($typeObject->hasPermission()) {
			$html->setAttribute('class', 'ckEditor');
		}

		$typeObject->onBuildWrapped($html);
		$content = $typeObject->loadData($args, $privateArgs);
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
		$typeObject->saveContent($content, json_decode($args, TRUE));

		$this->addNotify('Content saved', 'Success', Notification::TYPE_SUCCESS);
	}

}
