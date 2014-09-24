<?php
/**
* 
*/

namespace WPPFW\MVC;

# Imports
use \WPPFW\Plugin\Request as RequestInput;
use WPPFW\Obj\IFactory;

/**
* 
*/
class MVCViewDispatcher extends MVCDispatcher {

	/**
	* put your comment there...
	* 
	* @param IFactory $factory
	* @param {IFactory|RequestInput} $input
	* @param {IFactory|MVCViewStructure|RequestInput} $structure
	* @param {IFactory|MVCViewParams|MVCViewStructure|RequestInput} $target
	* @return {MVCViewDispatcher|IFactory|MVCViewParams|MVCViewStructure|RequestInput}
	*/
	public function __construct(IFactory & $factory, RequestInput & $input, MVCViewStructure & $structure, MVCViewParams & $target) {
		# Direct to parent
		parent::__construct($factory, $input, $structure, $target);
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & dispatch() {
		# Initialize
		$target =& $this->getTarget();
		# If not controller specified get it from view
		if (!$target->getController()) {
			$target->setController($target->getView());
		}
		# Dispatching
		return parent::dispatch($target);
	}

}
	