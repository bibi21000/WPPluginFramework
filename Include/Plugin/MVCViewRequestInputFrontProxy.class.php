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
class MVCViewRequestInputFrontProxy implements IServiceFrontProxy {
	
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
		$mvcParams = new MVC\MVCViewParams(
			$defParams->module, 
			$defParams->controller, 
			$defParams->action, 
			$defParams->format,
			$defParams->view,
			$defParams->layout
			);
		$mvcStructure = new MVC\MVCViewStructure(
			$namespace,
			$structure->module, 
			$structure->controller, 
			$structure->controllerClassId,
			$structure->view,
			$structure->viewClassId
			);
		$mvcNames = new MVC\MVCViewParams(
			$defNames->module, 
			$defNames->controller, 
			$defNames->action, 
			$defNames->format,
			$defNames->view,
			$defNames->layout
			);
		# Reading inputs
		$inputsReader = new MVC\MVCViewRequestParamsRouter($namespace->getNamespace(), $inputs->get(), $mvcNames, $mvcParams);
		# Chaining
		return $mvcNames;
	}
}