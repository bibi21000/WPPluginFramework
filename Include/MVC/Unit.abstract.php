<?php
/**
* 
*/

namespace WPPFW\MVC;

/**
* 
*/
abstract class Unit {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $structure;
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $target;
	
	/**
	* put your comment there...
	* 
	* @param mixed $structure
	* @param mixed $target
	* @return Unit
	*/
	protected function __construct(& $structure, & $target) {
		# Initialize
		$this->structure =& $structure;
		$this->target =& $target;
	}
  
	/**
	* put your comment there...
	* 
	*/
	public function & getStructure() {
		return $this->structure;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getTarget() {
		return $this->target;
	}
	
}

