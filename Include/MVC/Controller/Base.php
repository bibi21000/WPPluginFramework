<?php
/**
* 
*/

namespace WPPFW\MVC\Controller;

# Improts
use WPPFW\MVC;

/**
* 
*/
abstract class Base extends MVC\MVCComponenetsLayer implements IController {

	/**
	* put your comment there...
	* 
	*/
	public function & dispatch() {
		# Initialize
		$target =& $this->getTarget();
		$serviceManager =& $this->getMVCServiceManager();
		# Get method name
		$actionMethod = strtolower($target->getAction()) . 'Action';
		# Check existance
		if (!method_exists($this, $actionMethod)) {
			throw new \Exception('Controller action doesn\'t exists!');
		}
		# Call action
		$result = $this->$actionMethod();
		# Write model(s) state
		foreach ($serviceManager->getModels() as $model) {
			# Write model state
			$model->writeState();
		}
		$this->dispatched();
		# Creating responder
		$responder = $this->getResponder($result);
		# Return responder
		return $responder;
	}
	
	/**
	* put your comment there...
	* 
	*/
	protected function dispatched() {;}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getInput() {
		return $this->getMVCServiceManager()->getInput();
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getFactory() {
		return $this->getMVCServiceManager()->getFactory();
	}
	
	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getForm($name = null) {
		return $this->getMVCServiceManager()->getForm($name);
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getModel($name = null) {
		return $this->getMVCServiceManager()->getModel($name);
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getModels() {
		return $this->getMVCServiceManager()->getModels();
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
	public function & getStructure() {
		return $this->getMVCServiceManager()->getStructure();
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getTable($name = null) {
		return $this->getMVCServiceManager()->getTable($name);
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getTarget() {
		return $this->getMVCServiceManager()->getTarget();
	}

} # End class
