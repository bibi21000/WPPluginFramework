<?php
/**
* 
*/

namespace WPPFW\Plugin;

# Imports
use \WPPFW\MVC;

/**
* 
*/
class MVCRequestInputFrontProxy implements IServiceFrontProxy {
	
	/**
	* put your comment there...
	* 
	* @param PluginBase $PluginBase
	* @param mixed $serviceObject
	*/
	public function & proxy(PluginBase & $plugin, & $serviceObject) {
		# Initialize
		$config =& $plugin->getConfig();
		$inputs =& $plugin->getInputs();
		$namespace =& $plugin->getNamespace();
		# Get Service Object configuration
		$soc = $config->getServiceObject($serviceObject);
		# Getting objects defauls
		$defParams = $soc->params;
		$defNames = $soc->names;
		$structure = $soc->structure;
		# Creating objects
		$mvcParams = new MVC\MVCParams(
			$defParams->module, 
			$defParams->controller, 
			$defParams->action, 
			$defParams->format
			);
		$mvcStructure = new MVC\MVCStructure(
			$namespace, 
			$structure->module, 
			$structure->controller, 
			$structure->controllerClassId
			);
		$mvcNames = new MVC\MVCParams(
			$defNames->module, 
			$defNames->controller, 
			$defNames->action, 
			$defNames->format
			);
		# Reading inputs
		$inputsReader = new MVC\MVCRequestParamsRouter($namespace->getNamespace(), $inputs->get(), $mvcNames, $mvcParams);
		# Chaining
		return $mvcNames;
	}
}