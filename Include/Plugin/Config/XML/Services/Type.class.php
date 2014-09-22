<?php
/**
* 
*/

namespace WPPFW\Plugin\Config\XML\Services;

# Imports
use WPPFW\HDT\XML\XMLWriterPrototype;

/**
* 
*/
class TypePrototype extends XMLWriterPrototype {

	/**
	* put your comment there...
	* 
	*/
	public function getType() {
		# Initialize
		$typesList =& $this->getParentResult();
		$result =& $this->getResult();
		$reader =& $this->getReaderPrototype();
		$pipe =& $this->getPipe();
		# Type attributes
		$result = $reader->getAttributesArray();
		# Add type to types list
		$typesList[$result['name']] =& $result;
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function initialize() {}

}
