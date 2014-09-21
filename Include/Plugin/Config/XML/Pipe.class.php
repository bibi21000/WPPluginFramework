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
class PluginConfigPipe {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $currentObjectType;
	
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $objects;
	
	/**
	* Receiving objects
	* 
	* @param mixed $object
	*/
	public function addObject(& $object) {
		# Add object / Use object class as key
		$this->objects[$this->currentObjectType][$object['class']] = $object;
		# Chain
		return $this;
	}

	/**
	* put your comment there...
	* 
	* @param mixed $type
	*/
	public function setCurrentObjectType($type) {
		# Set
		$this->currentObjectType = $type;
		# Chain
		return $this;
	}
	
}