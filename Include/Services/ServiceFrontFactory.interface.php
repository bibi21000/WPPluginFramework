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
	public function & createServiceFront(& $serviceObject);
	
	/**
	* 
	*/
	public function & dispatch(IDispatcher & $serviceFront);
	
}
