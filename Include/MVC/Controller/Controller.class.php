<?php
/**
* 
*/

namespace WPPFW\MVC\Controller;

# imports
use WPPFW\MVC;
use WPPFW\Obj\IFactory;

/**
* 
*/
abstract class Controller extends Base {
	
	/**
	* put your comment there...
	* 
	* @param IFactory $factory
	* @param {IFactory|MVC\IMVCServiceManager} $serviceManager
	* @param {IFactory|MVC\IMVCServiceManager|MVC\MVCViewStructure} $structure
	* @param {IFactory|MVC\IMVCServiceManager|MVC\MVCViewParams|MVC\MVCViewStructure} $target
	* @return {Controller|IFactory|MVC\IMVCServiceManager|MVC\MVCViewParams|MVC\MVCViewStructure}
	*/
	public function __construct(IFactory & $factory,
															MVC\IMVCServiceManager & $serviceManager, 
															MVC\MVCViewStructure & $structure, 
															MVC\MVCViewParams & $target) {
		# Unit intialization
		parent::__construct($factory, $serviceManager, $structure, $target);
	}
	
	/**
	* put your comment there...
	* 
	* @param mixed $result
	*/
	public function getResponder(& $result) {
		# Initialize
		$structure =& $this->getStructure();
		$target =& $this->getTarget();
		# Getting view class components
		$viewClass[] = '';
		$viewClass[] = $structure->getRootNS()->getNamespace();
		$viewClass[] = $structure->getModule(); # Module(s) namespave
		$viewClass[] = $target->getModule();  # Module name
		$viewClass[] = $structure->getView(); # View(s) Namespace
		$viewClass[] = $target->getView();
		$viewClass[] = implode('', array($target->getView(), $target->getFormat(), $structure->getViewClassId())); # Controller name
		# View class
		$viewClass = implode('\\', $viewClass);
		# Creating view
		$view = new $viewClass($this->getFactory(), $structure, $target, $result);
		# Returning view
		return $view;
	}

} # End class
