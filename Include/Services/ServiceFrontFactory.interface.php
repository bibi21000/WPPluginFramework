<?php
/**
* 
*/

namespace WPPFW\Services;

# Imports
use WPPFW\MVC\IDispatcher;

/**
* 
*/
interface IServiceFrontFactory {

	/**
	* 
	*/
	public function & createServiceFront(& $service, & $serviceObject, ProxyBase & $proxy);
	
	/**
	* 
	*/
	public function & dispatch(IDispatcher & $serviceFront);
	
}
