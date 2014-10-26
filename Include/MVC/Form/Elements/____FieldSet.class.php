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
class FieldSetElement extends Form\Element implements Form\IElementsContainer {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $elements;
	
	/**
	* put your comment there...
	* 
	*/
	public function & elements() {
		return $this->elements;
	}
	
	/**
	* put your comment there...
	* 
	*/
	protected function initialize() {
		# Elements collection list
		$this->elements = new Form\ElementsCollection();
	}

}