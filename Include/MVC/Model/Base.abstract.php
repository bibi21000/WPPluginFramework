<?php
/**
* 
*/

namespace WPPFW\MVC\Model;

# Imports
use WPPFW\MVC\MVCLayer;

/**
* 
*/
abstract class ModelBase extends MVCLayer {
	
	/**
	* put your comment there...
	* 
	*/
	public function __sleep() {
		
	}

	/**
	* put your comment there...
	* 
	*/
	public function __walkup() {
		# Unserialization actions here!
		
	}

	/**
	* put your comment there...
	* 
	*/
	public function __destruct() {
		# Write state
		$this->writeState();
	}

	/**
	* put your comment there...
	* 
	* @param mixed $class
	*/
	public static function & getInstance($class) {
		
	}

	/**
	* put your comment there...
	* 
	*/
	public function & writeState() {
		
		# Chain
		return $this;
	}

}

