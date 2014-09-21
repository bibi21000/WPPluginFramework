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
class ObjectPrototype extends XMLWriterPrototype {

	/**
	* put your comment there...
	* 
	*/
	public function getObject() {
		# Object result structure.
		$this->result = $this->getReaderPrototype()->getObjectArrayModel();
		# Parent params
		$parent =& $this->getParent();
		$reader =& $this->getReaderPrototype();
		$parentParams =& $parent->getResult();
		$result =& $this->getResult();
		# Reading object attributes
		$this->result = array_merge($this->result, $reader->getAttributesArray());
		# Merge parent object
		$result['params'] = array_merge($result['params'], $parentParams['params']);
	}
	
	/**
	* Collect object parameters
	* 
	*/
	public function getObjectOut(& $pipe = null) {
		# Piping result
		$pipe->addObject($this->getResult());
	}
	
	/**
	* put your comment there...
	* 
	* @param mixed $pipe
	*/
	public function resolveNamespaces(& $pipe = null) {
		
	}

}
