
<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor;

use Doctrine\Common\EventManager;
use Nette\DI\Container;

class EditorManager
{

	const TAG_TYPE = 'ckEditor';

	/**
	 * @var EventManager
	 */
	private $eventManager;

	public function __construct(Container $container)
	{
		$this->eventManager = new EventManager();

//		$container->findByTag(self::TAG_TYPE);

		// PREDAT DO EVENT MANAGERU


//		$this->eventManager->addEventSubscriber();


//		if ($this->built) {
//			return;
//		}
//		$installersClass = $configurator->getBundleEvents();
//		foreach ($installersClass as $class) {
//			$event = new $class($configurator, $parameters);
//			if (!$event instanceof EventSubscriber) {
//				throw BundleException::eventMustByInstance($event);
//			}
//			$this->eventManager->addEventSubscriber($event);
//		}
//
//		$this->bundles = $this->loader->getBundles();
//		foreach ($this->bundles as $bundle) {
//			$eventArg = new BuildEventArgs($configurator, $bundle, $parameters);
//			$this->eventManager->dispatchEvent(Events::ON_BUILD, $eventArg);
//		}
//		$this->built = TRUE;
//



	}

}
