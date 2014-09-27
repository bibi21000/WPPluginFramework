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
class MVCDispatcher implements IDispatcher, IMVCServiceManager {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $controller;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $factory;
	
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
	protected $models = array();
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $names;
	
	/**
	* put your comment there...
	* 
	* @var Router
	*/
	protected $router;
	
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
	* @param IFactory $factory
	* @param {IFactory|RequestInput} $input
	* @param {IFactory|MVCStructure|RequestInput} $structure
	* @param {IFactory|MVCParams|MVCStructure|RequestInput} $target
	* @param {IFactory|MVCParams|MVCParams|MVCStructure|RequestInput} $names
	* @param mixed $router
	* @return MVCDispatcher
	*/
	public function __construct(IFactory & $factory, 
															RequestInput & $input, 
															MVCStructure & $structure, 
															MVCParams & $target,
															MVCParams & $names,
															IMVCRouter & $router) {
		# Unit intialization
		$this->factory =& $factory;
		$this->input =& $input;
		$this->structure =& $structure;
		$this->target =& $target;
		$this->names =& $names;
		# Creating router
		$this->router = $router;
	}
	
	/**
	* put your comment there...
	* 
	* @param MVCParams $target
	* @return MVCParams
	*/
	public function & dispatch() {
		# Initialize
		$structure =& $this->structure();
		$target =& $this->target();
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
		$this->controller = new $controllerClass($this);
		# Dispatch action
		$responder =& $this->controller->dispatch();
		# Return responder
		return $responder;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & input() {
		return $this->input;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & factory() {
		return $this->factory;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getController() {
		return $this->controller;
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
		# Init vars
		$target =& $this->target();
		# Use Controller Name for model until another model
		# is being requested
		if (!$name) {
			$name = $target->getController();
		}
		# Creating Model object if not already created
		if (!isset($this->models[$name])) {
			# Initialize vars
			$structure =& $this->structure();
			$namespace =& $structure->getRootNS();
			# Model class
			$modelClass[] = '';
			$modelClass[] = $namespace->getNamespace();
			$modelClass[] = $structure->getModule();
			$modelClass[] = $target->getModule();
			$modelClass[] = $structure->getModel();
			$modelClass[] = implode('', array($name, $structure->getModelClassId()));
			# Getting model instance.
			$this->models[$name] = \WPPFW\MVC\Model\ModelBase::getInstance(implode('\\', $modelClass), $this);
		}
		# Return model
		return $this->models[$name];
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getModels() {
		return $this->models;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & getTable($name = null) {
		
	}

	/**
	* put your comment there...
	* 
	*/
	public function & names() {
		return $this->names;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & router() {
		return $this->router;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & structure() {
		return $this->structure;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & target() {
		return $this->target;
	}
	
}