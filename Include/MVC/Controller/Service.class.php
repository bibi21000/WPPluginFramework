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
class ServiceController extends Base {
	
	/**
	* put your comment there...
	* 
	* @param IFactory $factory
	* @param {IFactory|MVC\IMVCServiceManager} $serviceManager
	* @param {IFactory|MVC\IMVCServiceManager|MVC\MVCStructure} $structure
	* @param {IFactory|MVC\IMVCServiceManager|MVC\MVCParams|MVC\MVCStructure} $target
	* @return {ServiceController|IFactory|MVC\IMVCServiceManager|MVC\MVCParams|MVC\MVCStructure}
	*/
	public function __construct(IFactory & $factory, 
															MVC\IMVCServiceManager & $serviceManager, 
															MVC\MVCStructure & $structure, 
															MVC\MVCParams & $target) {
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
		# Getting responder class components
		$responderClass[] = '';
		$responderClass[] = $structure->getRootNS()->getNamespace();
		$responderClass[] = $structure->getModule(); # Module(s) namespave
		$responderClass[] = $target->getModule();  # Module name
		$responderClass[] = $structure->getController(); # Controller(s) Namespace
		$responderClass[] = implode('', array($target->getFormat(), $structure->getControllerClassId(), 'Responder')); # Responder name
		# Responder class
		$responderClass = implode('\\', $responderClass);
		# Creating Responder
		$responder = new $responderClass($result);
		# Returning Responder
		return $responder;
	}

} # End class
