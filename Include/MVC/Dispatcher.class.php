<?php
/**
* 
*/

namespace WPPFW\MVC;

/**
* 
*/
class MVCDispatcher extends Unit implements IDispatcher, IMVCServiceManager {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $structure;
	
	/**
	* put your comment there...
	* 
	* @var MVCParams
	*/
	protected $target;
	
	/**
	* put your comment there...
	* 
	* @param MVCParams $structure
	* @return {Dispatcher|MVCParams}
	*/
	public function __construct(MVCStructure & $structure, MVCParams & $target) {
		# Unit intialization
		parent::__construct($structure, $target);
	}
	
	/**
	* put your comment there...
	* 
	* @param MVCParams $target
	* @return MVCParams
	*/
	public function & dispatch() {
		# Initialize
		$structure =& $this->getStructure();
		$target =& $this->getTarget();
		# Getting controller class components
		$controllerClass[] = '';
		$controllerClass[] = $structure->getRootNS()->getNamespace();
		$controllerClass[] = $structure->getModule(); # Module(s) namespave
		$controllerClass[] = $target->getModule();  # Module name
		$controllerClass[] = $structure->getController(); # Controller(s) Namespace
		$controllerClass[] = $target->getController();
		$controllerClass[] = implode('', array($target->getController(), $structure->getControllerClassId())); # Controller name
		# Controller class
		$controllerClass = implode('\\', $controllerClass);
		# Creating controller
		$controller = new $controllerClass($this, $structure, $target);
		# Dispatch action
		$responder =& $controller->dispatch();
		# Return responder
		return $responder;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getForm($name = null) {
		
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getModel($name = null) {
		
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getTable($name = null) {
		
	}

}