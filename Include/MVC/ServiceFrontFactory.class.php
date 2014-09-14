<?php
/**
* 
*/

namespace WPPFW\MVC;

# Imports
use WPPFW\Services\IServiceFrontFactory;

/**
* 
*/
class ServiceFrontFactory implements IServiceFrontFactory {

	/**
	* put your comment there...
	* 
	* @param mixed $service
	*/
	public function & load(& $serviceObject) {
		# Getting Service Front Object mapped to service object namespace
		$serviceObjectNamespace = dirname(get_class($serviceObject));
		$serviceFrontName = basename($serviceObjectNamespace);
		$serviceFrontClass = "{$serviceObjectNamespace}\\{$serviceFrontName}";
		# Instantiate Service fron object
		$serviceFront = new $serviceFrontClass($serviceObject);
		# Return service fron
		return $serviceFront;
	}

}
