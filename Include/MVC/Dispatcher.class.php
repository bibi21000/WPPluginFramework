<?php
/**
* 
*/

namespace WPPFW\MVC;

# Imports
use WPPFW\Plugin\Request as RequestInput;
use WPPFW\Obj\IFactory;

/**
* 
*/
class MVCDispatcher extends DispatcherLayer implements IDispatcher, IMVCServiceManager {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $input;
	
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
	* @param IFactory $Factory
	* @param {IFactory|RequestInput} $input
	* @param {IFactory|MVCStructure|RequestInput} $structure
	* @param {IFactory|MVCParams|MVCStructure|RequestInput} $target
	* @return {MVCDispatcher|IFactory|MVCParams|MVCStructure|RequestInput}
	*/
	public function __construct(IFactory & $Factory, RequestInput & $input, MVCStructure & $structure, MVCParams & $target) {
		# Unit intialization
		parent::__construct($Factory, $structure, $target);
		# Intialize
		$this->input =& $input;
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
		$controller = new $controllerClass($this->getFactory(), $this, $structure, $target);
		# Dispatch action
		$responder =& $controller->dispatch();
		# Return responder
		return $responder;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getInput() {
		return $this->input;
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