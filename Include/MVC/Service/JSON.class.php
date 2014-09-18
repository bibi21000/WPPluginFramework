<?php
/**
* 
*/

namespace WPPFW\MVC\Service;

# Imports
use WPPFW\MVC\IMVCResponder;

/**
* 
*/
class JSONEncoder implements IMVCResponder {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $result;
	
	/**
	* put your comment there...
	* 
	* @param mixed $result
	* @return JSONEncoder
	*/
	public function __construct(& $result) {
		# Initialize
		$this->result =& $result;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function __toString() {
		return json_encode($this->result);
	}
	
}