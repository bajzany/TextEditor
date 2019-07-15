<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

use Nette\Utils\Html;

interface IType
{

	/**
	 * @param string $content
	 * @param array $args
	 * @return mixed
	 */
	public function saveContent(string $content, array $args = []);

	/**
	 * @param array $args
	 * @param array $argsPrivate
	 * @return string
	 */
	public function loadData(array $args = [], array $argsPrivate = []): string;

	/**
	 * @param Html $wrapped
	 * @return void
	 */
	public function onBuildWrapped(Html $wrapped): void;

	/**
	 * @return bool
	 */
	public function hasPermission(): bool;

}
