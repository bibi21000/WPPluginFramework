<?php
/**
* 
*/

namespace WPPFW\MVC;

/**
* 
*/
class MVCViewDispatcher extends MVCDispatcher {

	/**
	* put your comment there...
	* 
	* @param MVCViewStructure $structure
	* @param {MVCViewParams|MVCViewStructure} $target
	* @return {MVCViewDispatcher|MVCViewParams|MVCViewStructure}
	*/
	public function __construct(MVCViewStructure & $structure, MVCViewParams & $target) {
		# Direct to parent
		parent::__construct($structure, $target);
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
	