<?php
/**
* 
*/

namespace WPPFW\MVC\Service;

# Imports
use WPPFW\MVC\IMVCResponder;
use WPPFW\Http\HTTPResponse;

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
	
	/***
	* put your comment there...
	* 
	* @param HTTPResponse $httpResponse
	* @param mixed $result
	* @return JSONEncoder
	*/
	public function __construct(HTTPResponse & $httpResponse, & $result) {
		# Initialize
		$this->result =& $result;
		# Set http response header
		$httpResponse->setContentType('text/json');
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function __toString() {
		return json_encode($this->result);
	}
	
}