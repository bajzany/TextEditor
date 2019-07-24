<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

use Bajzany\TextEditor\Exceptions\TextEditorException;

use Nette\DI\Container;

class EditorManager
{

	const TAG_TYPE = 'ckEditor';

	/**
	 * @var IType[]
	 */
	private $types = [];

	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	public function initial()
	{
		$builds = $this->container->findByTag(self::TAG_TYPE);
		foreach ($builds as $name => $type) {
			$service = $this->container->getService($name);
			if (!$service instanceof IType) {
				throw TextEditorException::listenerIsNotInstanceIEventSubscriber(get_class($service));
			}
			$this->types[$type] = $service;
		}
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
