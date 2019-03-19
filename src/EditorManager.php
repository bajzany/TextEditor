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
	/**
	 * @var Container
	 */
	private $container;
	/**
	 * @var Config
	 */
	private $config;

	public function __construct(Container $container, AppWebLoader $appWebLoader, Config $config)
	{
		$this->appWebLoader = $appWebLoader;
		$this->container = $container;
		$this->config = $config;
	}

	public function initial()
	{
		$collection = $this->appWebLoader->createCollection('ckEditor');
		$builds = $this->container->findByTag(self::TAG_TYPE);
		foreach ($builds as $name => $type) {
			$service = $this->container->getService($name);
			if (!$service instanceof IType) {
				throw TextEditorException::listenerIsNotInstanceIEventSubscriber(get_class($service));
			}
			$configFile = $service->getConfigFile();
			$collection->addScript($configFile);
			$this->types[$type] = $service;
		}


		$collection->addScript(__DIR__ . '/Asserts/fieldConfig.js');
		$collection->addScript(__DIR__ . '/Asserts/ckEditorRun.js');
		$collection->addScript($this->config->getBowerDir() . '/ck-editor-ultra-pro/ckeditor.js');
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
