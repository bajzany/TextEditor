<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

class Config
{
	/**
	 * @var string
	 */
	private $bowerDir;

	public function __construct(array $data = [])
	{
		foreach ($data as $key => $value) {
			if (property_exists($this, $key)) {
				$this->{$key} = $value;
			}
		}
	}

	/**
	 * @return string
	 */
	public function getBowerDir(): string
	{
		return $this->bowerDir;
	}
}
