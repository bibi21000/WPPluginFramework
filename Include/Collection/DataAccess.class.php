<?php
/**
* 
*/

namespace WPPFW\Collection;

/**
* 
*/
class DataAccess implements IDataAccess {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $data = array();
	
	/**
	* put your comment there...
	* 
	* @param mixed $data
	* @return DataAccess
	*/
	public function __construct(& $data = null) {
		# Initialize
		if ($data !== null) {
			$this->data =& $data;	
		}
	}
  
	/**
	* 
	*/
	public function get($name) {
		return isset($this->data[$name]) ? $this->data[$name] : null;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & getArray() {
		return $this->data;
	}
	
}