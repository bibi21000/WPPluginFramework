<?php
/**
* 
*/

namespace WPPFW\MVC\Form;

# Array Iterator
use WPPFW\Collection\ArrayIterator;

/**
* 
*/
class ElementsCollection extends ArrayIterator {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $elements = array();

	/**
	* put your comment there...
	* 
	*/
	public function __construct() {
		# Iterator
		parent::__construct($this->elements);
	}
	
	/**
	* put your comment there...
	* 
	* @param IElement $element
	* @return IElement
	*/
	public function & add(IElement & $element) {
		# Add element
		$this->elements[] =& $element;
		# Chain
		return $element;
	}
	
	/**
	* put your comment there...
	* 
	* @param IElement $element
	* @return IElement
	*/
	public function & addChain(IElement & $element) {
		# Add element
		$this->elements[] =& $element;
		# Chain
		return $this;
	}

}