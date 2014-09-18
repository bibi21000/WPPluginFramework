<?php
/**
* 
*/

namespace WPPFW\MVC\Controller;

#Imports
use WPPFW\MVC;

/**
* 
*/
abstract class Base extends MVC\Unit implements IController, MVC\IMVCServiceManager {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $service;
	
	/**
	* put your comment there...
	* 
	* @param MVC\IMVCServiceManager $serviceManager
	* @param mixed $structure
	* @param mixed $target
	* @return Base
	*/
	protected function __construct(MVC\IMVCServiceManager & $serviceManager, & $structure, & $target) {
		# Parent
		parent::__construct($structure, $target);
		# Initialize
		$this->service =& $serviceManager;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & dispatch() {
		# Initialize
		$target =& $this->getTarget();
		# Get method name
		$actionMethod = strtolower($target->getAction()) . 'Action';
		# Check existance
		if (!method_exists($this, $actionMethod)) {
			throw new \Exception('Controller action doesn\'t exists!');
		}
		# Call action
		$result = $this->$actionMethod();
		# Creating responder
		$responder = $this->getResponder($result);
		# Return responder
		return $responder;
	}
	
	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getForm($name = null) {
		return $this->getService()->getForm($name);
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getModel($name = null) {
		return $this->getService()->getModel($name);
	}

	/**
	* put your comment there...
	* 
	* @param mixed $result
	*/
	protected abstract function getResponder(& $result);
	
	/**
	* put your comment there...
	* 
	*/
	public function & getService() {
		return $this->service;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getTable($name = null) {
		return $this->getService()->getTable($name);
	}

} # End class
