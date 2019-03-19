<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

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
	 * @return string
	 */
	public function loadData(array $args = []): string;

	/**
	 * @return bool
	 */
	public function hasPermission(): bool;

	/**
	 * @return string
	 */
	public function getConfigFile(): ?string;

}
