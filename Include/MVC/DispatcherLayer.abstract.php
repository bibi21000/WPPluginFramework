<?php
/**
* 
*/

namespace WPPFW\MVC;

#Imports
use WPPFW\Obj\IFactory;

/**
* 
*/
abstract class DispatcherLayer extends MVCLayer {
	
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
	*/
	protected function __construct(IFactory & $factory, & $structure, & $target) {
		# MVC layer
		parent::__construct($factory);
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

