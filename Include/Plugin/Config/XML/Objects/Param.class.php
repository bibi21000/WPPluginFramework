<?php
/**
* 
*/

namespace WPPFW\Plugin\Config\XML;

# Imports
use WPPFW\HDT\XML\XMLWriterPrototype;

/**
* 
*/
class ObjectParamPrototype extends XMLWriterPrototype {
	
	/**
	* put your comment there...
	* 
	*/
	public function & processIn() {
		# Initialize
		$node =& $this->getDataSource();
		$result =& $this->getResult();
		$reader =& $this->getReaderPrototype();
		$object =& $this->getParent();
		$objectResult =& $object->getResult();
		# Get attributes as array
		$attributes = $reader->getAttributesArray($node);
		$result = array($attributes['name'] => $attributes['value']);
		# Push to parent object
		$objectResult = array_merge($objectResult, $this->result);
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function & processOut() {}

}
