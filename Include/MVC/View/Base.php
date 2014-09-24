<?php
/**
* 
*/

namespace WPPFW\MVC\View;

# Imports
use WPPFW\MVC;
use WPPFW\Obj\IFactory;

/**
* 
*/
abstract class Base extends MVC\DispatcherLayer implements MVC\IMVCResponder {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $result;
	
	/**
	* put your comment there...
	* 
	* @param IFactory $factory
	* @param {IFactory|MVC\MVCViewStructure} $structure
	* @param {IFactory|MVC\MVCViewParams|MVC\MVCViewStructure} $target
	* @param mixed $result
	* @return Base
	*/
	public function __construct(IFactory & $factory, MVC\MVCViewStructure & $structure, MVC\MVCViewParams & $target, & $result) {
		# Unit intialization
		parent::__construct($factory, $structure, $target);
		# Initialize
		$this->result =& $result;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getResult() {
		return $this->result;
	}
	
}

