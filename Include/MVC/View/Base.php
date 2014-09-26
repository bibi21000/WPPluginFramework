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
abstract class Base extends MVC\MVCComponenetsLayer implements MVC\IMVCResponder {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $result;
	
	/**
	* put your comment there...
	* 
	* @param MVC\IMVCServiceManager $serviceManager
	* @param mixed $result
	* @return Base
	*/
	public function __construct(MVC\IMVCServiceManager & $serviceManager, & $result) {
		# Unit intialization
		parent::__construct($serviceManager);
		# Initialize
		$this->result =& $result;
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getFactory() {
		return $this->getMVCServiceManager()->getFactory();
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getResult() {
		return $this->result;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getStructure() {
		return $this->getMVCServiceManager()->getStructure();
	}

	/**
	* put your comment there...
	* 
	*/
	public function & getTarget() {
		return $this->getMVCServiceManager()->getTarget();
	}

}

