<?php
/**
* 
*/

namespace WPPFW\MVC;

#Imports
use WPPFW\Obj\PHPNamespace;

/**
* 
*/
class MVCViewStructure extends MVCStructure {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $view;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $viewClassId;
	
	/**
	* put your comment there...
	* 
	* @param mixed $rootns
	* @param mixed $module
	* @param mixed $controller
	* @param mixed $controllerClassId
	* @param mixed $view
	* @param mixed $viewClassId
	* @param mixed $viewsPath
	* @return MVCViewStructure
	*/
	public function __construct(PHPNamespace $rootns, $module, $controller, $controllerClassId, $view, $viewClassId) {
		# iNitialize parent
		parent::__construct($rootns, $module, $controller, $controllerClassId);
		# Initialize
		$this->view =& $view;
		$this->viewClassId =& $viewClassId;
	}

	/**
	* put your comment there...
	* 
	*/
	public function getView() {
		return $this->view;
	}

	/**
	* put your comment there...
	* 
	*/
	public function getViewClassId() {
		return $this->viewClassId;
	}
	
}
	