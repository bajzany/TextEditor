<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@alistra.cz
 */

namespace Bajzany\TextEditor\DI;

use Bajzany\TextEditor\EditorManager;
use Bajzany\TextEditor\ITextEditorControl;
use Nette\Application\Application;
use Nette\Configurator;
use Nette\DI\Compiler;
use Nette\DI\CompilerExtension;

class TextEditorExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('manager'))
			->setFactory(EditorManager::class)
			->setInject(TRUE);

		$builder->addDefinition($this->prefix('control'))
			->setImplement(ITextEditorControl::class)
			->setInject(TRUE);
	}

	public function beforeCompile()
	{
		$builder = $this->getContainerBuilder();
		$application = $builder->getDefinitionByType(Application::class);
		$manager = $builder->getDefinitionByType(EditorManager::class);
		$application->addSetup('?->loadAssets()', [$manager]);
	}

	/**
	 * @param Configurator $configurator
	 */
	public static function register(Configurator $configurator)
	{
		$configurator->onCompile[] = function ($config, Compiler $compiler) {
			$compiler->addExtension('textEditor', new TextEditorExtension());
		};
	}

}
