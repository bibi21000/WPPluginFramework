<?php
/**
* 
*/

namespace WPPFW\MVC\Controller;

#Imports
use WPPFW\MVC;
use WPPFW\Obj\IFactory;

/**
* 
*/
abstract class Base extends MVC\DispatcherLayer implements IController, MVC\IMVCServiceManager {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $service;

	/**
	* put your comment there...
	* 
	* @param IFactory $factory
	* @param {IFactory|MVC\IMVCServiceManager} $serviceManager
	* @param mixed $structure
	* @param mixed $target
	* @return Base
	*/
	protected function __construct(IFactory & $factory, MVC\IMVCServiceManager & $serviceManager, & $structure, & $target) {
		# Parent
		parent::__construct($factory, $structure, $target);
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
	*/
	public function & getInput() {
		return $this->getService()->getInput();
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
