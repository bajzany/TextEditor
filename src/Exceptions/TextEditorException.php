<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\TextEditor\Exceptions;

use Bajzany\TextEditor\IType;

class TextEditorException extends \Exception
{

	/**
	 * @return TextEditorException
	 */
	public static function listenerIsNotInstanceIEventSubscriber(string $className)
	{
		return new self("Listener '{$className}' is not instance ". IType::class);
	}

}
