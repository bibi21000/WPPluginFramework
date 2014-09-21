<?php
/**
* 
*/

namespace WPPFW\Plugin\Config\XML;

# Imports
use WPPFW\HDT\XML\XMLWriterPrototype;;

/**
* 
*/
class ObjectPrototype extends XMLWriterPrototype {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $result;
	
	/**
	* put your comment there...
	* 
	*/
	protected function initializeModel() {
		# Define Result model
		$this->result = array('params' => array());
	}

	/**
	* Inherits parent class parameters
	* 
	*/
	public function & processIn() {
		# Parent params
		$parent =& $this->getParent();
		$parentParams = $parent->getResult();
		$result =& $this->getResult();
		# Merge parent object
		$result = array_merge($result['params'], $parentParams);
	}
	
	/**
	* Collect object parameters
	* 
	*/
	public function & processOut() {
		$result =& $this->getResult(); 
		$node =& $this->getDataSource();
		# Extend
		echo "Class = {$node->attributes()->class}<br>";
		var_dump($result);
		echo "----------------<br>";
	}

}
