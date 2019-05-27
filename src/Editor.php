<?php
/**
 * Author: Mykola Chomenko
 * Email: mykola.chomenko@dipcom.cz
 */

namespace Bajzany\TextEditor;

use Nette\Utils\Html;

abstract class Editor implements IType
{

	/**
	 * @param string $content
	 * @param array $args
	 * @return mixed|void
	 */
	public function saveContent(string $content, array $args = [])
	{
	}

	/**
	 * @return bool
	 */
	public function hasPermission(): bool
	{
		return TRUE;
	}

	/**
	 * @param Html $wrapped
	 * @return void
	 */
	public function onBuildWrapped(Html $wrapped): void
	{
	}

}
