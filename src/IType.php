<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

interface IType
{

	public function saveContent(string $content, array $args = []);

	/**
	 * @return array
	 */
	public function loadConfig(): array;

	/**
	 * @param array $args
	 * @return string
	 */
	public function loadData(array $args = []): string;

}
