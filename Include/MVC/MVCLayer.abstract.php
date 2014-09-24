<?php
/**
* 
*/

namespace WPPFW\MVC;

# Imports
use WPPFW\Obj\IFactory;

/**
* 
*/
abstract class MVCLayer implements IMVCLayer {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $factory;
	
	/**
	* put your comment there...
	* 
	* @param IFactory $factory
	* @return {MVCLayer|IFactory}
	*/
	protected function __construct(IFactory & $factory) {
		# Initialize
		$this->factory =& $factory;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getFactory() {
		return $this->factory;
	}
	
}

