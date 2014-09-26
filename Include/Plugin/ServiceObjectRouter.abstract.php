<?php
/**
* 
*/

namespace WPPFW\Plugin;

# MVC Router interface
use WPPFW\MVC;
use WPPFW\Services\IReachableServiceObject;
use WPPFW\Obj\CastObject;

/**
* 
*/
abstract class ServiceObjectRouterBase extends MVC\RouterBase implements MVC\IMVCRouter {
	
	/**
	* put your comment there...
	* 
	* @var ServiceObject
	*/
	protected $serviceObject;
	
	/**
	* put your comment there...
	* 
	* @var MVC\MVCParams
	*/
	protected $target;
	
	/**
	* put your comment there...
	* 
	* @param PluginBase $Plugin
	* @param {PluginBase|ServiceObject} $serviceObject
	* @param mixed $serviceConfig
	* @return ServiceObjectRouterBase
	*/
	public function __construct(PluginBase & $Plugin, IReachableServiceObject & $serviceObject, & $serviceConfig) {
		# Initialize vars
		$this->serviceObject =& $serviceObject;
		# Getting MVC Names and Target structures
		$this->createMVCStructures($serviceConfig, $names, $this->target);
		# Router base
		parent::__construct($Plugin->getNamespace()->getNamespace(), $names);
	}

	/**
	* put your comment there...
	* 
	* @param mixed $serviceConfig
	* @param mixed $names
	* @param mixed $target
	*/
	protected abstract function createMVCStructures(& $serviceConfig, & $names, & $target);

	/**
	* put your comment there...
	* 
	*/
	public function & getServiceObject() {
		return $this->serviceObject;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getTarget() {
		return $this->target;
	}
	
	/**
	* put your comment there...
	* 
	* @param MVCViewParams $target
	*/
	protected function gRouter($target) {
		# Initialize vars
		$requestParams = array();
		$names =& $this->getNames();
		# Getting all names
		$namesProperties =& $this->getNamesProperties();
		# Build request params array
		foreach ($namesProperties as $property) {
			# Property name
			$name = $property->getName();
			# Get getter name
			$getterName = $this->getterMethod($name);
			# Create request param, use property prefixed name as key and target as value
			$requestParams[$this->getParamName($names->$getterName())] = $target->$getterName();
		}
		# Service URL
		$url = $this->getServiceObject()->getUrl();
		# Add parameters
		$url->params()->merge(CastObject::getInstance($target)->getArray());
		# Chain
		return $url;
	}
	
	/**
	* put your comment there...
	* 
	* @param mixed $action
	*/
	public function routeAction($action) {
		# Get params object copy.
		$target = clone $this->getTarget();
		# Change action
		$target->setAction($action);
		# Return route
		return $this->gRouter($target);
	}

}