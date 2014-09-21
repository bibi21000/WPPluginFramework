<?php
/**
* 
*/

namespace WPPFW\Services\Dashboard\Ajax;

/**
* 
*/
class AjaxAccessPoint {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $name;
	
	/**
	* put your comment there...
	* 
	*/
	public function __construct()	{
		# Use model name
		$this->useModelName();
	}
	
	/**
	* put your comment there...
	* 
	* @param mixed $name
	*/
	public function & setName($name) {
		# Set
		$this->name =& $name;
		# Chain
		return $this;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function getName() {
		return $this->name;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & useModelName() {
		# Generate model name
		$this->name = strtolower(str_replace('\\', '-', get_class($this)));
		# Chain
		return $this;
	}

}