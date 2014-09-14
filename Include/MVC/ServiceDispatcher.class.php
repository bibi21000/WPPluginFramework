<?php
/**
* 
*/

namespace WPPFW\MVC;

/**
* 
*/
class ServiceDispatcher extends Dispatcher {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $serviceObject;
	
	/**
	* put your comment there...
	* 
	* @param mixed $serviceObject
	* @return ServiceDispatcher
	*/
	public function __construct(& $serviceObject) {
		# Initialize
		$this->serviceObject =& $serviceObject;	
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getServiceObject() {
		return $this->serviceObject;
	}
	
}