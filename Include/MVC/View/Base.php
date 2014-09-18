<?php
/**
* 
*/

namespace WPPFW\MVC\View;

# Imports
use WPPFW\MVC;

/**
* 
*/
abstract class Base extends MVC\Unit implements MVC\IMVCResponder {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $result;
	
	/**
	* put your comment there...
	* 
	* @param MVC\MVCViewStructure $structure
	* @param {MVC\MVCViewParams|MVC\MVCViewStructure} $target
	* @param mixed $result
	* @return Base
	*/
	public function __construct(MVC\MVCViewStructure & $structure, MVC\MVCViewParams & $target, & $result) {
		# Unit intialization
		parent::__construct($structure, $target);
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

