<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

use Bajzany\TextEditor\Exceptions\TextEditorException;

use Chomenko\AppWebLoader\AppWebLoader;
use Nette\DI\Container;

class EditorManager
{

	const TAG_TYPE = 'ckEditor';

	/**
	 * @var IType[]
	 */
	private $types = [];

	/**
	 * @var AppWebLoader
	 */
	private $appWebLoader;

	public function __construct(Container $container, AppWebLoader $appWebLoader)
	{
		$builds = $container->findByTag(self::TAG_TYPE);
		foreach ($builds as $name => $type) {
			$service = $container->getService($name);
			if (!$service instanceof IType) {
				throw TextEditorException::listenerIsNotInstanceIEventSubscriber(get_class($service));
			}

			$this->types[$type] = $service;
		}
		$this->appWebLoader = $appWebLoader;
	}

	public function loadAssets()
	{
		$collection = $this->appWebLoader->createCollection('ckEditor');
		$collection->addScript(__DIR__ . '/Asserts/ckeditor.js');
		$collection->addScript(__DIR__ . '/Asserts/ckEditorRun.js');
	}


	/**
	 * @return IType[]
	 */
	public function getTypes(): array
	{
		return $this->types;
	}

	public function getType(string $type): IType
	{
		return $this->types[$type];
	}

}
