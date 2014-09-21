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
class ObjectsPrototype extends XMLWriterPrototype {

	/**
	* put your comment there...
	* 
	*/
	public function getObject() {
		# Impersonate Objects as Object so that 
		# First level child object wouldn't fail while
		# it tried to inherits parent properties!
		$this->result = $this->getReaderPrototype()->getObjectArrayModel();
	}

}
