<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

use Bajzany\Notify\NotifyTrait;

class TextEditorField extends \Nette\Forms\Controls\TextArea
{

	use NotifyTrait;

	/**
	 * @var EditorManager
	 */
	private $editorManager;

	/**
	 * @var bool
	 */
	private $usedDefaultValue = FALSE;

	public function __construct(EditorManager $editorManager, $label = NULL)
	{
		$this->editorManager = $editorManager;

		parent::__construct($label);
	}

	/**
	 * @return \Nette\Utils\Html
	 */
	public function getControl()
	{
		$el = parent::getControl();
		$class = 'form-control ckEditor';
		if ($this->hasErrors()) {
			$class .= 'is-invalid';
		}
		$el->setAttribute('class', $class);
		$el->setAttribute('data-type', 'field');
		return $el;
	}

	/**
	 * Sets control's default value.
	 * @return static
	 */
	public function setDefaultValue($value)
	{
		parent::setDefaultValue($value);
		$this->usedDefaultValue = TRUE;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isUsedDefaultValue(): bool
	{
		return $this->usedDefaultValue;
	}

}
