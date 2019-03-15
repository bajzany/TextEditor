<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

interface IEvent
{
	/**
	 * @return string
	 */
	public function loadData() : string;

	/**
	 * @return array
	 */
	public function loadConfig() : array;


	public function saveContent();
}
