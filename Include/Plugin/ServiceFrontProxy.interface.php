<?php
/**
* 
*/

namespace WPPFW\Plugin;

/**
* 
*/
interface IServiceFrontProxy {
	
	/**
	* 
	*/
	public function & proxy(PluginBase & $input, & $serviceObject);

} 
