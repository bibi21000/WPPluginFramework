<?php
/**
* 
*/

namespace WPPFW\MVC\Form\Elements;

# Input element 
use WPPFW\MVC\Form;

/**
* 
*/
class StructuredElement extends Form\Elements\FieldSetElement implements Form\IElementsStructure {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $name;
	
	/**
	* put your comment there...
	* 
	* @param mixed $id
	* @param mixed $name
	* @return StructuredElement
	*/
	public function __construct($id, $name) {
		# Intialize FieldSet ELement
		parent::__construct($id);
		# Initialize 
		$this->name =& $name;
	}

	/**
	* put your comment there...
	* 
	*/
	public function getName() {
		return $this->name;
	}
	
}